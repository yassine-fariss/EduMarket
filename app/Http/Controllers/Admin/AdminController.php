<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'customers' => User::where('is_admin', false)->count(),
            'orders' => Order::count(),
            'revenue' => Order::where('status', 'completed')->sum('total'),
        ];

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        $lowStockProducts = Product::with('category:id,name')
            ->where('stock', '<', 5)
            ->orderBy('stock')
            ->take(10)
            ->get();

        $monthlySales = Order::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw('SUM(total) as total'),
            DB::raw('COUNT(*) as count'),
        )
            ->where('created_at', '>=', now()->subMonths(12))
            ->where('status', '!=', 'cancelled')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy('month')
            ->get();

        $months = [];
        $totals = [];
        $counts = [];

        foreach ($monthlySales as $row) {
            $months[] = Carbon::createFromFormat('Y-m', $row->month)->translatedFormat('M Y');
            $totals[] = (float) $row->total;
            $counts[] = (int) $row->count;
        }

        $mostSold = OrderItem::select(
            'product_id',
            DB::raw('SUM(quantity) as total_qty'),
            DB::raw('SUM(subtotal) as total_revenue'),
        )
            ->whereHas('order', fn ($q) => $q->where('status', '!=', 'cancelled'))
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(10)
            ->with('product.category')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentOrders',
            'lowStockProducts',
            'months',
            'totals',
            'counts',
            'mostSold',
        ));
    }
}

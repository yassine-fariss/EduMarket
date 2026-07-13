<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $orderCounts = $user->orders()
            ->selectRaw("COUNT(*) as total")
            ->selectRaw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending")
            ->selectRaw("SUM(CASE WHEN status = 'processing' THEN 1 ELSE 0 END) as processing")
            ->selectRaw("SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed")
            ->selectRaw("SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled")
            ->first();

        $stats = [
            'total' => $orderCounts->total ?? 0,
            'pending' => $orderCounts->pending ?? 0,
            'processing' => $orderCounts->processing ?? 0,
            'completed' => $orderCounts->completed ?? 0,
            'cancelled' => $orderCounts->cancelled ?? 0,
        ];

        $recentOrders = $user->orders()
            ->withSum('items as total_qty', 'quantity')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('user', 'stats', 'recentOrders'));
    }
}

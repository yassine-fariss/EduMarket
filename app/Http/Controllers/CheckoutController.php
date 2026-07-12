<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        private readonly CartService $cart
    ) {}

    public function index(): View|\Illuminate\Http\RedirectResponse
    {
        $items = $this->cart->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('warning', 'Votre panier est vide.');
        }

        return view('checkout.index', compact('items'));
    }

    public function store(Request $request): RedirectResponse
    {
        $items = $this->cart->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'shipping_address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:100'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'payment_method' => ['required', 'string', 'in:cash_on_delivery'],
            '_token' => ['required', 'string'],
        ]);

        $duplicateKey = 'checkout_submitted_' . md5(serialize($items->toArray()));

        if ($request->session()->has($duplicateKey)) {
            return redirect()->route('cart.index')
                ->with('error', 'Cette commande a déjà été soumise.');
        }

        DB::beginTransaction();

        try {
            $total = $this->cart->total();

            $order = Order::create([
                'user_id' => $request->user()->id,
                'full_name' => $validated['full_name'],
                'phone' => $validated['phone'],
                'shipping_address' => $validated['shipping_address'],
                'city' => $validated['city'],
                'notes' => $validated['notes'] ?? null,
                'payment_method' => $validated['payment_method'],
                'total' => $total,
                'status' => 'pending',
            ]);

            foreach ($items as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    DB::rollBack();
                    return redirect()->route('cart.index')
                        ->with('error', "Stock insuffisant pour {$product->title}. ({$product->stock} disponible(s))");
                }

                $product->decrement('stock', $item['quantity']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => round($item['price'] * $item['quantity'], 2),
                ]);
            }

            DB::commit();

            $request->session()->put($duplicateKey, true);
            $this->cart->clear();

            return redirect()->route('checkout.confirmation', $order)
                ->with('success', 'Votre commande a été confirmée !');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('checkout.index')
                ->with('error', 'Une erreur est survenue lors de la commande. Veuillez réessayer.');
        }
    }

    public function confirmation(Order $order): View
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('checkout.confirmation', compact('order'));
    }
}

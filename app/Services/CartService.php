<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const SESSION_KEY = 'cart';

    public function get(): Collection
    {
        $sessionItems = Session::get(self::SESSION_KEY, []);

        if (empty($sessionItems)) {
            return collect();
        }

        $productIds = collect($sessionItems)->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        return collect($sessionItems)
            ->map(function (array $item) use ($products) {
                $product = $products->get($item['product_id']);
                if (!$product) {
                    return null;
                }

                return [
                    'product_id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'price' => (float) $product->price,
                    'quantity' => $item['quantity'],
                    'stock' => $product->stock,
                    'image' => $product->image,
                ];
            })
            ->filter()
            ->values();
    }

    public function count(): int
    {
        $sessionItems = Session::get(self::SESSION_KEY, []);

        return collect($sessionItems)->sum('quantity');
    }

    public function total(): float
    {
        return round($this->get()->sum(fn (array $item) => $item['price'] * $item['quantity']), 2);
    }

    public function subtotal(int $productId): float
    {
        $item = collect(Session::get(self::SESSION_KEY, []))
            ->firstWhere('product_id', $productId);

        if (!$item) {
            return 0;
        }

        $product = Product::find($productId);

        return $product ? round((float) $product->price * $item['quantity'], 2) : 0;
    }

    public function add(Product $product, int $quantity = 1): array
    {
        $items = collect(Session::get(self::SESSION_KEY, []));
        $existing = $items->firstWhere('product_id', $product->id);

        $currentQty = $existing ? $existing['quantity'] : 0;
        $newQty = $currentQty + $quantity;

        if ($newQty > $product->stock) {
            return [
                'success' => false,
                'message' => "Stock insuffisant. {$product->stock} unité(s) disponible(s).",
            ];
        }

        $items = $items->reject(fn (array $item) => $item['product_id'] === $product->id);
        $items->push(['product_id' => $product->id, 'quantity' => $newQty]);

        Session::put(self::SESSION_KEY, $items->values()->toArray());

        if (Auth::check()) {
            $this->syncSessionToDatabase();
        }

        return [
            'success' => true,
            'message' => "{$product->title} ajouté au panier.",
            'count' => $this->count(),
            'total' => $this->total(),
        ];
    }

    public function updateQuantity(int $productId, int $quantity): array
    {
        $items = collect(Session::get(self::SESSION_KEY, []));
        $existing = $items->firstWhere('product_id', $productId);

        if (!$existing) {
            return ['success' => false, 'message' => 'Produit introuvable dans le panier.'];
        }

        $product = Product::find($productId);

        if ($quantity > ($product?->stock ?? 0)) {
            return [
                'success' => false,
                'message' => "Stock insuffisant. " . ($product?->stock ?? 0) . " unité(s) disponible(s).",
            ];
        }

        if ($quantity < 1) {
            return $this->remove($productId);
        }

        $items = $items->reject(fn (array $item) => $item['product_id'] === $productId);
        $items->push(['product_id' => $productId, 'quantity' => $quantity]);

        Session::put(self::SESSION_KEY, $items->values()->toArray());

        if (Auth::check()) {
            $this->syncSessionToDatabase();
        }

        return [
            'success' => true,
            'message' => 'Quantité mise à jour.',
            'count' => $this->count(),
            'total' => $this->total(),
            'subtotal' => $this->subtotal($productId),
        ];
    }

    public function remove(int $productId): array
    {
        $items = collect(Session::get(self::SESSION_KEY, []))
            ->reject(fn (array $item) => $item['product_id'] === $productId);

        Session::put(self::SESSION_KEY, $items->values()->toArray());

        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();
        }

        return [
            'success' => true,
            'message' => 'Produit retiré du panier.',
            'count' => $this->count(),
            'total' => $this->total(),
        ];
    }

    public function clear(): array
    {
        Session::forget(self::SESSION_KEY);

        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        }

        return [
            'success' => true,
            'message' => 'Panier vidé.',
            'count' => 0,
            'total' => 0,
        ];
    }

    public function hasItem(int $productId): bool
    {
        return collect(Session::get(self::SESSION_KEY, []))
            ->contains('product_id', $productId);
    }

    public function mergeSessionToDatabase(): void
    {
        if (!Auth::check()) {
            return;
        }

        $sessionItems = Session::get(self::SESSION_KEY, []);

        if (empty($sessionItems)) {
            return;
        }

        foreach ($sessionItems as $item) {
            $cartItem = CartItem::firstOrNew([
                'user_id' => Auth::id(),
                'product_id' => $item['product_id'],
            ]);
            $cartItem->quantity += $item['quantity'];
            $cartItem->save();
        }

        // Do NOT clear session cart — session (cookie) is the primary store,
        // DB is just a sync target. Clearing would lose the cart on cross-instance redirects.
    }

    private function syncSessionToDatabase(): void
    {
        $sessionItems = Session::get(self::SESSION_KEY, []);

        CartItem::where('user_id', Auth::id())->delete();

        foreach ($sessionItems as $item) {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ]);
        }
    }
}

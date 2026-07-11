<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const SESSION_KEY = 'cart';

    private function sessionCart(): Collection
    {
        return collect(Session::get(self::SESSION_KEY, []));
    }

    private function databaseCart(): Collection
    {
        return CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get()
            ->map(fn (CartItem $item) => [
                'product_id' => $item->product_id,
                'title' => $item->product->title,
                'slug' => $item->product->slug,
                'price' => (float) $item->product->price,
                'quantity' => $item->quantity,
                'stock' => $item->product->stock,
                'image' => $item->product->image,
            ]);
    }

    public function get(): Collection
    {
        return Auth::check() ? $this->databaseCart() : $this->sessionCart();
    }

    public function count(): int
    {
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id())->sum('quantity');
        }

        return $this->sessionCart()->sum('quantity');
    }

    public function total(): float
    {
        if (Auth::check()) {
            $result = CartItem::where('user_id', Auth::id())
                ->join('products', 'cart_items.product_id', '=', 'products.id')
                ->selectRaw('COALESCE(SUM(products.price * cart_items.quantity), 0) as total')
                ->first();

            return round((float) ($result->total ?? 0), 2);
        }

        return round($this->sessionCart()->sum(fn (array $item) => $item['price'] * $item['quantity']), 2);
    }

    public function subtotal(int $productId): float
    {
        if (Auth::check()) {
            $item = CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->with('product')
                ->first();

            return $item ? round((float) $item->product->price * $item->quantity, 2) : 0;
        }

        $item = $this->sessionCart()->firstWhere('product_id', $productId);

        return $item ? round($item['price'] * $item['quantity'], 2) : 0;
    }

    public function add(Product $product, int $quantity = 1): array
    {
        if (Auth::check()) {
            $cartItem = CartItem::firstOrNew([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);

            $newQty = $cartItem->quantity + $quantity;

            if ($newQty > $product->stock) {
                return [
                    'success' => false,
                    'message' => "Stock insuffisant. {$product->stock} unité(s) disponible(s).",
                ];
            }

            $cartItem->quantity = $newQty;
            $cartItem->save();

            return [
                'success' => true,
                'message' => "{$product->title} ajouté au panier.",
                'count' => $this->count(),
                'total' => $this->total(),
            ];
        }

        $items = $this->sessionCart();
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

        $items->push([
            'product_id' => $product->id,
            'title' => $product->title,
            'slug' => $product->slug,
            'price' => (float) $product->price,
            'quantity' => $newQty,
            'stock' => $product->stock,
            'image' => $product->image,
        ]);

        Session::put(self::SESSION_KEY, $items->values()->toArray());

        return [
            'success' => true,
            'message' => "{$product->title} ajouté au panier.",
            'count' => $this->count(),
            'total' => $this->total(),
        ];
    }

    public function updateQuantity(int $productId, int $quantity): array
    {
        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->with('product')
                ->first();

            if (!$cartItem) {
                return ['success' => false, 'message' => 'Produit introuvable dans le panier.'];
            }

            if ($quantity > $cartItem->product->stock) {
                return [
                    'success' => false,
                    'message' => "Stock insuffisant. {$cartItem->product->stock} unité(s) disponible(s).",
                ];
            }

            if ($quantity < 1) {
                return $this->remove($productId);
            }

            $cartItem->quantity = $quantity;
            $cartItem->save();

            return [
                'success' => true,
                'message' => 'Quantité mise à jour.',
                'count' => $this->count(),
                'total' => $this->total(),
                'subtotal' => $this->subtotal($productId),
            ];
        }

        $items = $this->sessionCart();
        $existing = $items->firstWhere('product_id', $productId);

        if (!$existing) {
            return ['success' => false, 'message' => 'Produit introuvable dans le panier.'];
        }

        if ($quantity > $existing['stock']) {
            return [
                'success' => false,
                'message' => "Stock insuffisant. {$existing['stock']} unité(s) disponible(s).",
            ];
        }

        if ($quantity < 1) {
            return $this->remove($productId);
        }

        $items = $items->reject(fn (array $item) => $item['product_id'] === $productId);
        $existing['quantity'] = $quantity;
        $items->push($existing);

        Session::put(self::SESSION_KEY, $items->values()->toArray());

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
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();

            return [
                'success' => true,
                'message' => 'Produit retiré du panier.',
                'count' => $this->count(),
                'total' => $this->total(),
            ];
        }

        $items = $this->sessionCart()->reject(fn (array $item) => $item['product_id'] === $productId);
        Session::put(self::SESSION_KEY, $items->values()->toArray());

        return [
            'success' => true,
            'message' => 'Produit retiré du panier.',
            'count' => $this->count(),
            'total' => $this->total(),
        ];
    }

    public function clear(): array
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        }

        Session::forget(self::SESSION_KEY);

        return [
            'success' => true,
            'message' => 'Panier vidé.',
            'count' => 0,
            'total' => 0,
        ];
    }

    public function hasItem(int $productId): bool
    {
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->exists();
        }

        return $this->sessionCart()->contains('product_id', $productId);
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

        Session::forget(self::SESSION_KEY);
    }
}

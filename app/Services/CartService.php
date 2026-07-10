<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const SESSION_KEY = 'cart';

    public function get(): Collection
    {
        return collect(Session::get(self::SESSION_KEY, []));
    }

    public function count(): int
    {
        return $this->get()->sum('quantity');
    }

    public function total(): float
    {
        return round($this->get()->sum(fn (array $item) => $item['price'] * $item['quantity']), 2);
    }

    public function subtotal(int $productId): float
    {
        $item = $this->get()->firstWhere('product_id', $productId);

        return $item ? round($item['price'] * $item['quantity'], 2) : 0;
    }

    public function add(Product $product, int $quantity = 1): array
    {
        $items = $this->get();
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
        $items = $this->get();
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
        $items = $this->get()->reject(fn (array $item) => $item['product_id'] === $productId);

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
        return $this->get()->contains('product_id', $productId);
    }
}

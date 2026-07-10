<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        $product = Product::factory();
        $price = fake()->randomFloat(2, 5, 100);
        $quantity = fake()->numberBetween(1, 5);
        $subtotal = round($price * $quantity, 2);

        return [
            'order_id' => Order::factory(),
            'product_id' => $product,
            'price' => $price,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
        ];
    }
}

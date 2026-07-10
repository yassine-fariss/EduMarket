<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_number' => 'EDM-' . now()->format('ymd') . '-' . str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'full_name' => fake()->name(),
            'city' => fake()->city(),
            'user_id' => User::factory(),
            'total' => 0,
            'status' => fake()->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'payment_method' => fake()->randomElement(['credit_card', 'paypal', 'bank_transfer', 'cash_on_delivery']),
            'shipping_address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}

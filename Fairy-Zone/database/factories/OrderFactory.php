<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_number' => 'ORD-' . strtoupper($this->faker->bothify('??-#####')),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'shipped', 'delivered', 'cancelled']),
            'total_amount' => $this->faker->randomFloat(2, 10, 100),
            'payment_method' => $this->faker->randomElement(['credit_card', 'cash_on_delivery', 'paypal', 'bank_transfer']),
            'notes' => $this->faker->sentence(),
            'shipping_address' => $this->faker->address(),
            'shipping_name' => $this->faker->name(),
            'shipping_phone' => $this->faker->phoneNumber(),
            'shipping_city' => $this->faker->city(),
            'shipping_state' => $this->faker->state(),
        ];
    }
}

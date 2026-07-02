<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends Factory<UserAddress>
 */
class UserAddressFactory extends Factory
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
            'address' => $this->faker->streetAddress(),
            'label' => $this->faker->randomElement(['Home', 'Work', 'Other']),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'phone' => $this->faker->phoneNumber(),
            'is_default' => $this->faker->boolean(),
        ];
    }
}

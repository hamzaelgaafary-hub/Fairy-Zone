<?php

namespace Database\Factories;

use App\Models\product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            's_code' => $this->faker->unique()->bothify('??-#####'),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'sale_price' => $this->faker->randomFloat(2, 5, 50),
            'stock' => $this->faker->numberBetween(1, 100),
            'is_featured' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
            'category_id' => Category::factory(),

        ];
    }
}

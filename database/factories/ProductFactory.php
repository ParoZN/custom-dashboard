<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'name' => fake()->name(),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 1, 100),
            'stock' => fake()->numberBetween(1, 100),
            'image' => fake()->imageUrl(),
            'category' => fake()->randomElement(['Electronics', 'Clothing', 'Home & Garden', 'Sports & Outdoors', 'Toys & Games']),
            'brand' => fake()->randomElement(['Brand A', 'Brand B', 'Brand C', 'Brand D']),
            'supplier' => fake()->randomElement(['Supplier A', 'Supplier B', 'Supplier C', 'Supplier D']),
            'status' => fake()->randomElement(['Active', 'Inactive']),
            'created_by' => null,
            'updated_by' => null,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        $categories = [
            'electronics',
            'shoes',
            'books'
        ];
        $category = $categories[ array_rand($categories, 1) ];
        $image = '';
        return [
            'title' => fake()->word(),
            'description' => fake()->word(),
            'currency' => 'USD',
            'price' => fake()->randomFloat(1, 200, 500),
            'brand' => fake()->word(),
            'category' => $category,
            'image' => fake()->imageUrl(
                640, // width
                480, // height
                'product'
            )
        ];
    }
}

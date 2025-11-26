<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {    return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'image' => $this->faker->image('public/storage/products', 640, 480, null, false),
            'weight' => $this->faker->numberBetween(100, 2000), // الوزن بالغرام
            'quantity' => $this->faker->numberBetween(1, 100),
            'expiry_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'added_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'category_id' => $this->faker->numberBetween(1, 10),
            'brand_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}

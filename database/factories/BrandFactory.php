<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class BrandFactory extends Factory
{
        protected $model = Brand::class; // ربط الـ Factory بالنموذج

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true), 
            'description'=>$this->faker->sentence(10)
        ];
    }
}

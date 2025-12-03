<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class; // ربط الـ Factory بالنموذج

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true), // اسم المنتج
            'description' => $this->faker->sentence(10), // وصف قصير
            'image' => $this->faker->imageUrl(640, 480, 'food', true), // صورة وهمية
            'weight' => $this->faker->numberBetween(100, 5000), // وزن بالجرام تقريبًا
            'quantity' => $this->faker->numberBetween(1, 100), // الكمية المتوفرة
            'added_date' => $this->faker->date(), // تاريخ الإضافة
            'category_id' => $this->faker->numberBetween(1,50), 
            'brand_id' => $this->faker->numberBetween(1,50),];
    }
}

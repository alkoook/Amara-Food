<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

    User::factory()->create([
            'name' => 'Ahmad Koke',
            'email' => 'kok@kok.kok',
            'password'=>bcrypt('00000000')
        ]);
        Category::factory()->count(50)->create();
        Brand::factory()->count(50)->create();
        Product::factory()->count(10000)->create();

    }
}
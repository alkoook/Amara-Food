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

    // User::factory()->create([
    //         'name' => 'أحمد كوكة ',
    //         'email' => 'kok@kok.com',
    //         'password'=>bcrypt('00000000')
    //     ]);
  
    // Category::factory()->count(10)->create();
    // Brand::factory()->count(10)->create();
     Product::factory()->count(50)->create();
    
    }
}

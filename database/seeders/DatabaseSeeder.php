<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Brand::factory()->count(10)->create();
        Category::factory()->count(3)->create();
        Product::factory()->count(50)
            ->has(
                Category::factory(), 'categories'
            )
            ->for(
                Brand::factory(), 'brand'
            )
//            ->for(Brand::factory(), 'brand')
            ->create();

//         User::factory(10)->hasPosts(5)->count(5)->create();
//         Post::factory(50)->create();

    }
}

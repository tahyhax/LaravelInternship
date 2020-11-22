<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence(3);
        $slug = Str::slug($name, '-');

        return [
            'sku' => $this->faker->numberBetween(0, 9999999999),
            'name' => $name,
            'slug'=> $slug,
            'description' => $this->faker->paragraphs(4, true),
            'price' => rand(1000, 450000) / 100,
            'brand_id' => $this->getBrandId(),
            'in_stock' => rand(1,25)

        ];
    }


    private function getBrandId()
    {
        $brandIds = Brand::pluck('id')->toArray();
        return Arr::random($brandIds);
    }
}

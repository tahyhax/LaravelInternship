<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = $this->faker->unique()->sentence;
        $slug = Str::slug($name, '-');
        // $file = UploadedFile::fake()->image('product.png', 600, 600);

        return [
            'sku' => $this->faker->numberBetween(0, 9999999999),
            'name' => $name,
            'description' => $this->faker->paragraphs(4, true),
            'slug'=> $slug,
            //'cover' => $file->store('products', ['disk' => 'public'])
            'description' => $this->faker->paragraph,
            'price' => rand(1000, 450000) / 100,

        ];
    }
}

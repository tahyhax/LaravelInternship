<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->company;
        $slug = Str::slug($name, '-');

        return [
            'name' => $name,
            'description' => $this->faker->paragraphs(4, true),
            'slug'=> $slug,

        ];
    }
}

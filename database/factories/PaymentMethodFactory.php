<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       $name =  $this->faker->randomElement([
           'WU',
           'WT',
           'PayPal'
        ]);
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug
        ];
    }
}

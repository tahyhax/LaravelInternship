<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $paymentMethodId = PaymentMethod::all()->pluck('id')->random();
        $userId = User::all()->pluck('id')->random();

        return [
            'address' => $this->faker->address,
            'status' => 'new',
            'payment_methods_id' => $paymentMethodId,
            'user_id' => $userId

        ];
    }
}

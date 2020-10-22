<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->randomElement([
            'Admin',
            'Manager',
            'ManagerOrder',
        ]);


        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id'=> $this->getRoleId($name)
        ];
    }

    private function getRoleId($name)
    {
        $role = Role::query()->select('id')->where('slug', Str::slug($name))->first();
        return $role ?? 1;
    }



}

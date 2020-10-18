<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(30);
        $slug = Str::slug($title, '-');
        $userId = User::all()->pluck('id')->random();

        return [
            'title' => $title,
            'slug' => $slug,
            'body' => $this->faker->paragraphs(3, true),
            'user_id' => $userId,
            'views' => $this->faker->biasedNumberBetween()

        ];
    }
}

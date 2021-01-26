<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'user_id' => fn () => User::factory()->create()->id,
            'category_slug' => fn () => Category::factory()->create()->slug,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'url' => $this->faker->url,
        ];
    }
}

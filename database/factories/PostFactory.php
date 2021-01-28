<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Provider;
use App\Models\User;
use Arr;
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
        $imageUri = "https://images.test/posts/";
        return [
            // "user_id" => fn() => User::factory()->create()->id,
            "provider_slug" => fn() => Provider::factory()->create()->slug,
            "category_slug" => fn() => Category::factory()->create()->slug,
            "title" => $this->faker->sentence,
            // "content" => $this->faker->paragraph,
            "url" => $this->faker->url,
            "image" => $imageUri . random_int(1, 16) . ".jpg",
            'liked' => 0,
        ];
    }
}

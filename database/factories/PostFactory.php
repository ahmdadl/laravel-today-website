<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Provider;
use App\Models\User;
use Arr;
use Carbon\Carbon;
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
        $hasAuthor = !!random_int(0, 1);
        $imageUri = "https://images.test/posts/";
        $userImagesUri = "https://images.test/users/";
        return [
            "provider_slug" => fn() => Provider::factory()->create()->slug,
            "category_slug" => fn() => Category::factory()->create()->slug,
            "title" => $this->faker->sentence,
            // "content" => $this->faker->paragraph,
            "url" => $this->faker->url,
            "image" => $imageUri . random_int(1, 16) . ".jpg",
            // 'liked' => random_int(1, 1200),
            'author' => $hasAuthor ? $this->faker->name : null,
            'author_img' => $hasAuthor ? $userImagesUri . random_int(1, 8) . ".jpg" : null,
            'author_url' => $hasAuthor ? $this->faker->url . '/byMe' : null,
            'created_at' => (Carbon::parse($this->faker->dateTimeThisMonth))->format('d-m-y') . 'T00:00:00',
        ];
    }
}

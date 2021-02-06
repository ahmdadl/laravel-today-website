<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class PostLikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostLike::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_slug' => fn() => Post::factory()->create()->slug,
            'cookie' => Str::limit(
                bin2hex(random_bytes(PostLike::COOKIE_LENGTH)),
                10,
                '',
            ),
            'ip' => $this->faker->ipv4,
        ];
    }
}

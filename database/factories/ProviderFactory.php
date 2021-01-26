<?php

namespace Database\Factories;

use App\Models\Provider;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Provider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => fn () => User::factory()->create()->id,
            'title' => $this->faker->words(2, true),
            'url' => $this->faker->url,
            'request_url' => '/' . $this->faker->word,
        ];
    }
}

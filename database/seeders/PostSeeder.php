<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\Provider;
use DB;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $categories = Category::all();

        Provider::all()->each(function (Provider $provider) use ($categories) {
            if ($provider->id !== 1) {
                $post = Post::factory()
                    ->count(random_int(10, 31))
                    ->create([
                        'category_slug' => $categories->random()->slug,
                        'provider_slug' => $provider->slug,
                    ]);
                $post->each(
                    fn($p) => PostLike::factory()
                        ->count(random_int(10, 80))
                        ->create(['post_slug' => $p->slug]),
                );
            }
        });

        DB::commit();
    }
}

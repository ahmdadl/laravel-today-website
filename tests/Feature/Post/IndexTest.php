<?php

namespace Tests\Feature\Post;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Str;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public Category $category;
    public Collection $posts;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();
        $this->posts = Post::factory()
            ->count(5)
            ->sequence([
                'category_slug' => $this->category->slug,
            ])
            ->create();
    }

    public function testUserCanSearchForPostsOrProviders()
    {
        $title = $this->posts->shuffle(1)->first()->title;

        $this->get('/?q=' . Str::substr($title, 3, 9))
            ->assertOk()
            ->assertDontSee('we could not found any posts')
            ->assertSee($title)
            ->assertViewIs('posts.by_category');

        $post = $this->posts->shuffle()->first();
        $providerTitle = $post->provider->title;
        $this->get('/?q=' . $providerTitle)
            ->assertOk()
            ->assertDontSee('we could not found any posts in this category')
            ->assertSee($providerTitle)
            ->assertSee($post->title)
            ->assertViewIs('posts.by_category');
    }

    public function testUserWillSeeHomePageIfNoSearchWasAdded()
    {
        $this->get('/')
            ->assertOk()
            ->assertSee($this->posts->last()->title)
            ->assertViewIs('posts.index');
    }
}

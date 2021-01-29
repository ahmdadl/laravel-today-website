<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetPostsByProviderTest extends TestCase
{
    use RefreshDatabase;

    public Provider $provider;
    public Collection $posts;

    protected function setUp(): void
    {
        parent::setUp();

        $this->provider = Provider::factory()->create();
        $this->posts = Post::factory()
            ->count(5)
            ->sequence([
                'provider_slug' => $this->provider->slug,
            ])
            ->create()
            ->sortByDesc('liked');
    }

    public function testUserCanGetPostsByProviderSlug()
    {
        $this->get('/' . $this->provider->slug)
            ->assertOk()
            ->assertViewIs('posts.by_category')
            ->assertSee($this->posts->first()->title);
    }
}

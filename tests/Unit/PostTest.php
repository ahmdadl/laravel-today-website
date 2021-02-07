<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Category $category;
    private Provider $provider;
    private Post $post;

    protected function setUp(): void
    {
        parent::setUp();
    
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->provider = Provider::factory()->create();
        $this->post = Post::factory()->make([
            'category_slug' => $this->category->slug,
            'provider_slug' => $this->provider->slug,
        ]);
    }

    public function testItBelongsToCategory()
    {
        $this->post->save();

        $this->assertNotNull($this->post->category);

        $this->assertEquals(
            $this->category->slug,
            $this->post->category->slug
        );
    }
    
    public function testPostHaveDefaultImage()
    {
        $this->post->image = '';
        $this->post->save();

        $this->assertIsString($this->post->image_url);
    }
    
    public function testPostBelongsToProvider()
    {
        $this->post->save();

        $this->assertNotNull($this->post->provider);

        $this->assertEquals(
            $this->provider->slug,
            $this->post->provider->slug
        );
    }

    public function testPostHasLikes()
    {
        $this->post->save();

        $this->assertNotNull($this->post->likes);

        $this->assertCount(0, $this->post->likes);
    }

    // public function testPostCanBeLikedAndDisliked()
    // {
    //     $this->post->save();
    //     $like = PostLike::factory()->make();

    //     $this->assertCount(0, $this->post->likes);
    //     $this->post->like($like->cookie);
    //     $this->post->refresh();
    //     $this->assertCount(1, $this->post->likes);

    //     $this->post->dislike($like->cookie);
    //     $this->post->refresh();
    //     $this->assertCount(0, $this->post->likes);
    // }
    
    public function testPostHasIsLikedAttr()
    {
        $this->post->save();
        $this->assertFalse($this->post->is_liked);
    }
    
    // public function testPostCanBeLikedOnceBySameCookie()
    // {
    //     $this->post->save();
    //     $like = PostLike::factory()->make();

    //     $this->assertCount(0, $this->post->likes);
    //     $this->post->like($like->cookie);
    //     $this->post->refresh();
    //     $this->assertCount(1, $this->post->likes);

    //     $this->post->like($like->cookie);
    //     $this->post->refresh();
    //     $this->assertCount(1, $this->post->likes);
    // }
    
}

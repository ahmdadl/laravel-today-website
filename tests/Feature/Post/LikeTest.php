<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\PostLike;
use Carbon\Carbon;
use Cookie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use LikeIt;
use Mockery;
use Symfony\Component\BrowserKit\Cookie as BrowserKitCookie;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public Post $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post = Post::factory()->create();
        $this->post = Post::withCount('likes')->find($this->post->id);
    }

    public function testPostCanBeLiked()
    {
        // $this->withoutExceptionHandling();
        $this->postJson('/' . $this->post->slug . '/like', [
            'like' => true,
        ])->assertStatus(201);

        $this->refreshCount(1);
    }

    // public function testPostCanBeDisliked()
    // {
    //     $this->withoutExceptionHandling();

    //     // like
    //     $this->postJson('/' . $this->post->slug . '/like', [
    //         'like' => true,
    //     ])->assertStatus(201);

    //     $this->refreshCount(1);

    //     // dislike
    //     $this->postJson('/' . $this->post->slug . '/like', [])->assertStatus(
    //         201,
    //     );

    //     $this->refreshCount(0);
    // }

    private function refreshCount(?int $expCount = null): void
    {
        $this->post = Post::withCount('likes')->find($this->post->id);

        if (null !== $expCount) {
            $this->assertSame($expCount, $this->post->likes_count);
        }
    }
}

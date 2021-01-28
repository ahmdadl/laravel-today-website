<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public Post $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post = Post::factory()->create();
    }

    public function testPostCanBeLiked()
    {
        // $this->withoutExceptionHandling();
        $this->postJson('/' . $this->post->slug . '/like', [
            'like' => true,
        ])->assertStatus(201);

        $this->post->refresh();
        $this->assertSame(1, $this->post->liked);
    }

    public function testPostCanBeDisliked()
    {
        $this->post->like();

        $this->postJson('/' . $this->post->slug . '/like', [])->assertStatus(
            201,
        );

        $this->post->refresh();
        $this->assertSame(0, $this->post->liked);
    }
}

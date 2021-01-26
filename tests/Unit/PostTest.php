<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Category $category;
    private Post $post;

    protected function setUp(): void
    {
        parent::setUp();
    
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->post = Post::factory()->make([
            'category_slug' => $this->category->slug,
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
    
}

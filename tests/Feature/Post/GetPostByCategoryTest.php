<?php

namespace Tests\Feature\Post;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class GetPostByCategoryTest extends TestCase
{
    use RefreshDatabase;

    const BASE_URI = '/category/';

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

    public function testUndefinedCategoryWillResultNotFound()
    {
        $this->get(self::BASE_URI . 'asdasd-asd')->assertNotFound();
    }

    public function testEmptyCategoryWillShowAlert()
    {
        $cat = Category::factory()->create();

        $this->get(self::BASE_URI . $cat->slug)
            ->assertOk()
            ->assertSee('we could not found any posts')
            ->assertViewIs('posts.by_category');
    }

    public function testUserCanSeePostsByCategorySlug()
    {
        $this->get(self::BASE_URI . $this->category->slug)
            ->assertOk()
            ->assertSee($this->posts->last()->title);
    }
}

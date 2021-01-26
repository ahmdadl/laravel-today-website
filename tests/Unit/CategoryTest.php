<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Str;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public User $user;
    public Category $category;

    protected function setUp(): void
    {
        parent::setUp();
    
        $this->user = User::factory()->create();
        $this->category = Category::factory()->make();
    }
    
    public function testCategoryHaveSlug()
    {
        $this->category->save();
        $this->category->refresh();

        $this->assertSame(
            Str::slug($this->category->title),
            $this->category->slug
        );
    }
    
}

<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProviderTest extends TestCase
{
    use RefreshDatabase;

    public Provider $provider;
    
    protected function setUp(): void
    {
        parent::setUp();
    
        $this->provider = Provider::factory()->create();
    }
    
    public function testProviderHasManyPosts()
    {
        Post::factory()->count(5)->create([
            'provider_slug' => $this->provider->slug,
        ]);

        $this->assertCount(5, $this->provider->posts);
    }
    
}
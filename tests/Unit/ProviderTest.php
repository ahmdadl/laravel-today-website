<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProviderTest extends TestCase
{
    use RefreshDatabase;

    public User $user;
    public Provider $provider;
    
    protected function setUp(): void
    {
        parent::setUp();
    
        $this->user = User::factory()->create();
        $this->provider = Provider::factory()->create([
            'user_id' => $this->user->id,
        ]);
    }
    
    public function testProviderHasManyPosts()
    {
        Post::factory()->count(5)->create([
            'provider_slug' => $this->provider->slug,
        ]);

        $this->assertCount(5, $this->provider->posts);
    }

    public function testProviderBelongsToUser()
    {
        $this->assertNotNull($this->provider->owner);

        $this->assertSame(
            $this->user->name,
            $this->provider->owner->name
        );
    }
    
}
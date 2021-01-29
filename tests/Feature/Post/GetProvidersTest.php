<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetProvidersTest extends TestCase
{
    use RefreshDatabase;

    private Collection $providers;

    protected function setUp(): void
    {
        parent::setUp();
    
        $this->providers = Provider::factory()->count(6)->has(Post::factory())->create();
    }

    public function testUserCanGetProvidersList()
    {
        $this->get('/providers')->assertOk()->assertJsonCount(6)->assertJsonFragment(['title' => $this->providers->first()->title]);
    }
    
}

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

        $this->providers = Provider::factory()
            ->count(6)
            ->has(Post::factory())
            ->create();
    }

    public function testUserWillOnlyGetApprovedProviders()
    {
        $providers = Provider::factory()
            ->count(2)
            ->create(['status' => Provider::APPROVED]);

        $this->get('/providers')
            ->assertOk()
            ->assertJsonCount(2)
            ->assertJsonFragment(['title' => $providers->first()->title])
            ->assertJsonMissing(['title' => $this->providers->first()->title]);
    }
}

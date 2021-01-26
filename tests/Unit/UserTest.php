<?php

namespace Tests\Unit;

use App\Models\Provider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testUserHasImage()
    {
        $this->assertIsString($this->user->image_url);
    }

    public function testUserHasProvider()
    {
        $provider = Provider::factory()->create([
            "user_id" => $this->user->id,
        ]);

        $this->assertNotNull($this->user->provider);

        $this->assertSame($provider->title, $this->user->provider->title);
    }
}

<?php

namespace Tests\Unit;

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

    public function testUserHaveImage()
    {
        $this->assertIsString($this->user->image_url);
    }
    
    
}

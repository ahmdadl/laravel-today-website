<?php

namespace Tests\Feature;

use App\Models\Provider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProviderControllerTest extends TestCase
{
    use RefreshDatabase;

    const BASE_URI = '/providers/';

    private User $user;
    private Provider $provider;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->make();
        $this->provider = Provider::factory()->make();
    }

    public function testUserCanVisitProviderCreatePage()
    {
        $this->get(self::BASE_URI . 'create')->assertOk();
    }

    public function testUserCanNotAddProviderWithInvalidData()
    {
        $this->post(self::BASE_URI)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'name',
                'email',
                'title',
                'home_url',
                'req_url',
            ]);

        // assert user cannot reregister provider again
        $this->user->save();
        $this->provider->save();
        $this->post(self::BASE_URI, [
            'title' => $this->provider->title,
            'email' => $this->user->email,
        ])
            ->assertStatus(302)
            ->assertSessionHasErrors(['title', 'email']);
    }

    public function testUserCanAddAProvider()
    {
        $this->withoutExceptionHandling();
        $this->post(self::BASE_URI, [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'avatar' => $this->user->image,
            'profile' => $this->user->url,
            'title' => $this->provider->title,
            'home_url' => $this->provider->url,
            'req_url' => $this->provider->request_url,
            'bio' => $this->provider->bio,
        ])->assertSessionDoesntHaveErrors();

        $this->assertTrue(User::whereEmail($this->user->email)->exists());
        $this->assertTrue(
            Provider::whereTitle($this->provider->title)
                ->whereStatus(Provider::PENDING)
                ->exists(),
        );
    }
}

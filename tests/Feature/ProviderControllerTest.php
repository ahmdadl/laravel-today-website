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

        // assert user cannot register provider twice
        $this->user->save();
        $this->provider->save();
        $this->post(self::BASE_URI, [
            'title' => $this->provider->title,
            'email' => $this->user->email,
            'req_url' => $this->provider->request_url,
        ])
            ->assertStatus(302)
            ->assertSessionHasErrors(['title', 'email', 'req_url']);
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
        ])
            ->assertSessionDoesntHaveErrors()
            ->assertViewIs('provider.created');

        $this->assertTrue(User::whereEmail($this->user->email)->exists());
        $this->assertTrue(
            Provider::whereTitle($this->provider->title)
                ->whereStatus(Provider::PENDING)
                ->exists(),
        );
    }

    public function testUserCannotCheckForProviderStatusWithInvalidData()
    {
        $this->postJson(self::BASE_URI . 'check', [])
            ->assertStatus(422)
            ->assertJsonFragment(['title' => ['The title field is required.']]);
    }

    public function testUserCanCheckForProviderStatus()
    {
        $this->provider->save();

        $this->postJson(self::BASE_URI . 'check', [
            'title' => strtoupper($this->provider->title),
            'req_url' => $this->provider->request_url,
        ])->assertOk()->assertJsonFragment(['status' => 'pending']);

        $this->provider->setStatus(Provider::APPROVED);
        $this->postJson(self::BASE_URI . 'check', [
            'title' => $this->provider->title,
            'req_url' => $this->provider->request_url,
        ])->assertOk()->assertJsonFragment(['status' => 'approved']);
    }
    
    public function testUserCannotCheckForProviderStatusIfNotFound()
    {
        $this->postJson(self::BASE_URI . 'check', [
            'title' => $this->provider->title,
            'req_url' => $this->provider->request_url,
        ])->assertStatus(204);
    }
    
    public function testOnlyAdminCanUpdateProvider()
    {
        $this->user->save();
        $this->provider->save();
        // $this->withoutExceptionHandling();
        $this->putJson(self::BASE_URI . $this->provider->id)->assertUnauthorized();

        // $this->actingAs($this->user)->putJson(self::BASE_URI . $this->provider->slug)->assertForbidden();
    }

    // public function testAdminCanUpdateProvider()
    // {
    //     $this->user->save();
    //     $this->provider->save();

    //     $this->actingAs($this->user)->putJson(self::BASE_URI . $this->provider->slug, [
    //         'state' => Provider::Rejected
    //     ])->assertOk()->assertJson(['updated' => true]);

    //     $this->assertTrue(Provider::whereStatus(Provider::Rejected)->exists());
    // }
}

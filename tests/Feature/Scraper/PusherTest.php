<?php

namespace Tests\Feature\Scraper;

use App\Models\Post;
use App\Scraper\Scrapers\Pusher;

class PusherTest extends Scraper
{
    protected string $type = Pusher::class;
    protected array $providerAttr = [
        'title' => 'Pusher',
        'request_url' => 'https://pusher.com/tutorials?tag=Laravel',
    ];

    public function testPusherContentWillBeSavedIntoPosts()
    {
        $this->crawler->run();

        $this->assertTrue(
            Post::whereTitle(
                'Creating a server health monitoring app with Laravel',
            )->exists(),
        );

        $this->assertTrue(
            Post::whereTitle('How to build Laravel packages')->exists(),
        );
    }
}

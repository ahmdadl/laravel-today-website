<?php

namespace Tests\Feature\Scraper;

use App\Models\Post;
use App\Scraper\Scrapers\LaravelDaily;

class LaravelDailyTest extends Scraper
{
    protected string $type = LaravelDaily::class;
    protected array $providerAttr = [
        'title' => 'Laravel Daily',
        'request_url' => 'https://laraveldaily.com/',
    ];

    public function testLaraDailyContentWillBeSavedIntoPosts()
    {
        $this->crawler->run();

        $this->assertTrue(
            Post::whereTitle(
                'FREE E-book: 100 Laravel Quick Tips (and counting)',
            )->exists(),
        );

        $this->assertTrue(
            Post::whereTitle(
                'Laravel Two-Step Registration: Optional Fields for Country and Bio',
            )
                ->whereImage(
                    'https://laraveldaily.com/wp-content/uploads/2019/07/Screen-Shot-2019-07-24-at-8.26.28-AM-218x150.png',
                )
                ->exists(),
        );
    }
}

<?php

namespace Tests\Feature\Scraper;

use App\Models\Post;
use App\Scraper\Scrapers\Vegibit;

class VegibitTest extends Scraper
{
    protected string $type = Vegibit::class;
    protected array $providerAttr = [
        'title' => 'Vegibit',
        'request_url' => 'https://vegibit.com/tag/laravel/',
    ];

    public function testVegibitContentWillBeSavedIntoPosts()
    {
        $this->crawler->run();

        $this->assertTrue(
            Post::whereTitle('Laravel API Resource Tutorial')->exists(),
        );

        $this->assertTrue(
            Post::whereTitle('Mentions And Notifications')->exists(),
        );
    }
}

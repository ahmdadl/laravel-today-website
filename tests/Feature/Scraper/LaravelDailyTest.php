<?php

namespace Tests\Feature\Scraper;

use App\Scraper\Scrapers\LaravelDaily;

class LaravelDailyTest extends Scraper
{
    protected string $type = LaravelDaily::class;
    protected array $providerAttr = [
        'title' => 'Laravel Daily',
        'request_url' => 'https://laraveldaily.com/'
    ];

    public function testLaraDailyContentWillBeSavedIntoPosts()
    {
        $this->crawler->saveHtml();
    }
}

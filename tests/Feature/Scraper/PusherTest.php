<?php

namespace Tests\Feature\Scraper;

use App\Scraper\Scrapers\Pusher;

class PusherTest extends Scraper
{
    protected string $type = Pusher::class;
    protected array $providerAttr = [
            "title" => "Pusher",
            "request_url" => "https://pusher.com/tutorials?tag=Laravel"
        ];

    public function testPusherContentWillBeSavedIntoPosts()
    {
        dd($this->crawler->saveHtml());
    }
}
<?php

namespace Tests\Feature\Scraper;

use App\Scraper\Scrapers\Vegibit;

class VegibitTest extends Scraper
{
    protected string $type = Vegibit::class;
    protected array $providerAttr = [
            "title" => "Vegibit",
            "request_url" => "https://vegibit.com/tag/laravel/"
        ];

    public function testVegibitContentWillBeSavedIntoPosts()
    {
        dd($this->crawler->saveHtml());
    }
}
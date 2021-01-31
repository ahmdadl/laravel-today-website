<?php

namespace Tests\Feature\Scraper;

use App\Scraper\Scrapers\Stillat;

class StillatTest extends Scraper
{
    protected string $type = Stillat::class;
    protected array $providerAttr = [
            "title" => "Stillat",
            "request_url" => "https://stillat.com/category/laravel-5"
        ];

    public function testStillatContentWillBeSavedIntoPosts()
    {
        $this->crawler->run();
    }
}
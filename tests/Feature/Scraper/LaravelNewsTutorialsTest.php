<?php

namespace Tests\Feature\Scraper;

use App\Scraper\Scrapers\LaravelNewsTutorials;

class LaravelNewsTutorialsTest extends Scraper
{
    protected string $type = LaravelNewsTutorials::class;
    protected array $providerAttr = [
            "title" => "LaravelNewsTutorials",
            "request_url" => "https://laravel-news.com/category/laravel-tutorials"
        ];

    public function testLaravelNewsTutorialsContentWillBeSavedIntoPosts()
    {
        $this->crawler->run();
    }
}
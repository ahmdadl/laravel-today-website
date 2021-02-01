<?php

namespace Tests\Feature\Scraper;

use App\Models\Post;
use App\Scraper\Scrapers\LaravelNewsTutorials;

class LaravelNewsTutorialsTest extends Scraper
{
    protected string $type = LaravelNewsTutorials::class;
    protected array $providerAttr = [
        'title' => 'LaravelNewsTutorials',
        'request_url' => 'https://laravel-news.com/category/laravel-tutorials',
    ];

    public function testLaravelNewsTutorialsContentWillBeSavedIntoPosts()
    {
        $this->crawler->run();

        $this->assertTrue(
            Post::whereTitle('Laravel Collections “when” Method')->exists(),
        );

        $this->assertTrue(
            Post::whereTitle('Laravel Blade @prepend Directive')
                ->whereUrl('https://laravel-news.com/blade-prepend')
                ->exists(),
        );
    }
}

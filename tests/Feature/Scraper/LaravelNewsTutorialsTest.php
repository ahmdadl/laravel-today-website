<?php

namespace Tests\Feature\Scraper;

use App\Models\Post;
use App\Scraper\Scrapers\LaravelNewsTutorials;

class LaravelNewsTutorialsTest extends Scraper
{
    protected string $type = LaravelNewsTutorials::class;
    protected array $providerAttr = [
        'title' => 'Laravel News Tutorials',
        'request_url' => 'https://laravel-news.com/category/laravel-tutorials',
    ];

    public function testLaravelNewsTutorialsContentWillBeSavedIntoPosts()
    {
        $this->crawler->run();

        $this->assertTrue(
            Post::whereTitle('New Laravel Route “Missing” Method')->exists(),
        );

        $this->assertTrue(
            Post::whereTitle('Building REST APIs with Laravel Orion')
                ->whereImage('https://laravelnews.imgix.net/images/orion.png')
                ->exists(),
        );
    }
}

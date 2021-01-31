<?php

namespace Tests\Feature\Scraper;

use App\Models\Post;
use App\Scraper\Scrapers\LaravelNews;

class LaravelNewsScraperTest extends Scraper
{
    protected string $type = LaravelNews::class;
    protected array $providerAttr = [
        'title' => 'Laravel News',
        'request_url' => 'https://laravel-news.com/category/news'
    ];

    public function testLaravelNewsPostsWillBeSaved()
    {
        $this->crawler->run();

        $this->assertTrue(
            Post::whereTitle(
                'Enlightn: Boost your Laravel App’s Performance & Security (sponsor)',
            )->exists(),
        );

        $this->assertTrue(
            Post::whereTitle('Laravel 8.22 Released')
                ->whereAuthor('Paul Redmond')
                ->exists(),
        );
    }
}

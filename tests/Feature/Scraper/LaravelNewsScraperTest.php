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
                'Laravel Console Wizard',
            )->exists(),
        );

        $this->assertTrue(
            Post::whereTitle('Laravel is moving to a yearly major release cycle')
                ->whereAuthor('Eric L. Barnes')
                ->exists(),
        );
    }
}

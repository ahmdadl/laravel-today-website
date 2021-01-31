<?php

namespace Tests\Feature\Scraper;

use App\Models\Category;
use App\Models\Post;
use App\Models\Provider;
use App\Scraper\Scrapers\LaravelNews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Symfony\Component\DomCrawler\Crawler;
use Tests\TestCase;

class LaravelNewsScraperTest extends TestCase
{
    use RefreshDatabase;

    protected LaravelNews $crawler;
    protected Category $category;
    protected Provider $provider;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create([
            'title' => 'news',
        ]);
        $this->provider = Provider::factory()->create([
            'title' => 'laravel news',
        ]);
        $this->crawler = new LaravelNews(
            $this->category,
            $this->provider,
            true,
        );

        Mockery::mock(Crawler::class);
    }

    public function testItWillReturnArrayWithPageContent()
    {
        collect($this->crawler->run());

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

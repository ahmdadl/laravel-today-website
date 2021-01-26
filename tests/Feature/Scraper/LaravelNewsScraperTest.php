<?php

namespace Tests\Feature\Scraper;

use App\Scraper\Scrapers\LaravelNews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Symfony\Component\DomCrawler\Crawler;
use Tests\TestCase;

class LaravelNewsScraperTest extends TestCase
{
    protected LaravelNews $crawler;

    protected function setUp(): void
    {
        parent::setUp();
    
        $this->crawler = new LaravelNews(true);

        Mockery::mock(Crawler::class);
    }
    
    public function testItWillReturnArrayWithPageContent()
    {
        $arr = collect($this->crawler->run());
        
        $this->assertSame(
            'Enlightn: Boost your Laravel App’s Performance & Security (sponsor)',
            $arr->first()->title
        );

        $this->assertSame(
            'Eric L. Barnes',
            $arr->last()->author->name
        );
    }
    
}

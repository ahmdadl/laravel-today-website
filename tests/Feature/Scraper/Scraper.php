<?php

namespace Tests\Feature\Scraper;

use App\Models\Category;
use App\Models\Provider;
use App\Scraper\AbstractScraper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

abstract class Scraper extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected AbstractScraper $crawler;
    protected Category $category;
    protected Provider $provider;
    protected string $type;

    protected string $categoryTitle = 'news';
    protected array $providerAttr = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = (Category::factory()
            ->count(2)
            ->sequence(['title' => 'news'], ['title' => 'tutorial'])
            ->create())->first();
        $this->provider = Provider::factory()->create($this->providerAttr);
        $this->crawler = $this->getCrawler($this->type);

        Mockery::mock(Crawler::class);
    }

    private function getCrawler($class): AbstractScraper
    {
        return new $class($this->provider, true);
    }
}

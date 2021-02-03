<?php

namespace Tests\Feature\Scraper;

use App\Models\Post;
use App\Scraper\Scrapers\DigitalOcean;

class DigitaloceanLaravelTest extends Scraper
{
    protected string $type = DigitalOcean::class;
    protected array $providerAttr = [
        'title' => 'DigitalOcean laravel',
        'request_url' =>
            'https://www.digitalocean.com/community/search?q=laravel&primary_filter=newest&type=tutorials',
    ];

    public function testDOContentWillBeSavedIntoPosts()
    {
        $this->crawler->run();

        $this->assertTrue(
            Post::whereTitle('Getting Started With Laravel Livewire')
                ->whereAuthor('Chris Sev')
                ->exists(),
        );

        $this->assertTrue(
            Post::whereTitle(
                'Como implantar o Laravel 7 e o MySQL no Kubernetes usando o Helm',
            )->exists(),
        );
    }
}

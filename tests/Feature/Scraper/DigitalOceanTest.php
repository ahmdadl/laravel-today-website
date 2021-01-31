<?php

namespace Tests\Feature\Scraper;

use App\Scraper\Scrapers\DigitalOcean;

class DigitalOceanTest extends Scraper
{
    protected string $type = DigitalOcean::class;
    protected array $providerAttr = [
        'title' => 'Digital Ocean',
        'request_url' => 'https://www.digitalocean.com/community/search?q=laravel&primary_filter=newest&type=tutorials'
    ];

    public function testDOContentWillBeSavedIntoPosts()
    {
        $this->crawler->saveHtml();
    }    
}

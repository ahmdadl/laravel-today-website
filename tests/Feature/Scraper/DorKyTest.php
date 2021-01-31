<?php

namespace Tests\Feature\Scraper;

use App\Scraper\Scrapers\DorKy;

class DorKyTest extends Scraper
{
    protected string $type = DorKy::class;
    protected array $providerAttr = [
        'title' => 'Dor dot Ky',
        'request_url' => 'https://dor.ky/tagged/laravel/'
    ];

    public function testDoKContentWillBeSavedIntoPosts()
    {
        $this->crawler->saveHtml();
    }    
}

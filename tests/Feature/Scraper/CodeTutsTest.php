<?php

namespace Tests\Feature\Scraper;

use App\Scraper\Scrapers\CodeTuts;

class CodeTutsTest extends Scraper
{
    protected string $type = CodeTuts::class;
    protected array $providerAttr = [
        'title' => 'Code Tuts',
        'request_url' => 'https://code.tutsplus.com/categories/laravel'
    ];

    public function testCodeTutsContentWillBeSavedIntoPosts()
    {
        $this->crawler->run();
    }    
}

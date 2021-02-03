<?php

namespace Tests\Feature\Scraper;

use App\Models\Post;
use App\Scraper\Scrapers\EnvatoTutsLaravel;

class CodeTutsTest extends Scraper
{
    protected string $type = EnvatoTutsLaravel::class;
    protected array $providerAttr = [
        'title' => 'envato Tuts Laravel',
        'request_url' => 'https://code.tutsplus.com/categories/laravel'
    ];

    public function testEnvatoTutsLaravelContentWillBeSavedIntoPosts()
    {
        $this->crawler->run();

        $this->assertTrue(
            Post::whereTitle('20 Useful Laravel Packages Available on CodeCanyon (And 5 Free)')->exists()
        );

        $this->assertTrue(
            Post::whereAuthor('Manjunath M')->whereAuthorUrl('https://tutsplus.com/authors/manjunath-m')->exists()
        );
    }    
}

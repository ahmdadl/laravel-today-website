<?php

namespace Tests\Feature\Scraper;

use App\Models\Post;
use App\Scraper\Scrapers\DorKy;

class DorKyTest extends Scraper
{
    protected string $type = DorKy::class;
    protected array $providerAttr = [
        'title' => 'Dor Ky',
        'request_url' => 'https://dor.ky/tagged/laravel/',
    ];

    public function testDoKContentWillBeSavedIntoPosts()
    {
        $this->crawler->run();

        $this->assertTrue(
            Post::whereTitle(
                'Using Additional Configuration Files with Laravel & Lumen',
            )->exists(),
        );

        $this->assertTrue(
            Post::whereTitle(
                "Customising Exports for the 'Laravel Nova Excel' Package",
            )
                ->whereUrl(
                    'https://dor.ky/posts/2018/12/customising-exports-for-the-laravel-nova-excel-package/',
                )
                ->exists(),
        );
    }
}

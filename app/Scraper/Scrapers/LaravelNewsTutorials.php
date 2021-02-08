<?php

namespace App\Scraper\Scrapers;

use App\Scraper\AbstractScraper;

final class LaravelNewsTutorials extends AbstractScraper
{
    use LaravelNewsExtractor;

    protected string $categorySlug = 'tutorial';
}

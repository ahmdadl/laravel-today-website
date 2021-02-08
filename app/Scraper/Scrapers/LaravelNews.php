<?php

namespace App\Scraper\Scrapers;

use App\Scraper\AbstractScraper;

final class LaravelNews extends AbstractScraper
{
    use LaravelNewsExtractor;
}

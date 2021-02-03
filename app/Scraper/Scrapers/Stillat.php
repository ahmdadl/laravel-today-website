<?php

namespace App\Scraper\Scrapers;

use App\Scraper\AbstractScraper;
use Symfony\Component\DomCrawler\Crawler;

final class Stillat extends AbstractScraper
{
    protected string $categorySlug = 'tutorial';

    protected function extract(): array
    {
        return $this->crawler->filter('div.space-y-5.mt-5 > div.space-y-6')->each(function (Crawler $node) {
            $link = $this->findEl($node, 'h2.font-bold > a.text-gray-900')?->first();
            $title = $link?->text();
            $uri = $link?->attr('href');

            return $this->item(
                $title,
                $uri,
                null
            );
        });
    }
}
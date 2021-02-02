<?php

namespace App\Scraper\Scrapers;

use App\Scraper\AbstractScraper;
use Symfony\Component\DomCrawler\Crawler;

final class DorKy extends AbstractScraper
{
    protected string $categorySlug = 'tutorial';

    protected function extract(): array
    {
        return $this->crawler->filter('li.c-listing__item > article')->each(function (Crawler $node) {
            $created_at = $this->findEl($node, 'time.u-color-gray')?->first()?->text();
            $node = $this->findEl($node, 'h2 > a')?->first();
            $uri = $this->resolveUri($node?->attr('href'));
            $title = $node?->text();

            return $this->item(
                $title,
                $uri,
                $created_at
            );
        });
    }
}
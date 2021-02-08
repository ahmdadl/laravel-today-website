<?php

namespace App\Scraper\Scrapers;

use App\Scraper\AbstractScraper;
use Symfony\Component\DomCrawler\Crawler;

final class Vegibit extends AbstractScraper
{
    protected string $categorySlug = 'tutorial';

    protected function extract(): array
    {
        return $this->crawler->filter('article.card.post > div.card-body')->each(function (Crawler $node) {
            $link = $this->findEl($node, 'header > h2 > a')?->first();
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
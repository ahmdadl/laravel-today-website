<?php

namespace App\Scraper\Scrapers;

use App\Scraper\AbstractScraper;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;

final class LaravelNewsTutorials extends AbstractScraper
{
    protected function extract(): array
    {
        return $this->crawler
            ->filter('a.card.col.mx-auto')
            ->each(function (Crawler $node) {
                $link = $this->resolveUri($node->attr('href'));
                $img = $this->findEl($node, '.card__image img')?->first()?->attr('src');
                $con = $this->findEl($node, '.card__content')?->first();
                $title = $con?->filter('h4')?->first()?->text();
                $created_at =  $this
                    ->findEl($con, "span.label text-xs")
                    ?->last()
                    ?->text();

                return $this->item($title, $link, $created_at, $img);
            });
    }
}

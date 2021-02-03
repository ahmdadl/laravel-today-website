<?php

namespace App\Scraper\Scrapers;

use App\Scraper\AbstractScraper;
use Symfony\Component\DomCrawler\Crawler;

final class LaravelDaily extends AbstractScraper
{
    protected string $categorySlug = 'tutorial';

    protected function extract(): array
    {
        return $this->crawler
            ->filter('div.td_module_10.td_module_wrap')
            ->each(function (Crawler $node) {
                $img = $this->findEl($node, 'div.td-module-thumb > a > img')?->attr('data-img-url');
                $node = $this->findEl($node, 'div.item-details')?->first();
                $link = $this->findEl($node, 'h3.entry-title > a')?->first();
                $uri = $link?->attr('href');
                $title = $link?->text();
                $created_at = $this->findEl($node, 'div.td-module-meta-info > span > .entry-date')?->first()?->text();

                return $this->item(
                    $title,
                    $uri,
                    $created_at,
                    $img
                );
            });
    }
}

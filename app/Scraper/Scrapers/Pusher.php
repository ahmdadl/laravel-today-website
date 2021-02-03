<?php

namespace App\Scraper\Scrapers;

use App\Scraper\AbstractScraper;
use Symfony\Component\DomCrawler\Crawler;

final class Pusher extends AbstractScraper
{
    protected string $categorySlug = 'tutorial';

    protected function extract(): array
    {
        return $this->crawler->filter('div.css-df8fv.e1xbdcly1')?->each(function (Crawler $node) {
            $link = $this->findEl($node, 'a.css-ll4zz7.e1kw903v0')?->first()?->attr('href');
            $title = $this->findEl($node, 'div.css-1s3ax5 > div > h3')?->first()?->text();

            return $this->item(
                $title,
                $link,
                null
            );
        });
    }
}
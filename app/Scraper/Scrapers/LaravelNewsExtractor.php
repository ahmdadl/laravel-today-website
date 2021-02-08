<?php

namespace App\Scraper\Scrapers;

use Str;
use Symfony\Component\DomCrawler\Crawler;

trait LaravelNewsExtractor
{
    protected function extract(): array
    {
        return $this->crawler
            ->filter("section.col-span-10.pb-24 > .grid > li.group.max-w-sm.col-span-12.group-link-underline a.flex")
            ->each(function (Crawler $node) {
                $uri = $this->resolveUri($node?->attr('href'));
                $title = $this->findEl($node, "p > span.link")?->first()?->text();
                $img = $this
                    ->findEl($node, "img.object-cover")
                    ?->first()
                    ?->attr('src');

                $created_at = $this
                    ->findEl($node, "p.text-gray-400")
                    ?->first()
                    ?->text();

                return $this->item(
                    $title,
                    $uri,
                    $created_at,
                    Str::substr($img ?? "", 0, strpos($img ?? "", "?"))
                );
            });
    }
}
<?php

namespace App\Scraper\Scrapers;

use App\Scraper\AbstractScraper;
use Str;
use Symfony\Component\DomCrawler\Crawler;

final class DigitaloceanLaravel extends AbstractScraper
{
    protected string $categorySlug = 'tutorial';

    protected function extract(): array
    {
        return $this->crawler
            ->filter('li.tutorial')
            ->each(function (Crawler $node) {
                $link = $this->findEl($node, 'h3 > a')?->first();
                $title = $link?->text();
                $uri = $this->resolveUri($link?->attr('href'));
                $node = $this->findEl($node, 'div.meta-section')?->first();
                $created_at = $this->findEl($node, 'span.publish-date')?->first()?->attr('title');
                $author = $this->findEl($node, 'span.authors')?->first()?->text();

                $created_at = (explode('T', $created_at))[0];

                return $this->item(
                    $title,
                    $uri,
                    $created_at,
                    author: (object) [
                        'name' => Str::replaceFirst("By ", "", $author),
                        'uri' => null,
                        'img' => null,
                    ]
                );
            });
    }
}

<?php

namespace App\Scraper\Scrapers;

use App\Scraper\AbstractScraper;
use Carbon\Carbon;
use InvalidArgumentException;
use Str;
use Symfony\Component\DomCrawler\Crawler;

final class LaravelNews extends AbstractScraper
{
    protected string $baseUri = "https://laravel-news.com";
    protected string $requestUri = "https://laravel-news.com/category/news";
    protected int $authorId = 1;

    protected function extract(): array
    {
        return $this->crawler
            ->filter("div.w-full.px-5.mb-6 > div.card.w-full.mx-0")
            ->each(function (Crawler $node) {
                $link = $this->findEl($node, "h2 .text-red")?->first();
                $img = $this
                    ->findEl($node, ".post__image img")
                    ?->first()
                    ?->attr('src');

                $created_at = Carbon::createFromTimeString(
                    $this
                        ->findEl($node, ".prose > span > span")
                        ?->last()
                        ?->text() . " 00:00" ?? Carbon::now()
                );
                $author = $this->findEl($node, ".author__content > h4 > a")?->first();

                return $this->item(
                    $link?->text(),
                    $this->resolveUri($link?->attr("href")),
                    $created_at,
                    Str::substr($img ?? "", 0, strpos($img ?? "", "?")),
                    "",
                    !is_null($author)
                        ? (object) [
                            "name" => $author->text("null"),
                            "uri" => $this->resolveUri($author->attr("href")),
                        ]
                        : null
                );
            });
    }
}

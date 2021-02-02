<?php

namespace App\Scraper\Scrapers;

use App\Scraper\AbstractScraper;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;

final class EnvatoTutsLaravel extends AbstractScraper
{
    protected string $categorySlug = 'tutorial';

    protected function extract(): array
    {
        return $this->crawler->filter('li.posts__post > article')?->each(function (Crawler $node) {
            $img = $this->findEl($node, 'a.posts__post-preview > img')?->attr('data-src');
            $link = $this->findEl($node, 'a.posts__post-title')?->first();
            $url = $this->resolveUri($link?->attr('href'));
            $title = $link?->filter('h1')?->first()?->text();
            $footer = $this->findEl($node, 'footer.posts__post-details > .posts__post-publication-meta')?->first();
            $create_at = $this->findEl($footer, 'div.posts__post-details__info > .posts__post-publication-date')?->first()?->text();
            $author = $this->findEl($footer, 'div.posts__post-details__info > .posts__post-author > a.posts__post-author-link')?->first();
            $authorImg = $this->findEl($footer, 'div.posts__post-publication-meta img')?->first()?->attr('data-src');

            return $this->item(
                $title,
                $url,
                $create_at,
                $img,
                (object) [
                    'name' => $author?->text(),
                    'uri' => $author?->attr('href'),
                    'img' => $authorImg,
                ]
            );
        });
    }
}
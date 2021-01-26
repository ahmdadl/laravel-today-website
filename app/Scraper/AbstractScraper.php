<?php

namespace App\Scraper;

use Carbon\Carbon;
use Goutte\Client;
use InvalidArgumentException;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\UriResolver;

use function PHPUnit\Framework\returnSelf;

abstract class AbstractScraper
{
    protected Client $goutte;
    protected Crawler $crawler;

    protected string $baseUri;
    protected string $requestUri;
    protected int $authorId;

    public function __construct(protected bool $isTest = false) {
        $this->goutte = app('goutte');
        $this->getInstance();
    }

    private function getInstance(): void
    {
        if ($this->isTest) {
            $this->crawler = new Crawler();
            $this->crawler->addHtmlContent(file_get_contents(
                base_path('tests/sites/laravel_news.txt')
            ));
            return;
        }

        $this->crawler = $this->goutte->request('GET', $this->requestUri);
    }

    public function run(): ?array {
        $arr = array_filter($this->extract(), fn ($i) => !is_null($i));
        
        if ($this->isTest) return $arr;
        return $arr;
    }

    protected function item(
        string $title,
        string $url,
        string $created_at,
        ?string $image = null,
        ?string $content = '',
        ?object $author = null
    ): object {
        return (object) compact('title', 'url', 'image', 'content', 'created_at', 'author');
    }

    protected function resolveUri(?string $uri = ''): string
    {
        return UriResolver::resolve($uri, $this->requestUri);
    }

    protected function findEl(Crawler $node, string $selector): ?Crawler
    {
        $node = $node->filter($selector);

        return is_null($node->getNode(0)) ? null : $node;
    }

    protected abstract function extract(): array;
}
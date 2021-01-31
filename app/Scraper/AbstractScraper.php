<?php

namespace App\Scraper;

use App\Models\Category;
use App\Models\Post;
use App\Models\Provider;
use Carbon\Carbon;
use Goutte\Client;
use InvalidArgumentException;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\UriResolver;

abstract class AbstractScraper
{
    protected Client $goutte;
    protected Crawler $crawler;

    // protected string $baseUri;
    // protected string $requestUri;
    // protected int $authorId;

    public function __construct(
        protected Category $category,
        protected Provider $provider,
        protected bool $isTest = false
    ) {
        $this->goutte = app('goutte');
        $this->getInstance();
    }

    private function getInstance(): void
    {
        if ($this->isTest) {
            $this->crawler = new Crawler();
            // $this->crawler->addHtmlContent(file_get_contents(
            //     base_path('tests/sites/'. $this->provider->slug .'.txt')
            // ));
            return;
        }

        $this->crawler = $this->goutte->request('GET', $this->provider->request_url);
    }

    public function run(): void {
        $arr = array_filter($this->extract(), fn ($i) => !is_null($i));
        
        foreach ($arr as $p) {
            Post::create([
                'category_slug' => $this->category->slug,
                'provider_slug' => $this->provider->slug,
                'title' => $p->title,
                'url' => $p->url,
                'image' => $p->image,
                'created_at' => $p->created_at,
                'author' => $p->author?->name,
                'author_url' => $p->author?->uri,
                'author_img' => $p->author?->img,
            ]);
        }
    }

    public function saveHtml(): ?bool
    {
        $this->crawler = $this->goutte->request('GET', $this->provider->request_url);

        $done = file_put_contents(base_path('tests/sites/') . $this->provider->slug . '.txt', "<!doctype html><html>".
        $this->crawler->html() . "</html>");

        return $done;
    }

    protected function item(
        string $title,
        string $url,
        string $created_at,
        ?string $image = null,
        ?object $author = null
    ): object {
        return (object) compact('title', 'url', 'image', 'created_at', 'author');
    }

    protected function resolveUri(?string $uri = ''): string
    {
        return UriResolver::resolve($uri, $this->provider->request_url);
    }

    protected function findEl(Crawler $node, string $selector): ?Crawler
    {
        $node = $node->filter($selector);

        return is_null($node->getNode(0)) ? null : $node;
    }

    protected abstract function extract(): array;
}
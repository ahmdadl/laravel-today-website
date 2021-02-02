<?php

namespace App\Scraper;

use App\Models\Category;
use App\Models\Post;
use App\Models\Provider;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Database\QueryException;
use InvalidArgumentException;
use PDOException;
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
            $fileName = 'tests/sites/'. $this->provider->slug .'.html';
            if (!file_exists($fileName)) return;
            $this->crawler = new Crawler();
            $this->crawler->addHtmlContent(file_get_contents(
                base_path($fileName)
            ));
            return;
        }

        $this->crawler = $this->goutte->request('GET', $this->provider->request_url);
    }

    public function run(): bool | null {
        $arr = array_filter($this->extract(), fn ($i) => !is_null($i));

        foreach ($arr as $p) {
            try {
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
            } catch (QueryException | PDOException) {}
        }

        return isset($arr[0]) ? Post::whereTitle($arr[0]->title)->exists() : null;
    }

    public function saveHtml(): ?bool
    {
        $this->crawler = $this->goutte->request('GET', $this->provider->request_url);

        $done = file_put_contents(base_path('tests/sites/') . $this->provider->slug . '.html', "<!doctype html><html>".
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
        $node = $node?->filter($selector);

        return is_null($node?->getNode(0)) ? null : $node;
    }

    protected abstract function extract(): array;
}
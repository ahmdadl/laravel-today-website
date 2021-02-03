<?php

namespace App\Console\Commands;

use App\Models\Provider;
use Illuminate\Console\Command;
use Str;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape
                {provider? : provider slug}
                {class? : provider class name}
                {--t|test : use local saved data}
                {--c|check : check if provider have required meta}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'scrape posts from one or more providers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (null !== $this->argument('provider')) {
            return $this->one($this->argument('provider'));
        }

        // scrape all providers
        Provider::all()->each(
            fn(Provider $provider) => $this->one($provider->slug),
        );
    }

    private function one(string $slug): void
    {
        if ($this->option('check')) {
            $this->check($slug);
            return;
        }

        $provider = Provider::whereSlug($slug)->first();

        if (null === $provider) {
            $this->error('provider ' . $slug . ' not found');
            return;
        }

        $class =
            '\App\Scraper\Scrapers\\' . str_replace('-', '', Str::title($slug));

        if (null !== $this->argument('class')) {
            $class = '\App\Scraper\Scrapers\\' . $this->argument('class');
        }

        $this->warn('Begin Scraping: ' . $provider->title . '...');

        $done = (new $class($provider, $this->option('test')))->run();

        if (!$done) {
            $this->error('an error occured scraping provider');
            return;
        }

        $this->info('scraping ' . $provider->title . ' done successfully');
    }

    private function check(string $providerSlug): void
    {
        $provider = Provider::whereSlug($providerSlug)->first();

        $goutte = app('goutte');

        if ($this->option('test')) {
            $fileName = 'tests/sites/' . $provider->slug . '.html';
            if (!file_exists($fileName)) {
                $this->error('file ' . $provider->slug . '.html not found');
                return;
            }
            $crawler = new Crawler();
            $crawler->addHtmlContent(file_get_contents(base_path($fileName)));
            $this->checkForMeta($crawler, $provider->url);
            return;
        }
        $crawler = $goutte->request('GET', $provider->url);
        $this->checkForMeta($crawler, $provider->url);

        $crawler = $goutte->request('GET', $provider->request_url);
        $this->checkForMeta($crawler, $provider->request_url);
    }

    /**
     * check if meta scraper is present
     *
     * @param Crawler $crawler
     * @param string $url
     * @return void
     */
    private function checkForMeta($crawler, string $url): void
    {
        $this->warn('checking for ' . $url);
        $crawler->filter('meta')->each(function (Crawler $node) use ($url) {
            $name = $node?->attr('name');
            $content = $node?->attr('content');

            if ($name === 'can_be_scraped' && $content === 'approve') {
                $this->info('provider ' . $url . ' meta tag was successfully found');
            };
        });
    }
}

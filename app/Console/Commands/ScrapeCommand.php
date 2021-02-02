<?php

namespace App\Console\Commands;

use App\Models\Provider;
use Illuminate\Console\Command;
use Str;

class ScrapeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape
                {provider? : provider slug}
                {--t|test : use local saved data}';

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
        if ($this->hasArgument('provider')) {
            return $this->one($this->argument('provider'));
        }

        // scrape all providers
    }

    private function one(string $slug)
    {
        $provider = Provider::whereSlug($slug)->first();

        if (null === $provider) {
            $this->error('provider ' . $slug . ' not found');
            return;
        }

        $class =
            '\App\Scraper\Scrapers\\' . str_replace('-', '', Str::title($slug));

        $this->warn('Begin Scraping: ' . $provider->title . '...');

        $done = (new $class(
            $provider,
            $this->option('test'),
        ))->run();

        if (!$done) {
            $this->error('an error occured');
            return;
        }

        $this->info('scraping ' . $provider->title . ' done successfully');
    }
}

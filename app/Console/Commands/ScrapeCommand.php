<?php

namespace App\Console\Commands;

use App\Models\Provider;
use Illuminate\Console\Command;
use Str;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeCommand extends Command
{
    use ScrapeTrait;

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
}

<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Provider;
use Illuminate\Console\Command;
use Str;

class AddProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:provider 
            {title : provider title} 
            {req_url : request URL} 
            {--d|do-not-save : do not save html after files creation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add new provider class and test';

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
        $title = str_replace('-', '', Str::title($this->argument('title')));
        $req_url = $this->argument('req_url');

        $this->warn('Creating Scraper for: ' . $title);

        $done = file_put_contents(
            app_path('scraper/scrapers/') . $title . '.php',
            $this->scraperContent($title),
        );

        if (!$done) {
            $this->error('an error occured with scraper class');
            return 0;
        }

        $this->warn('Creating test class for: ' . $req_url);
        $done = file_put_contents(
            base_path('tests/Feature/Scraper/') . $title . 'Test.php',
            $this->testContent($title, $req_url),
        );

        if (!$done) {
            $this->error('an error occured with test class');
            return 0;
        }

        $this->info('files created successfully');

        if ($this->hasOption('-d')) {
            return 0;
        }

        $this->warn('dumping provider html data...');

        $category = Category::factory()->create();
        $provider = Provider::factory()->create([
            'title' => $title,
            'request_url' => $req_url,
        ]);
        $title = "App\Scraper\Scrapers\\$title";
        $done = (new $title($category, $provider, true))->saveHtml();

        $category->delete();
        $provider->delete();

        if (!$done) {
            $this->error('an error occured with dumbing data');
            return 0;
        }
        $this->info($title . ' data was added successfully');
    }

    private function scraperContent(string $name): string
    {
        return <<<STR
        <?php

        namespace App\Scraper\Scrapers;

        use App\Scraper\AbstractScraper;

        final class $name extends AbstractScraper
        {
            protected function extract(): array
            {
                return [];
            }
        }
        STR;
    }

    private function testContent(string $name, string $req): string
    {
        $type = 'protected string $type = ' . $name . '::class;';
        $providerAttr =
            'protected array $providerAttr = [
            "title" => "' .
            $name .
            '",
            "request_url" => "' .
            $req .
            '"
        ];';
        $crawler = '$this->crawler->run();';
        return <<<STR
        <?php

        namespace Tests\Feature\Scraper;

        use App\Scraper\Scrapers\\$name;

        class {$name}Test extends Scraper
        {
            $type
            $providerAttr

            public function test{$name}ContentWillBeSavedIntoPosts()
            {
                $crawler
            }
        }
        STR;
    }
}

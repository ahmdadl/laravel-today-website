<?php

namespace App\Providers;

use Goutte\Client as GoutteClient;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\BrowserKit\History;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\HttpClient\HttpClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(History::class);
        $this->app->bind(CookieJar::class);

        $this->app->singleton('goutte', function ($app) {
            $config = $app->make('config');

            $goutte = new GoutteClient(
                HttpClient::create($config->get('goutte.client', [])),
                $app->make(History::class),
                $app->make(CookieJar::class)
            );

            return $goutte;
        });
        $this->app->alias('goutte', GoutteClient::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 
    }
}

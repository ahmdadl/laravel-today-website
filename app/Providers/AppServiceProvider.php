<?php

namespace App\Providers;

use App\Actions\ApproveProvider;
use App\Actions\RejectProvider;
use App\FormFields\StateFormField;
use Enlightn\Enlightn\EnlightnServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->app->register(EnlightnServiceProvider::class);
        }
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

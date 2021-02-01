<?php

namespace App\Providers;

use App\Actions\ApproveProvider;
use App\FormFields\StateFormField;
use Enlightn\Enlightn\EnlightnServiceProvider;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;

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
        Voyager::addFormField(StateFormField::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Voyager::addAction(ApproveProvider::class);
    }
}

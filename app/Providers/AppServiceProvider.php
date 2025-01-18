<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(env('APP_SECURE')){
            URL::forceScheme('https');
        }
        
        View::composer('*', function ($view) {
            $lang = app()->getLocale();

            if ($lang !== LaravelLocalization::getCurrentLocale()) {
                app()->setLocale(LaravelLocalization::getCurrentLocale());
            }

            $view->with([
                'java_version' => now()->timestamp,
                'lang' => $lang,
            ]);
        });
    }
}

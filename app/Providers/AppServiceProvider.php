<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Transistor;
use App\Services\PodcastParser;
use Illuminate\Contracts\Foundation\Application;
use App\Services\VerifyEmailService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton('verify_email', function(){
            return new VerifyEmailService();
        });
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

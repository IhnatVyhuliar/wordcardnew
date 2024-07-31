<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Transistor;
use App\Services\PodcastParser;
use Illuminate\Contracts\Foundation\Application;
use App\Services\VerifyEmailService;
use App\Services\FolderLearnService;
use App\Services\FolderService;
use App\Services\FollowerManageService;
use App\Http\Controllers\Learn\ComposeCardController;
use App\Http\Controllers\Folder\FolderController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('learn_service', function($app){
            return new FolderLearnService();
        });

        $this->app->bind('folder_service', function($app){
            return new FolderService();
        });

        $this->app->bind('folder_controller', function($app){
            return new FolderController();
        });

        $this->app->bind("folder_manage_service"::class, function($app){
            return new FollowerManageService();
        });
        $this->app->bind('compose_card_controller', function($app){
            return new ComposeCardController();
        });

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

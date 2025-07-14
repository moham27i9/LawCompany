<?php

namespace App\Providers;

use App\Broadcasting\FcmChannel;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;

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
        app(ChannelManager::class)->extend('fcm', function ($app) {
        return new FcmChannel();
    });
    }
}

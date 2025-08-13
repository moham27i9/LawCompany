<?php

namespace App\Providers;

use App\Broadcasting\FcmChannel;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\URL;
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
         if(config('app.env') !== 'local') { // فقط للبيئة الحقيقية
        URL::forceScheme('https');
    }
        app(ChannelManager::class)->extend('fcm', function ($app) {
        return new FcmChannel();
    });
    }
}

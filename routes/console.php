<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());

    Schedule::command('faiss:rebuild')->everyTwelveHours();
})->purpose('Display an inspiring quote');


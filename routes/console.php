<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

<<<<<<< HEAD
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
=======
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
>>>>>>> c17f75803b68b5280742ddcf3c9e17a4e4050fbb

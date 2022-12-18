<?php

namespace App\Application\Common\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class AppRoutesServiceProvider extends RouteServiceProvider
{
    public function boot()
    {
        $this->routes(
            fn() => Route::get('api/', function () {
                return 'Server is running ' . Carbon::now() . ' !!';
            })
        );
    }
}

<?php

namespace App\Application\Link\Providers;

use App\Api\Http\Controllers\LinkController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class LinkRoutesServiceProvider extends RouteServiceProvider
{
    public function boot()
    {
        $this->routes(
            fn() => Route::prefix('api/link')
                ->namespace($this->namespace)
                ->group(function () {
                    Route::post('/short', [
                        LinkController::class,
                        'createOrUpdate',
                    ])->name('short');
                    Route::get('/redirect/{short_url}', [
                        LinkController::class,
                        'redirectToLink',
                    ])->name('redirect');
                })
        );
    }
}

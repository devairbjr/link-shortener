<?php

namespace App\Application\Link\Providers;

use Illuminate\Support\ServiceProvider;

class LinkServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->register(LinkRoutesServiceProvider::class);
    }
}

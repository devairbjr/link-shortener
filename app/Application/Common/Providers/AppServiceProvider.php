<?php

namespace App\Application\Common\Providers;

use Illuminate\Support\ServiceProvider;
use App\Application\Link\Providers\LinkServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(LinkServiceProvider::class);
    }
}

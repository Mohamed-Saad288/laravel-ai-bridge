<?php

namespace Saad\AiBridge;

use Illuminate\Support\ServiceProvider;

class AiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AiService::class, function () {
            return new AiService();
        });
    }

    public function boot()
    {
    }
}

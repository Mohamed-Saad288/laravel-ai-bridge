<?php

namespace Saad\AiBridge;

use Illuminate\Support\ServiceProvider;

class AiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AiService::class, function ($app) {
            return new AiService();
        });
        $this->app->alias(AiService::class, 'ai-service');
    }

    public function boot()
    {
        //
    }
}

<?php

declare(strict_types=1);

namespace Webparking\LaravelMinox\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelMinoxServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerConfig();
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/minox.php',
            'minox'
        );

        $this->publishes([
            __DIR__ . '/../../config/minox.php' => config_path('minox.php'),
        ], 'config');
    }
}

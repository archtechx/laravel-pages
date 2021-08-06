<?php

declare(strict_types=1);

namespace ArchTech\Pages;

use Illuminate\Support\ServiceProvider;

class PagesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../assets/views', 'pages');
        $this->mergeConfigFrom(__DIR__ . '/../assets/config.php', 'pages');

        $this->publishes([
            __DIR__ . '/../assets/views' => resource_path('views/vendor/pages'),
        ], 'archtech-pages-views');

        $this->publishes([
            __DIR__ . '/../assets/config.php' => config_path('pages.php'),
        ], 'archtech-pages-config');
    }
}

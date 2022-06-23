<?php

namespace Praweb\BaseTools;

use Illuminate\Support\ServiceProvider;

class BaseToolsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'praweb');
        $this->publishes([
            __DIR__ . '/../resources/views/components' => resource_path('views/vendor/praweb/components'),
            __DIR__ . '/../resources/views/livewire' => resource_path('views/vendor/praweb/livewire'),
        ], 'base-tools-components');
    }
}

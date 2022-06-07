<?php

namespace Praweb\BaseTools;

use Illuminate\Support\ServiceProvider;

class BaseToolsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/views/components' => resource_path('views/components'),
            __DIR__.'/../resources/views/livewire' => resource_path('views/livewire'),

        ], 'base-tools-components');
    }
}

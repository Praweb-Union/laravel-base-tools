<?php

namespace Praweb\BaseTools;

class BaseToolsServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/views/components' => resource_path('views/components')
        ], 'base-tools-components');
    }
}

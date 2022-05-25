<?php

use Livewire\LivewireServiceProvider;
use Praweb\BaseTools\BaseToolsServiceProvider;

class LivewireTest extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {

        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            BaseToolsServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    public function testBase()
    {
        $this->assertTrue(true);
    }
}
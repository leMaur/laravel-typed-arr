<?php

namespace Lemaur\LaravelTypedArr\Tests;

use Lemaur\LaravelTypedArr\LaravelTypedArrServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelTypedArrServiceProvider::class,
        ];
    }
}

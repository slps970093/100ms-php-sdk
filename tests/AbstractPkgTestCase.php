<?php

namespace Slps970093\Live100ms\Tests;

use Orchestra\Testbench\TestCase;
use Slps970093\Live100ms\Live100msServiceProvider;

abstract class AbstractPkgTestCase extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            Live100msServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('100ms.access_token', 'app-access-token');
        $app['config']->set('100ms.secret', 'app-secret');
        $app['config']->set('100ms.api-version', 2);
    }
}
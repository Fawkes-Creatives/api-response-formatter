<?php
/**
 * @author fawkescreatives created on 17/09/2021
 */

namespace ApiResponse\Formatter\Tests;

use ApiResponse\Formatter\ApiResponseServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app):array
    {
        return [
            ApiResponseServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'ApiResponse' => 'ApiResponse\Facade',
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('logging.default', 'null');
    }
}
<?php
/**
 * @author fawkescreatives created on 17/09/2021
 */

namespace LaravelIntuition\Tests;

use LaravelIntuition\LaravelIntuitionServiceProvider;
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
            LaravelIntuitionServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Intuition' => 'LaravelIntuition\Facade',
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('logging.default', 'null');
    }
}

<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */

namespace LaravelIntuition;

use LaravelIntuition\Http\ResponseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use LaravelIntuition\Contracts\ResponseContract;

class LaravelIntuitionServiceProvider extends ServiceProvider
{
    /* @var Application */
    protected $app;

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/intuition.php' => $this->app->configPath('intuition.php'),
            ]);

            $this->registerStub();
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/intuition.php', 'intuition');

        $this->app->bind(ResponseContract::class, function ($app) {
            return $app->make(ResponseService::class);
        });
    }

    public function registerStub()
    {
        if (file_exists(app_path('Http/HttpStatusCode.php'))) {
            return;
        }

        $stub = file_get_contents(__DIR__ . '/stubs/http-status-code.stub');

        file_put_contents(app_path('Http/HttpStatusCode.php'), $stub);
    }
}

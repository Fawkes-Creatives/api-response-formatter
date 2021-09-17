<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */

namespace ApiResponse\Formatter;

use ApiResponse\Formatter\Http\ResponseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use ApiResponse\Formatter\Contracts\ResponseContract;

class ApiResponseServiceProvider extends ServiceProvider
{
    /* @var Application */
    protected $app;

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/api_response_format.php' => $this->app->configPath('api_response_format.php'),
            ]);

            $this->registerStub();
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/api_response_format.php', 'api_response_format');

        $this->app->bind(ResponseContract::class, function ($app) {
            return $app->make(ResponseService::class);
        });
    }

    public function registerStub()
    {
        if (file_exists(app_path('Http/HtmlStatusCode.php'))) {
            return;
        }
        $stub = file_get_contents(__DIR__ . '/stubs/html-status-code.stub');

        file_put_contents('app/Http/HtmlStatusCode.php', $stub);
    }
}

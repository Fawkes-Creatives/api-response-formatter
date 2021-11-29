<?php

use LaravelIntuition\Contracts\ResponseContract;
use LaravelIntuition\Helpers\ArrayService;
use Illuminate\Support\Facades\Config;

if (!function_exists('intuition')) {

    /**
     * A helper method to resolve the api response contract out of the service container.
     *
     * @return ResponseContract
     */
    function intuition(): ResponseContract
    {
        return app(ResponseContract::class);
    }
}

if (!function_exists('getSuccessHttpStatus')) {
    /**
     * Get success status and ref response from config.
     * @return array
     */
    function getSuccessHttpStatus(): array
    {
        return Config::get('intuition.default_success_status');
    }
}

if (!function_exists('getErrorHttpStatus')) {
    /**
     * Get error status and ref response from config.
     * @return array
     */
    function getErrorHttpStatus(): array
    {
        return Config::get('intuition.default_error_status');
    }
}

if (!function_exists('getSuccessHttpStatusCode')) {
    /**
     * Get only success status code from config.
     * @param int $default
     * @return int
     */
    function getSuccessHttpStatusCode(int $default = 200): int
    {
        return ArrayService::get(getSuccessHttpStatus(), 'status', $default);
    }
}

if (!function_exists('getSuccessHttpStatusRef')) {
    /**
     * Get only success status ref from config.
     * @param string $default
     * @return string
     */
    function getSuccessHttpStatusRef(string $default = 'Ok'): string
    {
        return ArrayService::get(getSuccessHttpStatus(), 'status_ref', $default);
    }
}

if (!function_exists('getErrorHttpStatusCode')) {
    /**
     * Get only error status code from config.
     * @param int $default
     * @return int
     */
    function getErrorHttpStatusCode(int $default = 400): int
    {
        return ArrayService::get(getErrorHttpStatus(), 'status', $default);
    }
}

if (!function_exists('getErrorHttpStatusRef')) {
    /**
     * Get only error status ref from config.
     * @param string $default
     * @return string
     */
    function getErrorHttpStatusRef(string $default = 'Bad Request'): string
    {
        return ArrayService::get(getErrorHttpStatus(), 'status_ref', $default);
    }
}

if (!function_exists('httpStatusCodeClassName')) {
    /**
     * Get HttpStatusCode class from config.
     * @return string
     */
    function httpStatusCodeClassName(): string
    {
        return Config::get('intuition.http_status_code_class');
    }
}

if (!function_exists('getStatusRef')) {
    /**
     * Find the ref associated with the status code in HttpStatusCode
     * @param int $status
     * @return string
     * @throws ReflectionException
     */
    function getStatusRef(int $status = 200): string
    {
        $class = new \ReflectionClass(httpStatusCodeClassName());
        $value = array_flip(($class)->getConstants())[$status];

        return constant(httpStatusCodeClassName() . "::{$value}_REF");
    }
}

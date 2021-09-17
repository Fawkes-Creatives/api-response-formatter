<?php

use ApiResponse\Formatter\Contracts\ResponseContract;

if (! function_exists('api_response')) {

    /**
     * A helper method to resolve the api response contract out of the service container.
     *
     * @return ResponseContract
     */
    function api_response(): ResponseContract
    {
        return app(ResponseContract::class);
    }
}
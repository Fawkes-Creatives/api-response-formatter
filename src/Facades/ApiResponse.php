<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */

namespace ApiResponse\Formatter\Facades;

use Illuminate\Support\Facades\Facade;
use ApiResponse\Formatter\Contracts\ResponseContract;

class ApiResponse extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ResponseContract::class;
    }
}

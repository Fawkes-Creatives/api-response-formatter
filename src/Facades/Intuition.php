<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */

namespace LaravelIntuition\Facades;

use Illuminate\Support\Facades\Facade;
use LaravelIntuition\Contracts\ResponseContract;

class Intuition extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ResponseContract::class;
    }
}

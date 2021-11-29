<h1 align="center">Laravel Intuition</h1>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fawkescreatives/laravel-intuition.svg)](https://packagist.org/packages/fawkescreatives/laravel-intuition)
[![Laravel 8.x](https://img.shields.io/badge/Laravel-8.x-red.svg)](http://laravel.com)
[![Total Downloads](https://poser.pugx.org/fawkescreatives/laravel-intuition/downloads)](https://packagist.org/packages/fawkescreatives/laravel-intuition)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fawkescreatives/laravel-intuition)

This package is for building the same format APIs responses in Laravel.

## Table of Contents

<p>

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](docs/usage.md#usage)
    - [Success Response](docs/usage.md#success-response)
    - [Error Response](docs/usage.md#error-response)
</p>

## Installation

You can install this package via composer using this command:

```bash
composer require fawkescreatives/laravel-intuition
```

The package will automatically register itself.

```php
/*
 * Package Service Providers...
 */

LaravelIntuition\LaravelIntuitionServiceProvider::class,
```

## Configuration
```bash
php artisan vendor:publish --provider="LaravelIntuition\LaravelIntuitionServiceProvider"
```

You can change the response by modifying the boolean values in ``config/intuition.php``.

You can customize the ``http status code class`` and ``default response values`` as needed.

eg..,
```php
. intuition.php

return [
    'status'               => true, // boolean
    'success'              => false, // boolean
    'message'              => false, // boolean
    
    // default response values
    'data_key_default_type'  => null, // null || array() // data key ရဲ့ default value type အတွက်
    'http_status_code_class' => LaravelIntuition\Http\HttpStatusCode::class,
    'default_success_status' => [
        'status'     => LaravelIntuition\Http\HttpStatusCode::SUCCESS,
        'status_ref' => LaravelIntuition\Http\HttpStatusCode::SUCCESS_REF
    ],
    'default_error_status'   => [
        'status'     => LaravelIntuition\Http\HttpStatusCode::BAD_REQUEST,
        'status_ref' => LaravelIntuition\Http\HttpStatusCode::BAD_REQUEST_REF
    ]
];

. output
{
    "status": 200,
    "status_ref": "Ok"
    "data": null
}
```

It is recommended to use ``App\Http\HttpStatusCode`` for ``https status code``.

```php
namespace App\Http;


class HttpStatusCode
{
     /**
     * Information code
     */

    const CONTINUE = 100;
    const EARLY_HITS = 103;

     /**
     * Success code
     */

    const SUCCESS = 200;
    const CREATED = 201;
    const ACCEPTED = 202;

    /**
     * Client error code
     */

    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;
}
```

## Testing

You can run the tests with:

```bash
composer test
```

### License

The MIT License (MIT). Please see [License File](https://github.com/Fawkes-Creatives/laravel-intuition/blob/main/LICENSE.md) for more information.

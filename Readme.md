# APIs Response Formatter

APIs response များကို format တစ်ခုတည်းဖြစ်စေရန်ရည်ရွယ်ပြီးတည်ဆောက်သည်။

## Table of Contents

<p>

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](docs/usage.md#usage)
    - [Success Response](docs/usage.md#success-response)
    - [Error Response](docs/usage.md#error-response)
</p>

## Installation

Composer ကိုသုံးပြီး Install လုပ်ပါ။

```bash
composer require fawkescreatives/api-response-formatter
```

Laravel Package Auto-Discovery မလုပ်လျှင် `config/app.php` file ထဲမှ `providers` ထဲမှာ ဒီလိုသွားထည့်ပါ။

```php
/*
 * Package Service Providers...
 */

ApiResponse\Formatter\ApiResponseServiceProvider::class,
```

## Configuration
```bash
php artisan vendor:publish --provider="ApiResponse\Formatter\ApiResponseServiceProvider"
```


``config/api_response_format.php`` မှ boolean value များကိုပြင်ဆင်ခြင်းဖြင့် response ကိုပြောင်းလဲနိုင်သည်။

eg..,
```php
. api_response_format.php

return [
    'status'               => true, // boolean
    'success'              => false, // boolean
    'message'              => false, // boolean
    'always_data_wrapping' => true, // boolean
];

. output
{
    "status": 200,
    "data": null
}
```

``status code`` များကိုအသုံးပြုရာတွင် ``App\Http\HtmlStatusCode`` ဖြင့်အသုံးပြုရန် အကြံပေးသည်။

<small>_ထို class ထဲမှ တန်ဖိုးများကိုပြောင်းလဲခြင်းဖြင့်လည်း default သတ်မှတ်ထားသော response status code များပြောင်းလဲမည်။_</small>

```php
namespace App\Http;


class HtmlStatusCode
{
     /**
     * Information code
     */

    const CONTINUE = 100;
    const EARLY_HITS = 103;

     /**
     * Success code
     */

    const SUCCESS = 200; // default success response
    const CREATED = 201;
    const ACCEPTED = 202;

    /**
     * Client error code
     */

    const BAD_REQUEST = 400; // default error response
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;
}
```

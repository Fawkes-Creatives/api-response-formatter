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

``http status code class`` နှင့် ``default response values များကိုမိမိလိုအပ်သလိုပြုလုပ်နိုင်သည်။ 

eg..,
```php
. api_response_format.php

return [
    'status'               => true, // boolean
    'success'              => false, // boolean
    'message'              => false, // boolean
    'always_data_wrapping' => true, // boolean
    
    // default response values
    'http_status_code_class' => ApiResponse\Formatter\Http\HttpStatusCode::class,
    'default_success_status' => [
        'status'     => ApiResponse\Formatter\Http\HttpStatusCode::SUCCESS,
        'status_ref' => ApiResponse\Formatter\Http\HttpStatusCode::SUCCESS_REF
    ],
    'default_error_status'   => [
        'status'     => ApiResponse\Formatter\Http\HttpStatusCode::BAD_REQUEST,
        'status_ref' => ApiResponse\Formatter\Http\HttpStatusCode::BAD_REQUEST_REF
    ]
];

. output
{
    "status": 200,
    "status_ref": "Ok"
    "data": null
}
```

``status code`` များကိုအသုံးပြုရာတွင် ``App\Http\HttpStatusCode`` ဖြင့်အသုံးပြုရန် အကြံပြုသည်။

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

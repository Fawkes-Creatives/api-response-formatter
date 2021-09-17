# Za Support Package

ဟိုနေရာသုံး ဒီနေရာသုံးနဲ့ ကော်ပီကူးပြီး ပြန်ပြန်ရေးနေရတဲ့ feature တွေကို Project ပေါင်းစုံမှာ ပြန်သုံးလို့ရအောင် လုပ်ထားတာ

## Table of Contents

<details><summary>Click to expand</summary><p>

- [Installation](#installation)
- [Usage](#usage)
    - [Request Helpers](#request-helpers)
    - [ZA Client](#za-client)
    - [Role & Permission](#role-permission)
    - [SMS Poh](#sms-poh)
    - [Slack Error Notification](#slack-error-notification)
    - [Language Switcher](#language-switcher)
    - [API Token Middleware](#api-token-middleware)
    - [Firebase Notification](#firebase-notification)
    - [Password Reset with OTP](#password-reset-with-otp)
    - [APK Update Endpoint Function](#apk-update-endpoint-function)
</p></details>

## Installation

Package ကို Laravel project ထဲမှာ git submodule အနေနဲ့ ထည့်ပါ။

```bash
git submodule add git@gitlab.com:zacompany/za-support.git za

```

Project `composer.json` ဖိုင်မှာ ဒီလိုလေးထည့်ပါ။

```json
"repositories": [
    {
        "type": "path",
        "url": "./za"
    }
]
```

ပြီးရင် `composer.json` ရဲ့ *require* section ထဲမှာ `za/support` ကိုထည့်ပါ။

```json
"require": {
    "php": "^7.1.3",
    "... other packages": "version",
    "za/support": "dev-master",
},
```
composer ကို အပ်ဒိတ်လုပ်ပါ။
```bash
composer update --prefer-source
```

## Usage

### Request Helpers
Json string အနေနဲ့ ပို့လိုက်တဲ့ ဒေတာတွေကို array အနေနဲ့ အလွယ်တစ်ကူယူရန်

```php
request()->jsonInput('json_string_key');
request()->jsonInputOnly(['json_string_key']);
request()->jsonInputExcept(['other_key']);
```

***

### ZA Client

အရင်ဆုံး 
`app\Providers\AppServiceProvider.php` မှာ Client ကိုဖန်တီးပေးရပါမယ်။
```php
$this->app->singleton('za', function($app) {
    return new \Za\Support\Services\ZaClient(ZA_API_TOKEN);
}); 
// GET Method
app('za')->get($uri, array $query = []);
app('za')->post($uri, array $inputs = []);
app('za')->put($uri, array $inputs = []);
app('za')->delete($uri);
```

***

### Role & Permission

`config\app.php` မှာ `Za\Support\Permission\PermissionServiceProvider` ကိုထည့်ပေးပါ။
Delivery system မှာသုံးနေတဲ့ Role/Permission ပုံစံမျိုးကို ဒီ ပတ်ကေ့မှာ သုံးနိုင်ပါတယ်။
ပထမအနေနဲ့ vendor publish လုပ်ပါမယ်။
```bash
php artisan vendor:publish --provider="Za\Support\Permission\PermissionServiceProvider"
```
အဲ့တာဆိုရင် database migration file နဲ့ `permissions.php` config file ရပါမယ်။ `permissions.php` config ဖိုင်မှာ ကိုယ် သုံးချင်တဲ့ permission data တွေဖြည့်သွင်းပေးပါ။ ပြီးရင်
```bash
php artisan permission:refresh
```
ဆိုပြီး permissions တွေကို database ထဲထည့်လို့ရပါတယ်။

Role အသစ်ဖန်တီးချင်ရင်
```bash
php artisan permission:create-role
```
ဆိုပြီးဖန်တီးပါ။

User model မှာ Permission trait ကို ချိတ်ပေးရပါမယ်။
```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use Za\Support\Permission\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use HasRoleAndPermission;

    // ...
}

// Check user has permission
auth()->user()->permit('post_create');
// OR
auth()->user()->canAccess('post_create');

// Assign permissions to role
Role::find(1)->attachPermissions(['permission-slug-array-from-permission-database']);
```

#### Permission Middleware
Middleware ကိုအသုံးပြုမယ်ဆို အရင်ဆုံး `app\Http\Kernel.php` မှာ သွားကြေငြာပေးရပါမယ်။
```php
protected $routeMiddleware = [
    // ...
    'permission' => \Za\Support\Permission\Middleware\Permission::class,
];
```
ပြီးရင် Route ကြေငြာတဲ့နေရာမှ သုံးလို့ရပါပြီ။
```php
Route::get('test', 'TestController@index')->middleware('permission:text_index');
// OR
Route::get('test', 'TestController@index')->permission('text_index');
```

#### Blade Directives

User  အနေနဲ့ permission ရှိမရှိ blade မှာ စစ်မယ်ဆိုရင်
```php
@permit('post_edit')
You have permisison for post edit.
@elseif ('post_create')
You does not have permisison for post edit but you can create new post.
@else
Sorry.
@endif
```

```php
@unless('post_edit')
Sorry. Bar lar shar par tha lal?
@endif
```

***

### SMS Poh
SMS Service အတွက် အဘသုံးတဲ့ SMSPoh နဲ့အလွယ်တစ်ကူချိတ်ဆက်လို့ရတဲ့ Layer တစ်ခုပါ။ ဒါကိုသုံးမယ်ဆိုရင်တော့ အရင်ဆုံး 
`app\Providers\AppServiceProvider.php` မှာ SmsPoh ကိုဖန်တီးပေးရပါမယ်။ လိုအပ်တဲ့ authentication key နဲ့ sender_name ကို `config\services.php` မှာအရင်ဆုံးဖြည့်ပေးပါ။
```php
    // ....,
    'sms_poh' => [
        'auth_key' => env('SMS_POH_KEY'),
        'sender_name' => env('SMS_POH_SENDER_NAME'),
    ],
```
ပြီးသွားရင် 
```php
public function boot()
{
    $this->app->singleton('smsPoh', function($app) {
        $config = config('services.sms_poh');
        return new SmsPoh($config['auth_key'], $config['sender_name']);
    });
}
```
SMS ပို့မယ်ဆိုရင်
```php
$number = '0912345678';
$message = 'Your OTP Code is : 123456';
app('smsPoh')->poh($number, $message);
```

***

### Slack Error Notification

Application မှာ error တက်တဲ့အချိန် Slack ကို error message ပို့ရန် (သို့) Slack ကို message တစ်ခုခုပို့ရန် အတွက်အသုံးပြုနိုင်ပါသည်။
အရင်ဆုံး 
`app\Providers\AppServiceProvider.php` မှာ Slack ကိုဖန်တီးပေးရပါမယ်။
```php
$this->app->singleton('slack', function($app) {
    $botName = "Your Application Name";
    // Icon is optional
    $botIcon = "https://storage.googleapis.com/delivery_software/slack_icons/epost_logo.png";
    return new SlackErrorNotification($botName, $botIcon);
}); 
```
Error Notification အတွက် `config\services.php` မှာ `error_channel` ဖြည့်ပေးပါ။
> Slack channel မှာ bot ထည့်နည်းကိုတော့ slack documentation မှာကြည့်ပါ
```php
    // ....,
    'slack' => [
        'error_channel' => 'XAF32600Z/BQ251TP2T/HLExu0EAsMZyVUtEaNuR8YYh',
    ],
```
ပြီးသွားရင် `app\Exceptions\Handler.php` မှာ error ကို slack ကိုပို့ပါမယ်။
```php
public function report(Exception $exception)
{
    parent::report($exception);

    if (env('ENABLE_SLACK_DEBUG') && $this->shouldReport($exception)) {
        SlackErrorNotification::captureError(app('slack'), $exception);
    }
}
```
Slack ကို သီးသန့် message ပို့ချင်ရင်တော့ ဒီလိုသုံးလို့ရပါတယ်။
```php
app('slack')->message($messageText, $attachments = [], $channel = null);
```
`$channel` က optional ဖြစ်ပြီးတော့ မသတ်မှတ်ပေးထားရင် error_channel ကို အသုံးပြုသွားမှာပါ။
`$channel`  အသစ်အတွက်ကို `config\services.php` မှာ `$channel` ဆိုပြီး အသစ်ဖြည့်ပေးရပါမယ်။
eg:
```php
    // ....,
    'slack' => [
        'error_channel' => 'XAF32600Z/BQ251TP2T/HLExu0EAsMZyVUtEaNuR8YYh',
        'alert_channel' => 'F3260XA0Z/25BQP2T1T/AsMZyVUtu0EEaNuR8YYhHLEx',
    ],

    app('slack')->message($messageText, $attachments = [], 'alert_channel');
```
Laravel ရဲ့ Macroable trait ကိုသုံးထားတဲ့ လိုအပ်တဲ့ method အသစ်ကို ထည့်ရေးလို့ရပါတယ်။
ဥပမာ Seller အသစ်တစ်ယောက် register လုပ်ရင် slack channel ကို ပို့ချင်တာမျိုး ဆိုပါတော့
`app\Providers\AppServiceProvider.php` မှာ `macro` အသစ်ထည့်ရေးပါမယ်။
```php
SlackErrorNotification::macro('newSellerRegister', function ($seller) {
    $channel = config("services.slack.seller_register");
    $payload = [
        'json' => [
            'text'        => 'New seller $seller->name registered.',
            'username'    => 'Seller',
        ]
    ];

    $this->sendMessage($channel, $payload);
});

// Usage
app('slack')->newSellerRegister($seller);
```
***

### Language Switcher

`config\app.php` မှာ `Za\Support\LanguageSwitch\LanguageSwitchServiceProvider` ကိုထည့်ပေးပါ။

ပထမအနေနဲ့ vendor publish လုပ်ပါမယ်။
```bash
php artisan vendor:publish --provider="Za\Support\LanguageSwitch\LanguageSwitchServiceProvider"
```
အဲ့တာဆိုရင် `language_switch.php` config file ရပါမယ်။ `language_switch.php` config ဖိုင်မှာ ကိုယ် သုံးချင်တဲ့ data တွေပြုပြင်နိုင်ပါတယ်။ ပြီးရင် `app/Http/Kernel.php` မှာ middleware ကိုထည့်ပေးပါ။
```php
'web' => [
    \App\Http\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    // ....
    \Za\Support\LanguageSwitch\Middlewares\SetApplicationLocale::class,
],
```
နောက်တစ်ဆင့်အနေနဲ့ controller file ကို ထုတ်ပါမယ်။
```bash
php artisan language:controller
```
Route file မှာ language switch route ကိုထည့်ပေးရပါမယ်။
```php
Route::languageSwitch();
// This method is same with this route
// Route::get('language-switch/{locale}', 'LanguageSwitch\LanguageSwitchController')->name('language.switch');
```

***

### API Token Middleware

`config\app.php` မှာ `Za\Support\Api\ApiServiceProvider` ကိုထည့်ပေးပါ။
API တွေရေးတဲ့နေရာမှာ token middleware ကို ဒီဟာသုံးလို့ရပါတယ်။
API request app ကိုလဲ token အလိုက်ခွဲထားပေးလို့ရလို့ slack error message မှာ Application Name ပါလာတာကြောင့် debug လုပ်ရတာကို ပိုပြီးအထောက်အကူ ပြုပါတယ်။
config file ကို အရင်ဆုံး publish လုပ်ပေးရပါမယ်။
```bash
php artisan vendor:publish --provider="Za\Support\Api\ApiServiceProvider"
```
ပြီးရင် `app/Http/Kernel.php` မှာ middleware ကိုထည့်ပေးပါ။
```php
'api' => [
    'throttle:60,1',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
    // ...
    \Za\Support\Api\Middlewares\ApiToken::class,
],
```

***

### Firebase Notification

Mobile app ကို Firebase push notification ပို့ဖို့အတွက် သုံးလို့ရပါတယ်။ 
`app\Providers\AppServiceProvider.php` မှာ Firebase configure လုပ်ပေးရပါမယ်။
```php
public function boot()
{
    \Za\Support\Services\Firebase::configure(SERVER_KEY, SENDER_ID);
}
```

User ရဲ့ firebase token နဲ့ ပို့မယ်ဆိုရင်
```php
Za\Support\Services\Firebase::send($token, $title, $body, $serverKey = null, $senderId = null);
// Example
// Za\Support\Services\Firebase::send(TOKEN, 'Testing Title', 'Hello world');
```
User ရဲ့ firebase token နဲ့ Data Message ပို့မယ်ဆိုရင်
```php
Za\Support\Services\Firebase::sendData($token, $title, $body, $payload = [], $serverKey = null, $senderId = null);
// Example
// Za\Support\Services\Firebase::sendData(TOKEN, 'Testing Title', 'Hello world', ['post_id' => 123]);
// Multuiple Token
// $tokens = [TOKEN_1, TOKEN_2];
// Za\Support\Services\Firebase::sendData($tokens, 'Testing Title', 'Hello world', ['post_id' => 123]);
```
> Za Android Developer တွေကတော့ Data Message အနေနဲ့ပဲ ပို့ဖို့ တောင်းဆိုပါတယ်။

***

### Password Reset with OTP

> SMS ပို့ရန်အတွက် SMS Poh Service ကိုလိုအပ်ပါတယ်။

OTP ကို SMS Message ပို့ပြီး Password Reset လုပ်ရန်အတွက် `config\app.php` မှာ `Za\Support\OTP\OTPServiceProvider` ကိုထည့်ပေးပါ။
လိုအပ်တဲ့ migration file ကို ထုတ်ပါမယ်။ ပြီးရင် migration command run ပါမယ်။
```bash
php artisan vendor:publish --provider="Za\Support\OTP\OTPServiceProvider"
php artisan migrate
```
နောက်တစ်ဆင့်အနေနဲ့ controller file ကို ထုတ်ပါမယ်။
```bash
php artisan otp:controller
```
Route file မှာ otp routes ကိုထည့်ပေးရပါမယ်။
```php
Route::otpPasswordReset();
// This method is same with this 2 routes
// Route::post('otp/password', 'OTP\PasswordResetController@request')->name('otp.password.request');
// Route::post('otp/password/reset', 'OTP\PasswordResetController@reset')->name('otp.password.reset');
```

***

### APK Update Endpoint Function

> Za Backend ကိုချိတ်ဆက်ရန်အတွက် ZaClient Service ကိုလိုအပ်ပါတယ်။

APK Version Update Endpoint လုပ်ရန်အတွက် `config\app.php` မှာ `Za\Support\ApkUpdater\ApkUpdaterServiceProvider` ကိုထည့်ပေးပါ။
နောက်တစ်ဆင့်အနေနဲ့ controller file ကို ထုတ်ပါမယ်။
```bash
php artisan apk:controller
```
Route file မှာ otp routes ကိုထည့်ပေးရပါမယ်။
```php
Route::apkUpdater();
// This method is same with this route
// Route::get('apk-updater/check', 'ZaApkUpdaterController@check')->name('za.apk_update_check');
```

***



[link-apility-laravel-fcm]: https://github.com/apility/Laravel-FCM
[link-packagist]: https://packagist.org/packages/za/permission
[link-downloads]: https://packagist.org/packages/za/permission
[link-travis]: https://travis-ci.org/za/permission
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/za
[link-contributors]: ../../contributors

<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */


/*
|--------------------------------------------------------------------------
| API Response Structure
|--------------------------------------------------------------------------
|
| Here is where you can register API response for your application. You
| can remove the parts you do not want. Happy to building API!
|
*/

return [
    'status'               => true, // boolean
    'success'              => true, // boolean
    'message'              => true, // boolean
    'always_data_wrapping' => true, // boolean | ဘယ်လိုအခြေအနေမျိုးမှာပဲဖြစ်ဖြစ် data ဆိုတဲ့ keyword နဲ့ wrap လုပ်ထားချင်ရင်

    // default response values
    'http_status_code_class' => ApiResponse\Formatter\Helpers\HttpStatusCode::class,
    'default_success_status' => [
        'status'     => ApiResponse\Formatter\Helpers\HttpStatusCode::SUCCESS,
        'status_ref' => ApiResponse\Formatter\Helpers\HttpStatusCode::SUCCESS_REF
    ],
    'default_error_status'   => [
        'status'     => ApiResponse\Formatter\Helpers\HttpStatusCode::BAD_REQUEST,
        'status_ref' => ApiResponse\Formatter\Helpers\HttpStatusCode::BAD_REQUEST_REF
    ]
];

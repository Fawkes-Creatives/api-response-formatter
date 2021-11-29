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
    'status'                 => true, // boolean
    'success'                => true, // boolean
    'message'                => true, // boolean

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

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

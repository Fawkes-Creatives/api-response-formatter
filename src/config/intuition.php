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
    /**
     * APIs response များတွင် http code(status code) ကိုပေးရန်ဖြစ်သည်
     * boolean တန်ဖိုးဖြင့် အဖွင့်အပိတ်ပြုလုပ်နိုင်သည်
     *
     * ဥပမာ - "status": 200
     *
     */
    'status'                 => true,

    /**
     * APIs response များတွင် success ဖြစ်မဖြစ်ပြန်ပေးရန်ဖြစ်သည်
     * boolean တန်ဖိုးဖြင့် အဖွင့်အပိတ်ပြုလုပ်နိုင်သည်
     *
     * ဥပမာ - "success": true
     *
     */
    'success'                => true,

    /**
     * APIs response များတွင် message ကိုပေးရန်ဖြစ်သည်
     * boolean တန်ဖိုးဖြင့် အဖွင့်အပိတ်ပြုလုပ်နိုင်သည်
     *
     * ဥပမာ - message: "This is successful"
     *
     */
    'message'                => true,

    /**
     * APIs response များတွင် data key ၏ default value type ကိုသတ်မှတ်ရန်ဖြစ်သည်။
     * null || array() အသုံးပြုနိုင်သည်
     *
     * ဥပမာ - "data": null
     *
     */
    'data_key_default_type'  => null,

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

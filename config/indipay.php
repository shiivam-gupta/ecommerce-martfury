<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Indipay Service Config
    |--------------------------------------------------------------------------
    |   gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo / ZapakPay / Mocker
    |   view    = File
    */

    'gateway' => 'payumoney',                // Replace with the name of default gateway you want to use

    'testMode'  => true,                   // True for Testing the Gateway [For production false]

    'ccavenue' => [                         // CCAvenue Parameters
        'merchantId'  => env('PAYMENT_MERCHANT_ID', ''),
        'accessCode'  => env('PAYMENT_ACCESS_CODE', ''),
        'workingKey' => env('PAYMENT_WORKING_KEY', ''),

        // Should be route address for url() function
        'redirectUrl' => env('PAYMENT_REDIRECT_URL', 'indipay/response'),
        'cancelUrl' => env('PAYMENT_CANCEL_URL', 'indipay/response'),

        'currency' => env('PAYMENT_CURRENCY', 'INR'),
        'language' => env('PAYMENT_LANGUAGE', 'EN'),
    ],

    'payumoney' => [                         // PayUMoney Parameters
        'merchantKey'  => env('PAYMENT_MERCHANT_KEY', ''),
        'salt'  => env('PAYMENT_SALT', ''),
        'workingKey' => env('PAYMENT_WORKING_KEY', ''),

        // Should be route address for url() function
        'successUrl' => env('PAYMENT_SUCCESS_URL', 'payment-response'),
        'failureUrl' => env('PAYMENT_FAILURE_URL', 'payment-response'),
    ],

    'ebs' => [                         // EBS Parameters
        'account_id'  => env('PAYMENT_MERCHANT_ID', ''),
        'secretKey' => env('PAYMENT_WORKING_KEY', ''),

        // Should be route address for url() function
        'return_url' => env('PAYMENT_SUCCESS_URL', 'indipay/response'),
    ],

    'citrus' => [                         // Citrus Parameters
        'vanityUrl'  => env('PAYMENT_CITRUS_VANITY_URL', ''),
        'secretKey' => env('PAYMENT_WORKING_KEY', ''),

        // Should be route address for url() function
        'returnUrl' => env('PAYMENT_SUCCESS_URL', 'indipay/response'),
        'notifyUrl' => env('PAYMENT_SUCCESS_URL', 'indipay/response'),
    ],

    'instamojo' =>  [
        'api_key' => env('INSTAMOJO_API_KEY',''),
        'auth_token' => env('INSTAMOJO_AUTH_TOKEN',''),
        'redirectUrl' => env('PAYMENT_REDIRECT_URL', 'indipay/response'),
    ],

    'mocker' =>  [
        'service' => env('MOCKER_SERVICE','default'),
        'redirect_url' => env('MOCKER_REDIRECT_URL', 'indipay/response'),
    ],

    'zapakpay' =>  [
        'merchantIdentifier' => env('ZAPAKPAY_MERCHANT_ID',''),
        'secret' => env('ZAPAKPAY_SECRET', ''),
        'returnUrl' => env('ZAPAKPAY_RETURN_URL', 'indipay/response'),
    ],

    // Add your response link here. In Laravel 5.2 you may use the api middleware instead of this.
    'remove_csrf_check' => [
        'indipay/response'
    ],





];

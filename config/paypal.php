<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => config('app.PAyPAL_MODE'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => config('app.PAYPAL_EMAIL_USERNAME'),
        'password'    => config('app.PAYPAL_KEY'),
        'secret'      => config('app.PAYPAL_SIGNATURE'),
        'certificate' => config('app.PAYPAL_CERTIFICATE'),
        'app_id'      => 'APP-80W284485P519543T', // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username'    => config('app.PAYPAL_EMAIL_USERNAME'),
        'password'    => config('app.PAYPAL_KEY'),
        'secret'      => config('app.PAYPAL_SIGNATURE'),
        'certificate' => config('app.PAYPAL_CERTIFICATE'),
        'app_id'      => '', // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => 'GBP',
    'billing_type'   => 'MerchantInitiatedBilling',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => false, // Validate SSL when creating api client.
];

// paypal!emon
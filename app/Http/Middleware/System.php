<?php

namespace App\Http\Middleware;

use Schema;
use Closure;
use Config;
use Session;
use App;
use App\Setting;

class System
{

    /*
    |--------------------------------------------------------
    | System middleware for get all system info
    |--------------------------------------------------------
    |
    | Company : Webexcel
    | Author : Emon Ahmed
    | Version : 1.0.0
    |
    */

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Schema::hasTable('theme_settings')) {

            $systemData = Setting::findOrFail(1);

            $lan = $systemData->site_language;
            $sitetimezone = $systemData->site_timezone;
            $currency = $systemData->site_currency;
            $dateFormat = $systemData->site_date_format;

            // Globally use host name
            $host = request()->getHttpHost();
            Session::put('domain_name',$host);

            // Language
            $locale = config('app.locale');
            if ($lan) {
                $locale = $lan;
            }
            App::setLocale($locale);

            // Timezone
            $timezone = config('app.timezone');
            if ($sitetimezone) {
                $timezone = $sitetimezone;
            }
            config(['app.timezone' => $timezone]);
            date_default_timezone_set($timezone);

            // currency
            Session::put('currency',$currency);
            
            // Date Format
            Session::put('dateFormat',$dateFormat);

            // Payment Keys

            $paymentInfo = \DB::table('payment_settings')->where('id',1)->first();

            $stripe_publish_key = $paymentInfo->s_p_k;
            $stripe_secret_key = $paymentInfo->s_s_k;

            config(['app.STRIPE_KEY' => $stripe_publish_key]);
            config(['app.STRIPE_SECRET' => $stripe_secret_key]);


            $paypal_email_username = $paymentInfo->p_u;
            $paypal_key = $paymentInfo->p_p;
            $paypal_signature = $paymentInfo->p_s;
            $paypal_mode = $paymentInfo->p_a_t;

            config(['app.PAYPAL_EMAIL_USERNAME' => $paypal_email_username]);
            config(['app.PAYPAL_KEY' => $paypal_key]);
            config(['app.PAYPAL_SIGNATURE' => $paypal_signature]);
            config(['app.PAyPAL_MODE' => $paypal_mode]);
        }

        return $next($request);
    }
}
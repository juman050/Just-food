<?php

namespace App\Http\Middleware;

use Schema;
use Closure;
use Session;
use App\Setting;

class Maintenance
{

    /*
    |----------------------------------------------------
    | Custom maintenance middleware for website
    |----------------------------------------------------
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
            if($systemData->site_status===0){
                Session::put('site_status','disable');
            }
            
            if($systemData->site_status===null){
                Session::put('site_status','enable');
            }
        }
        
        return $next($request);
    }
}
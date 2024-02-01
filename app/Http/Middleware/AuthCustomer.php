<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AuthCustomer
{
    /*
    |------------------------------------------------
    | Custom Authentication middleware for customer
    |------------------------------------------------
    |
    | 
    | Author : Juman
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
        if(Session::get('customerEmail') === null)
        {
            $output = [ 'status' => 'error','message' => 'Please Log-in first !' ];
            \Session::flash('sess_alert',$output);
            return redirect('/home');
        }

        
        return $next($request);
    }
}

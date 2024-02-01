<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use Schema;

class InstallController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Install Controller
    |--------------------------------------------------------------------------
    |
    | Author : Emon Ahmed
    | Version : 1.0.0
    |
    */

    public function __construct()
    {
        set_time_limit(3000);
    }

    /**
     * Install Your Project
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        if(!Schema::hasTable('theme_settings')) {
            Artisan::call('migrate:fresh', ["--force"=> true]);
            Artisan::call('db:seed');
        }
        return 'Installed Successfully !';

    }

    /**
     * Reset all tables
     *
     * @return \Illuminate\Http\Response
     */
    public function resetTable(){

        Artisan::call('migrate:fresh', ["--force"=> true]);
        Artisan::call('db:seed');
        return 'Table reset Successfully !';

    }


    /**
     * Clear Cache/Config/View/Route etc
     *
     * @return \Illuminate\Http\Response
     */
    public function clear(){

        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:cache');
        Artisan::call('route:clear');
        return 'Cache/Config/View/Route Clear Successfully !';

    }


}

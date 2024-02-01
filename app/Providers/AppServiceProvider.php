<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;

use View;
use App\Setting;
use App\Offer;
use App\StoreSetting;
use App\RestaurantOpenClose;
use App\DeliveryCollectionOther;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * All basic info for Just-food websites.
     *
     * @return websites info
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (Schema::hasTable('theme_settings')) {
            View::composer('*',function($view){

                $themeDatas = Setting::where('id',1)->first();
                $view->with('themeDatas',$themeDatas);

                $storeDatas = StoreSetting::where('id',1)->first();
                $view->with('storeDatas',$storeDatas);

                $openCloseDatas = RestaurantOpenClose::where('day',date('l'))->first();
                $view->with('openCloseDatas',$openCloseDatas);

                $offers = Offer::where('status','enable')
                        ->where('display_banner','yes')
                        ->where('startdate','<=',date('Y-m-d'))
                        ->where('enddate','>=',date('Y-m-d'))
                        ->first();
                $view->with('offers',$offers);

            });
        }

    }
}

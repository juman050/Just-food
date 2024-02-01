<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageSetting;
use App\Setting;
use App\Category;
use App\DeliveryCollectionOther;
use Session;

class HomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | Author : Juman
    | Version : 1.0.0
    |
    */

    protected $otherInfo = array();


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->otherInfo = DeliveryCollectionOther::where('id',1)->first();
    }


    /**
     * Display a Home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $otherDatas = $this->otherInfo;
        $pageInfo = PageSetting::find(1);
        $data['meta_title'] = $pageInfo->home_title;
        $data['meta_description'] = $pageInfo->home_meta_description;
        $categories = Category::withCount('getItems')->where('status','enable')->orderBy('sort','ASC')->get();
        return view('frontend.imageTheme.home.index',compact('data','otherDatas','pageInfo','categories'));
    }


    /**
     * Display a blank page.
     *
     * @return \Illuminate\Http\Response
     */
    public function blank()
    {
        return view('errors.blank');
    }
}

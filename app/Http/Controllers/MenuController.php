<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\PostcodeHelper;

use App\Item;
use App\Allergy;
use App\Category;
use App\Postcode;
use App\Mileage;
use App\Offer;
use App\DeliveryCollectionOther;

use DB;
use Cart;
use Validator;
use Session;
use Response;

class MenuController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Menu Controller
    |--------------------------------------------------------------------------
    |
    | Author : Emon Ahmed
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
     * Display a Menu page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $otherDatas = $this->otherInfo;
        if(checkPage($otherDatas,'menu') == 'false'){
            return redirect('/');
        }else{

            $pageInfo = DB::table('menu_page_settings')->where('id',1)->first();
            $data['meta_title'] = $pageInfo->menu_title;
            $data['meta_description'] = $pageInfo->menu_meta_description;

            $categories = Category::withCount('getItems')->where('status','enable')->orderBy('sort','ASC')->get();

            if(count($categories) > 0){

                if($request->id){
                    $sinCat = Category::where('id',$request->id)->where('status','enable')->first();
                    if($sinCat){
                        $cat_id = $sinCat->id;
                        $cat_name = $sinCat->cat_name;
                    }else{
                        return redirect('/');
                    }
                    
                }else{
                    $cat_id = $categories[0]->id;
                    $cat_name = $categories[0]->cat_name;
                }

                $records = DB::table('categories')
                            ->leftJoin('items', 'items.item_cat_id', '=', 'categories.id')
                            ->orderBy('categories.sort','ASC')
                            ->where('categories.id',$cat_id)
                            ->where('categories.status','enable')
                            ->where('items.status','enable')
                            ->select(
                                'items.*',
                                'categories.id as cat_id',
                                'categories.cat_name',
                                'categories.cat_description',
                                'categories.cat_image',
                                'categories.cat_available_days',
                                'categories.cat_available_delivery_method',
                                'categories.sort',
                                'categories.status'
                            )
                            ->get();


                foreach ($records as $record) {
                    $record->variances = DB::table('item_variances')
                                            ->leftJoin('variance', 'variance.id', '=', 'item_variances.variance_id')
                                            ->select(
                                                'item_variances.*',
                                                'variance.variance_name',
                                                'variance.sort as variance_sort',
                                                'variance.status as v_status'
                                            )
                                            ->where('item_variances.item_id',$record->id)
                                            ->where('item_variances.status','enable')
                                            ->orderBy('item_variances.sort','DESC')
                                            ->get();
                    $record->allergies = DB::table('item_allergies')
                                            ->leftJoin('allergies', 'allergies.id', '=', 'item_allergies.allergy_id')
                                            ->where('item_allergies.item_id',$record->id)
                                            ->where('allergies.status','enable')
                                            ->select(
                                                'allergies.*'
                                            )
                                            ->get();
                }

                return view('frontend.imageTheme.menu.index',compact('data','otherDatas','pageInfo','categories','records','cat_name','cat_id'));
            }else{
                $records = array();
                return view('frontend.imageTheme.menu.index',compact('data','otherDatas','pageInfo','categories','records','cat_name','cat_id'));
            }

        }

    }


    /**
     * Display menu page by category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function catItem(Request $request)
    {
        $otherDatas = $this->otherInfo;
        if(checkPage($otherDatas,'menu') == 'false'){
            return redirect('/');
        }else{
            $cat_id = $request->cat_id;
            $records = DB::table('categories')
                        ->leftJoin('items', 'items.item_cat_id', '=', 'categories.id')
                        ->orderBy('categories.sort','ASC')
                        ->where('categories.id',$cat_id)
                        ->where('categories.status','enable')
                        ->where('items.status','enable')
                        ->select(
                            'items.*',
                            'categories.id as cat_id',
                            'categories.cat_name',
                            'categories.cat_description',
                            'categories.cat_image',
                            'categories.cat_available_days',
                            'categories.cat_available_delivery_method',
                            'categories.sort',
                            'categories.status'
                        )
                        ->get();


            foreach ($records as $record) {
                $record->variances = DB::table('item_variances')
                                        ->leftJoin('variance', 'variance.id', '=', 'item_variances.variance_id')
                                        ->where('item_variances.item_id',$record->id)
                                        ->where('item_variances.status','enable')
                                        ->orderBy('item_variances.sort','DESC')
                                        ->select(
                                            'item_variances.*',
                                            'variance.variance_name',
                                            'variance.sort as variance_sort',
                                            'variance.status'
                                        )
                                        ->get();
                $record->allergies = DB::table('item_allergies')
                                        ->leftJoin('allergies', 'allergies.id', '=', 'item_allergies.allergy_id')
                                        ->where('item_allergies.item_id',$record->id)
                                        ->where('allergies.status','enable')
                                        ->select(
                                            'allergies.*'
                                        )
                                        ->get();
            
            }

            return view('frontend.imageTheme.menu.catItem',compact('records','otherDatas'));

        }
    }


    /**
     * Display sub variance of item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subVar(Request $request)
    {
        $otherDatas = $this->otherInfo;
        if(checkPage($otherDatas,'menu') == 'false'){
            return redirect('/');
        }else{

            $data['item_id'] = $item_id = $request->item_id;
            $data['item_name'] = $request->item_name;
            $data['item_price'] = $request->item_price;
            $data['item_var_id'] = $request->item_var_id;
            $data['var_name'] = $request->var_name;

            $sub_items = DB::table('sub_items_item')
                            ->leftJoin('sub_items','sub_items.id','=','sub_items_item.sub_item_id')
                            ->select('sub_items.*','sub_items_item.id as sii_id','sub_items_item.item_id as sii_item_id','sub_items_item.sub_item_id as sii_sub_item_id')
                            ->where('sub_items_item.item_id',$item_id)
                            ->orderBy('sub_items.sort','ASC')
                            ->get();

            foreach ($sub_items as $single_sub_variances) {

                $single_sub_variances->sub_variances = DB::table('item_subvariances')
                                    ->leftJoin('sub_item_variance','sub_item_variance.id','=','item_subvariances.sub_var_id')
                                    ->select('sub_item_variance.*','item_subvariances.id as isv_id','item_subvariances.sub_item_id as isv_sub_item_id','item_subvariances.sub_var_id as isv_sub_var_id','item_subvariances.status as isv_status')
                                    ->where('item_subvariances.sub_item_id',$single_sub_variances->sii_id)
                                    ->orderBy('item_subvariances.sort','ASC')
                                    ->get();
            }

            return view('frontend.imageTheme.menu.subvar',compact('data','sub_items','otherDatas'));

        }
    }


    /**
     * Check post code
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkPostcode(Request $request)
    {
        $otherDatas = $this->otherInfo;
        if(checkPage($otherDatas,'menu') == 'false'){
            return redirect('/');
        }else{

            $postcode = $request->postcode;

            if($postcode){

                // get all restricted zipcodes from the tables. i'm dsiplaying static codes 'B23','B24';
                // $restrictedZipCodes = ['B23 6SN','B24','SW1A'];
                $restrictedZipCodes = Postcode::where('postcode_status','enable')->get();


                // $zipcode = PostcodeHelper::getDistrict($postcode);
                $zipcode = $postcode;

                $flag=0;
                $minimumOrder = 0;
                $deliveryCharge = 0.00;

                for ($i=0; $i < count($restrictedZipCodes) ; $i++) {
                    // if(strtoupper($restrictedZipCodes[$i]->postcode_area)==strtoupper($zipcode)){
                        $pos = strpos(strtoupper($zipcode), strtoupper($restrictedZipCodes[$i]->postcode_area));
                        if($pos!==false){
                            $deliveryCharge = $restrictedZipCodes[$i]->postcode_delivery_charge;
                            $minimumOrder = $restrictedZipCodes[$i]->postcode_minimum_order;

                            if(Cart::total() >= $minimumOrder){
                                $flag++;
                                $msg = 'Delivery postcode is: '.$postcode;
                                break;
                            }else{
                                $msg = 'Please order minimum: '.$minimumOrder;
                                break;
                            }

                        }
                    else{
                        $msg = 'We do not deliver to this postcode: '.$postcode;
                    }
                }

                if ($flag==1) {

                    Session::put('postcode',$postcode);
                    Session::put('deliveryCharge',$deliveryCharge);
                    $records = [
                        'message' => $msg
                    ];

                }else{

                    Session::remove('postcode');
                    Session::remove('deliveryCharge');
                    $records = [
                        'message' => $msg
                    ];

                }
                
            }

            return view('frontend.imageTheme.menu.postcode_cart',compact('records','otherDatas'));

        }
    }


    /**
     * Change delivery method
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeMethod(Request $request)
    {
        $methodType = $request->method;
        $otherDatas = $this->otherInfo;
        if(checkPage($otherDatas,'menu') == 'false'){
            return redirect('/');
        }else{
            if(Session::get('deliveryMethod')){
                Session::remove('deliveryMethod');
                Session::put('deliveryMethod',$methodType);
                
                Session::remove('postcode');
                Session::remove('deliveryCharge');
                
            }else{
                
                Session::put('deliveryMethod',$methodType);
            }
            return view('frontend.imageTheme.menu.pickup',compact('methodType','otherDatas'));
        }
    }



    /**
     * Suggest post code
     *
     * @return \Illuminate\Http\Response
     */
    public function getPostcodeForSuggest()
    {
        $finalResult = array();
        if (isset($_GET['term'])){

            $q = strtolower($_GET['term']);
            $data = Postcode::where('postcode_status','enable')
                    ->Where('postcode_area', 'LIKE', '%'.$q.'%')
                    ->get();

            foreach ($data as $value) {
                $finalResult[] = $value->postcode_area;
            }
            
            return Response::json($finalResult);
        }

    }



    /**
     * Check Coupon code
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkCouponCode(Request $request)
    {
        $otherDatas = $this->otherInfo;
        if(checkPage($otherDatas,'menu') == 'false'){
            return redirect('/');
        }else{

            $offer_id = $request->offer_id;
            $code = $request->code;

            if($code){

                $result = Offer::where('id',$offer_id)->where('coupon_code',$code)->first();

                if ($result) {

                    Session::put('coupon_status','done');
                    Session::put('coupon_code',$code);
                    return view('frontend.imageTheme.menu.cart')->with(compact('otherDatas'));

                }else{

                    Session::put('coupon_status','pending');
                    return 'error';

                }
                
            }


        }
    }



    /**
     * category item for mobile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function catItemMb(Request $request)
    {
        $otherDatas = $this->otherInfo;
        if(checkPage($otherDatas,'menu') == 'false'){
            return redirect('/');
        }else{
            $cat_id = $request->cat_id;
            $records = DB::table('categories')
                        ->leftJoin('items', 'items.item_cat_id', '=', 'categories.id')
                        ->orderBy('categories.sort','ASC')
                        ->where('categories.id',$cat_id)
                        ->where('categories.status','enable')
                        ->where('items.status','enable')
                        ->select(
                            'items.*',
                            'categories.id as cat_id',
                            'categories.cat_name',
                            'categories.cat_description',
                            'categories.cat_image',
                            'categories.cat_available_days',
                            'categories.cat_available_delivery_method',
                            'categories.sort',
                            'categories.status'
                        )
                        ->get();


            foreach ($records as $record) {
                $record->variances = DB::table('item_variances')
                                        ->leftJoin('variance', 'variance.id', '=', 'item_variances.variance_id')
                                        ->where('item_variances.item_id',$record->id)
                                        ->where('variance.status','enable')
                                        ->orderBy('item_variances.sort','DESC')
                                        ->select(
                                            'item_variances.*',
                                            'variance.variance_name',
                                            'variance.sort as variance_sort',
                                            'variance.status'
                                        )
                                        ->get();
                $record->allergies = DB::table('item_allergies')
                                        ->leftJoin('allergies', 'allergies.id', '=', 'item_allergies.allergy_id')
                                        ->where('item_allergies.item_id',$record->id)
                                        ->where('allergies.status','enable')
                                        ->select(
                                            'allergies.*'
                                        )
                                        ->get();
            
            }

            return view('frontend.imageTheme.menu.catItemMb',compact('records','otherDatas'));

        }
    }


}

<?php

namespace App\Http\Controllers\Printapi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Carbon\Carbon;

class ApiController extends Controller
{


    /*
    |-------------------------------------
    | Print Api Controller
    |-------------------------------------
    |
    | Company : Webexcel
    | Author : Juman Muhammad
    | Version : 1.0.0
    |
    */



    /**
     * Display a listing of the order data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $key = $request->key;
        if ($key=='pending') {
     
            $st = array(
                'order_status'=>'pending',
                'order_payment_status' => 'done'
            );
            
        }elseif ($key=='delivered') {
            $st = array('order_status'=>'delivered');

        }elseif ($key=='cancelled') {
            $st = array('order_status'=>'cancelled' );           

        }elseif ($key=='not_paid') {
            $st = array('order_payment_status'=>'pending');            
        }else{
            $st = array(
                'order_status'=>'processing'
            );
        }
        
        $lists = DB::table('orders')->where($st)->orderBy('id', 'DESC')->get();

        return response()->json(['lists'=>$lists]);
        
    }


    /**
     * Display a specific order details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $key = $request->key;
        $id = $request->order_id;
        $lists=array();
        if ($key=='show' && $id) {

            $lists['order_info'] = DB::table('orders')
                                    ->where('id',$id)
                                    ->get();
     
            $lists['order_items'] = DB::table('order_items')
                                    ->where('order_id',$id)
                                    ->orderBy('id','ASC')
                                    ->get();

            $lists['order_payment'] = DB::table('order_payment')
                                    ->where('order_id',$id)
                                    ->get();
                                    
            return response()->json(['lists'=>$lists]);
        }  
        
    }


   

}

<?php

namespace App\Http\Controllers\Backend;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Carbon\Carbon;

class OrderController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Order Controller
    |--------------------------------------------------------------------------
    |
    | Author : Juman
    | Version : 1.0.0
    |
    */



    /**
     * Display a listing of all order.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Manage | Orders';
        $data['pageName'] = 'All orders';
        $data['pageTagLine'] = 'Manage Orders';
        $lists = Order::orderBy('id','DESC')->get();
        return view('admin.order.index',compact('data','lists'));
    }


    /**
     * Display a listing of the pending order.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending_method()
    {
        $data['title'] = 'Manage | Orders';
        $data['pageName'] = 'Pending orders';
        $data['pageTagLine'] = 'Manage Orders';
        $lists = Order::orderBy('id','DESC')->where('order_status','pending')->get();
        return view('admin.order.pending',compact('data','lists'));
    }

    
    /**
     * Display a listing of processing order.
     *
     * @return \Illuminate\Http\Response
     */
    public function processing()
    {
        $data['title'] = 'Manage | Orders';
        $data['pageName'] = 'Processing orders';
        $data['pageTagLine'] = 'Manage Orders';
        $lists = Order::orderBy('id','DESC')->where('order_status','processing')->get();
        return view('admin.order.processing',compact('data','lists'));
    }


    
    /**
     * Display a listing of delevered order
     *
     * @return \Illuminate\Http\Response
     */
    public function delivered()
    {
        $data['title'] = 'Manage | Orders';
        $data['pageName'] = 'Delivered orders';
        $data['pageTagLine'] = 'Manage Orders';
        $lists = Order::orderBy('id','DESC')->where('order_status','delivered')->get();
        return view('admin.order.delivered',compact('data','lists'));
    }



    
    /**
     * Display a listing of cancelled order.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelled()
    {
        $data['title'] = 'Manage | Orders';
        $data['pageName'] = 'Delivered orders';
        $data['pageTagLine'] = 'Manage Orders';
        $lists = Order::orderBy('id','DESC')->where('order_status','cancelled')->get();
        return view('admin.order.cancelled',compact('data','lists'));
    }


    
    /**
     * Display a listing of not paid order.
     *
     * @return \Illuminate\Http\Response
     */
    public function not_paid()
    {
        $data['title'] = 'Manage | Orders';
        $data['pageName'] = 'Payment pending orders';
        $data['pageTagLine'] = 'Manage Orders';
        $lists = Order::orderBy('id','DESC')->where('order_payment_status','pending')->get();
        return view('admin.order.not_paid',compact('data','lists'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $lists[] = $order;

        foreach ($lists as $singleOrder) {

            $singleOrder->order_items = DB::table('order_items')
                                    ->where('order_id',$singleOrder['id'])
                                    ->orderBy('id','ASC')
                                    ->get();

            $singleOrder->order_payment = DB::table('order_payment')
                                    ->where('order_id',$singleOrder['id'])
                                    ->get();


        }
        return view('admin.order.show',compact('lists'));
    }


    /**
     * Update status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        try {

            $order_id = $request->id;
            $order_status = $request->status;

            $order = Order::find($order_id);
            $order->order_status = $order_status;
            $order->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Order moved to '.$order_status];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => $e->getMessage() ];

        }

        echo json_encode($output);
        exit;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $data['title'] = 'Manage | Orders';
        $data['pageTagLine'] = 'Manage Orders';

        $order_type = $request->order_type;

        $where = array();

        if($order_type=='allorder'){
            $where = array();
            $data['pageName'] = 'All orders';
        }

        if($order_type=='pendingorder'){
            $where['order_status'] = 'pending';
            $data['pageName'] = 'Pending orders';
        }

        if($order_type=='deliveredorder'){
            $where['order_status'] = 'delivered';
            $data['pageName'] = 'Delivered orders';
        }

        if($order_type=='cancelledorder'){
            $where['order_status'] = 'cancelled';
            $data['pageName'] = 'Cancelled orders';
        }

        if($order_type=='processingorder'){
            $where['order_status'] = 'processing';
            $data['pageName'] = 'Processing orders';
        }


        $filter_type = $request->filter_type;

        if($filter_type=='all'){
            $lists = Order::orderBy('id','DESC')->where($where)->get();
        }
        if($filter_type=='today'){
            $lists = Order::orderBy('id','DESC')->where($where)->whereDay('created_at', '=', date('d'))->get();
        }
        if($filter_type=='week'){
            // $date = Carbon::now()->addDays(7);
            Carbon::setWeekStartsAt(Carbon::SUNDAY);
            Carbon::setWeekEndsAt(Carbon::SATURDAY);
            $lists = Order::orderBy('id','DESC')->where($where)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        }
        if($filter_type=='month'){
            $lists = Order::orderBy('id','DESC')->where($where)->whereMonth('created_at', '=', date('m'))->get();
        }
        if($filter_type=='year'){
            $lists = Order::orderBy('id','DESC')->where($where)->whereYear('created_at', '=', date('Y'))->get();
        }
        return view('admin.order.filter',compact('data','lists','order_type'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function date_filter(Request $request)
    {
        $date = $request->date;
        $dateArray = explode('-', $date);
        $startdate = str_replace('/', '-', $dateArray[0]);
        $enddate = str_replace('/', '-', $dateArray[1]);

        $order_type = $request->order_type;

        $data['title'] = 'Manage | Orders';
        $data['pageTagLine'] = 'Manage Orders';

        $where = array();

        if($order_type=='allorder'){
            $where = array();
            $data['pageName'] = 'All orders';
        }

        if($order_type=='pendingorder'){
            $where['order_status'] = 'pending';
            $data['pageName'] = 'Pending orders';
        }

        if($order_type=='deliveredorder'){
            $where['order_status'] = 'delivered';
            $data['pageName'] = 'Delivered orders';
        }

        if($order_type=='cancelledorder'){
            $where['order_status'] = 'cancelled';
            $data['pageName'] = 'Cancelled orders';
        }

        if($order_type=='processingorder'){
            $where['order_status'] = 'processing';
            $data['pageName'] = 'Processing orders';
        }


        $lists = Order::orderBy('id','DESC')->where($where)->whereBetween('created_at', [$startdate, $enddate])->get();

        return view('admin.order.filter',compact('data','lists','order_type'));
    }

}

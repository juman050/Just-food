<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;
use Session;
use Validator;
use App\DeliveryCollectionOther;
use App\Customer;
use App\Order;
use Stripe;
use Illuminate\Support\Facades\Mail;


class CartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Cart Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cart::content();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $otherDatas = $this->otherInfo;
        $subVariance=[];

        $varId = null;
        $varName = null;

        $itemId = $request->item_id;
        $itemName = $request->item_name;
        $itemQty = 1;
        $itemPrice = $request->item_price;

        $varId = $request->variance_id;
        $varName = $request->variance_name;

        $subVariance = $request->subVariance;

        $result = Cart::add([
            'id' => $itemId, 
            'name' => $itemName, 
            'qty' => $itemQty, 
            'price' => number_format($itemPrice, 2, '.', ','),
            'options' => ['varId' => $varId,'varName' => $varName,'subVariances' => $subVariance]
        ]);

        if($result){
            return view('frontend.imageTheme.menu.cart')->with(compact('result','otherDatas'));
        }else{
            return view('frontend.imageTheme.menu.cart')->with(compact('otherDatas'));
        }
    }
    


    /**
     * Update cart information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $otherDatas = $this->otherInfo;
        $qty = $request->qty;
        $rowid = $request->rowid;
        $result = Cart::update($rowid,$qty);
        if($result){
            return view('frontend.imageTheme.menu.cart')->with(compact('result','otherDatas'));
        }else{
            return view('frontend.imageTheme.menu.cart')->with(compact('otherDatas'));
        }
    }


    /**
     * Display checkout page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $reqDatas['shippingMethod'] = $request->shippingMethod;
        $reqDatas['zipcode'] = $request->zipcode;
        $reqDatas['postcode'] = $request->postcode;
        $reqDatas['deliveryCharge'] = $request->deliveryCharge;
        $reqDatas['discount'] = $request->discount;

        $otherDatas = $this->otherInfo;

        $paymentInfo = DB::table('payment_settings')->where('id',1)->first();

        $pageInfo = DB::table('menu_page_settings')->where('id',1)->first();
        $data['meta_title'] = $pageInfo->menu_title;
        $data['meta_description'] = $pageInfo->menu_meta_description;
        $datas = $request->all();

        $user = Customer::find(\Session::get('customerId'));

        return view('frontend.imageTheme.checkout.index')->with(compact('data','otherDatas','reqDatas','user','paymentInfo'));
    }



    /**
     * Make a order
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                    'shipping_time' => 'required',
                    'first_name' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                    'payment' => 'required',
                    'shippingMethod' => 'required',
                    'deliveryCharge' => 'required',
                    'discount' => 'required',
                ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // DB::beginTransaction();

            $date = date('Y-m-d H:i:s');
            $shipping_time = $request->shipping_time;
            $shippingMethod = $request->shippingMethod;
            $zipcode = $request->zipcode;
            $postcode = $request->postcode;
            if($shippingMethod=='collection'){
                $zipcode = $request->store_postcode;
                $postcode = $request->store_postcode;
            }
            $deliveryCharge = $request->deliveryCharge;
            $discount = $request->discount;
            $postcode_details = $request->postcode_details;
            $special_request = $request->special_request;
            $customer_id = \Session::get('customerId');
            $first_name = $request->first_name;
            $email = $request->email;
            $phone = $request->phone;
            $address = $request->address;
            $payment = $request->payment;
            $totalQty = 0;
            foreach (Cart::content() as $row) {
                $totalQty = $totalQty + $row->qty;
            }
            $subtotal = Cart::total();
            $qty = $totalQty;
            $total = Cart::total() + $deliveryCharge;

            $ordersData = array(

                'order_date' => $date,
                'order_delivery_time' => $shipping_time,
                'order_delivery_type' => $shippingMethod,
                'order_extra_fee' => 0,
                'order_delivery_charge' => $deliveryCharge,
                'order_subtotal' => $subtotal,
                'order_total' => $total,
                'order_total_item' => $qty,
                'login_user_id' => $customer_id,
                'order_customer_name' => $first_name,
                'order_contact_number' => $phone,
                'order_email' => $email,
                'order_address' => $address,
                'order_postcode' => $postcode,
                'order_postcode_details' => $postcode_details,
                'order_special_request' => $special_request,
                'order_status' => 'pending',
                'inserted' => $date,
            );

            if($payment=="cash"){

                $ordersData['order_pay_method'] = 'cash';
                $ordersData['order_payment_status'] = 'done';

                $order = Order::create($ordersData);
                $insertedOrderId = $order->id;

                foreach (Cart::content() as $row) {

                    $itemId = $row->id;
                    $itemName = $row->name;
                    $itemPrice = $row->price;
                    $itemQty = $row->qty;

                    $itemData['order_id'] = $insertedOrderId;
                    $itemData['item_id'] = $itemId;
                    $itemData['item_name'] = $itemName;
                    $itemData['price'] = $itemPrice;
                    $itemData['qty'] = $itemQty;
                    $itemData['created_at'] = $date;

                    if($row->options->has('varName')){
                        $varName = $row->options->varName;
                        $itemData['var_name'] = $varName;
                    }

                    if($row->options->subVariances){
                        $subVarAll = implode(',', $row->options->subVariances);
                        $itemData['sub_var'] = $subVarAll;
                    }

                    $itemInsertedId = $order_id = DB::table('order_items')->insert($itemData);

                }

                Mail::send('mail.orderMail',$ordersData,function($message) use ($email){
                    $message->to($email)->subject('New order from Just-Food');
                });

                $otherDatas = $this->otherInfo;
                $pageInfo = DB::table('menu_page_settings')->where('id',1)->first();
                $data['meta_title'] = $pageInfo->menu_title;
                $data['meta_description'] = $pageInfo->menu_meta_description;
                Cart::destroy();
                return view('frontend.imageTheme.checkout.success',compact('data','otherDatas','pageInfo','order_id'));

            }


            if($payment=="paypal"){

                $paypal_email_username = config('app.PAYPAL_EMAIL_USERNAME');
                $paypal_key = config('app.PAYPAL_KEY');
                $paypal_signature = config('app.PAYPAL_SIGNATURE');
                $paypal_mode = config('app.PAyPAL_MODE');

                $ordersData['order_pay_method'] = 'online';
                $ordersData['order_payment_status'] = 'pending';
                $order = Order::create($ordersData);
                $insertedOrderId = $order->id;

                foreach (Cart::content() as $row) {

                    $itemId = $row->id;
                    $itemName = $row->name;
                    $itemPrice = $row->price;
                    $itemQty = $row->qty;

                    $itemData['order_id'] = $insertedOrderId;
                    $itemData['item_id'] = $itemId;
                    $itemData['item_name'] = $itemName;
                    $itemData['price'] = $itemPrice;
                    $itemData['qty'] = $itemQty;
                    $itemData['created_at'] = $date;

                    if($row->options->has('varName')){
                        $varName = $row->options->varName;
                        $itemData['var_name'] = $varName;
                    }

                    if($row->options->subVariances){
                        $subVarAll = implode(',', $row->options->subVariances);
                        $itemData['sub_var'] = $subVarAll;
                    }

                    $itemInsertedId = DB::table('order_items')->insert($itemData);

                }

                Mail::send('mail.orderMail',$ordersData,function($message) use ($email){
                    $message->to($email)->subject('New order from Just-Food');
                });

                $data = [];
                $data['items'] = [
                    [
                        'name' => 'Just-food paypal payment',
                        'price' => $total,
                        'desc'  => 'A payment from justfood company',
                        'qty' => 1
                    ]
                ];
          
                $data['invoice_id'] = $insertedOrderId;
                $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
                $data['return_url'] = route('payment.success');
                $data['cancel_url'] = route('payment.cancel');
                $data['total'] = $total;
          
                $provider = new ExpressCheckout;
          
                $response = $provider->setExpressCheckout($data);
          
                $response = $provider->setExpressCheckout($data, true);
          
                return redirect($response['paypal_link']);

            }

            if($payment=="card"){

                $ordersData['order_pay_method'] = 'online';
                $ordersData['order_payment_status'] = 'pending';
                $order = Order::create($ordersData);
                $insertedOrderId = $order->id;

                foreach (Cart::content() as $row) {

                    $itemId = $row->id;
                    $itemName = $row->name;
                    $itemPrice = $row->price;
                    $itemQty = $row->qty;

                    $itemData['order_id'] = $insertedOrderId;
                    $itemData['item_id'] = $itemId;
                    $itemData['item_name'] = $itemName;
                    $itemData['price'] = $itemPrice;
                    $itemData['qty'] = $itemQty;
                    $itemData['created_at'] = $date;

                    if($row->options->has('varName')){
                        $varName = $row->options->varName;
                        $itemData['var_name'] = $varName;
                    }

                    if($row->options->subVariances){
                        $subVarAll = implode(',', $row->options->subVariances);
                        $itemData['sub_var'] = $subVarAll;
                    }

                    $itemInsertedId = DB::table('order_items')->insert($itemData);

                }


                Mail::send('mail.orderMail',$ordersData,function($message) use ($email){
                    $message->to($email)->subject('New order from Just-Food');
                });


                $otherDatas = $this->otherInfo;
                $pageInfo = DB::table('menu_page_settings')->where('id',1)->first();
                $data['meta_title'] = $pageInfo->menu_title;
                $data['meta_description'] = $pageInfo->menu_meta_description;
                return view('frontend.imageTheme.checkout.stripe',compact('data','otherDatas','pageInfo','pageInfo','total','insertedOrderId'));

            }

            // DB::commit();

            $otherDatas = $this->otherInfo;
            $pageInfo = DB::table('menu_page_settings')->where('id',1)->first();
            $data['meta_title'] = $pageInfo->menu_title;
            $data['meta_description'] = $pageInfo->menu_meta_description;
            Cart::destroy();
            return view('frontend.imageTheme.checkout.success',compact('data','otherDatas','pageInfo','order_id'));

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());


            $reqDatas['shippingMethod'] = $shippingMethod;
            $reqDatas['zipcode'] = $zipcode;
            $reqDatas['postcode'] = $postcode;
            $reqDatas['deliveryCharge'] = $deliveryCharge;
            $reqDatas['discount'] = $discount;

            $otherDatas = $this->otherInfo;
            $pageInfo = DB::table('menu_page_settings')->where('id',1)->first();
            $data['meta_title'] = $pageInfo->menu_title;
            $data['meta_description'] = $pageInfo->menu_meta_description;
            $datas = $request->all();

            $user = Customer::find(\Session::get('customerId'));
            $paymentInfo = DB::table('payment_settings')->where('id',1)->first();

            \Session::flash('message', $e->getMessage());
            return view('frontend.imageTheme.checkout.index')->with(compact('data','otherDatas','reqDatas','user','paymentInfo'));

        }

    }


    /**
     * Destroy all cart info 
     *
     * @return \Illuminate\Http\Response
     */
    public function cartalldelete(){
        
        Cart::destroy();
        \Session::remove('coupon_status');
        \Session::remove('deliveryMethod');

    }


    /**
     * Stripe payment code
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request){

        $amount = $total = $request->amount;
        $order_id = $insertedOrderId = $request->order_id;
        $stripeToken = $request->stripeToken;

        $stripe_key = config('app.STRIPE_KEY');
        $stripe_secret = config('app.STRIPE_SECRET');


        $stripe = Stripe\Stripe::setApiKey($stripe_secret);

        $charge = Stripe\Charge::create ([
            "amount" => $amount * 100,
            "currency" => "GBP",
            "source" => $stripeToken,
            "description" => "Just-food payment" 
        ]);

        if($charge['status'] === 'succeeded') {

            $transaction_id = $charge['balance_transaction'];

            $ordersData = array(
                'order_id' => $order_id,
                'order_payment_method' => 'card',
                'transaction_id' => $transaction_id,
                'payment_status' => 'paid',
                'created_at' => date('Y-m-d H:i:s'),
            );
            $insertId = DB::table('order_payment')->insertGetId($ordersData);

            $updateData = array(
                'order_payment_status' => 'done',
            );
            DB::table('orders')->where('id', $order_id)->update($updateData);

            $otherDatas = $this->otherInfo;
            $pageInfo = DB::table('menu_page_settings')->where('id',1)->first();
            $data['meta_title'] = $pageInfo->menu_title;
            $data['meta_description'] = $pageInfo->menu_meta_description;

            Cart::destroy();

            return view('frontend.imageTheme.checkout.success',compact('data','otherDatas','pageInfo','order_id'));

        } else {

            $otherDatas = $this->otherInfo;
            $pageInfo = DB::table('menu_page_settings')->where('id',1)->first();
            $data['meta_title'] = $pageInfo->menu_title;
            $data['meta_description'] = $pageInfo->menu_meta_description;
            $output = [ 'status' => 'error','message' => 'Something is wrong in payment ! Please try again. Thank you :)' ];
            \Session::flash('sess_alert',$output);

            return view('frontend.imageTheme.checkout.stripe',compact('data','otherDatas','pageInfo','pageInfo','total','insertedOrderId'));

        }

    }

    /**
     * Responds for cancell payment
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }
  

    /**
     * Payment success code here
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $id
     */
    public function success(Request $request)
    {
        return $request->id;
        $response = $provider->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            $otherDatas = $this->otherInfo;
            $pageInfo = DB::table('menu_page_settings')->where('id',1)->first();
            $data['meta_title'] = $pageInfo->menu_title;
            $data['meta_description'] = $pageInfo->menu_meta_description;
            Cart::destroy();
            return view('frontend.imageTheme.checkout.success',compact('data','otherDatas','pageInfo','order_id'));

        }

        dd('Something is wrong.');
    }

    /**
     * Store free item in cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFreeItem(Request $request)
    {
        $otherDatas = $this->otherInfo;


        $allData = $request->allData;
        $storeData = explode(',', $allData);

        $subVariance=[];
        $varId = null;
        $varName = null;

        $itemId = $storeData[2];
        $itemName = $storeData[3];
        $itemQty = 1;
        $itemPrice = 0;

        if(isset($storeData[5])){
            $varId = $storeData[5];
        }
        if(isset($storeData[6])){
            $varName = $storeData[6];
        }
        
        $result = Cart::add([
            'id' => $itemId, 
            'name' => $itemName.' (Offer)',
            'qty' => $itemQty, 
            'price' => $itemPrice,
            'options' => ['varId' => $varId,'varName' => $varName,'subVariances' => $subVariance]
        ]);

        if($result){
            return view('frontend.imageTheme.menu.cart')->with(compact('result','otherDatas'));
        }else{
            return view('frontend.imageTheme.menu.cart')->with(compact('otherDatas'));
        }
    }
    

}

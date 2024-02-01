<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeliveryCollectionOther;
use App\Customer;
use App\Order;
use Session;
use Validator;
use DB;

class ProfileController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Profile Controller
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
     * Display profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $otherDatas = $this->otherInfo;
        $data['meta_title'] = 'Profile';
        $data['meta_description'] = 'Description';
        $user = Customer::find(\Session::get('customerId'));
        return view('frontend.imageTheme.profile.index',compact('data','otherDatas','user'));

    }



    /**
     * Display all pre orders of login custimer.
     *
     * @return \Illuminate\Http\Response
     */
    public function preOrders(){

        $otherDatas = $this->otherInfo;
        $data['meta_title'] = 'Pre-orders';
        $data['meta_description'] = 'Previoues orders';
        $user = Customer::find(\Session::get('customerId'));
        $lists = Order::orderBy('id','DESC')->where('login_user_id',\Session::get('customerId'))->get();
        return view('frontend.imageTheme.profile.preOrder',compact('data','otherDatas','user','lists'));

    }



    /**
     * Display customer order details.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function viewOrderDetails($id){
        $order = Order::find($id);
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
        return view('frontend.imageTheme.profile.show',compact('lists'));
    }



    /**
     * Change customer password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request){

        $customerId = \Session::get('customerId');

        if($request->new_password != $request->confirm_password)
        {
            $output = ['status' => 'error','message' => 'Confirm Password Must Be Same'];
        }
        else
        {
            $checkPassword = Customer::find($customerId)->first();
            if(count($checkPassword) > 0)
            {
                if(password_verify($request->old_password,$checkPassword->password))
                {

                    $profile = Customer::find($customerId);
                    $profile->password = bcrypt($request->new_password);
                    $profile->save();
                    $output = ['status' => 'success','message' => 'Password Changed SuccessFully !'];
                }
                else
                {
                    $output = ['status' => 'error','message' => 'Old Password Does Not Match !'];
                }
            }
            else
            {
                $output = ['status' => 'error','message' => 'No data found !'];
            }
        }

        echo json_encode($output);

    }


    /**
     * Edit profile for customer page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request){

        $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'post_code' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ]);

        if ($validator->fails())
        {
            foreach ($validator->messages()->getMessages() as $field_name => $messages)
            {
                $output = ['status' => 'error','message' => $messages[0]];
                
            }

        }else{

            try {

                DB::beginTransaction();

                $customerId = \Session::get('customerId');
                $customer = Customer::find($customerId);
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->post_code = $request->post_code;
                $customer->address = $request->address;
                $customer->save();

                Session::remove('customerName');
                Session::put('customerName',$request->name);
                Session::put('customerPhone',$request->phone);
                Session::put('customerPostcode',$request->post_code);
                Session::put('customerAddress',$request->address);

                DB::commit();
                $output = ['status' => 'success','message' => 'Profile updated successfully.'];

            } catch (\Exception $e) {

                DB::rollBack();
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
                
                $output = [ 'status' => 'error','message' => 'something is went to wrong !','error_message' => $e->getMessage() ];

            }

        }

        echo json_encode($output);

    }
}

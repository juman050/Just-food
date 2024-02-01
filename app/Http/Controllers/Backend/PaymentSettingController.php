<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Validator;
use App\Payment_setting;

class PaymentSettingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Payment settings Controller
    |--------------------------------------------------------------------------
    |
    | Author : Juman
    | Version : 1.0.0
    |
    */

    private $one;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->one = 1;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Settings | Payment';
        $data['pageName'] = 'Manage All Payments';
        $id = $this->one;
        $lists = Payment_setting::find($id);

        return view('admin.payment.index',compact('data','lists'));
    }


    /**
     * Store payment management info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeManagePayment(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'cash' => 'required',
                'online' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            
            $id = $this->one;

        	$paymentTable = Payment_setting::find($id);
            $paymentTable->cash = $request->cash;
            $paymentTable->online = $request->online;
            $paymentTable->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Updated successfully.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();

    }


    /**
     * Store paypal info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePaypalInfo(Request $request)
    {
        try {
        	
            $validator = Validator::make($request->all(), [
                'p_u' => 'required',
                'p_p' => 'required',
                'p_s' => 'required',
                'p_a_t' => 'required',
                'p_e_d' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            
            $id = $this->one;

        	$paymentTable = Payment_setting::find($id);
            $paymentTable->p_u = $request->p_u;
            $paymentTable->p_p = $request->p_p;
            $paymentTable->p_s = $request->p_s;
            $paymentTable->p_a_t = $request->p_a_t;
            $paymentTable->p_e_d = $request->p_e_d;
            $paymentTable->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Updated successfully.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }



    /**
     * Store stripe info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStripeInfo(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                's_p_k' => 'required',
                's_s_k' => 'required',
                's_e_d' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            
            $id = $this->one;

        	$paymentTable = Payment_setting::find($id);
            $paymentTable->s_p_k = $request->s_p_k;
            $paymentTable->s_s_k = $request->s_s_k;
            $paymentTable->s_e_d = $request->s_e_d;
            $paymentTable->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Updated successfully.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }

}

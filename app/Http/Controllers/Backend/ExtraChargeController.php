<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Validator;
use App\ExtraCharge;

class ExtraChargeController extends Controller
{

    /*
    |-------------------------------------
    | Extra Charge Controller
    |-------------------------------------
    |
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
        $data['title'] = 'Settings';
        $data['pageName'] = 'Extra charge';
        $data['pageTagLine'] = 'Setting extra charge';
        $id = $this->one;
        $record = ExtraCharge::find($id);
        return view('admin.timing_maintainance.extraCharge',compact('data','record'));
    }


    /**
     * Update info
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'deliveryMethod' => 'required',
                'extraAmount' => 'required',
                'ExtraChargeStatus' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            
            $id = $this->one;

            $singleData = ExtraCharge::find($id);
            $singleData->deliveryMethod = $request->deliveryMethod;
            $singleData->extraAmount = $request->extraAmount;
            $singleData->ExtraChargeStatus = $request->ExtraChargeStatus;
            $singleData->save();

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

<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Validator;
use App\RestaurantOpenClose;

class RestaurantOpenCloseController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Restaurant Open Close Controller
    |--------------------------------------------------------------------------
    |
    | Author : Emon Ahmed
    | Version : 1.0.0
    |
    */



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Settings';
        $data['pageName'] = 'Restaurant Open-Close';
        $data['pageTagLine'] = 'Manage restaurant time schedule';
        $lists = RestaurantOpenClose::all();
        return view('admin.timing_maintainance.index',compact('data','lists'));
    }


    /**
     * Update open close status
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOpenCloseStatus(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $openClose = RestaurantOpenClose::find($id);
            $openClose->restaurantStatus = $status;
            $openClose->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Status updated'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }


    /**
     * Update open close data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOpenCloseData(Request $request)
    {
        try {

            $id = $request->id;

            $openClose = RestaurantOpenClose::find($id);
            $openClose->openingTime = $request->openingTime;
            $openClose->closingTime = $request->closingTime;
            $openClose->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Time changes successfully'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }
}

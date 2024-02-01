<?php

namespace App\Http\Controllers\Backend;

use App\Mileage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Validator;

class MileageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Mileage Controller
    |--------------------------------------------------------------------------
    |
    | Author : Juman
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
        $data['title'] = 'Mileage';
        $data['pageName'] = 'Mileage';
        $data['pageTagLine'] = 'Manage mileages';
        return view('admin.mileage.index',compact('data'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tableData()
    {
        $lists = Mileage::all();
        return view('admin.mileage.table',compact('lists'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mileage.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                    'mileage_length' => 'required',
                    'mileage_delivery_charge' => 'required',
                    'mileage_minimum_order' => 'required',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();

            $inserdObject = new Mileage();
            $inserdObject->mileage_length = $request->mileage_length;
            $inserdObject->mileage_delivery_charge = $request->mileage_delivery_charge;
            $inserdObject->mileage_minimum_order = $request->mileage_minimum_order;
            $inserdObject->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Inserted successfully.'];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['status' => 'error','message' => 'Something is wrong !'];
        }

        return $output;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Mileage  $mileage
     * @return \Illuminate\Http\Response
     */
    public function show(Mileage $mileage)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mileage  $mileage
     * @return \Illuminate\Http\Response
     */
    public function edit(Mileage $mileage)
    {
        return view('admin.mileage.edit',compact('mileage'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mileage  $mileage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mileage $mileage)
    {       
        try {

            $validator = Validator::make($request->all(), [
                    'mileage_length' => 'required',
                    'mileage_delivery_charge' => 'required',
                    'mileage_minimum_order' => 'required',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();

            $updateObject = Mileage::find($mileage->id);
            $updateObject->mileage_length = $request->mileage_length;
            $updateObject->mileage_delivery_charge = $request->mileage_delivery_charge;
            $updateObject->mileage_minimum_order = $request->mileage_minimum_order;
            $updateObject->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Updated successfully.'];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['status' => 'error','message' => 'Something is wrong !'];
        }

        return $output;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mileage  $mileage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mileage $mileage)
    {
        try {

            $id = $mileage->id;

            $mileage = Mileage::find($id);
            $mileage->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'Mileage deleted'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }


    /**
     * Update mileage status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mileagestatusupdate(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $mileage = Mileage::find($id);
            $mileage->mileage_status = $status;
            $mileage->save();

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

}

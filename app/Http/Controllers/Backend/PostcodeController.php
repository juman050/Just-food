<?php

namespace App\Http\Controllers\Backend;

use App\Postcode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Validator;

class PostcodeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Postcode Controller
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
        $data['title'] = 'Postcode';
        $data['pageName'] = 'Postcode';
        $data['pageTagLine'] = 'Manage postcodes';
        return view('admin.postcode.index',compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tableData()
    {
        $lists = Postcode::all();
        return view('admin.postcode.table',compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.postcode.create');
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
                    'postcode_area' => 'required',
                    'postcode_delivery_charge' => 'required',
                    'postcode_minimum_order' => 'required',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();

            $inserdObject = new Postcode();
            $inserdObject->postcode_area = $request->postcode_area;
            $inserdObject->postcode_delivery_charge = $request->postcode_delivery_charge;
            $inserdObject->postcode_minimum_order = $request->postcode_minimum_order;
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
     * @param  \App\Postcode  $postcode
     * @return \Illuminate\Http\Response
     */
    public function show(Postcode $postcode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Postcode  $postcode
     * @return \Illuminate\Http\Response
     */
    public function edit(Postcode $postcode)
    {
        return view('admin.postcode.edit',compact('postcode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Postcode  $postcode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postcode $postcode)
    {
        try {

            $validator = Validator::make($request->all(), [
                    'postcode_area' => 'required',
                    'postcode_delivery_charge' => 'required',
                    'postcode_minimum_order' => 'required',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();

            $updateObject = Postcode::find($postcode->id);
            $updateObject->postcode_area = $request->postcode_area;
            $updateObject->postcode_delivery_charge = $request->postcode_delivery_charge;
            $updateObject->postcode_minimum_order = $request->postcode_minimum_order;
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
     * @param  \App\Postcode  $postcode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postcode $postcode)
    {
        try {

            $id = $postcode->id;

            $postcode = Postcode::find($id);
            $postcode->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'Postcode deleted'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }


    /**
     * Status update
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function statusupdate(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $postcode = Postcode::find($id);
            $postcode->postcode_status = $status;
            $postcode->save();

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

<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use DB;

class CustomerController extends Controller
{

    /*
    |-------------------------------------
    | Customer Controller
    |-------------------------------------
    |
    | Company : Webexcel
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
        $data['title'] = 'Food | Customer';
        $data['pageName'] = 'Customer';
        $data['pageTagLine'] = 'Manage customer';
        $lists = Customer::orderBy('id','DESC')->get();
        return view('admin.customer.index',compact('data','lists'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param   $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {

            $customers = Customer::find($id);
            $customers->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'Data deleted'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong','error_message' => $e->getMessage() ];

        }

        echo json_encode($output);
        exit;
    }


    /**
     * Status update of the specified customer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCustomerStatus(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $customer = Customer::find($id);
            $customer->status = $status;
            $customer->save();

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

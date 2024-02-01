<?php

namespace App\Http\Controllers\Backend;

use App\Variance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Validator;
use App\Item;

class VarianceController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Variance Controller
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
        $data['title'] = 'Variance';
        $data['pageName'] = 'Variance';
        $data['pageTagLine'] = 'Manage variances';
        return view('admin.food.variance.index',compact('data'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tableData()
    {
        $lists = DB::table('item_variances')
            ->leftJoin('variance', 'variance.id', '=', 'item_variances.variance_id')
            ->leftJoin('items', 'items.id', '=', 'item_variances.item_id')
            ->select(
                'item_variances.*',
                'variance.variance_name',
                'items.item_name as item_name'
            )
            ->orderBy('item_variances.item_id','DESC')
            ->orderBy('item_variances.sort','ASC')
            ->get();

        return view('admin.food.variance.table',compact('lists'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all()->pluck('item_name', 'id');
        return view('admin.food.variance.create', compact('items'));
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
                    'variance_name' => 'required',
                    'item_id' => 'required',
                    'item_new_price' => 'required',
                    'status' => 'required',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();

            $check = Variance::where('status','enable')->where('variance_name',$request->variance_name)->first();
            if($check){
                $varianceInsertedId = $check->id;
            }else{

                $inserdObject = new Variance();
                $inserdObject->variance_name = $request->variance_name;
                $inserdObject->save();

                $varianceInsertedId = $inserdObject->id;
            }

            $itemVarianceData = array(
                'item_id' => $request->item_id,
                'variance_id' => $varianceInsertedId,
                'item_new_price' => $request->item_new_price,
                'item_old_price' => $request->item_old_price,
                'status' => $request->status,
            );
            $addData = DB::table('item_variances')->insert($itemVarianceData);

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
     * @param  \App\Variance  $variance
     * @return \Illuminate\Http\Response
     */
    public function show(Variance $variance)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $lists = DB::table('item_variances')
            ->leftJoin('variance', 'variance.id', '=', 'item_variances.variance_id')
            ->leftJoin('items', 'items.id', '=', 'item_variances.item_id')
            ->select(
                'item_variances.*',
                'variance.variance_name',
                'items.item_name as item_name'
            )
            ->where('item_variances.id',$id)
            ->first();

        $items = Item::all()->pluck('item_name', 'id');
        return view('admin.food.variance.edit',compact('lists','items'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Variance  $variance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        try {

            $validator = Validator::make($request->all(), [
                    'variance_name' => 'required',
                    'item_id' => 'required',
                    'item_new_price' => 'required',
                    'status' => 'required',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();

            $check = Variance::where('status','enable')->where('variance_name',$request->variance_name)->first();
            if($check){
                $varianceInsertedId = $check->id;
            }else{

                $inserdObject = new Variance();
                $inserdObject->variance_name = $request->variance_name;
                $inserdObject->save();

                $varianceInsertedId = $inserdObject->id;
            }

            $itemVarianceData = array(
                'item_id' => $request->item_id,
                'variance_id' => $varianceInsertedId,
                'item_new_price' => $request->item_new_price,
                'item_old_price' => $request->item_old_price,
                'status' => $request->status,
            );
            $addData = DB::table('item_variances')->where('id',$request->id)->update($itemVarianceData);

            DB::commit();
            $output = ['status' => 'success','message' => 'Inserted successfully.'];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['status' => 'error','message' => $e->getMessage()];
        }

        return $output;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Variance  $variance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {

            $id = $request->id;
            
            $result = DB::table('item_variances')->where('id',$id)->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'Variance deleted'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }


    
    /**
     * Update status
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function statusupdate(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $updatedata = array('status' => $status);
            $result = DB::table('item_variances')->where('id',$id)->update($updatedata);

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
     * Suggestion for variance name
     *
     * @return \Illuminate\Http\Response
     */
    public function suggestVariance(){
        if (isset($_GET['term'])){

            $q = strtolower($_GET['term']);
            $check = Variance::where('status','enable')->where('variance_name', 'like', '%'.$q.'%')->get();
            if($check){
                foreach ($check as $row) {
                    $row_set[] = htmlentities(stripslashes($row['variance_name']));
                }
            }
            echo json_encode($row_set);

        }
    }

        
    /**
     * Item variancesorts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itemVarianceSorts(Request $request)
    {
        try {

            $ids = $request->position;

            $i=1;
            foreach($ids as $id){

                $updatedata = array('sort' => $i);
                $result = DB::table('item_variances')->where('id',$id)->update($updatedata);

                $i++;
            }

            DB::commit();
            $output = ['status' => 'success','message' => 'Sorted successfully'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }


}

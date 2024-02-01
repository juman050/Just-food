<?php

namespace App\Http\Controllers\Backend;

use App\Subitem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Validator;
use App\Item;
use App\Subvariance;


class SubitemController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Sub item Controller
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
        $data['title'] = 'Sub-item';
        $data['pageName'] = 'Sub-item';
        $data['pageTagLine'] = 'Manage Sub-item';
        return view('admin.food.subitem.index',compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subItemTableData()
    {

        $lists = Subitem::orderBy('sort','ASC')
                    ->orderBy('sort','ASC')
                    ->orderBy('id','DESC')
                    ->get();

        foreach ($lists as $list) {
            $list->itemLists = DB::table('sub_items_item')
                                ->leftJoin('items','items.id', '=', 'sub_items_item.item_id')
                                ->select('sub_items_item.*','items.id as main_item_id','items.item_name')
                                ->where('sub_items_item.sub_item_id',$list->id)
                                ->get();
        }

        return view('admin.food.subitem.table',compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all()->pluck('item_name', 'id');
        return view('admin.food.subitem.create', compact('items'));
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
                    'sub_item_name' => 'required',
                    'required' => 'required',
                    'min_value' => 'required',
                    'max_value' => 'required',
                    'status' => 'required',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $inserdObject = new Subitem();
            $inserdObject->sub_item_name = $request->sub_item_name;
            $inserdObject->required = $request->required;
            $inserdObject->min_value = $request->min_value;
            $inserdObject->max_value = $request->max_value;
            $inserdObject->status = $request->status;
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
     * @param  \App\Subitem  $subitem
     * @return \Illuminate\Http\Response
     */
    public function show(Subitem $subitem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subitem  $subitem
     * @return \Illuminate\Http\Response
     */
    public function edit(Subitem $subitem)
    {
        return view('admin.food.subitem.edit', compact('subitem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subitem  $subitem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subitem $subitem)
    {
        try {


            $validator = Validator::make($request->all(), [
                    'sub_item_name' => 'required',
                    'required' => 'required',
                    'min_value' => 'required',
                    'max_value' => 'required',
                    'status' => 'required',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();

            $updateObject = Subitem::find($request->id);
            $updateObject->sub_item_name = $request->sub_item_name;
            $updateObject->required = $request->required;
            $updateObject->min_value = $request->min_value;
            $updateObject->max_value = $request->max_value;
            $updateObject->status = $request->status;
            $updateObject->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Updated successfully.'];


        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['status' => 'error','message' => $e->getMessage()];
        }

        return $output;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subitem  $subitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subitem $subitem)
    {
        try {

            $id = $subitem->id;
            
            $result = DB::table('sub_items')->where('id',$id)->delete();
            $result2 = DB::table('sub_item_variance')->where('sub_item_id',$id)->delete();

            $datas = DB::table('sub_items_item')->where('sub_item_id',$id)->get();
            if($datas){
                foreach ($datas as $value) {
                    $deleteItemVar = DB::table('item_subvariances')->where('sub_item_id',$value->id)->delete();
                }
                $deleteItemsItem = DB::table('sub_items_item')->where('sub_item_id',$id)->delete();
            }


            DB::commit();
            $output = ['status' => 'success','message' => 'Sub-item deleted'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }


    /**
     * Update subitem status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function statusSubItem(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $updatedata = array('status' => $status);
            $result = DB::table('sub_items')->where('id',$id)->update($updatedata);

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
     * Add Sub variance
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function addSubVariance($id){

        $subItems = Subitem::where('id',$id)->first();
        $subItemName = $subItems->sub_item_name;
        $subItemId = $id;
        return view('admin.food.subitem.addSubVariance', compact('subItemName','subItemId'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subVarianceTable($id)
    {
        $lists = Subvariance::where('sub_item_id',$id)->get();
        return view('admin.food.subitem.subVarianceTable', compact('lists'));
    }




    /**
     * edit Sub Variance view
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function editSubVariance($id)
    {
        $lists = Subvariance::where('id',$id)->first();
        return $lists;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSubVariance(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                    'sub_item_variance_name' => 'required',
                    'item_variance_new_price' => 'required',
                    'sub_item_id' => 'required',
                    'status' => 'required',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $inserdObject = new Subvariance();
            $inserdObject->sub_item_variance_name = $request->sub_item_variance_name;
            $inserdObject->item_variance_new_price = $request->item_variance_new_price;
            $inserdObject->item_variance_old_price = $request->item_variance_old_price;
            $inserdObject->sub_item_id = $request->sub_item_id;
            $inserdObject->status = $request->status;
            $inserdObject->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Inserted successfully.'];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['status' => 'error','message' => 'Something is wrong !'];
        }

        return $output;
        exit;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSubVariance(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                    'sub_item_variance_name' => 'required',
                    'item_variance_new_price' => 'required',
                    'sub_item_id' => 'required',
                    'status' => 'required',
                    'id' => 'required',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $inserdObject = Subvariance::find($request->id);
            $inserdObject->sub_item_variance_name = $request->sub_item_variance_name;
            $inserdObject->item_variance_new_price = $request->item_variance_new_price;
            $inserdObject->item_variance_old_price = $request->item_variance_old_price;
            $inserdObject->sub_item_id = $request->sub_item_id;
            $inserdObject->status = $request->status;
            $inserdObject->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Updated successfully.'];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['status' => 'error','message' => 'Something is wrong !'];
        }

        return $output;
        exit;
    }



    /**
     * Status update for sub variance
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function statusSubVariance(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $updatedata = array('status' => $status);
            $result = DB::table('sub_item_variance')->where('id',$id)->update($updatedata);

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
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function subvariance($id)
    {
        try {
            
            $result = DB::table('sub_item_variance')->where('id',$id)->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'Sub-variance deleted !'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }



    /**
     * View item page for store
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function addItem($id){

        $subItems = Subitem::where('id',$id)->first();
        $subItemName = $subItems->sub_item_name;
        $subItemId = $id;
        $lists = Subvariance::where('sub_item_id',$id)->where('status','enable')->get();
        $itemLists = Item::where('status','enable')->pluck('item_name', 'id');

        return view('admin.food.subitem.addItemVariance', compact('lists','itemLists','subItemName','subItemId'));
    }

    public function itemSubVariance($id){

        $sub_items_item_data = DB::table('sub_items_item')->where('id',$id)->first();
        $item_id = $sub_items_item_data->item_id;
        $sub_item_id = $sub_items_item_data->sub_item_id;

        $subItems = Subitem::where('id',$sub_item_id)->first();
        $subItemName = $subItems->sub_item_name;
        $subItemId = $sub_item_id;
        $lists = Subvariance::where('sub_item_id',$sub_item_id)->where('status','enable')->get();
        $itemLists = Item::where('status','enable')->pluck('item_name', 'id');
        $checkLists = DB::table('item_subvariances')->select('sub_var_id')->where('sub_item_id',$id)->get();
        $checkArray = array();
        foreach ($checkLists as $value) {
            $checkArray[] = $value->sub_var_id;
        }
        return view('admin.food.subitem.editItemVariance', compact('checkArray','lists','itemLists','subItemName','subItemId','item_id','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeItem(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                    'item_id' => 'required',
                    'sub_item_id' => 'required',
                    'idsArray' => 'required',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $check = DB::table('sub_items_item')->where('item_id',$request->item_id)->where('sub_item_id',$request->sub_item_id)->first();
            if($check){
                $item_sub_item_id = $check->id;
            }else{
                $insertData = array('item_id'=>$request->item_id,'sub_item_id'=>$request->sub_item_id);
                $item_sub_item_id = DB::table('sub_items_item')->insertGetId($insertData);
            }

            foreach ($request->idsArray as $subVarianceIds) {

                $subVarianceDatas = DB::table('sub_item_variance')->where('id',$subVarianceIds)->first();

                $datas = array(
                    'sub_item_id' => $item_sub_item_id,
                    'sub_var_id' => $subVarianceDatas->id
                );

                $isData = DB::table('item_subvariances')->where($datas)->first();
                if(!$isData){
                    $ids[] = DB::table('item_subvariances')->insertGetId($datas);
                }else{
                    $updateDatas = DB::table('item_subvariances')->where('id',$isData->id)->update($datas);
                    $ids[] = $isData->id;
                }

            }

            DB::table('item_subvariances')->whereNotIn('id',$ids)->where('sub_item_id',$item_sub_item_id)->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'Inserted successfully.'];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['status' => 'error','message' => $e->getMessage()];
        }

        return $output;
        exit;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSubItemVariance(Request $request)
    {
        try {

            $id = $request->id;
            
            $result = DB::table('sub_items_item')->where('id',$id)->delete();
            $result2 = DB::table('item_subvariances')->where('sub_item_id',$id)->delete();

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
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function itemSVdelete($id)
    {
        try {
            
            $result = DB::table('item_subvariances')->where('id',$id)->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'Sub-variance deleted'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function itemVdelete($id)
    {
        try {
            
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
     * Item Sub Item sort
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itemSubItemSorts(Request $request)
    {
        try {

            $ids = $request->position;

            $i=1;
            foreach($ids as $id){

                $updatedata = array('sort' => $i);
                $result = DB::table('sub_items')->where('id',$id)->update($updatedata);

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

        
    /**
     * Sub Item sort
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subItemSorts(Request $request)
    {
        try {

            $ids = $request->position;

            $i=1;
            foreach($ids as $id){

                $updatedata = array('sort' => $i);
                $result = DB::table('item_subvariances')->where('id',$id)->update($updatedata);

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

    
    /**
     * Update status for sub variance
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subvarstatusupdate(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $updatedata = array('status' => $status);
            $result = DB::table('item_subvariances')->where('id',$id)->update($updatedata);

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

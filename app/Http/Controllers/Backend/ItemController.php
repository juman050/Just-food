<?php

namespace App\Http\Controllers\Backend;

use App\Item;
use App\Allergy;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;

class ItemController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Item Controller
    |--------------------------------------------------------------------------
    |
    | Author : Juman
    | Version : 1.0.0
    |
    */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Manage | Items';
        $data['pageName'] = 'Items';
        $data['pageTagLine'] = 'Manage Items';
        $lists = Item::with('getCategory','getAllergies','getVariances')->orderBy('item_cat_id','ASC')->orderBy('sort','ASC')->get();
        return view('admin.food.item.index',compact('data','lists'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add item';
        $data['pageName'] = 'Add item';
        $data['pageTagLine'] = 'Add item';
        $categories = Category::where('status','enable')->pluck('cat_name', 'id');
        $allergies = Allergy::where('status','enable')->pluck('name', 'id');
        return view('admin.food.item.create',compact('data','categories','allergies'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'item_name' => 'required|max:255',
                'item_new_price' => 'required',
                'item_cat_id' => 'required',
                'item_delivery_type' => 'required',
                'item_variance' => 'required',
                'item_sub_menu' => 'required',
                'item_sp_request_sts' => 'required',
                'item_offer_include' => 'required',
                'item_spice_level' => 'required',
                'status' => 'required',
                'item_description' => 'max:500',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'image.image' => 'The type of the uploaded file should be an image.',
                'image.uploaded' => 'Maximum upload size is 2MB.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        try {

            DB::beginTransaction();            

            $items = new Item();
            $items->item_name = $request->item_name;
            $items->item_description = $request->item_description;
            $items->item_new_price = $request->item_new_price;
            $items->item_old_price = $request->item_old_price;
            $items->item_cat_id = $request->item_cat_id;
            $items->item_delivery_type = $request->item_delivery_type;
            $items->item_variance = $request->item_variance;
            $items->item_sub_menu = $request->item_sub_menu;
            $items->item_sp_request_sts = $request->item_sp_request_sts;
            $items->item_offer_include = $request->item_offer_include;
            $items->item_spice_level = $request->item_spice_level;
            $items->cus_int_field = $request->cus_int_field;
            $items->cus_text_field = $request->cus_text_field;
            $items->cus_tinyInt_field = $request->cus_tinyInt_field;
            $items->status = $request->status;

            if($request->hasFile('image'))
            {
                $imgDetails = $request->file('image');
                $getTime = $imgDetails->getATime();
                $orginalName = $imgDetails->getClientOriginalName();
                $imagePath      = 'media/items/';
                $getBGImageName = explode(".",$orginalName);
                $imgName = $getTime.mt_rand(0,5).'.'.$getBGImageName['1'];
                $imgDetails->move($imagePath,$imgName);

                $items->item_image = $imgName;
            }

            $items->save();
            $itemInsertedId = $items->id;
            if($request->item_allergies){
                foreach ($request->item_allergies as $alergyId) {
                    $allergyData = array(
                        'item_id' => $itemInsertedId,
                        'allergy_id' => $alergyId
                    );
                    $addAllergies = DB::table('item_allergies')->insert($allergyData);
                }
            }

            DB::commit();
            $output = ['status' => 'success','message' => 'Inserted successfully.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $lists[] = $item;

        foreach ($lists as $singleItem) {
            $singleItem->variance = DB::table('item_variances')
                                    ->leftJoin('variance','variance.id','=','item_variances.variance_id')
                                    ->select('variance.*','item_variances.item_new_price','item_variances.item_old_price','item_variances.status as iv_status','item_variances.sort as iv_sort')
                                    ->where('item_variances.item_id',$singleItem['id'])
                                    ->orderBy('iv_sort','ASC')
                                    ->get();


            $singleItem->sub_items = $sub_items = DB::table('sub_items_item')
                                    ->leftJoin('sub_items','sub_items.id','=','sub_items_item.sub_item_id')
                                    ->select('sub_items.*','sub_items_item.id as sii_id','sub_items_item.item_id as sii_item_id','sub_items_item.sub_item_id as sii_sub_item_id')
                                    ->where('sub_items_item.item_id',$singleItem['id'])
                                    ->orderBy('sub_items.sort','ASC')
                                    ->get();

            foreach ($sub_items as $single_sub_variances) {

                $single_sub_variances->sub_variances = DB::table('item_subvariances')
                                    ->leftJoin('sub_item_variance','sub_item_variance.id','=','item_subvariances.sub_var_id')
                                    ->select('sub_item_variance.*','item_subvariances.id as isv_id','item_subvariances.sub_item_id as isv_sub_item_id','item_subvariances.sub_var_id as isv_sub_var_id')
                                    ->where('item_subvariances.sub_item_id',$single_sub_variances->sii_id)
                                    ->orderBy('sub_item_variance.sort','ASC')
                                    ->get();
            }

        }
        return view('admin.food.item.show',compact('lists'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $data['title'] = 'Edit item';
        $data['pageName'] = 'Edit item';
        $data['pageTagLine'] = 'Edit item';
        $categories = Category::where('status','enable')->pluck('cat_name', 'id');
        $allergies = Allergy::where('status','enable')->pluck('name', 'id');

        $lists[] = $item;

        foreach ($lists as $singleItem) {

            $singleItem->variance = DB::table('item_variances')
                                    ->leftJoin('variance','variance.id','=','item_variances.variance_id')
                                    ->select('variance.*','item_variances.item_new_price','item_variances.id as iv_id','item_variances.item_old_price','item_variances.status as iv_status','item_variances.sort as iv_sort')
                                    ->where('item_variances.item_id',$singleItem['id'])
                                    ->orderBy('iv_sort','ASC')
                                    ->get();


            $singleItem->sub_items = $sub_items = DB::table('sub_items_item')
                                    ->leftJoin('sub_items','sub_items.id','=','sub_items_item.sub_item_id')
                                    ->select('sub_items.*','sub_items_item.id as sii_id','sub_items_item.item_id as sii_item_id','sub_items_item.sub_item_id as sii_sub_item_id')
                                    ->where('sub_items_item.item_id',$singleItem['id'])
                                    ->orderBy('sub_items.sort','ASC')
                                    ->get();

            foreach ($sub_items as $single_sub_variances) {

                $single_sub_variances->sub_variances = DB::table('item_subvariances')
                                    ->leftJoin('sub_item_variance','sub_item_variance.id','=','item_subvariances.sub_var_id')
                                    ->select('sub_item_variance.*','item_subvariances.id as isv_id','item_subvariances.sub_item_id as isv_sub_item_id','item_subvariances.sub_var_id as isv_sub_var_id','item_subvariances.status as isv_status')
                                    ->where('item_subvariances.sub_item_id',$single_sub_variances->sii_id)
                                    ->orderBy('item_subvariances.sort','ASC')
                                    ->get();
            }

        }

        return view('admin.food.item.edit',compact('data','categories','allergies','lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validator = Validator::make($request->all(), [
                'item_name' => 'required|max:255',
                'item_new_price' => 'required',
                'item_cat_id' => 'required',
                'item_delivery_type' => 'required',
                'item_variance' => 'required',
                'item_sub_menu' => 'required',
                'item_sp_request_sts' => 'required',
                'item_offer_include' => 'required',
                'item_spice_level' => 'required',
                'status' => 'required',
                'item_description' => 'max:500',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'image.image' => 'The type of the uploaded file should be an image.',
                'image.uploaded' => 'Maximum upload size is 2MB.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        try {

            DB::beginTransaction();            

            $items = Item::find($item->id);
            $items->item_name = $request->item_name;
            $items->item_description = $request->item_description;
            $items->item_new_price = $request->item_new_price;
            $items->item_old_price = $request->item_old_price;
            $items->item_cat_id = $request->item_cat_id;
            $items->item_delivery_type = $request->item_delivery_type;
            $items->item_variance = $request->item_variance;
            $items->item_sub_menu = $request->item_sub_menu;
            $items->item_sp_request_sts = $request->item_sp_request_sts;
            $items->item_offer_include = $request->item_offer_include;
            $items->item_spice_level = $request->item_spice_level;
            $items->cus_int_field = $request->cus_int_field;
            $items->cus_text_field = $request->cus_text_field;
            $items->cus_tinyInt_field = $request->cus_tinyInt_field;
            $items->status = $request->status;

            if($request->hasFile('image'))
            {
                $imgDetails = $request->file('image');
                $getTime = $imgDetails->getATime();
                $orginalName = $imgDetails->getClientOriginalName();
                $imagePath      = 'media/items/';
                $getBGImageName = explode(".",$orginalName);
                $imgName = $getTime.mt_rand(0,5).'.'.$getBGImageName['1'];
                $imgDetails->move($imagePath,$imgName);

                $items->item_image = $imgName;
            }

            $items->save();

            $itemUpdatedId = $item->id;

            if($request->item_allergies){
                foreach ($request->item_allergies as $alergyId) {

                    $allergyData = array(
                        'item_id' => $itemUpdatedId,
                        'allergy_id' => $alergyId
                    );

                    $isData = DB::table('item_allergies')->where($allergyData)->first();
                    if(!$isData){
                        $ids[] = DB::table('item_allergies')->insertGetId($allergyData);
                    }else{
                        $updateDatas = DB::table('item_allergies')->where('id',$isData->id)->update($allergyData);
                        $ids[] = $isData->id;
                    }

                }

                DB::table('item_allergies')->whereNotIn('id',$ids)->where('item_id',$item->id)->delete();

            }

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
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        try {

            // Allergy delete of this item
            \DB::table('item_allergies')->where('item_id', $item->id)->delete();

            // Item variance delete of this item
            \DB::table('item_variances')->where('item_id', $item->id)->delete();

            // Sub items item delete of this item
            \DB::table('sub_items_item')->where('item_id', $item->id)->delete();

            $item = Item::find($item->id);
            $item->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'Postcode deleted'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => $e->getMessage() ];

        }

        echo json_encode($output);
        exit;
    }


    /**
     * Update item status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateItemStatus(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $item = Item::find($id);
            $item->status = $status;
            $item->save();

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
     * Update item sorts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itemSorts(Request $request)
    {
        try {

            $ids = $request->position;

            $i=1;
            foreach($ids as $id){

                $item = Item::find($id);
                $item->sort = $i;
                $item->save();

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

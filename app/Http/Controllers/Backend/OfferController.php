<?php

namespace App\Http\Controllers\Backend;

use App\Offer;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Validator;


class OfferController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Offer Controller
    |--------------------------------------------------------------------------
    |
    | Author : Emon Ahmed
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
        $data['title'] = 'All offer';
        $data['pageName'] = 'All offer';
        $data['pageTagLine'] = 'All offer';
        $lists = Offer::orderBy('sort','ASC')->get();
        return view('admin.offers.index',compact('data','lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add offer';
        $data['pageName'] = 'Add offer';
        $data['pageTagLine'] = 'Add offer';
        $items = Item::with('getVariances')->orderBy('sort','ASC')->where('status','enable')->get();
        return view('admin.offers.create',compact('data','items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'startdate' => 'required',
                'enddate' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'status' => 'required',
                'display_banner' => 'required',
                'free_shipping' => 'required',
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

            if($request->days == null){
                $output = [ 'status' => 'error','message' => 'Days can not be null !' ];
                \Session::flash('sess_alert',$output);
                return redirect()->back();
            }


            if(($request->payment_type == null) && ($request->delivery_type == null) && ($request->subtotal == null || $request->sub_amount == null) && ($request->total_quantity == null || $request->qty_amount == null) && ($request->no_condition == null)){
                $output = [ 'status' => 'error','message' => 'Condition can not be null !' ];
                \Session::flash('sess_alert',$output);
                return redirect()->back();
            }

            if(($request->discount_type == null || $request->discount_amount == null) && ($request->free_item == null || $request->free_item_allowed == null)){
                $output = [ 'status' => 'error','message' => 'Action can not be null !' ];
                \Session::flash('sess_alert',$output);
                return redirect()->back();
            }


            $offer = new Offer();
            $offer->title = $request->title;
            $offer->description = $request->description;
            $offer->startdate = $request->startdate;
            $offer->enddate = $request->enddate;
            $offer->days = implode(',', $request->days);
            $offer->start_time = $request->start_time;
            $offer->end_time = $request->end_time;
            $offer->status = $request->status;
            $offer->display_banner = $request->display_banner;
            $offer->customer_use = $request->customer_use;
            $offer->free_shipping = $request->free_shipping;
            $offer->coupon_code = $request->coupon_code;
            $offer->custom_int = $request->custom_int;
            $offer->custom_text = $request->custom_text;

            if($request->hasFile('image'))
            {
                $imgDetails = $request->file('image');
                $getTime = $imgDetails->getATime();
                $orginalName = $imgDetails->getClientOriginalName();
                $imagePath      = 'media/offers/';
                $getBGImageName = explode(".",$orginalName);
                $imgName = $getTime.mt_rand(0,5).'.'.$getBGImageName['1'];
                $imgDetails->move($imagePath,$imgName);

                $offer->banner_image = $imgName;
            }

            $offer->save();
            $offerInsertedId = $offer->id;



            // Condition set 

            if($request->payment_type != null){
                    $insertData = array(
                        'offer_id' => $offerInsertedId,
                        'con_type' => 'con_payment',
                        'con_value' => $request->payment_type,
                        'con_other' => null
                    );
                    $add = DB::table('offer_conditions')->insert($insertData);
            }


            if($request->delivery_type != null){
                    $insertData = array(
                        'offer_id' => $offerInsertedId,
                        'con_type' => 'con_delivery_type',
                        'con_value' => $request->delivery_type,
                        'con_other' => null
                    );
                    $add = DB::table('offer_conditions')->insert($insertData);
            }


            if($request->subtotal != null && $request->sub_amount != null){
                    $insertData = array(
                        'offer_id' => $offerInsertedId,
                        'con_type' => 'con_subtotal',
                        'con_value' => $request->subtotal,
                        'con_other' => $request->sub_amount
                    );
                    $add = DB::table('offer_conditions')->insert($insertData);
            }


            if($request->total_quantity != null && $request->qty_amount != null){
                    $insertData = array(
                        'offer_id' => $offerInsertedId,
                        'con_type' => 'con_total_qty',
                        'con_value' => $request->total_quantity,
                        'con_other' => $request->qty_amount
                    );
                    $add = DB::table('offer_conditions')->insert($insertData);
            }


            if($request->no_condition != null){
                    $insertData = array(
                        'offer_id' => $offerInsertedId,
                        'con_type' => 'con_condition',
                        'con_value' => $request->no_condition,
                        'con_other' => null
                    );
                    $add = DB::table('offer_conditions')->insert($insertData);
            }


            // Action set
            if($request->discount_type != null && $request->discount_amount != null){
                $insertData = array(
                    'offer_id' => $offerInsertedId,
                    'action_type' => 'action_basket',
                    'action_value' => $request->discount_type,
                    'action_other' => $request->discount_amount
                );
                $add = DB::table('offer_actions')->insert($insertData);
            }


            if($request->free_item != null && $request->free_item_allowed != null){
                $insertData = array(
                    'offer_id' => $offerInsertedId,
                    'action_type' => 'action_free_item',
                    'action_value' => $request->free_item_allowed,
                    'action_other' => implode(',', $request->free_item)
                );
                $add = DB::table('offer_actions')->insert($insertData);
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
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        $data['title'] = 'Edit offer';
        $data['pageName'] = 'Edit offer';
        $data['pageTagLine'] = 'Edit offer';
        $conditions = DB::table('offer_conditions')->where('offer_id',$offer->id)->get();
        $actions = DB::table('offer_actions')->where('offer_id',$offer->id)->get();
        $items = Item::with('getVariances')->orderBy('sort','ASC')->where('status','enable')->get();
        return view('admin.offers.edit',compact('data','items','offer','conditions','actions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'startdate' => 'required',
                'enddate' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'status' => 'required',
                'display_banner' => 'required',
                'free_shipping' => 'required',
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


            if($request->days == null){
                $output = [ 'status' => 'error','message' => 'Days can not be null !' ];
                \Session::flash('sess_alert',$output);
                return redirect()->back();
            }

            if(($request->payment_type == null) && ($request->delivery_type == null) && ($request->subtotal == null || $request->sub_amount == null) && ($request->total_quantity == null || $request->qty_amount == null) && ($request->no_condition == null)){
                $output = [ 'status' => 'error','message' => 'Condition can not be null !' ];
                \Session::flash('sess_alert',$output);
                return redirect()->back();
            }

            if(($request->discount_type == null || $request->discount_amount == null) && ($request->free_item == null || $request->free_item_allowed == null)){
                $output = [ 'status' => 'error','message' => 'Action can not be null !' ];
                \Session::flash('sess_alert',$output);
                return redirect()->back();
            }

            $offer = Offer::find($offer->id);
            $offer->title = $request->title;
            $offer->description = $request->description;
            $offer->startdate = $request->startdate;
            $offer->enddate = $request->enddate;
            $offer->days = implode(',', $request->days);
            $offer->start_time = $request->start_time;
            $offer->end_time = $request->end_time;
            $offer->status = $request->status;
            $offer->display_banner = $request->display_banner;
            $offer->customer_use = $request->customer_use;
            $offer->free_shipping = $request->free_shipping;
            $offer->coupon_code = $request->coupon_code;
            $offer->custom_int = $request->custom_int;
            $offer->custom_text = $request->custom_text;

            if($request->hasFile('image'))
            {
                $imgDetails = $request->file('image');
                $getTime = $imgDetails->getATime();
                $orginalName = $imgDetails->getClientOriginalName();
                $imagePath      = 'media/offers/';
                $getBGImageName = explode(".",$orginalName);
                $imgName = $getTime.mt_rand(0,5).'.'.$getBGImageName['1'];
                $imgDetails->move($imagePath,$imgName);

                $offer->banner_image = $imgName;
            }

            $offer->save();
            $offerInsertedId = $offer->id;

            $deleteConditions = DB::table('offer_conditions')->where('offer_id',$offerInsertedId)->delete();
            $deleteActions = DB::table('offer_actions')->where('offer_id',$offerInsertedId)->delete();

            // Condition set 

            if($request->payment_type != null){
                    $insertData = array(
                        'offer_id' => $offerInsertedId,
                        'con_type' => 'con_payment',
                        'con_value' => $request->payment_type,
                        'con_other' => null
                    );
                    $add = DB::table('offer_conditions')->insert($insertData);
            }


            if($request->delivery_type != null){
                    $insertData = array(
                        'offer_id' => $offerInsertedId,
                        'con_type' => 'con_delivery_type',
                        'con_value' => $request->delivery_type,
                        'con_other' => null
                    );
                    $add = DB::table('offer_conditions')->insert($insertData);
            }


            if($request->subtotal != null && $request->sub_amount != null){
                    $insertData = array(
                        'offer_id' => $offerInsertedId,
                        'con_type' => 'con_subtotal',
                        'con_value' => $request->subtotal,
                        'con_other' => $request->sub_amount
                    );
                    $add = DB::table('offer_conditions')->insert($insertData);
            }


            if($request->total_quantity != null && $request->qty_amount != null){
                    $insertData = array(
                        'offer_id' => $offerInsertedId,
                        'con_type' => 'con_total_qty',
                        'con_value' => $request->total_quantity,
                        'con_other' => $request->qty_amount
                    );
                    $add = DB::table('offer_conditions')->insert($insertData);
            }


            if($request->no_condition != null){
                    $insertData = array(
                        'offer_id' => $offerInsertedId,
                        'con_type' => 'con_condition',
                        'con_value' => $request->no_condition,
                        'con_other' => null
                    );
                    $add = DB::table('offer_conditions')->insert($insertData);
            }


            // Action set
            if($request->discount_type != null && $request->discount_amount != null){
                $insertData = array(
                    'offer_id' => $offerInsertedId,
                    'action_type' => 'action_basket',
                    'action_value' => $request->discount_type,
                    'action_other' => $request->discount_amount
                );
                $add = DB::table('offer_actions')->insert($insertData);
            }


            if($request->free_item != null && $request->free_item_allowed != null){
                $insertData = array(
                    'offer_id' => $offerInsertedId,
                    'action_type' => 'action_free_item',
                    'action_value' => $request->free_item_allowed,
                    'action_other' => implode(',', $request->free_item)
                );
                $add = DB::table('offer_actions')->insert($insertData);
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
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        try {

            $id = $offer->id;

            $offer = Offer::find($id);
            $offer->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'Offer deleted'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }


    
    /**
     * Update sorts
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sorts(Request $request)
    {
        try {

            $ids = $request->position;

            $i=1;
            foreach($ids as $id){

                $offer = Offer::find($id);
                $offer->sort = $i;
                $offer->save();

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
     * Update status
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $slider = Offer::find($id);
            $slider->status = $status;
            $slider->save();

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

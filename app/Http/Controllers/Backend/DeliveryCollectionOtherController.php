<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Validator;
use App\DeliveryCollectionOther;

class DeliveryCollectionOtherController extends Controller
{

    /*
    |-------------------------------------
    | Delivery & Collection & other Controller
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
        $data['pageName'] = 'Delivery & collection & maintainance';
        $data['pageTagLine'] = 'Setting Delivery & collection & maintainance all';
        $id = $this->one;
        $record = DeliveryCollectionOther::find($id);
        return view('admin.timing_maintainance.del_col_other',compact('data','record'));
    }

    /**
     * Update info
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'deliveryMethod' => 'required',
                'deliveryTimeLimit' => 'required',
                'collectionTimeLimit' => 'required',
                'mileage_or_postcode' => 'required',
                'table_book_status' => 'required',
                'home_page_status' => 'required',
                'contact_page_status' => 'required',
                'gallery_page_status' => 'required',
                'menu_page_status' => 'required',
                'privacy_page_status' => 'required',
                'terms_page_status' => 'required',
                'pre_order_status' => 'required',
                'special_reequest_status' => 'required',
                'instant_open_close' => 'required',
                'image_showing' => 'required',
                'free_shipping_status' => 'required',
                'amount_for_free_shipping' => 'required',
                'menu_file_status' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            
            $id = $this->one;

            $singleData = DeliveryCollectionOther::find($id);
            $singleData->deliveryMethod = $request->deliveryMethod;
            $singleData->deliveryTimeLimit = $request->deliveryTimeLimit;
            $singleData->collectionTimeLimit = $request->collectionTimeLimit;
            $singleData->mileage_or_postcode = $request->mileage_or_postcode;
            
            $singleData->table_book_status = $request->table_book_status;
            $singleData->home_page_status = $request->home_page_status;
            $singleData->contact_page_status = $request->contact_page_status;
            $singleData->gallery_page_status = $request->gallery_page_status;
            $singleData->menu_page_status = $request->menu_page_status;
            $singleData->privacy_page_status = $request->privacy_page_status;
            $singleData->terms_page_status = $request->terms_page_status;

            $singleData->pre_order_status = $request->pre_order_status;
            $singleData->special_reequest_status = $request->special_reequest_status;
            $singleData->instant_open_close = $request->instant_open_close;
            $singleData->image_showing = $request->image_showing;
            $singleData->free_shipping_status = $request->free_shipping_status;
            $singleData->amount_for_free_shipping = $request->amount_for_free_shipping;
            $singleData->menu_file_status = $request->menu_file_status;


            if($request->hasFile('menu_file'))
            {
                if($singleData->menu_file){
                    $filenameSmall = 'media/theme/'.$singleData->menu_file;
                    if (file_exists($filenameSmall)) {
                        unlink($filenameSmall);
                    } 
                }

                $smallLogoDetails = $request->file('menu_file');
                $getTime = $smallLogoDetails->getATime();
                $smallLogoName = $smallLogoDetails->getClientOriginalName();
                $imagePath      = 'media/theme/';
                $getSmallLogoName = explode(".",$smallLogoName);
                $smallLogoFullName = $getTime.mt_rand(0,5).'.'.$getSmallLogoName['1'];
                $smallLogoDetails->move($imagePath,$smallLogoFullName);

                $singleData->menu_file = $smallLogoFullName;
            }

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

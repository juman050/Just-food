<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Validator;
use App\StoreSetting;
use Mail;

class StoreSettingController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Store settings Controller
    |--------------------------------------------------------------------------
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
        $data['pageName'] = 'Store information';
        $data['pageTagLine'] = 'Setting your store information';
        $id = $this->one;
        $record = StoreSetting::find($id);
        return view('admin.settings.store',compact('data','record'));
    }

    /**
     * Insert store info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insertStoreInfo(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'store_name' => 'required|min:2',
                'store_city' => 'required|max:50',
                'store_country' => 'required|max:50',
                'store_postcode' => 'required|max:25',
                'store_support_number' => 'required|max:25',
                'store_support_email' => 'required|email',
                'store_active_theme' => 'required',
                'store_address' => 'required|min:2|max:500',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();

            $id = $this->one;
            $storeSetting = StoreSetting::find($id);

            $storeSetting->store_name = $request->store_name;
            $storeSetting->store_address = $request->store_address;
            $storeSetting->store_city = $request->store_city;
            $storeSetting->store_state = $request->store_state;
            $storeSetting->store_country = $request->store_country;
            $storeSetting->store_postcode = $request->store_postcode;
            $storeSetting->store_support_number = $request->store_support_number;
            $storeSetting->store_support_email = $request->store_support_email;
            $storeSetting->store_fax = $request->store_fax;
            $storeSetting->store_owner_name = $request->store_owner_name;
            $storeSetting->store_owner_number = $request->store_owner_number;
            $storeSetting->store_owner_email = $request->store_owner_email;
            $storeSetting->store_map = $request->store_map;
            $storeSetting->store_active_theme = $request->store_active_theme;
            $storeSetting->store_custom_text_1 = $request->store_custom_text_1;
            $storeSetting->store_custom_text_2 = $request->store_custom_text_2;
            $storeSetting->store_custom_textarea_1 = $request->store_custom_textarea_1;
            $storeSetting->store_custom_textarea_2 = $request->store_custom_textarea_2;

            $storeSetting->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Updated successfully'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong','lol' => $e->getMessage() ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }



    /**
     * Package status
     *
     * @return \Illuminate\Http\Response
     */
    public function custom_func(){
        echo 'success';
        exit;
    }

}

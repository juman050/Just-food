<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Validator;
use App\Setting;

class SiteSettingController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Site settings Controller
    |--------------------------------------------------------------------------
    |
    | Author : Emon Ahmed
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
        $data['pageName'] = 'Theme Setting';
        $data['pageTagLine'] = 'Setting all theme information';
        $id = $this->one;
        $themeData = Setting::find($id);

        return view('admin.settings.theme',compact('data','themeData'));
    }


    /**
     * Store social link info
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSocialLink(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'site_facebook_link' => 'nullable|url|max:500',
                'site_twitter_link' => 'nullable|url|max:500',
                'site_instagram_link' => 'nullable|url|max:500',
                'site_linkedin_link' => 'nullable|url|max:500',
                'site_google_plus_link' => 'nullable|url|max:500',
                'site_pinterest_link' => 'nullable|url|max:500',
                'site_youtube_link' => 'nullable|url|max:500',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();


            $id = $this->one;
            $siteSetting = Setting::find($id);

            $siteSetting->site_facebook_link = $request->site_facebook_link;
            $siteSetting->site_twitter_link = $request->site_twitter_link;
            $siteSetting->site_instagram_link = $request->site_instagram_link;
            $siteSetting->site_linkedin_link = $request->site_linkedin_link;
            $siteSetting->site_google_plus_link = $request->site_google_plus_link;
            $siteSetting->site_pinterest_link = $request->site_pinterest_link;
            $siteSetting->site_youtube_link = $request->site_youtube_link;

            $siteSetting->save();
            

            DB::commit();
            $output = ['status' => 'success','message' => 'Updated successfully'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }


    /**
     * Store social site basic info
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSiteBasic(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'site_title' => 'required|min:2|max:255',
                'site_date_format' => 'required|max:100',
                'site_currency' => 'required|max:50',
                'site_language' => 'required|max:50',
                'site_copyright' => 'required|max:255',

                'site_android_url' => 'nullable|url|max:500',
                'site_ios_url' => 'nullable|url|max:500',
                'site_description' => 'sometimes|max:1000',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();

            $siteSetting = Setting::find(1);

            $siteSetting->site_title = $request->site_title;
            $siteSetting->site_description = $request->site_description;
            $siteSetting->site_copyright = $request->site_copyright;
            $siteSetting->site_date_format = $request->site_date_format;
            $siteSetting->site_timezone = $request->site_timezone;
            $siteSetting->site_currency = $request->site_currency;
            $siteSetting->site_language = $request->site_language;
            $siteSetting->site_android_url = $request->site_android_url;
            $siteSetting->site_ios_url = $request->site_ios_url;

            $siteSetting->site_copyright = $request->site_copyright;
            $siteSetting->site_status = $request->site_status;

            if($request->hasFile('smallLogo'))
            {
                $filenameSmall = 'media/theme/'.$siteSetting->site_small_logo;
                if (file_exists($filenameSmall)) {
                    unlink($filenameSmall);
                }

                $smallLogoDetails = $request->file('smallLogo');
                $getTime = $smallLogoDetails->getATime();
                $smallLogoName = $smallLogoDetails->getClientOriginalName();
                $imagePath      = 'media/theme/';
                $getSmallLogoName = explode(".",$smallLogoName);
                $smallLogoFullName = $getTime.mt_rand(0,5).'.'.$getSmallLogoName['1'];
                $smallLogoDetails->move($imagePath,$smallLogoFullName);

                $siteSetting->site_small_logo = $smallLogoFullName;
            }
            
            if($request->hasFile('mainLogo'))
            {
                $filenamemain = 'media/theme/'.$siteSetting->site_main_logo;
                if (file_exists($filenamemain)) {
                    unlink($filenamemain);
                }

                $mainLogoDetails = $request->file('mainLogo');
                $getTime = $mainLogoDetails->getATime();
                $mainLogoName = $mainLogoDetails->getClientOriginalName();
                $imagePath      = 'media/theme/';
                $getMainLogoName = explode(".",$mainLogoName);
                $mainLogoFullName = $getTime.mt_rand(0,4).'.'.$getMainLogoName['1'];
                $mainLogoDetails->move($imagePath,$mainLogoFullName);

                $siteSetting->site_main_logo = $mainLogoFullName;
            }
            if($request->hasFile('preLoader'))
            {
                $filenamePre = 'media/theme/'.$siteSetting->site_pre_loader;
                if (file_exists($filenamePre)) {
                    unlink($filenamePre);
                }

                $preLoaderDetails = $request->file('preLoader');
                $getTime = $preLoaderDetails->getATime();
                $preLoaderName = $preLoaderDetails->getClientOriginalName();
                $imagePath      = 'media/theme/';
                $getpreLoaderName = explode(".",$preLoaderName);
                $preLoaderFullName = $getTime.mt_rand(0,3).'.'.$getpreLoaderName['1'];
                $preLoaderDetails->move($imagePath,$preLoaderFullName);

                $siteSetting->site_pre_loader = $preLoaderFullName;
            }
            if($request->hasFile('fabicon'))
            {
                $filenameFab = 'media/theme/'.$siteSetting->site_fabicon;
                if (file_exists($filenameFab)) {
                    unlink($filenameFab);
                }

                $fabiconDetails = $request->file('fabicon');
                $getTime = $fabiconDetails->getATime();
                $fabiconName = $fabiconDetails->getClientOriginalName();
                $imagePath      = 'media/theme/';
                $getfabiconName = explode(".",$fabiconName);
                $fabiconFullName = $getTime.mt_rand(0,2).'.'.$getfabiconName['1'];
                $fabiconDetails->move($imagePath,$fabiconFullName);

                $siteSetting->site_fabicon = $fabiconFullName;
            }

            $siteSetting->save();
            

            DB::commit();
            $output = ['status' => 'success','message' => 'Theme data updated successfully'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Validator;
use App\PageSetting;

class PageSettingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Page setting Controller
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
     * Display a data of the Home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Settings | Home';
        $data['pageName'] = 'Home page & SEO Setting';
        $data['pageTagLine'] = 'Setting all web page information';

        $id = $this->one;
        $homeData = PageSetting::find($id);

        return view('admin.settings.homepage',compact('data','homeData'));
    }



    /**
     * Display a data of the Menu page.
     *
     * @return \Illuminate\Http\Response
     */
    public function menuPage()
    {
        $data['title'] = 'Settings | Menu';
        $data['pageName'] = 'Menu page & SEO Setting';
        $data['pageTagLine'] = 'Setting all web page information';

        $id = $this->one;
        $menuData = DB::table('menu_page_settings')->where('id',$id)->get()->first();

        return view('admin.settings.menupage',compact('data','menuData'));
    }


    /**
     * Display a data of the Gallery
     *
     * @return \Illuminate\Http\Response
     */
    public function galleryPage()
    {
        $data['title'] = 'Settings | Gallery';
        $data['pageName'] = 'Gallery page & SEO Setting';
        $data['pageTagLine'] = 'Setting all web page information';

        $id = $this->one;
        $galleryData = DB::table('gallery_page_settings')->where('id',$id)->get()->first();

        return view('admin.settings.gallerypage',compact('data','galleryData'));
    }



    /**
     * Display a data of the Conatact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactPage()
    {
        $data['title'] = 'Settings | Contact';
        $data['pageName'] = 'Contact page & SEO Setting';
        $data['pageTagLine'] = 'Setting all web page information';

        $id = $this->one;
        $contactData = DB::table('contact_page_settings')->where('id',$id)->get()->first();

        return view('admin.settings.contactpage',compact('data','contactData'));
    }


    /**
     * Display a data of the Terms page.
     *
     * @return \Illuminate\Http\Response
     */
    public function termsPage()
    {
        $data['title'] = 'Settings | Terms';
        $data['pageName'] = 'Terms page & SEO Setting';
        $data['pageTagLine'] = 'Setting all web page information';

        $id = $this->one;
        $termsData = DB::table('terms_page_settings')->where('id',$id)->get()->first();

        return view('admin.settings.termspage',compact('data','termsData'));
    }


    /**
     * Display a data of the Privacy page.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacyPage()
    {
        $data['title'] = 'Settings | Privacy';
        $data['pageName'] = 'Privacy page & SEO Setting';
        $data['pageTagLine'] = 'Setting all web page information';

        $id = $this->one;
        $privacyData = DB::table('privacy_page_settings')->where('id',$id)->get()->first();

        return view('admin.settings.privacypage',compact('data','privacyData'));
    }


    /**
     * Display a data of the Faq page.
     *
     * @return \Illuminate\Http\Response
     */
    public function faqPage()
    {
        $data['title'] = 'Settings | Faq';
        $data['pageName'] = 'Faq Page & SEO Setting';
        $data['pageTagLine'] = 'Setting all web page information';

        $id = $this->one;
        $faqs = DB::table('faqs')->orderBy('sorting_position','ASC')->get();

        return view('admin.settings.faqpage',compact('data','faqs'));
    }



    /**
     * Store all data for homepage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeHomeInfo(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'home_title' => 'required|min:2|max:255',
                'home_caption' => 'nullable|max:255|min:2',
                'home_meta_description' => 'required|min:10',
                'home_tagline' => 'nullable|max:255|min:2',
                'home_custom_text' => 'nullable|max:255|min:2',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();
            
            $id = $this->one;
            $homeInfo = PageSetting::where('id', $id)->first();

            $homeInfo->home_title = $request->home_title;
            $homeInfo->home_meta_description = $request->home_meta_description;
            $homeInfo->home_caption = $request->home_caption;
            $homeInfo->home_description = $request->home_description;
            $homeInfo->home_tagline = $request->home_tagline;
            $homeInfo->home_custom_text = $request->home_custom_text;
            $homeInfo->home_custom_textarea = $request->home_custom_textarea;

            if($request->hasFile('home_background_image'))
            {

                $filename = 'media/theme/'.$homeInfo->home_background_image;
                if (file_exists($filename)) {
                    unlink($filename);
                }

                $bgDetails = $request->file('home_background_image');
                $getTime = $bgDetails->getATime();
                $orginalName = $bgDetails->getClientOriginalName();
                $imagePath      = 'media/theme/';
                $getBGImageName = explode(".",$orginalName);
                $imgName = $getTime.mt_rand(0,5).'.'.$getBGImageName['1'];
                $bgDetails->move($imagePath,$imgName);

                $homeInfo->home_background_image = $imgName;
            }

            $homeInfo->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Homepage data updated.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }


    /**
     * Store all data for menu page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMenuInfo(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'menu_title' => 'required|min:2|max:500',
                'menu_meta_description' => 'required|min:10',
                'menu_custom_text' => 'nullable|max:255|min:2',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            
            $id = $this->one;

            $menuInfo['menu_title'] = $request->menu_title;
            $menuInfo['menu_meta_description'] = $request->menu_meta_description;
            $menuInfo['menu_custom_text'] = $request->menu_custom_text;
            $menuInfo['menu_custom_textarea'] = $request->menu_custom_textarea;

            $result = DB::table('menu_page_settings')->where('id', $id)->update($menuInfo);

            DB::commit();
            $output = ['status' => 'success','message' => 'Menu page data updated.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }



    /**
     * Store all data for gallery page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGalleryInfo(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'gallery_title' => 'required|min:2|max:500',
                'gallery_meta_description' => 'required|min:10',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            
            $id = $this->one;

            $galleryInfo['gallery_title'] = $request->gallery_title;
            $galleryInfo['gallery_meta_description'] = $request->gallery_meta_description;
            $galleryInfo['gallery_custom_text'] = $request->gallery_custom_text;
            $galleryInfo['gallery_custom_textarea'] = $request->gallery_custom_textarea;

            $result = DB::table('gallery_page_settings')->where('id', $id)->update($galleryInfo);

            DB::commit();
            $output = ['status' => 'success','message' => 'Gallery page data updated.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }


    /**
     * Store all data for contact page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeContactInfo(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'contact_title' => 'required|min:2|max:500',
                'contact_meta_description' => 'required|min:10',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            
            $id = $this->one;

            $contactInfo['contact_title'] = $request->contact_title;
            $contactInfo['contact_meta_description'] = $request->contact_meta_description;
            $contactInfo['contact_custom_text'] = $request->contact_custom_text;
            $contactInfo['contact_custom_textarea'] = $request->contact_custom_textarea;

            $result = DB::table('contact_page_settings')->where('id', $id)->update($contactInfo);

            DB::commit();
            $output = ['status' => 'success','message' => 'Contact page data updated.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }

    
    /**
     * Store all data for terms page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTermInfo(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'terms_title' => 'required|min:2|max:500',
                'terms_meta_description' => 'required|min:10',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            
            $id = $this->one;

            $contactInfo['terms_title'] = $request->terms_title;
            $contactInfo['terms_meta_description'] = $request->terms_meta_description;
            $contactInfo['terms_description'] = $request->terms_description;
            $contactInfo['terms_custom_text'] = $request->terms_custom_text;
            $contactInfo['terms_custom_textarea'] = $request->terms_custom_textarea;

            $result = DB::table('terms_page_settings')->where('id', $id)->update($contactInfo);

            DB::commit();
            $output = ['status' => 'success','message' => 'Terms page data updated.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }
    

    /**
     * Store all data for privacy page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePrivacyInfo(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'privacy_title' => 'required|min:2|max:500',
                'privacy_meta_description' => 'required|min:10',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            
            $id = $this->one;

            $contactInfo['privacy_title'] = $request->privacy_title;
            $contactInfo['privacy_meta_description'] = $request->privacy_meta_description;
            $contactInfo['privacy_description'] = $request->privacy_description;
            $contactInfo['privacy_custom_text'] = $request->privacy_custom_text;
            $contactInfo['privacy_custom_textarea'] = $request->privacy_custom_textarea;

            $result = DB::table('privacy_page_settings')->where('id', $id)->update($contactInfo);

            DB::commit();
            $output = ['status' => 'success','message' => 'Privacy page data updated.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }
    

    /**
     * Store all data for faq page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFaqs(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'question' => 'required|min:2',
                'answer' => 'required|min:2',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            
            $faq['question'] = $request->question;
            $faq['answer'] = $request->answer;
            $faq['status'] = $request->status;
            $faq['sorting_position'] = 1;

            $result = DB::table('faqs')->insert($faq);

            DB::commit();
            $output = ['status' => 'success','message' => 'FAQ added successfully.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        \Session::flash('sess_alert',$output);
        return redirect()->back();
    }

    /**
     * Delete a data from faq.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteFaq(Request $request)
    {
        try {

            $id = $request->id;
            $result = DB::table('faqs')->where('id',$id)->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'FAQ deleted'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }
    

    /**
     * update a data from faq.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateFaqStatus(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $updateData = array('status'=>$status);
            $result = DB::table('faqs')->where('id',$id)->update($updateData);

            DB::commit();
            $output = ['status' => 'success','message' => 'FAQ status updated'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }
    

    /**
     * Sorts faq.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function faqSorts(Request $request)
    {
        try {

            $ids = $request->position;

            $i=1;
            foreach($ids as $id){
                $updateData = array(
                    'sorting_position' => $i
                );
                $result = DB::table('faqs')->where('id',$id)->update($updateData);
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

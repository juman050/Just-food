<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Order;
use DB;
use Auth;

class DashboardController extends Controller
{

    /*
    |-------------------------------------
    | Customer Controller
    |-------------------------------------
    |
    | Company : Webexcel
    | Author : Emon Ahmed
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['pageName'] = 'Dashboard';
        $data['pageTagLine'] = 'Control-Panel';

        $data['total_users'] = User::count();
        $data['total_orders'] = Order::count();
        $data['total_pending_orders'] = Order::where('order_status','pending')->count();
        $data['total_earning'] = Order::sum('order_total');

        $sevenDays = [];
        $seven_days_earn = [];
        $seven_days_orders = [];

        $date = \Carbon\Carbon::today()->subDays(7);

        for($k=6;$k>=0;$k--){

            $singleDate = \Carbon\Carbon::today()->subDays($k)->toDateString();
            $sevenDays[] = $singleDate;
            $orderData = Order::whereDate('created_at', $singleDate)->get();
            $seven_days_earn[] = Order::whereDate('created_at', $singleDate)->sum('order_total');
            $seven_days_orders[] = $orderData->count();

        }

        return view('admin.dashboard.index',compact('data','sevenDays','seven_days_earn','seven_days_orders'));
    }



    /**
     * Show the profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $data['title'] = 'Profile';
        $data['pageName'] = 'Profile';
        $data['pageTagLine'] = 'Profile';
        return view('admin.profile.index',compact('data'));
    }


    /**
     * Show the application dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        try {
            

            $current_password = Auth::User()->password;           
            if(!(Hash::check($request->old_password, $current_password))){
                $output = ['status' => 'error','message' => 'Old password does not match !'];
                echo json_encode($output);
                exit;
            }

            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->new_password);
            $user->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Password updated'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => $e->getMessage() ];

        }

        echo json_encode($output);
        exit;
    }


    /**
     * Display a listing of the all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function tableData()
    {
        $lists = User::all();
        return view('admin.profile.table',compact('lists'));
    }



    /**
     * remove user
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function userDelete($id)
    {
        try {
            
            $result = DB::table('users')->where('id',$id)->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'User deleted'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }



    /**
     * Update user status
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userstatusupdate(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $updatedata = array('active' => $status);
            $result = DB::table('users')->where('id',$id)->update($updatedata);

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
     * Add new user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addUser(Request $request)
    {

        try {

            DB::beginTransaction();       

            if(User::where('email',$request->email)->first()){
                $output = ['status' => 'error','message' => 'Email already exists !'];
                echo json_encode($output);
                exit;
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'active' => $request->active,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();
            $output = ['status' => 'success','message' => 'Added successfully.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }


}

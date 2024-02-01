<?php

namespace App\Http\Controllers\Backend;

use App\Allergy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Validator;

class AllergyController extends Controller
{
    /*
    |-------------------------------------
    | Allergy Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Allergy';
        $data['pageName'] = 'Allergy';
        $data['pageTagLine'] = 'Manage allergies';
        return view('admin.allergy.index',compact('data'));
    }


    /**
     * Display all Allergies
     *
     * @return \Illuminate\Http\Response
     */
    public function allergyTableData()
    {
        $lists = Allergy::all();
        return view('admin.allergy.table',compact('lists'));
    }


    /**
     * Show the form for creating a new allergy info.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.allergy.create');
    }


    /**
     * Store a newly created allery info in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                    'name' => 'required|min:2|max:255',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'image.image' => 'The type of the uploaded file should be an image.',
                    'image.uploaded' => 'Maximum upload size is 2MB.',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $inserdObject = new Allergy();
            $inserdObject->name = $request->name;

            if($request->hasFile('image'))
            {
                $imageDetails = $request->file('image');
                $getTime = $imageDetails->getATime();
                $imagename = $imageDetails->getClientOriginalName();
                $imagePath      = 'media/allergy/';
                $getSmallLogoName = explode(".",$imagename);
                $imageFullName = $getTime.mt_rand(0,5).'.'.$getSmallLogoName['1'];
                $imageDetails->move($imagePath,$imageFullName);

                $inserdObject->image = $imageFullName;
            }

            $inserdObject->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Inserted successfully.'];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['status' => 'error','message' => 'Something is wrong !'];
        }

        echo json_encode($output);
        exit;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function show(Allergy $allergy)
    {
        //
    }


    /**
     * Show the form for editing the allergies data.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function edit(Allergy $allergy)
    {
        return view('admin.allergy.edit',compact('allergy'));
    }


    /**
     * Update the allergy info in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allergy $allergy)
    {
        try {
            
            $validator = Validator::make($request->all(), [
                    'name' => 'required|min:2|max:255',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'image.image' => 'Uploaded file should be an image.',
                    'image.uploaded' => 'Maximum upload size is 2MB.',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();

            $updateObject = Allergy::find($allergy->id);
            $updateObject->name = $request->name;

            if($request->hasFile('image'))
            {
                $filenameSmall = 'media/allergy/'.$updateObject->image;
                if (file_exists($filenameSmall)) {
                    unlink($filenameSmall);
                }

                $imageDetails = $request->file('image');
                $getTime = $imageDetails->getATime();
                $imagename = $imageDetails->getClientOriginalName();
                $imagePath      = 'media/allergy/';
                $getSmallLogoName = explode(".",$imagename);
                $imageFullName = $getTime.mt_rand(0,5).'.'.$getSmallLogoName['1'];
                $imageDetails->move($imagePath,$imageFullName);

                $updateObject->image = $imageFullName;
            }

            $updateObject->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Updated successfully.'];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['status' => 'error','message' => 'Something is wrong !'];
        }

        return $output;
    }


    /**
     * Remove the specified allergy from storage.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allergy $allergy)
    {
        try {

            $id = $allergy->id;
            $allergy = Allergy::find($id);
            
            $filenameSmall = 'media/allergy/'.$allergy->image;
            if (file_exists($filenameSmall)) {
                unlink($filenameSmall);
            }
            $allergy->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'Allergy deleted'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }



    /**
     * Status update of the specified allergy.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allergystatusupdate(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $allergy = Allergy::find($id);
            $allergy->status = $status;
            $allergy->save();

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

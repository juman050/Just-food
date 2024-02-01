<?php

namespace App\Http\Controllers\Backend;

use App\Slider;
use Validator;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Slider Controller
    |--------------------------------------------------------------------------
    |
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
        $data['title'] = 'Manage | Sliders';
        $data['pageName'] = 'Slider';
        $data['pageTagLine'] = 'Manage sliders';

        $lists = Slider::orderBy('position','ASC')->get();
        return view('admin.slider.index',compact('data','lists'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {


            $validator = Validator::make($request->all(), [
                    'title' => 'required|min:2|max:255',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'alt' => 'required|min:2|max:255',
                    'status' => 'required',
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

            $slider = new Slider();
            $slider->title = $request->title;
            $slider->alt = $request->alt;
            $slider->description = $request->description;
            $slider->status = $request->status;

            if($request->hasFile('image'))
            {

                $imgDetails = $request->file('image');
                $getTime = $imgDetails->getATime();
                $orginalName = $imgDetails->getClientOriginalName();
                $imagePath      = 'media/sliders/';
                $getBGImageName = explode(".",$orginalName);
                $imgName = $getTime.mt_rand(0,5).'.'.$getBGImageName['1'];
                $imgDetails->move($imagePath,$imgName);

                $slider->image = $imgName;
            }

            $slider->save();

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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $singleData[] = $slider;
        $data['title'] = 'Manage | Sliders';
        $data['pageName'] = 'Slider';
        $data['pageTagLine'] = 'Manage sliders';

        $lists = Slider::orderBy('position','ASC')->get();
        return view('admin.slider.index',compact('data','lists','singleData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        try {

            $validator = Validator::make($request->all(), [
                    'title' => 'required|min:2|max:255',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'alt' => 'required|min:2|max:255',
                    'status' => 'required',
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

            $updateSlider = Slider::find($slider->id);
            $updateSlider->title = $request->title;
            $updateSlider->alt = $request->alt;
            $updateSlider->description = $request->description;
            $updateSlider->status = $request->status;

            if($request->hasFile('image'))
            {

                $filename = 'media/sliders/'.$slider->image;
                if (file_exists($filename)) {
                    unlink($filename);
                }

                $imgDetails = $request->file('image');
                $getTime = $imgDetails->getATime();
                $orginalName = $imgDetails->getClientOriginalName();
                $imagePath      = 'media/sliders/';
                $getBGImageName = explode(".",$orginalName);
                $imgName = $getTime.mt_rand(0,5).'.'.$getBGImageName['1'];
                $imgDetails->move($imagePath,$imgName);

                $updateSlider->image = $imgName;
            }

            $updateSlider->save();

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
     * Delete slider
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSlider(Request $request)
    {
        try {

            $id = $request->id;

            $slider = Slider::find($id);
            $filename = 'media/sliders/'.$slider->image;
            if (file_exists($filename)) {
                unlink($filename);
            }
            $slider->delete();

            DB::commit();
            $output = ['status' => 'success','message' => 'Data deleted'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'Something is went to wrong' ];

        }

        echo json_encode($output);
        exit;
    }

    
    /**
     * Update slider status
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSliderStatus(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $slider = Slider::find($id);
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

    /**
     * Update slider sorts
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sliderSorts(Request $request)
    {
        try {

            $ids = $request->position;

            $i=1;
            foreach($ids as $id){

                $slider = Slider::find($id);
                $slider->position = $i;
                $slider->save();

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

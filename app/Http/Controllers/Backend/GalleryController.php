<?php

namespace App\Http\Controllers\Backend;

use App\Gallery;
use Validator;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Gallery Controller
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
        $data['title'] = 'Manage | Galleries';
        $data['pageName'] = 'Gallery';
        $data['pageTagLine'] = 'Manage Gallery';
        $lists = Gallery::orderBy('position','ASC')->get();
        return view('admin.gallery.index',compact('data','lists'));
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

            $galleries = new Gallery();
            $galleries->title = $request->title;
            $galleries->description = $request->description;
            $galleries->status = $request->status;

            if($request->hasFile('image'))
            {

                $imgDetails = $request->file('image');
                $getTime = $imgDetails->getATime();
                $orginalName = $imgDetails->getClientOriginalName();
                $imagePath      = 'media/gallery/';
                $getBGImageName = explode(".",$orginalName);
                $imgName = $getTime.mt_rand(0,5).'.'.$getBGImageName['1'];
                $imgDetails->move($imagePath,$imgName);

                $galleries->image = $imgName;
            }

            $galleries->save();

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
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $singleData[] = $gallery;
        $data['title'] = 'Manage | Galleries';
        $data['pageName'] = 'Gallery';
        $data['pageTagLine'] = 'Manage Gallery';

        $lists = Gallery::orderBy('position','ASC')->get();
        return view('admin.gallery.index',compact('data','lists','singleData'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        try {

            $validator = Validator::make($request->all(), [
                    'title' => 'required|min:2|max:255',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

            $updateDatas = Gallery::find($gallery->id);
            $updateDatas->title = $request->title;
            $updateDatas->description = $request->description;
            $updateDatas->status = $request->status;

            if($request->hasFile('image'))
            {

                $filename = 'media/gallery'.$gallery->image;

                if (file_exists($filename)) {
                    if($filename!="default_gallery_image.png"){
                        unlink($filename);
                    }
                }

                $imgDetails = $request->file('image');
                $getTime = $imgDetails->getATime();
                $orginalName = $imgDetails->getClientOriginalName();
                $imagePath      = 'media/gallery/';
                $getBGImageName = explode(".",$orginalName);
                $imgName = $getTime.mt_rand(0,5).'.'.$getBGImageName['1'];
                $imgDetails->move($imagePath,$imgName);

                $updateDatas->image = $imgName;
            }

            $updateDatas->save();

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
     * Remove the specified galery from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteGallery(Request $request)
    {
        try {

            $id = $request->id;

            $gallery = Gallery::find($id);
            $filename = 'media/gallery/'.$gallery->image;
            if (file_exists($filename)) {
                if($filename!="default_gallery_image.png"){
                    unlink($filename);
                }
            }
            $gallery->delete();

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
     * Update the gallery status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateGalleryStatus(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $gallery = Gallery::find($id);
            $gallery->status = $status;
            $gallery->save();

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
     * Update the gallery sorts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function gallerySorts(Request $request)
    {
        try {

            $ids = $request->position;

            $i=1;
            foreach($ids as $id){

                $galleries = Gallery::find($id);
                $galleries->position = $i;
                $galleries->save();

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

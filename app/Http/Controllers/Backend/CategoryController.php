<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class CategoryController extends Controller
{

    /*
    |-------------------------------------
    | Category Controller
    |-------------------------------------
    |
    | 
    | Author : Juman
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
        $data['title'] = 'Food | Category';
        $data['pageName'] = 'Category';
        $data['pageTagLine'] = 'Manage category';
        $lists = Category::orderBy('sort','ASC')->get();
        return view('admin.category.index',compact('data','lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
                    'cat_name' => 'required|min:2|max:255',
                    'cat_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'days' => 'required',
                    'cat_available_delivery_method' => 'required',
                    'status' => 'required',
                    'cat_description' => 'required',
                ],
                [
                    'cat_image.image' => 'The type of the uploaded file should be an image.',
                    'cat_image.uploaded' => 'Maximum upload size is 2MB.',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();

            $insertData = new Category();
            $insertData->cat_name = $request->cat_name;
            $insertData->cat_available_days = implode(',', $request->days);
            $insertData->cat_available_delivery_method = $request->cat_available_delivery_method;
            $insertData->status = $request->status;
            $insertData->cat_description = $request->cat_description;

            if($request->hasFile('cat_image'))
            {

                $imgDetails = $request->file('cat_image');
                $getTime = $imgDetails->getATime();
                $orginalName = $imgDetails->getClientOriginalName();
                $imagePath      = 'media/categories/';
                $getBGImageName = explode(".",$orginalName);
                $imgName = $getTime.mt_rand(0,5).'.'.$getBGImageName['1'];
                $imgDetails->move($imagePath,$imgName);

                $insertData->cat_image = $imgName;
            }

            $insertData->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Inserted successfully.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'something is went to wrong !','error_message' => $e->getMessage() ];

        }

        echo json_encode($output);
        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        try {

            $validator = Validator::make($request->all(), [
                    'cat_name' => 'required|min:2|max:255',
                    'cat_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'days' => 'required',
                    'cat_available_delivery_method' => 'required',
                    'status' => 'required',
                    'cat_description' => 'required',
                ],
                [
                    'cat_image.image' => 'The type of the uploaded file should be an image.',
                    'cat_image.uploaded' => 'Maximum upload size is 2MB.',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            DB::beginTransaction();

            $updateData = Category::find($category->id);
            $updateData->cat_name = $request->cat_name;
            $updateData->cat_available_days = implode(',', $request->days);
            $updateData->cat_available_delivery_method = $request->cat_available_delivery_method;
            $updateData->status = $request->status;
            $updateData->cat_description = $request->cat_description;

            if($request->hasFile('cat_image'))
            {
                $filename = 'media/categories/'.$category->cat_image;
                if (file_exists($filename)) {
                    if($category->cat_image!="default_cat_image.png"){
                        unlink($filename);
                    }
                }
                $imgDetails = $request->file('cat_image');
                $getTime = $imgDetails->getATime();
                $orginalName = $imgDetails->getClientOriginalName();
                $imagePath      = 'media/categories/';
                $getBGImageName = explode(".",$orginalName);
                $imgName = $getTime.mt_rand(0,5).'.'.$getBGImageName['1'];
                $imgDetails->move($imagePath,$imgName);

                $updateData->cat_image = $imgName;
            }

            $updateData->save();

            DB::commit();
            $output = ['status' => 'success','message' => 'Updated successfully.'];

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = [ 'status' => 'error','message' => 'something is went to wrong !','error_message' => $e->getMessage() ];

        }

        echo json_encode($output);
        exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {

            $categories = Category::find($category->id);
            $filename = 'media/categories/'.$categories->cat_image;
            if (file_exists($filename)) {
                if($category->cat_image!="default_cat_image.png"){
                    unlink($filename);
                }
            }
            $categories->delete();

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
     * Update the category status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCategoryStatus(Request $request)
    {
        try {

            $id = $request->id; 
            $status = $request->status;

            $category = Category::find($id);
            $category->status = $status;
            $category->save();

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
     * Update the category sorting position.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function categorySorts(Request $request)
    {
        try {

            $ids = $request->position;

            $i=1;
            foreach($ids as $id){

                $category = Category::find($id);
                $category->sort = $i;
                $category->save();

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

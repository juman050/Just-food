@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/all.css') }}">
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>{{$data['pageName']}}</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Admin-Section</a></li>
                <li class="active">{{$data['pageName']}}</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Manage Category</h3>
                            <button id="sort_save"  type="button" class="btn btn-primary btn-sm pull-right save_sort_left_margin" onClick="saveCategoryPosition();" >Save sort</button>
                            <button type="button" class="btn btn-sm btn-primary btn-modal pull-right" data-href="{{action('Backend\CategoryController@create')}}" data-container=".category_modal"><i class="fa fa-plus"></i> Add</button>
                        </div>

                        <div class="box-body no-padding">
                            <table class="table table-striped text-center" id="Table">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th >Name</th>
                                        <th >Image</th>
                                        <th >Available Days</th>
                                        <th >Delivery method</th>
                                        <th >Status</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody class="row_position">
                                    @if(count($lists) > 0)
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($lists as $list)
                                    <tr id="{!! $list->id !!}">
                                        <td>{{$i++}}</td>
                                        <td>{{$list->cat_name}}</td>
                                        <td>
                                            @if(($list->cat_image == 'default_cat_image.png') || ($list->cat_image == '') || ($list->cat_image == null))
                                            <p>No image</p>
                                            @else
                                            <img src="{{asset('media/categories/'.$list->cat_image)}}" height="60">
                                            @endif
                                        </td>
                                        <td>
                                            <?php
                                            $days = explode(',',$list->cat_available_days);
                                            foreach ($days as $day) { ?>
                                                <button class="btn btn-xs btn-success"><?php echo $day; ?></button>
                                            <?php } ?>
                                        </td>
                                        <td>{{$list->cat_available_delivery_method}}</td>
                                        <td>
                                            <div class="switch">
                                                <input type="checkbox" id="switch{{ $list->id }}" data-id="{{ $list->id }}" class="switch__input" {{ $list->status=='disable' ? '' : 'checked' }} >
                                                <label for="switch{{ $list->id }}" class="switch__label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);"  data-href="{{action('Backend\CategoryController@edit', [$list->id])}}"  class="btn btn-xs btn-primary edit_category_button"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:void(0);" onclick="deleteCategory('{!! $list->id !!}')" class="btn btn-xs btn-danger del{{$list->id}}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7" class="text-center">No data in record yet</td>
                                    </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </div>
    <div class="modal fade category_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">


    </div>

@endsection

@section('js')

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('admin/pages/category.js') }}"></script>

@endsection
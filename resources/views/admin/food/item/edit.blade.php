@extends('admin.layout.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$data['pageName']}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin-Section</a></li>
            <li class="active">{{$data['pageName']}}</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit item</h3>
                        <a href="{{route('item.index')}}" class="btn btn-sm btn-primary pull-right">Item Lists</a>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => action('Backend\ItemController@update', [$lists[0]->id]), 'method' => 'PUT', 'id' => 'storeForm','class' => '', 'enctype' => 'multipart/form-data', 'role'=>'form']) !!}

                    <div class="box-body row">

                        <div class="form-group col-sm-4">
                            {!! Form::label('item_name', 'Item name', array('class' => 'control-label')) !!}
                            {!! Form::text('item_name', $lists[0]->item_name, ['class' => 'form-control','required' => 'required']); !!}
                            @if ($errors->has('item_name'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('item_name') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('item_new_price', 'Item new price ('.\Session::get('currency').')', array('class' => 'control-label')) !!}
                            {!! Form::text('item_new_price',  $lists[0]->item_new_price, ['class' => 'form-control']); !!}
                            @if ($errors->has('item_new_price'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('item_new_price') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('item_old_price', 'Item old price ('.\Session::get('currency').')', array('class' => 'control-label')) !!}
                            {!! Form::text('item_old_price',  $lists[0]->item_old_price, ['class' => 'form-control']); !!}
                            @if ($errors->has('item_old_price'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('item_old_price') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="clearfix"></div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('item_cat_id', 'Category', array('class' => 'control-label')) !!}
                            {{ Form::select('item_cat_id', $categories, $lists[0]->item_cat_id, ['placeholder' => 'Please select category','id' => 'item_cat_id','class' => 'form-control select2']) }}
                            @if ($errors->has('item_cat_id'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('item_cat_id') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('item_allergies', 'Allergy', array('class' => 'control-label')) !!}
                            {{ Form::select('item_allergies[]', $allergies, $lists[0]->getAllergies, ['multiple' => 'multiple','data-placeholder' => 'Choose allergies','id' => 'item_allergies','class' => 'form-control select2']) }}
                            @if ($errors->has('item_allergies'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('item_allergies') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('item_delivery_type', 'Available delivery method', array('class' => 'control-label')) !!}
                            @php
                            $delivery_type = array('both'=>'Both','delivery'=>'Delivery','collection'=>'Collection');
                            @endphp
                            {{ Form::select('item_delivery_type', $delivery_type, $lists[0]->item_delivery_type, ['id' => 'item_delivery_type','class' => 'form-control']) }}
                            @if ($errors->has('cus_text_field'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('item_delivery_type') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="clearfix"></div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('item_variance', 'Is variance item ?', array('class' => 'control-label')) !!}
                            @php
                            $yesNo = array('no'=>'No','yes'=>'Yes');
                            @endphp
                            {{ Form::select('item_variance', $yesNo, $lists[0]->item_variance, ['id' => 'item_variance','class' => 'form-control']) }}
                            @if ($errors->has('cus_text_field'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('item_variance') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('item_sub_menu', 'Is Sub-item ?', array('class' => 'control-label')) !!}
                            @php
                            $yesNo = array('no'=>'No','yes'=>'Yes');
                            @endphp
                            {{ Form::select('item_sub_menu', $yesNo, $lists[0]->item_sub_menu, ['id' => 'item_sub_menu','class' => 'form-control']) }}
                            @if ($errors->has('cus_text_field'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('item_sub_menu') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('item_sp_request_sts', 'Is Special request available ?', array('class' => 'control-label')) !!}
                            @php
                            $yesNo = array('no'=>'No','yes'=>'Yes');
                            @endphp
                            {{ Form::select('item_sp_request_sts', $yesNo, $lists[0]->item_sp_request_sts, ['id' => 'item_sp_request_sts','class' => 'form-control']) }}
                            @if ($errors->has('cus_text_field'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('item_sp_request_sts') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="clearfix"></div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('item_offer_include', 'Item include in offer ?', array('class' => 'control-label')) !!}
                            @php
                            $yesNo = array('yes'=>'Yes','no'=>'No');
                            @endphp
                            {{ Form::select('item_offer_include', $yesNo, $lists[0]->item_offer_include, ['id' => 'item_offer_include','class' => 'form-control']) }}
                            @if ($errors->has('cus_text_field'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('item_offer_include') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('item_spice_level', 'Spice level ?', array('class' => 'control-label')) !!}
                            @php
                            $spiceArray = array('no_spice'=>'No Spice','low'=>'Low','medium'=>'Medium','high'=>'High');
                            @endphp
                            {{ Form::select('item_spice_level', $spiceArray, $lists[0]->item_spice_level, ['id' => 'item_spice_level','class' => 'form-control']) }}
                            @if ($errors->has('cus_text_field'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('item_spice_level') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('status', 'Status', array('class' => 'control-label')) !!}
                            @php
                            $statusArray = array('enable'=>'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('status', $statusArray, $lists[0]->status, ['id' => 'status','class' => 'form-control']) }}
                            @if ($errors->has('cus_text_field'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('status') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="clearfix"></div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('cus_int_field', 'Custom Integer field', array('class' => 'control-label')) !!}
                            {!! Form::text('cus_int_field', $lists[0]->cus_int_field, ['class' => 'form-control']); !!}
                            @if ($errors->has('cus_int_field'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('cus_int_field') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('cus_text_field', 'Custom Text field', array('class' => 'control-label')) !!}
                            {!! Form::text('cus_text_field', $lists[0]->cus_text_field, ['class' => 'form-control']); !!}
                            @if ($errors->has('cus_text_field'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('cus_text_field') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('cus_tinyInt_field', 'Custom select field', array('class' => 'control-label')) !!}
                            @php
                            $statusArray = array(''=>'Select one','0'=>'0','1'=>'1');
                            @endphp
                            {{ Form::select('cus_tinyInt_field', $statusArray, $lists[0]->cus_tinyInt_field, ['id' => 'cus_tinyInt_field','class' => 'form-control']) }}
                        </div>


                        <div class="clearfix"></div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('image','Image') !!} <span class="recommended">Recommended size : 310x180 pixels </span>
                            {!! Form::file('image', ['id' => 'image', 'accept' => 'image/*']); !!}
                            <small><p class="help-block">Max File size: 1MB</p></small>
                            @if ($errors->has('image'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('image') }}</strong>
                            </p>
                            @endif
                            <img src="{{asset('media/items/'.$lists[0]->item_image)}}" style="width: 100%;">
                        </div>



                        <div class="form-group col-sm-8">
                            {!! Form::label('item_description', 'Item description', array('class' => 'control-label')) !!}
                            {!! Form::textarea('item_description', $lists[0]->item_description, ['class' => 'form-control textarea']); !!}
                            @if ($errors->has('item_description'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('item_description') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="clearfix"></div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>

                    {!! Form::close() !!}
                </div>
                <!-- /.box -->

            </div>

        </div>
        <!-- /.row -->

        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Variance of {{$lists[0]->item_name}}</h3>
                        <a href="{{route('variance.index')}}"  class="btn btn-primary btn-sm pull-right" style="margin-left: 10px;">Add variance</a>
                        <button id="sort_save"  type="button" class="btn btn-success btn-sm pull-right" onClick="saveItemVariancePosition();" >Save sort</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body row">

                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table table-condensed bg-gray text-center">

                                    <thead>

                                        <tr class="bg-green">
                                            <th>Serial</th>
                                            <th>Variance name</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Delete</th>
                                        </tr>

                                    </thead>

                                    <tbody class="row_position">

                                        @if(count($lists[0]->variance) > 0)

                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach($lists[0]->variance as $variance)
                                        <tr id="{!! $variance->iv_id !!}">
                                            <td>{{$i++}}</td>
                                            <td>{{$variance->variance_name}}</td>
                                            <td> <del>{{$variance->item_old_price}}</del> {{$variance->item_new_price}}  {{ \Session::get('currency') }}</td>
                                            <td>
                                                <div class="switch">
                                                    <input type="checkbox" id="switch{{ $variance->iv_id }}" data-id="{{ $variance->iv_id }}" class="switch__input var_switch__input"  {{ $variance->iv_status=='disable' ? '' : 'checked' }} >
                                                    <label for="switch{{ $variance->iv_id }}" class="switch__label">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="deleteVarianceItem('{!! $variance->iv_id !!}')" class="delv{{$variance->iv_id}} btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @else
                                        <tr>
                                            <td colspan="4">No variance of this product</td>
                                        </tr>
                                        @endif

                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.box -->

            </div>

        </div>
        <!-- /.row -->`


        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sub-Variance of {{$lists[0]->item_name}}</h3>
                        <a href="{{route('subitem.index')}}"  class="btn btn-primary btn-sm pull-right" style="margin-left: 10px;">Add Sub-variance</a>
                        <button id="sort_save2"  type="button" class="btn btn-success btn-sm pull-right" onClick="saveSubVariancePosition();" >Save sort</button>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body row">

                        @if(count($lists[0]->sub_items) > 0)

                        @foreach($lists[0]->sub_items as $sub_item)

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-12">
                                    <h4 style="background: #029552; margin: 0;padding: 10px 5px;color: white;font-size: 13px;">{{$sub_item->sub_item_name}} (Required {{$sub_item->required}}, Min-{{$sub_item->min_value}}, Max-{{$sub_item->max_value}}, {{$sub_item->status}})</h4>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-condensed bg-gray text-center">
                                            <thead>
                                                <tr class="bg-green">
                                                    <th>Serial</th>
                                                    <th>Sub-variance name</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            @if(count($sub_item->sub_variances) > 0)
                                            @php
                                            $k=1;
                                            @endphp
                                            <tbody class="row_position2">
                                                @foreach($sub_item->sub_variances as $sub_variance)
                                                <tr id="{!! $sub_variance->isv_id !!}">
                                                    <td>{{$k++}}</td>
                                                    <td>{{$sub_variance->sub_item_variance_name}}</td>
                                                    <td><del>{{$sub_variance->item_variance_old_price}}</del> {{$sub_variance->item_variance_new_price}} {{ \Session::get('currency') }}</td>
                                                    <td>
                                                        <div class="switch">
                                                            <input type="checkbox" id="switch{{ $sub_variance->isv_id }}" data-id="{{ $sub_variance->isv_id }}" class="switch__input sub_var_switch__input"  {{ $sub_variance->isv_status=='disable' ? '' : 'checked' }} >
                                                            <label for="switch{{ $sub_variance->isv_id }}" class="switch__label">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="deleteSubVarianceItem('{!! $sub_variance->isv_id !!}')" class="delsb{{$sub_variance->isv_id}} btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @else
                                            <tr>
                                                <td colspan="4">No sub-variance</td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>

                        @endforeach
                        @else
                        <div class="col-md-12">
                            <p class="" style="background: #d2d6de;padding: 10px;">No Sub variance</p>
                        </div>
                        @endif

                    </div>


                </div>
                <!-- /.box -->

            </div>

        </div>
        <!-- /.row -->`



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js')

<script type="text/javascript">
    $('.var_switch__input').change(function(e){
        e.preventDefault();
        if($(this).is(':checked')){
            var sts = 'Enable';
            var status = 'enable';
        }else{
            var sts = 'Disable';
            var status = 'disable';
        }

        var id = $(this).data('id');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: base_URL+'/'+'backoffice/food/statusupdate',
            data: {id:id,status:status},
            async: false,
            success: function(response){
                toast(response)
            }
        });

        e.stopImmediatePropagation();
        return false;
    })

    $('.sub_var_switch__input').change(function(e){
        e.preventDefault();
        if($(this).is(':checked')){
            var sts = 'Enable';
            var status = 'enable';
        }else{
            var sts = 'Disable';
            var status = 'disable';
        }

        var id = $(this).data('id');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: base_URL+'/'+'backoffice/food/subvarstatusupdate',
            data: {id:id,status:status},
            async: false,
            success: function(response){
                toast(response)
            }
        });

        e.stopImmediatePropagation();
        return false;
    })
</script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('admin/pages/item.js') }}"></script>
@endsection
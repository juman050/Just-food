@extends('admin.layout.master')
@section('css')

<link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/all.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/timepicker/bootstrap-timepicker.min.css') }}">

@endsection
@section('content')
@php

$paymentOption = null;
$deliveryOption = null;
$subtotal = null;
$sub_amount = null;
$total_quantity = null;
$qty_amount = null;
$con_condition = null;

$ac_discount_type = null;
$ac_discount_amount = null;
$free_item_allowed = null;
$free_items = [];

@endphp
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

        {!! Form::open(['url' => action('Backend\OfferController@update', [$offer->id]), 'method' => 'PUT', 'id' => 'storeForm','class' => '', 'enctype' => 'multipart/form-data', 'role'=>'form']) !!}


        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit offer</h3>
                        <a href="{{route('offer.index')}}" class="btn btn-sm btn-primary pull-right">Offer Lists</a>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body row">

                        <div class="form-group col-sm-6">
                            {!! Form::label('title', 'Title', array('class' => 'control-label')) !!}
                            {!! Form::text('title', $offer->title, ['class' => 'form-control','required' => 'required']); !!}
                            @if ($errors->has('title'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('title') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-3">
                            {!! Form::label('startdate', 'Start-date', array('class' => 'control-label')) !!}
                            {!! Form::text('startdate',  $offer->startdate, ['class' => 'form-control']); !!}
                            @if ($errors->has('startdate'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('startdate') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="form-group col-sm-3">
                            {!! Form::label('enddate', 'End-date', array('class' => 'control-label')) !!}
                            {!! Form::text('enddate', $offer->enddate, ['class' => 'form-control']); !!}
                            @if ($errors->has('enddate'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('enddate') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            {!! Form::label('custom_text', 'Header top text', array('class' => 'control-label')) !!}
                            {!! Form::text('custom_text', $offer->custom_text, ['class' => 'form-control']); !!}
                            @if ($errors->has('custom_text'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('custom_text') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            {!! Form::label('days','Available days') !!}
                            <br>
                            <?php  $daysArray = explode(',', $offer->days); ?>

                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="sun" <?php if(in_array('sun', $daysArray)){echo 'checked';} ?> > Sunday</label>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="mon"  <?php if(in_array('mon', $daysArray)){echo 'checked';} ?> > Monday</label>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="tue"  <?php if(in_array('tue', $daysArray)){echo 'checked';} ?> > Tuesday</label>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="wed"  <?php if(in_array('wed', $daysArray)){echo 'checked';} ?> > Wednesday</label>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="thu"  <?php if(in_array('thu', $daysArray)){echo 'checked';} ?> > Thursday</label>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="fri"  <?php if(in_array('fri', $daysArray)){echo 'checked';} ?> > Friday</label>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="sat"  <?php if(in_array('sat', $daysArray)){echo 'checked';} ?> > Saturday</label>
                        </div>


                        <div class="clearfix"></div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('start_time', 'Time start', array('class' => 'control-label')) !!}
                            {!! Form::text('start_time', $offer->start_time, ['class' => 'form-control start_time']); !!}
                            @if ($errors->has('start_time'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('start_time') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('end_time', 'Time end', array('class' => 'control-label')) !!}
                            {!! Form::text('end_time', $offer->end_time, ['class' => 'form-control end_time']); !!}
                            @if ($errors->has('end_time'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('end_time') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="form-group col-sm-4">
                            {!! Form::label('display_banner', 'Display in banner ?', array('class' => 'control-label')) !!}
                            @php
                            $yesNo = array('yes'=>'Yes','no'=>'No');
                            @endphp
                            {{ Form::select('display_banner', $yesNo, $offer->display_banner, ['id' => 'display_banner','class' => 'form-control']) }}
                            @if ($errors->has('cus_text_field'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('display_banner') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="clearfix"></div>



                        <div class="form-group col-sm-4">
                            {!! Form::label('coupon_code', 'Coupon code', array('class' => 'control-label')) !!}
                            {!! Form::text('coupon_code', $offer->coupon_code, ['class' => 'form-control']); !!}
                            @if ($errors->has('coupon_code'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('coupon_code') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-4">
                            {!! Form::label('customer_use', 'Customer can use', array('class' => 'control-label')) !!}
                            {!! Form::text('customer_use', $offer->customer_use, ['class' => 'form-control']); !!}
                            @if ($errors->has('customer_use'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('customer_use') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="form-group col-sm-4">
                            {!! Form::label('free_shipping', 'Free shipping', array('class' => 'control-label')) !!}
                            @php
                            $yesNo = array('no'=>'No','yes'=>'Yes');
                            @endphp
                            {{ Form::select('free_shipping', $yesNo, $offer->free_shipping, ['id' => 'free_shipping','class' => 'form-control']) }}
                            @if ($errors->has('cus_text_field'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('free_shipping') }}</strong>
                            </p>
                            @endif
                        </div>



                        <div class="clearfix"></div>


                        <div class="form-group col-sm-8">
                            {!! Form::label('custom_int', 'Custom integer field', array('class' => 'control-label')) !!}
                            {!! Form::text('custom_int', $offer->custom_int, ['class' => 'form-control']); !!}
                            @if ($errors->has('custom_int'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('custom_int') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="form-group col-sm-4">
                            {!! Form::label('status', 'Status', array('class' => 'control-label')) !!}
                            @php
                            $statusArray = array('enable'=>'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('status', $statusArray, $offer->status, ['id' => 'status','class' => 'form-control']) }}
                            @if ($errors->has('cus_text_field'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('status') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-8">
                            {!! Form::label('description', 'Description', array('class' => 'control-label')) !!}
                            {!! Form::textarea('description', $offer->description, ['class' => 'form-control textarea']); !!}
                            @if ($errors->has('description'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('description') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="form-group col-sm-4">
                            {!! Form::label('image','Image') !!}
                            {!! Form::file('image', ['id' => 'image', 'accept' => 'image/*']); !!}
                            <small><p class="help-block">Max File size: 1MB</p></small>
                            @if ($errors->has('image'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('image') }}</strong>
                            </p>
                            @endif
                            @if($offer->banner_image)
                            <img src="{{asset('media/offers/'.$offer->banner_image)}}" style="width: 100%;">
                            @endif
                        </div>

                        <div class="clearfix"></div>


                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->

            </div>

        </div>


        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Offer Conditions</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">


                        @foreach($conditions as $condition)

                        @if($condition->con_type == 'con_payment')
                        @php
                        $paymentOption = $condition->con_value;
                        @endphp
                        @endif

                        @if($condition->con_type == 'con_delivery_type')
                        @php
                        $deliveryOption = $condition->con_value;
                        @endphp
                        @endif

                        @if($condition->con_type == 'con_subtotal')
                        @php
                        $subtotal = $condition->con_value;
                        $sub_amount = $condition->con_other;
                        @endphp
                        @endif

                        @if($condition->con_type == 'con_total_qty')
                        @php
                        $total_quantity = $condition->con_value;
                        $qty_amount = $condition->con_other;
                        @endphp
                        @endif

                        @if($condition->con_type == 'con_condition')
                        @php
                        $con_condition = $condition->con_value;
                        @endphp
                        @endif

                        @endforeach

                        <div class="form-group" hidden>
                            {!! Form::label('payment_type', '1) Payment Type :', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-10">
                                @php
                                $paymentOptions = array(''=>'None','cash'=>'Cash','online'=>'Online');
                                @endphp

                                {{ Form::select('payment_type', $paymentOptions, $paymentOption, ['id' => 'payment_type','class' => 'form-control']) }}
                                @if ($errors->has('payment_type'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('payment_type') }}</strong>
                                </p>
                                @endif
                            </div>
                        </div>
                        <br><br>

                        <div class="form-group">
                            {!! Form::label('delivery_type', '1) Delivery Type :', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-10">
                                @php
                                $deliveryOptions = array('delivery'=>'Delivery','collection'=>'Collection');
                                @endphp
                                {{ Form::select('delivery_type', $deliveryOptions, $deliveryOption, ['id' => 'delivery_type','class' => 'form-control','placeholder' => 'Select delivery type']) }}
                                @if ($errors->has('delivery_type'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('delivery_type') }}</strong>
                                </p>
                                @endif
                            </div>
                        </div>
                        <br><br>

                        <div class="form-group">
                            {!! Form::label('subtotal', '2) Subtotal ', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-5">
                                @php
                                $sign = array(''=>'None','equals'=>'is','not_equals'=>'is not','less_than'=>'Less than','greater_than'=>'is Greater than','less_than_equal'=>'Less than and equal to','greater_than_equal'=>'Greater than end equal to');
                                @endphp
                                {{ Form::select('subtotal', $sign, $subtotal, ['id' => 'subtotal','class' => 'form-control']) }}
                                @if ($errors->has('subtotal'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('subtotal') }}</strong>
                                </p>
                                @endif
                            </div>
                            <div class="col-sm-5">
                                {!! Form::text('sub_amount', $sub_amount, ['placeholder' => \Session::get('currency').' 10','class' => 'form-control']); !!}
                                @if ($errors->has('sub_amount'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('sub_amount') }}</strong>
                                </p>
                                @endif
                            </div>
                        </div>
                        <br><br>

                        <div class="form-group">
                            {!! Form::label('total_quantity', '3) Total quantity ', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-5">
                                @php
                                $sign = array('equals'=>'is','not_equals'=>'is not','less_than'=>'Less than','greater_than'=>'is Greater than','less_than_equal'=>'Less than and equal to','greater_than_equal'=>'Greater than end equal to');
                                @endphp
                                {{ Form::select('total_quantity', $sign, $total_quantity, ['id' => 'total_quantity','class' => 'form-control','placeholder' => 'None']) }}
                                @if ($errors->has('total_quantity'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('total_quantity') }}</strong>
                                </p>
                                @endif
                            </div>
                            <div class="col-sm-5">
                                {!! Form::text('qty_amount', $qty_amount, ['placeholder' => '10','class' => 'form-control']); !!}
                                @if ($errors->has('qty_amount'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('qty_amount') }}</strong>
                                </p>
                                @endif
                            </div>
                        </div>
                        <br><br>

                        <div class="form-group">
                            {!! Form::label('no_condition', '4) Without Condition :', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-10">
                                @php
                                $condition = array('no'=>'No','yes'=>'Yes');
                                @endphp
                                {{ Form::select('no_condition', $condition, $con_condition, ['id' => 'no_condition','class' => 'form-control','placeholder' => 'None']) }}
                                @if ($errors->has('no_condition'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('no_condition') }}</strong>
                                </p>
                                @endif
                            </div>
                        </div>
                        <br><br>

                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Offer Actions</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">

                        @foreach($actions as $action)

                        @if($action->action_type == 'action_basket')
                        @php
                        $ac_discount_type = $action->action_value;
                        $ac_discount_amount = $action->action_other;
                        @endphp
                        @endif

                        @if($action->action_type == 'action_free_item')
                        @php
                        $free_item_allowed = $action->action_value;
                        $free_items = explode(',',$action->action_other);
                        @endphp
                        @endif


                        @endforeach


                        <div class="form-group">
                            {!! Form::label('discount_type', '1) Discount on total basket', array('class' => 'col-sm-3 control-label')) !!}
                            <div class="col-sm-5">
                                @php
                                $type = array('percent'=>'Percent','fix_amount'=>'Fix amount');
                                @endphp
                                {{ Form::select('discount_type', $type, $ac_discount_type, ['id' => 'discount_type','class' => 'form-control','placeholder' => 'Select discount type']) }}
                                @if ($errors->has('discount_type'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('discount_type') }}</strong>
                                </p>
                                @endif
                            </div>
                            <div class="col-sm-4">
                                {!! Form::text('discount_amount', $ac_discount_amount, ['placeholder' => 'Discount amount','class' => 'form-control']); !!}
                                @if ($errors->has('discount_amount'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('discount_amount') }}</strong>
                                </p>
                                @endif
                            </div>
                        </div>
                        <br><br>


                        <div class="form-group">
                            {!! Form::label('free_item', '2) Free Items ', array('class' => 'col-sm-3 control-label')) !!}
                            <div class="col-sm-5">
                                <select name="free_item[]" id="free_item" class="form-control select2" multiple="multiple">
                                    <option value="">Select items</option>
                                    <?php 

                                    foreach ($items as $item) {
                                        if(count($item->getVariances) > 0){
                                            foreach ($item->getVariances as $var) {
                                                $val = $var->pivot->item_id.'-'.$var->pivot->variance_id;
                                                $name = $var->variance_name.' '.$item->item_name.' ( '.\Session::get('currency').$var->pivot->item_new_price.' )';
                                                ?>
                                                <option value="<?=$val;?>" <?php if(in_array($val, $free_items)){echo 'selected';} ?>><?=$name;?></option>
                                                <?php
                                            }
                                        }else{
                                            $val = $item->id;
                                            $name = $item->item_name.' ( '.\Session::get('currency').$item->item_new_price.' )';
                                            ?>
                                            <option value="<?=$val;?>"  <?php if(in_array($val, $free_items)){echo 'selected';} ?>><?=$name;?></option>
                                            <?php
                                        }
                                    }

                                    ?>

                                </select>
                                @if ($errors->has('free_item'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('free_item') }}</strong>
                                </p>
                                @endif
                            </div>
                            <div class="col-sm-4">
                                {!! Form::text('free_item_allowed', $free_item_allowed, ['placeholder' => 'Maximum allowed item','class' => 'form-control']); !!}
                                @if ($errors->has('free_item_allowed'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('free_item_allowed') }}</strong>
                                </p>
                                @endif
                            </div>
                        </div>
                        <br><br>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Edit</button>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
        </div>


        <!-- /.row -->

        {!! Form::close() !!}


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('admin/pages/offer.js') }}"></script>
<script type="text/javascript">
    $(function () {

        // set default dates
        var start = new Date();
        var end = new Date(new Date().setYear(start.getFullYear()+1));

        $('#startdate').datepicker({
            startDate : start,
            format: "yyyy-mm-dd",
            endDate   : end
        }).on('changeDate', function(){
            $('#enddate').datepicker('setStartDate', new Date($(this).val()));
        }); 

        $('#enddate').datepicker({
            startDate : start,
            format: "yyyy-mm-dd",
            endDate   : end
        }).on('changeDate', function(){
            $('#startdate').datepicker('setEndDate', new Date($(this).val()));
        });


        //Timepicker
        $('.start_time').timepicker({
            showInputs: false,
            maxHours : 24,
            showMeridian : false,
        })
        //Timepicker
        $('.end_time').timepicker({
            showInputs: false,
            maxHours : 24,
            showMeridian : false,
        })


        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })

    })
</script>


@endsection
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

            {!! Form::open(['url' => action('Backend\DeliveryCollectionOtherController@updateData'), 'method' => 'POST', 'id' => 'updateOther','class' => '', 'role'=>'form','files' => 'true']) !!}
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body row">

                        <div class="form-group col-sm-4">
                            {!! Form::label('home_page_status', 'Home page Hide/Show', array('class' => 'control-label')) !!}
                            @php
                            $status = array('enable'=> 'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('home_page_status', $status, $record->home_page_status, ['id' => 'home_page_status','class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-4">
                            {!! Form::label('menu_page_status', 'Menu page Hide/Show', array('class' => 'control-label')) !!}
                            @php
                            $status = array('enable'=> 'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('menu_page_status', $status, $record->menu_page_status, ['id' => 'menu_page_status','class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-4">
                            {!! Form::label('contact_page_status', 'Contact page Hide/Show', array('class' => 'control-label')) !!}
                            @php
                            $status = array('enable'=> 'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('contact_page_status', $status, $record->contact_page_status, ['id' => 'contact_page_status','class' => 'form-control']) }}
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-4">
                            {!! Form::label('gallery_page_status', 'Gallery page Hide/Show', array('class' => 'control-label')) !!}
                            @php
                            $status = array('enable'=> 'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('gallery_page_status', $status, $record->gallery_page_status, ['id' => 'gallery_page_status','class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-4">
                            {!! Form::label('privacy_page_status', 'Privacy page Hide/Show', array('class' => 'control-label')) !!}
                            @php
                            $status = array('enable'=> 'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('privacy_page_status', $status, $record->privacy_page_status, ['id' => 'privacy_page_status','class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-4">
                            {!! Form::label('terms_page_status', 'Terms page Hide/Show', array('class' => 'control-label')) !!}
                            @php
                            $status = array('enable'=> 'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('terms_page_status', $status, $record->terms_page_status, ['id' => 'terms_page_status','class' => 'form-control']) }}
                        </div>

                        <div class="clearfix"></div>

                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->

            </div>

            <div class="clearfix"></div>

            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Book a table</h3>
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('table_book_status', 'Table book Hide/Show', array('class' => 'control-label')) !!}
                        @php
                        $table_book_status_array = array('enable'=> 'Enable','disable'=>'Disable');
                        @endphp
                        {{ Form::select('table_book_status', $table_book_status_array, $record->table_book_status, ['id' => 'table_book_status','class' => 'form-control']) }}
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pre-order</h3>
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('pre_order_status', 'Pre-order status', array('class' => 'control-label')) !!}
                        @php
                        $pre_order_status_array = array('enable'=> 'Enable','disable'=>'Disable');
                        @endphp
                        {{ Form::select('pre_order_status', $pre_order_status_array, $record->pre_order_status, ['id' => 'pre_order_status','class' => 'form-control']) }}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Postcode/mileage</h3>
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('mileage_or_postcode', 'Postcode/Mileage setting', array('class' => 'control-label')) !!}
                        @php
                        $mileage_or_postcode_array = array('mileage'=> 'Mileage','postcode'=>'Postcode');
                        @endphp
                        {{ Form::select('mileage_or_postcode', $mileage_or_postcode_array, $record->mileage_or_postcode, ['id' => 'mileage_or_postcode','class' => 'form-control']) }}
                    </div>


                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body row">


                        <div class="form-group col-sm-4">
                            {!! Form::label('special_reequest_status', 'Special request status', array('class' => 'control-label')) !!}
                            @php
                            $special_reequest_status_array = array('enable'=> 'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('special_reequest_status', $special_reequest_status_array, $record->special_reequest_status, ['id' => 'special_reequest_status','class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-4">
                            {!! Form::label('instant_open_close', 'Instant open/close status', array('class' => 'control-label')) !!}
                            @php
                            $instant_open_close_array = array('enable'=> 'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('instant_open_close', $instant_open_close_array, $record->instant_open_close, ['id' => 'instant_open_close','class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-4">
                            {!! Form::label('image_showing', 'Enable/Disable Image in frontend', array('class' => 'control-label')) !!}
                            @php
                            $image_showing_array = array('enable'=> 'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('image_showing', $image_showing_array, $record->image_showing, ['id' => 'image_showing','class' => 'form-control']) }}
                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->

            </div>

            <div class="col-sm-8">
                <div class="row">


                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Upload menu</h3>
                            </div>

                            <div class="form-group col-sm-12">
                                {!! Form::label('menu_file_status', 'Menu file status', array('class' => 'control-label')) !!}
                                @php
                                $menu_file_status_array = array('enable'=> 'Enable','disable'=>'Disable');
                                @endphp
                                {{ Form::select('menu_file_status', $menu_file_status_array, $record->menu_file_status, ['id' => 'menu_file_status','class' => 'form-control']) }}
                            </div>


                            <div class="form-group col-sm-12">
                                {!! Form::label('menu_file','Menu file') !!}
                                {!! Form::file('menu_file', ['id' => 'menu_file']); !!}
                                <small><p class="help-block">Max File size: 1MB</p></small>
                            </div>

                            <div class="form-group col-sm-12">
                                @if($record->menu_file)
                                <a href="{{asset('media/theme/'.$record->menu_file)}}" target="_blank">View food menu</a>
                                @endif
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Shipping</h3>
                            </div>

                            <div class="form-group col-sm-12">
                                {!! Form::label('free_shipping_status', 'Total free shipping', array('class' => 'control-label')) !!}
                                @php
                                $free_shipping_status_array = array('enable'=> 'Enable','disable'=>'Disable');
                                @endphp
                                {{ Form::select('free_shipping_status', $free_shipping_status_array, $record->free_shipping_status, ['id' => 'free_shipping_status','class' => 'form-control']) }}
                            </div>

                            <div class="form-group col-sm-12">
                                {!! Form::label('amount_for_free_shipping', 'Amount for free shipping', array('class' => 'control-label')) !!}
                                {!! Form::text('amount_for_free_shipping', $record->amount_for_free_shipping, ['class' => 'form-control','required' => 'required']); !!}
                                @if ($errors->has('amount_for_free_shipping'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('amount_for_free_shipping') }}</strong>
                                </p>
                                @endif
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-sm-4">
                <div class="row">

                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Delivery & collection</h3>
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('deliveryMethod', 'Active Delivery method', array('class' => 'control-label')) !!}
                                @php
                                $suatus = array('both'=>'Both','delivery'=>'Delivery','collection'=> 'Collection');
                                @endphp
                                {{ Form::select('deliveryMethod', $suatus, $record->deliveryMethod, ['id' => 'deliveryMethod','class' => 'form-control']) }}
                            </div>

                            <div class="form-group col-sm-12">
                                {!! Form::label('deliveryTimeLimit', 'Delivery time limit', array('class' => 'control-label')) !!}
                                {!! Form::text('deliveryTimeLimit', $record->deliveryTimeLimit, ['class' => 'form-control','required' => 'required']); !!}
                                @if ($errors->has('deliveryTimeLimit'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('deliveryTimeLimit') }}</strong>
                                </p>
                                @endif
                            </div>

                            <div class="form-group col-sm-12">
                                {!! Form::label('collectionTimeLimit', 'Collection time limit', array('class' => 'control-label')) !!}
                                {!! Form::text('collectionTimeLimit', $record->collectionTimeLimit, ['class' => 'form-control','required' => 'required']); !!}
                                @if ($errors->has('collectionTimeLimit'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('collectionTimeLimit') }}</strong>
                                </p>
                                @endif
                            </div>
                            <div class="clearfix"></div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="{{ asset('admin/pages/del_col_extra.js') }}"></script>
@endsection
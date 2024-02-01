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

            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => action('Backend\ExtraChargeController@update'), 'method' => 'POST', 'id' => 'updateExtraCharge','class' => '', 'role'=>'form']) !!}
                    <div class="box-body row">


                        <div class="form-group col-sm-12">
                            {!! Form::label('deliveryMethod', 'Delivery method', array('class' => 'control-label')) !!}
                            @php
                            $suatus = array('both'=>'Both','delivery'=>'Delivery','collection'=> 'Collection');
                            @endphp
                            {{ Form::select('deliveryMethod', $suatus, $record->deliveryMethod, ['id' => 'deliveryMethod','class' => 'form-control']) }}
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            {!! Form::label('extraAmount', 'Amount', array('class' => 'control-label')) !!}
                            {!! Form::text('extraAmount', $record->extraAmount, ['class' => 'form-control','required' => 'required']); !!}
                            @if ($errors->has('extraAmount'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('extraAmount') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="form-group col-sm-12">
                            {!! Form::label('ExtraChargeStatus', 'Status', array('class' => 'control-label')) !!}
                            @php
                            $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('ExtraChargeStatus', $suatus, $record->ExtraChargeStatus, ['id' => 'ExtraChargeStatus','class' => 'form-control']) }}
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

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js')
<script src="{{ asset('admin/pages/del_col_extra.js') }}"></script>
@endsection
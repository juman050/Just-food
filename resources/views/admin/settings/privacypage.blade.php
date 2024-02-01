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

                    {!! Form::open(['url' => action('Backend\PageSettingController@storePrivacyInfo'), 'method' => 'POST', 'id' => 'storePrivacyInfo', 'class' => '','role'=>'form']) !!}
                    <div class="box-body row">

                        <div class="form-group col-sm-6">
                            {!! Form::label('privacy_title', 'Privacy & policy meta title', array('class' => 'control-label')) !!}
                            {!! Form::text('privacy_title', $privacyData->privacy_title, ['class' => 'form-control','required' => 'required']); !!}
                            @if ($errors->has('privacy_title'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('privacy_title') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('privacy_custom_text', 'Custom field', array('class' => 'control-label')) !!}
                            {!! Form::text('privacy_custom_text', $privacyData->privacy_custom_text, ['class' => 'form-control']); !!}
                            @if ($errors->has('privacy_custom_text'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('privacy_custom_text') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-6">
                            {!! Form::label('privacy_meta_description', 'Privacy & policy meta description', array('class' => 'control-label')) !!}
                            {!! Form::textarea('privacy_meta_description', $privacyData->privacy_meta_description, ['class' => 'form-control textarea']); !!}
                            @if ($errors->has('privacy_meta_description'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('privacy_meta_description') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('privacy_custom_textarea', 'Privacy & policy custom textarea', array('class' => 'control-label')) !!}
                            {!! Form::textarea('privacy_custom_textarea', $privacyData->privacy_custom_textarea, ['class' => 'form-control textarea']); !!}
                            @if ($errors->has('privacy_custom_textarea'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('privacy_custom_textarea') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            {!! Form::label('privacy_description', 'Privacy & policy main description', array('class' => 'control-label')) !!}
                            {!! Form::textarea('privacy_description', $privacyData->privacy_description, ['class' => 'form-control textarea']); !!}
                            @if ($errors->has('privacy_description'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('privacy_description') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="clearfix"></div>

                    </div>

                    <div class="clearfix"></div>
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
    <script src="{{ asset('admin/pages/pageSetting.js') }}"></script>
@endsection
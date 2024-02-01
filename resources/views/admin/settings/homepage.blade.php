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

                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => action('Backend\PageSettingController@storeHomeInfo'), 'method' => 'POST', 'id' => 'storeHomeInfo', 'class' => '', 'files' => 'true','role'=>'form']) !!}
                    <div class="box-body row">

                        <div class="form-group col-sm-6">
                            {!! Form::label('home_title', 'Home meta title', array('class' => 'control-label')) !!}
                            {!! Form::text('home_title', $homeData->home_title, ['class' => 'form-control']); !!}
                            @if ($errors->has('home_title'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('home_title') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('home_caption', 'Home caption', array('class' => 'control-label')) !!}
                            {!! Form::text('home_caption', $homeData->home_caption, ['class' => 'form-control']); !!}
                            @if ($errors->has('home_caption'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('home_caption') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            {!! Form::label('home_tagline', 'Home tag line', array('class' => 'control-label')) !!}
                            {!! Form::text('home_tagline', $homeData->home_tagline, ['class' => 'form-control']); !!}
                            @if ($errors->has('home_tagline'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('home_tagline') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-6">
                            {!! Form::label('home_meta_description', 'Home meta description', array('class' => 'control-label')) !!}
                            {!! Form::textarea('home_meta_description', $homeData->home_meta_description, ['class' => 'form-control textarea']); !!}
                            @if ($errors->has('home_meta_description'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('home_meta_description') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('home_description', 'Home description', array('class' => 'control-label')) !!}
                            {!! Form::textarea('home_description', $homeData->home_description, ['class' => 'form-control textarea']); !!}
                            @if ($errors->has('home_description'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('home_description') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('home_custom_text', 'Custom field', array('class' => 'control-label')) !!}
                            {!! Form::text('home_custom_text', $homeData->home_custom_text, ['class' => 'form-control']); !!}
                            @if ($errors->has('home_custom_text'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('home_custom_text') }}</strong>
                            </p>
                            @endif
                        </div>


                        <div class="form-group col-sm-6">
                            {!! Form::label('home_background_image','Home Background image') !!}
                            {!! Form::file('home_background_image', ['id' => 'home_background_image', 'accept' => 'image/*']); !!}
                            <small><p class="help-block">Max File size: 1MB</p></small>
                        </div>


                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-sm-6">


                                <div class="form-group col-sm-12">
                                    {!! Form::label('home_custom_textarea', 'Custom textarea', array('class' => 'control-label')) !!}
                                    {!! Form::textarea('home_custom_textarea', $homeData->home_custom_textarea, ['class' => 'form-control textarea']); !!}
                                    @if ($errors->has('home_custom_textarea'))
                                    <p class="help-block error_login">
                                        <strong>{{ $errors->first('home_custom_textarea') }}</strong>
                                    </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <img src="{{asset('media/theme/'.$homeData->home_background_image)}}" style="width: 100%;">
                            </div>


                        </div>
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
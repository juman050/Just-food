@extends('admin.layout.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$data['pageName']}}
            <small>{{$data['pageTagLine']}}</small>
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

            <div class="col-md-7">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic setting of theme</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => action('Backend\SiteSettingController@storeSiteBasic'), 'method' => 'POST', 'id' => 'siteBasicForm','class' => '', 'files' => 'true','role'=>'form']) !!}
                    <div class="box-body row">

                        <div class="form-group col-sm-6">
                            {!! Form::label('site_title', 'Site title', array('class' => 'control-label')) !!}
                            {!! Form::text('site_title', $themeData->site_title, ['class' => 'form-control']); !!}
                            @if ($errors->has('site_title'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('site_title') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('site_date_format', 'Date Format', array('class' => 'control-label')) !!}
                            @php
                            $dateFormat = [
                            'F j, Y, g:i a' => 'Jun 10, 2001, 5:16 pm',
                            'j F, Y H:i a' => '10 Jun, 2020 00:02 AM',
                            'Y-m-d H:i:s' => '2020-06-10 17:16:18',
                            'm.d.y' => '06.10.20',
                            'm-d-y' => '06-10-20',
                            'j, n, Y' => '10, 6, 2020',
                            ];
                            @endphp
                            {!! Form::select('site_date_format', $dateFormat, $themeData->site_date_format, ['id' => 'site_date_format','class' => 'select2 form-control']) !!}
                            @if ($errors->has('site_date_format'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('site_date_format') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-6">
                            @include('admin.extras.timezones')
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('site_currency', 'Currency', array('class' => 'control-label')) !!}
                            @php
                            $currencies = array('$'=>'USD ($)', '€'=> 'EUR (€)', '£'=>'GBP (£)', 'pуб'=>'RUB (pуб)');
                            @endphp
                            {{ Form::select('site_currency', $currencies, $themeData->site_currency, ['id' => 'site_currency','class' => 'select2 form-control']) }}
                            @if ($errors->has('site_currency'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('site_currency') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="clearfix"></div>

                        @can('super-admin-only',Auth::user())
                        <div class="form-group col-sm-6">
                            @else
                            <div class="form-group col-sm-12">
                                @endcan
                                {!! Form::label('site_language', 'Language', array('class' => 'control-label')) !!}
                                @php
                                $languages = array('bn'=> 'Bangla','en'=>'English');
                                @endphp
                                {{ Form::select('site_language', $languages, $themeData->site_language, ['id' => 'site_language','class' => 'select2 form-control']) }}
                                @if ($errors->has('site_language'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('site_language') }}</strong>
                                </p>
                                @endif
                            </div>

                            @can('super-admin-only',Auth::user())
                            <div class="form-group col-sm-6">
                                {!! Form::label('site_status', 'Website Status', array('class' => 'control-label')) !!}
                                @php
                                $suatus = array(''=> 'Enable','0'=>'Disable');
                                @endphp
                                {{ Form::select('site_status', $suatus, $themeData->site_status, ['id' => 'site_status','class' => 'form-control']) }}
                            </div>
                            @endcan

                            <div class="clearfix"></div>


                            <div class="form-group col-sm-6">
                                {!! Form::label('site_android_url', 'Android url', array('class' => 'control-label')) !!}
                                {!! Form::url('site_android_url', $themeData->site_android_url, ['class' => 'form-control']); !!}
                                @if ($errors->has('site_android_url'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('site_android_url') }}</strong>
                                </p>
                                @endif
                            </div>

                            <div class="form-group col-sm-6">
                                {!! Form::label('site_ios_url', 'IOS url', array('class' => 'control-label')) !!}
                                {!! Form::url('site_ios_url', $themeData->site_ios_url, ['class' => 'form-control']); !!}
                                @if ($errors->has('site_ios_url'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('site_ios_url') }}</strong>
                                </p>
                                @endif
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group col-sm-6">
                                {!! Form::label('smallLogo','Small Logo') !!}
                                {!! Form::file('smallLogo', ['id' => 'smallLogo', 'accept' => 'image/*']); !!}
                                <small><p class="help-block">Max File size: 1MB</p></small>
                                <img src="{{asset('media/theme/'.$themeData->site_small_logo)}}" height="60">
                            </div>

                            <div class="form-group col-sm-6">
                                {!! Form::label('mainLogo','Main Logo') !!}
                                {!! Form::file('mainLogo', ['id' => 'mainLogo', 'accept' => 'image/*']); !!}
                                <small><p class="help-block">Max File size: 1MB</p></small>
                                <img src="{{asset('media/theme/'.$themeData->site_main_logo)}}" height="60">
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group col-sm-6">
                                {!! Form::label('preLoader','Pre loader') !!}
                                {!! Form::file('preLoader', ['id' => 'preLoader', 'accept' => 'image/*']); !!}
                                <small><p class="help-block">Max File size: 1MB</p></small>
                                <img src="{{asset('media/theme/'.$themeData->site_pre_loader)}}" height="60">
                            </div>

                            <div class="form-group col-sm-6">
                                {!! Form::label('fabicon','Fabicon') !!}
                                {!! Form::file('fabicon', ['id' => 'fabicon', 'accept' => 'image/*']); !!}
                                <small><p class="help-block">Max File size: 1MB</p></small>
                                <img src="{{asset('media/theme/'.$themeData->site_fabicon)}}" height="60">
                            </div>

                            <div class="clearfix"></div>


                            <div class="form-group col-sm-12">
                                {!! Form::label('site_description', 'Site Description', array('class' => 'control-label')) !!}
                                {!! Form::textarea('site_description', $themeData->site_description, ['class' => 'form-control textarea']); !!}
                                @if ($errors->has('site_description'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('site_description') }}</strong>
                                </p>
                                @endif
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group col-sm-12">
                                {!! Form::label('site_copyright', 'Copyright', array('class' => 'control-label')) !!}
                                {!! Form::textarea('site_copyright', $themeData->site_copyright, ['class' => 'form-control textarea']); !!}
                                @if ($errors->has('site_copyright'))
                                <p class="help-block error_login">
                                    <strong>{{ $errors->first('site_copyright') }}</strong>
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

                <div class="col-md-5">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Social link</h3>
                        </div>
                        {!! Form::open(['url' => action('Backend\SiteSettingController@storeSocialLink'), 'method' => 'POST', 'id' => 'socialForm',
                        'class' => 'form-horizontal']) !!}
                        <div class="box-body">

                            <div class="form-group">
                                {!! Form::label('site_facebook_link', 'Facebook', array('class' => 'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::url('site_facebook_link', $themeData->site_facebook_link, ['class' => 'form-control']); !!}
                                </div>
                            </div>


                            <div class="form-group">
                                {!! Form::label('site_twitter_link', 'Twitter', array('class' => 'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::url('site_twitter_link', $themeData->site_twitter_link, ['class' => 'form-control']); !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('site_instagram_link', 'Instagram', array('class' => 'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::url('site_instagram_link', $themeData->site_instagram_link, ['class' => 'form-control']); !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('site_linkedin_link', 'LinkedIn', array('class' => 'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::url('site_linkedin_link', $themeData->site_linkedin_link, ['class' => 'form-control']); !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('site_google_plus_link', 'Google plus', array('class' => 'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::url('site_google_plus_link', $themeData->site_google_plus_link, ['class' => 'form-control']); !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('site_pinterest_link', 'Pinterest', array('class' => 'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::url('site_pinterest_link', $themeData->site_pinterest_link, ['class' => 'form-control']); !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('site_youtube_link', 'YouTube', array('class' => 'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::url('site_youtube_link', $themeData->site_youtube_link, ['class' => 'form-control']); !!}
                                </div>
                            </div>


                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Update</button>
                        </div>
                        <!-- /.box-footer -->
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
        <script src="{{ asset('admin/pages/themeSetting.js') }}"></script>
    @endsection
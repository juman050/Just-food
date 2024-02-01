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

        <div class="row">

            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#changePassword" data-toggle="tab">Change Password</a></li>
                        @can('super-admin-only',Auth::user())
                        <li><a href="#addNewUser" data-toggle="tab">Add New User</a></li>
                        <li><a href="#userLists" data-toggle="tab">User Lists</a></li>
                        @endcan
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="changePassword">

                            {!! Form::open(['url' => action('Backend\DashboardController@changePassword'), 'method' => 'POST', 'id' => 'changePasswordForm','class' => 'form-horizontal', 'role'=>'form']) !!}

                            <div class="form-group">
                                {!! Form::label('old_password', 'Old Password', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-7">
                                    {!! Form::text('old_password', null, ['placeholder' => '*********','class' => 'form-control']); !!}
                                    @if ($errors->has('old_password'))
                                    <p class="help-block error_login">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('new_password', 'New Password', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-7">
                                    {!! Form::text('new_password', null, ['placeholder' => '*********','class' => 'form-control']); !!}
                                    @if ($errors->has('new_password'))
                                    <p class="help-block error_login">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                {!! Form::label('confirm_password', 'Confirm Password', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-7">
                                    {!! Form::text('confirm_password', null, ['placeholder' => '*********','class' => 'form-control']); !!}
                                    @if ($errors->has('confirm_password'))
                                    <p class="help-block error_login">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                            {!! Form::close() !!}

                        </div>
                        <!-- /.tab-pane -->
                        @can('super-admin-only',Auth::user())
                        <div class="tab-pane" id="addNewUser">


                            {!! Form::open(['url' => action('Backend\DashboardController@addUser'), 'method' => 'POST', 'id' => 'registerUser','class' => 'form-horizontal', 'role'=>'form']) !!}

                            <div class="form-group">
                                {!! Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-7">
                                    {!! Form::text('name', null, ['placeholder' => 'Enter name','class' => 'form-control']); !!}
                                    @if ($errors->has('name'))
                                    <p class="help-block error_login">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                {!! Form::label('email', 'Email', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-7">
                                    {!! Form::email('email', null, ['placeholder' => 'Enter email','class' => 'form-control']); !!}
                                    @if ($errors->has('email'))
                                    <p class="help-block error_login">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                {!! Form::label('role', 'Role', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-7">
                                    @php
                                    $roles = array('super-admin'=>'Super-admin','admin'=>'Admin');
                                    @endphp
                                    {{ Form::select('role', $roles, null, ['id' => 'role','class' => 'form-control']) }}
                                    @if ($errors->has('role'))
                                    <p class="help-block error_login">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                {!! Form::label('active', 'Status', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-7">
                                    @php
                                    $active = array('0'=>'De-active','1'=>'Active');
                                    @endphp
                                    {{ Form::select('active', $active, null, ['id' => 'active','class' => 'form-control']) }}
                                    @if ($errors->has('active'))
                                    <p class="help-block error_login">
                                        <strong>{{ $errors->first('active') }}</strong>
                                    </p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                {!! Form::label('password', 'Password', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-7">
                                    {!! Form::text('password', null, ['placeholder' => '*********','class' => 'form-control']); !!}
                                    @if ($errors->has('password'))
                                    <p class="help-block error_login">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                {!! Form::label('add_confirm_password', 'Confirm Password', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-7">
                                    {!! Form::text('add_confirm_password', null, ['placeholder' => '*********','class' => 'form-control','id' => 'password-confirm']); !!}
                                    @if ($errors->has('add_confirm_password'))
                                    <p class="help-block error_login">
                                        <strong>{{ $errors->first('add_confirm_password') }}</strong>
                                    </p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </div>


                            {!! Form::close() !!}

                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="userLists">

                            <div class="TableData">

                            </div>

                        </div>
                        @endcan
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js')

<script src="{{ asset('admin/pages/profile.js') }}"></script>

@endsection
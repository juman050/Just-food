@extends('frontend.imageTheme.layout.master')

@section('mainContent')

<!-- Profile Section -->
<section id="bg-section">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="nav-tabs-custom">

                    <ul class="nav nav-tabs">

                        <li  class="active"><a href="#editProfile" data-toggle="tab">Edit profile</a></li>

                        <li><a href="#changePassword" data-toggle="tab">Change Password</a></li>

                        <!-- <li><a href="#orders" data-toggle="tab">Your Order</a></li> -->

                        <li  class="pull-right"><a href="{{ url('customer/logout') }}">Logout</a></li>

                    </ul>

                    <div class="tab-content">

                        <div class="active tab-pane" id="editProfile">


                            {!! Form::open(['url' => action('ProfileController@editProfile'), 'method' => 'POST', 'id' => 'editProfileForm','class' => 'form-horizontal', 'role'=>'form']) !!}

                            <div class="form-group">

                                {!! Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) !!}

                                <div class="col-sm-7">

                                    {!! Form::text('name', $user->name, ['placeholder' => 'Enter name','class' => 'form-control']); !!}

                                    @if ($errors->has('name'))

                                    <p class="help-block error_login">

                                        <strong>{{ $errors->first('name') }}</strong>

                                    </p>

                                    @endif

                                </div>

                            </div>



                            <div class="form-group">

                                {!! Form::label('phone', 'Phone', array('class' => 'col-sm-2 control-label')) !!}

                                <div class="col-sm-7">

                                    {!! Form::text('phone', $user->phone, ['placeholder' => 'Enter phone','class' => 'form-control']); !!}

                                    @if ($errors->has('phone'))

                                    <p class="help-block error_login">

                                        <strong>{{ $errors->first('phone') }}</strong>

                                    </p>

                                    @endif

                                </div>

                            </div>



                            <div class="form-group">

                                {!! Form::label('post_code', 'Post code', array('class' => 'col-sm-2 control-label')) !!}

                                <div class="col-sm-7">

                                    {!! Form::text('post_code', $user->post_code, ['placeholder' => 'Enter post_code','class' => 'form-control']); !!}

                                    @if ($errors->has('post_code'))

                                    <p class="help-block error_login">

                                        <strong>{{ $errors->first('post_code') }}</strong>

                                    </p>

                                    @endif

                                </div>

                            </div>



                            <div class="form-group">

                                {!! Form::label('address', 'Address', array('class' => 'col-sm-2 control-label')) !!}

                                <div class="col-sm-7">

                                    {!! Form::text('address', $user->address, ['placeholder' => 'Enter address','class' => 'form-control']); !!}

                                    @if ($errors->has('address'))

                                    <p class="help-block error_login">

                                        <strong>{{ $errors->first('address') }}</strong>

                                    </p>

                                    @endif

                                </div>

                            </div>



                            <div class="form-group">

                                <div class="col-sm-offset-2 col-sm-10">

                                    <button type="submit" class="btn btn-primary">Update</button>

                                </div>

                            </div>

                            {!! Form::close() !!}


                        </div>


                        <div class="tab-pane" id="changePassword">

                            {!! Form::open(['url' => action('ProfileController@changePassword'), 'method' => 'POST', 'id' => 'changePasswordForm','class' => 'form-horizontal', 'role'=>'form']) !!}



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


                    </div>

                </div>

            </div>



        </div>

    </div>

</section>

@endsection



@section('js')

<script type="text/javascript">

    jQuery(function($){


        $( "#changePasswordForm" ).validate({

            rules: {

                old_password:  {

                    required: true,

                },

                new_password:  {

                    required: true,

                    minlength:3,

                },

                confirm_password:  {

                    required: true,

                    minlength:3,

                    equalTo: '#new_password',

                },

            },

            submitHandler: function(form) {

                var data =  new FormData($('#changePasswordForm')[0]);

                $.ajax({

                    type: "POST",

                    url: $('#changePasswordForm').attr("action"),

                    dataType: "json",

                    data: data,

                    contentType: false,

                    processData: false,

                    success: function(response){

                        if(response.status == 'success'){

                            $('#changePasswordForm')[0].reset();

                        }

                        toast(response);

                    }

                });

            }

        });


        $( "#editProfileForm" ).validate({

            rules: {

                name:  {

                    required: true,

                },

                phone:  {

                    required: true,

                },

                post_code:  {

                    required: true,

                },

                address:  {

                    required: true,

                },

            },

            submitHandler: function(form) {

                var data =  new FormData($('#editProfileForm')[0]);

                $.ajax({

                    type: "POST",

                    url: $('#editProfileForm').attr("action"),

                    dataType: "json",

                    data: data,

                    contentType: false,

                    processData: false,

                    success: function(response){

                        toast(response);

                    }

                });

            }

        });

    });

</script>

@endsection
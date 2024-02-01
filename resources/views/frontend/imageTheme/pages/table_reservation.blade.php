@extends('frontend.imageTheme.layout.master')

@section('css')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin/plugins/timepicker/bootstrap-timepicker.min.css') }}">
@endsection

@section('mainContent')


<!-- Table reservation Section -->
<section id="" class="p_174_100 reservation-section">
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="table-res">

                <h3>Table Reservation</h3>
                <p class="text-center">Advanced book a table & get enjoy !</p>

                {!! Form::open(['url' => action('PagesController@submitBookTable'), 'method' => 'POST', 'id' => 'contact', 'class' => 'tableReservationForm', 'role'=>'form']) !!}

                {!! Form::text('name', null, ['placeholder' => 'Name','tabindex' => '1','required' => 'required']); !!}
                @if ($errors->has('name'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('name') }}</strong>
                </p>
                @endif

                {!! Form::email('email', null, ['placeholder' => 'Email','tabindex' => '2']); !!}
                @if ($errors->has('email'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('email') }}</strong>
                </p>
                @endif

                {!! Form::text('phone', null, ['placeholder' => 'Phone','tabindex' => '4','required' => 'required']); !!}
                @if ($errors->has('phone'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('phone') }}</strong>
                </p>
                @endif

                {!! Form::text('no_of_guests', null, ['placeholder' => 'No of guests','tabindex' => '3','required' => 'required']); !!}
                @if ($errors->has('no_of_guests'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('no_of_guests') }}</strong>
                </p>
                @endif

                {!! Form::text('res_date', null, ['placeholder' => 'Date','class' => 'res_date','tabindex' => '5','required' => 'required']); !!}
                @if ($errors->has('res_date'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('res_date') }}</strong>
                </p>
                @endif


                {!! Form::text('time', null, ['placeholder' => '00:00','class' => 'time','tabindex' => '6','required' => 'required']); !!}
                @if ($errors->has('time'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('time') }}</strong>
                </p>
                @endif


                {!! Form::textarea('sp_request', null, ['placeholder' => 'Special Request....','tabindex' => '7','required' => 'required']); !!}
                @if ($errors->has('sp_request'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('sp_request') }}</strong>
                </p>
                @endif

                {{ Form::button('Book now',['type' => 'submit','id' => 'table-submit','name' => 'submit']) }}

                {!! Form::close() !!}

            </div>

        </div>
    </div><!-- End container --> 
</section>


@endsection

@section('js')

<script src="{{ asset('admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<script type="text/javascript">
    jQuery(function($){

        $(".res_date").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            // maxDate:'+1m +2d',
            maxDate:'+7d',
        });

        //Timepicker
        $('.time').timepicker({
            showInputs: false,
            maxHours : 24,
            showMeridian : false,
        
        })
        
        $( ".tableReservationForm" ).validate({
        
            rules: {
                name:  {
                    required: true,
                    maxlength: 100,
                },
                email:  {
                    email: true,
                },
                phone: {
                    required: true,
                    maxlength: 20,
                },
                no_of_guests: {
                    required: true,
                    digits: true,
                    max: 30,
                    min: 1,
                },
                res_date:  {
                    required: true,
                },
                time: {
                    required: true,
                },
                sp_request: {
                    required: true,
                    maxlength: 1000,
                }
            },
            messages: {
                name: {
                    required: "Please fill-up name field.",
                    maxlength: "Must contain in 100 letters",
                },
                email: {
                    email: "Please enter valid email address",
                },
                phone: {
                    required: "Please enter your contact number.",
                    maxlength: "Must contain in 20 letters",
                },
                no_of_guests: {
                    required: "Please enter number of guests.",
                    integer: "Please enter digits !",
                    max: "Maximum 30 person !",
                    min: "Maximum 1 person !",
                },
                res_date: {
                    required: "Please enter resevation date.",
                },
                time: {
                    required: "Please enter resevation time.",
                },
                sp_request: {
                    required: "Please enter special request.",
                    maxlength: "Must contain in 1000 letters",
                },
            },
            submitHandler: function(form) {
        
                var data =  new FormData($('.tableReservationForm')[0]);
                $.ajax({
                    type: "POST",
                    url: $('.tableReservationForm').attr("action"),
                    dataType: "json",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        $('.tableReservationForm')[0].reset();
                        toast(response);
                    }
        
                });
            }
        
        });
    })
</script>

@endsection

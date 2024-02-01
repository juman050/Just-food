<!DOCTYPE html>
<html lang="en">
<head>
    
<!--=== meta ===-->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="JustFood - Online takeway | Food Delivery Restaurant Website and Online Ordering script">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

<title>{{ $data['meta_title'] }}</title>

<link rel="icon" type="image/png" href="{{asset('media/theme/'.$themeDatas->site_fabicon)}}"/>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

       <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->


<!-- CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}"> <!-- Bootstrap v3.3.7 -->
<link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}"> <!-- Font Awesome V4.7.0 -->
<link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}"> <!-- Carousel css -->
<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}"> <!-- Style css -->
<link rel="stylesheet" href="{{ asset('common/toast/iziToast.min.css') }}"> <!-- Toast css -->
<link rel="stylesheet" href="{{ asset('common/bootstrap-fileinput/fileinput.min.css') }}"> <!-- Fileinput css -->
<link rel="stylesheet" href="{{ asset('common/select2/dist/css/select2.min.css') }}"> <!-- Select2 css -->
<link rel="stylesheet" href="{{ asset('common/jquery-ui/jquery-ui.css') }}"> <!-- jquery ui css -->

<!-- JS -->
<script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script> <!-- jQuery v3.1.1 -->
<script type="text/javascript" src="{{ asset('frontend/js/loadingoverlay.min.js') }}"></script> <!-- loadingoverlay.min.js v3.1.1 -->
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script> <!-- Bootstrap v3.3.7 -->
<script type="text/javascript" src="{{ asset('common/jquery_validate/jquery.validate.min.js') }}"></script> <!-- Validator js -->

@php
    $flag = 0;
@endphp

@if($openCloseDatas->restaurantStatus=='open')

    @php

        $flag = 1;

    @endphp

    @if((date('H:i:s') >= $openCloseDatas->openingTime) && (date('H:i:s') <= $openCloseDatas->closingTime))

        @php

            $flag = 1;

        @endphp

    @else

        @php

            $flag = 2;

        @endphp

    @endif

@endif


<!-- Global JS variable by PHP -->
<script type="text/javascript">

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });

    var base_URL = '{{ asset('/') }}';

    var shippingMethod = '{{$otherDatas->deliveryMethod}}';

    var sess_postcode = '{{\Session::get('postcode')}}';

    var str_sts = '{{$storeDatas->store_extra_tiny_2}}';

    var store_extra = '{{$storeDatas->store_extra_tiny}}';

    var segment = '{{Request::segment(1)}}';

    var CSRF = '{{ csrf_token() }}';

    var res_status = 'close';

    @if($flag==1)

        var res_status = 'open';

    @endif

    @if($flag==2)

        @if($otherDatas->pre_order_status=='enable')

            var res_status = 'pre_order_on';

        @else

            var res_status = 'pre_order_off';

        @endif

    @endif

    $.LoadingOverlaySetup({

       background      : "rgba(255, 255, 255, 0.76)",

       image           : "{{asset('media/theme/'.$themeDatas->site_pre_loader)}}",

       imageAnimation  : "1.5s fadein",

       imageColor      : "#ffcc00",

       zIndex          : 9

    });

</script>

@yield('css')

</head>

<body>



<div class="page-wrapper">

    <!-- header -->

    @if($offers)

        <p class="text-center offer_title">{{$offers->custom_text}}</p>

    @endif

    @if((\Request::segment(1)=='home') || (\Request::segment(1)==''))

    <header class="home_header" style="background-image: url({{asset('media/theme/'.$pageInfo->home_background_image)}});">

    @else

    <header>

    @endif

        <nav>

            <div id="menu-toggle" class="menu-toggle">

                <div class="hamburger">

                    <span class="bar"></span>

                    <span class="bar"></span>

                    <span class="bar"></span>

                </div>

                <div class="cross">

                    <span class="bar"></span>

                    <span class="bar"></span>

                </div>

            </div>


            <div class="container-fluid nav-container">

                <div class="logo">

                    <a href="{{ url('/') }}"><img class="logo-img" src="{{asset('media/theme/'.$themeDatas->site_main_logo)}}" alt="Logo"></a>

                </div>

                <div class="menu-box">

                    <ul class="menu-list">



                        @if($otherDatas->home_page_status == 'enable')

                            <li><a href="{{url('/')}}" class="menu-item">Home</a></li>

                        @endif



                        @if($otherDatas->menu_page_status == 'enable')

                            <li><a href="{{url('/menu')}}" class="menu-item">Menu</a></li>

                        @endif



                        @if($otherDatas->table_book_status=='enable')

                            <li><a href="{{url('/table-reservation')}}" class="menu-item">Book Table</a></li>

                        @endif



                        @if($otherDatas->menu_file_status=='enable')

                            <li><a href="{{url('/menu-download')}}" class="menu-item">Menu download</a></li>

                        @endif



                        @if($otherDatas->gallery_page_status=='enable')

                            <li><a href="{{url('/gallery')}}" class="menu-item">Gallery</a></li>

                        @endif



                        @if($otherDatas->contact_page_status=='enable')

                            <li><a href="{{url('/contact')}}" class="menu-item">Contact</a></li>

                        @endif



                        @if(Session::get('customerEmail') != null)

                            <li><a href="{{url('/pre-orders')}}" class="menu-item">My Orders</a></li>

                        @endif



                    </ul>

                    <div class="signup-box">

                        @if(Session::get('customerEmail') != null)

                        <a href="{{url('profile')}}" class="register btn-rounded btn-o">{{Session::get('customerName')}}</a>

                        @else

                        <a href="javascript:void(0)" class="register btn-rounded btn-o log_reg">Login / Register</a>

                        @endif

                    </div>

                </div>

            </div>

        </nav>

        @if((\Request::segment(1)=='home') || (\Request::segment(1)==''))

        <div class="header-info">

            <div class="container">

                <h1 class="heading-1">Restaurant {{ ($flag==1) ? 'Open' : 'Close' }}</h1>

                <p class="p-text">We are also taking order via <a href="tel:{{ $storeDatas->store_support_number }}" class="p-text">Call {{ $storeDatas->store_support_number }}</a></p>

                <form>

                    @if($flag==1)

                        <a href="{{url('/menu')}}" class="btn-rounded res_btn_rounded">Order now</a>

                    @endif

                    @if($flag==2)

                        @if($otherDatas->pre_order_status=='enable')

                            <a href="{{url('/menu')}}" class="btn-rounded res_btn_rounded">Pre-order now</a>

                        @endif

                    @endif

                </form>

            </div>

        </div>

        @endif

    </header>

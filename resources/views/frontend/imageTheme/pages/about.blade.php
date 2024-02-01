@extends('frontend.imageTheme.layout.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/gallery.css') }}">
@endsection

@section('mainContent')

<!-- About Section -->
<section id="gallery" class="p_174_100">
    <div class="container">
        <h2 class="heading-2 text-center">About</h2>
        <div class="white-space30"></div>
        <div id="image-gallery">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                    <div class="img-wrapper">
                        <a href="{{asset('media/theme/food-1.jpg')}}"><img src="{{asset('media/theme/food-1.jpg')}}" class="img-responsive"></a>
                        <div class="img-overlay">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                    <div class="img-wrapper">
                        <a href="{{asset('media/theme/item_856787.jpg')}}"><img src="{{asset('media/theme/item_856787.jpg')}}" class="img-responsive"></a>
                        <div class="img-overlay">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div><!-- End row -->
        </div><!-- End image gallery -->
    </div><!-- End container --> 
</section>

@endsection

@section('js')

<script type="text/javascript" src="{{ asset('frontend/js/gallery.js') }}"></script>

@endsection
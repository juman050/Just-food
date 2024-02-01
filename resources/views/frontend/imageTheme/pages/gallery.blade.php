@extends('frontend.imageTheme.layout.master')
@section('mainContent')

<!-- Gallery Section -->
<section id="gallery" class="p_174_100">
    <div class="container">
        <h2 class="heading-2 text-center">Galleries</h2>
        <div class="white-space30"></div>
        <div id="image-gallery">
            <div class="row">

                @if(count($galleries) > 0)
                @foreach($galleries as $gallery)

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                    <div class="img-wrapper">
                        <a href="{{asset('media/gallery/'.$gallery->image)}}"><img src="{{asset('media/gallery/'.$gallery->image)}}" class="img-responsive" alt="{{$gallery->title}}"></a>
                        <div class="img-overlay">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                @endforeach
                @else
                <p class="text-center text-danger">No Photo in gallery !</p>
                @endif


            </div><!-- End row -->
        </div><!-- End image gallery -->
    </div><!-- End container --> 
</section>

@endsection
@extends('frontend.imageTheme.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/chekout.css')}}">
@endsection

@section('mainContent')


<section id="gallery" class="p_174_100">
    <div class="container">

        <div class="col-md-6 col-xs-12 col-md-offset-3">

            <div id="cart-checkout" class="cus_success_pa">

                <h3 class="text-center">Success</h3>

                <p class="text-center success_p">Ordered successfully !</p>
                <p class="text-center success_p">We will take care of your order.</p>
                <p class="text-center success_p">Thank you :)</p>
                <br>
                <br>
                <p class="text-center"><a href="{{url('/menu')}}" class="btn btn-sm btn-primary">Go to Menu</a></p>

            </div>

        </div>


    </div><!-- End container --> 
</section>


@endsection


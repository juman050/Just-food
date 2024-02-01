@extends('frontend.imageTheme.layout.master')
@section('mainContent')

<!-- Faq Section -->
<section id="contact-section" class="p_174_100">
    <div class="container">
        <h2 class="heading-2 text-center">Faqs</h2>
        <div class="white-space30"></div>

        @if($faqs->count() > 0)
        @foreach($faqs as $faq)
        <h2 class="faq-h2">{{ $faq->question }}</h2>
        <p class="faq-p">{{ $faq->answer }}</p>
        <br>
        @endforeach
        @else
        <p class="text-center text-danger">No faqs inserted yet !</p>
        @endif

    </div><!-- End container --> 
</section>

@endsection
@extends('frontend.imageTheme.layout.master')
@section('mainContent')

<!-- Privacy & Policy Section -->
<section id="contact-section" class="p_174_100">
	<div class="container">
		<h2 class="heading-2 text-center">Privacy & Policy</h2>
		<div class="white-space30"></div>
		{{$pageInfo->privacy_description}}

	</div><!-- End container --> 
</section>

@endsection
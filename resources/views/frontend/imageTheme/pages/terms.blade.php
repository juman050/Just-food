@extends('frontend.imageTheme.layout.master')
@section('mainContent')

<!-- Terms & Conditions Section -->
<section id="contact-section" class="p_174_100">
	<div class="container">
		<h2 class="heading-2 text-center">Terms & Conditions</h2>
		<div class="white-space30"></div>
		{{$pageInfo->terms_description}}
	</div>
</section>

@endsection
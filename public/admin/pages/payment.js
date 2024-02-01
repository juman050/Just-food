/*
|--------------------------------------------------------------------------
| JS for Payment method
|--------------------------------------------------------------------------
|
| Author : Juman
| Version : 1.0.0
|
*/

jQuery(function($){

	$( "#paymentMethodForm" ).validate({
		rules: {
			cash:  {
				required: true,
			},
			online:  {
				required: true,
			},
		},
	});

	$( "#paypalForm" ).validate({
		rules: {
			p_u:  {
				required: true,
			},
			p_p:  {
				required: true,
			},
			p_s:  {
				required: true,
			},
			p_a_t:  {
				required: true,
			},
			p_e_d:  {
				required: true,
			},
		},
	});


	$( "#stripeForm" ).validate({
		rules: {
			s_p_k:  {
				required: true,
			},
			s_s_k:  {
				required: true,
			},
			s_e_d:  {
				required: true,
			},
		},
	});


});
/*
|--------------------------------------------------------------------------
| JS for store setting
|--------------------------------------------------------------------------
|
| Author : Juman
| Version : 1.0.0
|
*/

jQuery(function($){

	$( "#storeForm" ).validate({
		rules: {
			store_name:  {
				required: true,
				minlength: 2
			},
			store_city:  {
				required: true,
				maxlength: 50,
			},
			store_state: {
				maxlength: 100, 
			},
			store_country: {
				required: true,
				maxlength: 50,
			},
			store_postcode: {
				required: true,
				maxlength: 25,
			},
			store_fax: {
				maxlength: 50
			},
			store_support_number: {
				required: true,
				minlength: 5,
				maxlength: 25
			},
			store_support_email: {
				required: true,
				email: true,
			},
			store_owner_email: {
				email: true,
			},
			store_active_theme: {
				required: true,
			},
			store_address: {
				required: true,
				minlength: 2,
				maxlength: 500
			},
			store_custom_text_1: {
				minlength: 2,
				maxlength: 255
			},
			store_custom_text_2: {
				minlength: 2,
				maxlength: 255
			},
			store_custom_textarea_1: {
				minlength: 2,
				maxlength: 1000
			},
			store_custom_textarea_2: {
				minlength: 2,
				maxlength: 1000
			},
		},

	});

});
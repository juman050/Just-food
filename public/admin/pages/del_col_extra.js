/*
|--------------------------------------------------------------------------
| JS for delivery,collection & other
|--------------------------------------------------------------------------
|
| Author : Emon Ahmed
| Version : 1.0.0
|
*/
jQuery(function($){

	var img_fileinput_setting = {
		'showUpload':false,
		'showPreview':true,
		'browseLabel': 'Upload',
		'removeLabel': 'remove',
		'previewSettings': {
	    	image: {width: "auto", height: "auto", 'max-width': "100%", 'max-height': "100%"}
	    } 
	};
	
	$("#menu_file").fileinput(img_fileinput_setting);

	$( "#updateExtraCharge" ).validate({
		rules: {
			deliveryMethod:  {
				required: true,
			},
			extraAmount:  {
				required: true,
				digits: true,
			},
			ExtraChargeStatus:  {
				required: true,
			},
		},

	});


	$( "#updateOther" ).validate({
		rules: {
			deliveryMethod:  {
				required: true,
			},
			deliveryTimeLimit:  {
				required: true,
				digits: true,
			},
			collectionTimeLimit:  {
				required: true,
				digits: true,
			},
			mileage_or_postcode:  {
				required: true,
			},
			table_book_status:  {
				required: true,
			},
			pre_order_status:  {
				required: true,
			},
			special_reequest_status:  {
				required: true,
			},
			instant_open_close:  {
				required: true,
			},
			image_showing:  {
				required: true,
			},
			free_shipping_status:  {
				required: true,
			},
			amount_for_free_shipping:  {
				required: true,
				digits: true,
			},
			menu_file_status:  {
				required: true,
			},
		},

	});


});

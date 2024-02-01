/*
|--------------------------------------------------------------------------
| JS for page settings
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
	
	$("#home_background_image").fileinput(img_fileinput_setting);

	$( "#storeHomeInfo" ).validate({
		rules: {
			home_title:  {
				required: true,
				minlength: 2,
				maxlength: 255,
			},
			home_caption:  {
				minlength: 2,
				maxlength: 255,
			},
			home_meta_description:  {
				required: true,
				minlength: 10,
			},
			home_tagline: {
				minlength: 2,
				maxlength: 255,
			},
			home_custom_text: {
				minlength: 2,
				maxlength: 255,
			},
		},

	});

	$( "#storeMenuInfo" ).validate({
		rules: {
			menu_title:  {
				required: true,
				minlength: 2,
				maxlength: 500,
			},
			menu_meta_description:  {
				required: true,
				minlength: 10,
			},
			home_custom_text: {
				minlength: 2,
				maxlength: 255,
			},
		},

	});


	$( "#storeGalleryInfo" ).validate({
		rules: {
			gallery_title:  {
				required: true,
				minlength: 2,
				maxlength: 500,
			},
			gallery_meta_description:  {
				required: true,
				minlength: 10,
			},
		},

	});


	$( "#storeContactInfo" ).validate({
		rules: {
			contact_title:  {
				required: true,
				minlength: 2,
				maxlength: 500,
			},
			contact_meta_description:  {
				required: true,
				minlength: 10,
			},
		},

	});


	$( "#storeTermInfo" ).validate({
		rules: {
			terms_title:  {
				required: true,
				minlength: 2,
				maxlength: 500,
			},
			terms_meta_description:  {
				required: true,
				minlength: 10,
			},
		},

	});



	$( "#storePrivacyInfo" ).validate({
		rules: {
			privacy_title:  {
				required: true,
				minlength: 2,
				maxlength: 500,
			},
			privacy_meta_description:  {
				required: true,
				minlength: 10,
			},
		},

	});




	$( "#storeFAQInfo" ).validate({
		rules: {
			question:  {
				required: true,
				minlength: 2,
			},
			answer:  {
				required: true,
				minlength: 2,
			},
			status: {
				required: true, 
			},
		},

	});


	$('.switch__input').change(function(e){
		e.preventDefault();
		if($(this).is(':checked')){
			var sts = 'Enable';
			var status = 'enable';
		}else{
			var sts = 'Disable';
			var status = 'disable';
		}

		var id = $(this).data('id');

		// if(confirm('Are you sure ? You want to '+sts+' it.')){
			$.ajax({
			    type: 'POST',
			    dataType: 'json',
			    url: base_URL+'/'+'backoffice/pagesettings/updateFaqStatus',
			    data: {id:id,status:status},
			    async: false,
			    success: function(response){
			        toast(response);
			    }
			});
		// }
		e.stopImmediatePropagation();
		return false;
	})

});

function deleteFaq(id){
	if(confirm('Are you sure ?')){
		$.ajax({
		    type: 'POST',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/pagesettings/deleteFaq',
		    data: {id:id},
		    async: false,
		    success: function(response){
		    	$('.del'+id).closest('tr').remove();
		        toast(response);
		    }
		});
	}
}

function saveFaqPosition() {

	var data = new Array();

	$('.row_position tr').each(function () {
		data.push($(this).attr("id"));
	});

	$.ajax({
		url: base_URL+'/'+'backoffice/pagesettings/faqSorts',
		type: 'post',
		dataType: 'json',
		data: {position: data},
		success: function (response) {
			toast(response);
			document.getElementById("sort_save").disabled = true;
		},
		error: function (response) {
			toast(response);
		}
	})
}
/*
|--------------------------------------------------------------------------
| JS for offer
|--------------------------------------------------------------------------
|
| Author : Juman
| Version : 1.0.0
|
*/
function deleteOffer(id){
	if(confirm('Are you sure ?')){
		$.ajax({
		    type: 'DELETE',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/offer/'+id,
		    data: {id:id},
		    async: false,
		    success: function(response){
		    	if(response.status == 'success'){
		    		$('.del'+id).closest('tr').remove();
		    	}
		        toast(response);
		    }
		});
	}
}

function saveOfferPosition() {

	var data = new Array();

	$('.row_position tr').each(function () {
		data.push($(this).attr("id"));
	});

	$.ajax({
		url: base_URL+'backoffice/offer/sorts',
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
	
	$("#image").fileinput(img_fileinput_setting);

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

		$.ajax({
		    type: 'POST',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/offer/updateStatus',
		    data: {id:id,status:status},
		    async: false,
		    success: function(response){
		        toast(response);
		    }
		});
		e.stopImmediatePropagation();
		return false;
	})

	// $.validator.addMethod('filesize', function (value, element, param) {
	// 	console.log(element.files[0].size)
	//     return this.optional(element) || (element.files[0].size <= param)
	// }, 'Maximum 2MB');


	$( "#storeForm" ).validate({
		rules: {
			title:  {
				required: true,
			},
			startdate:  {
				required: true,
			},
			enddate:  {
				required: true,
			},
			start_time:  {
				required: true,
			},
			end_time:  {
				required: true,
			},
			display_banner:  {
				required: true,
			},
			customer_use:  {
				required: true,
			},
			free_shipping:  {
				required: true,
			},
			status:  {
				required: true,
			},
			description:  {
				required: true,
				maxlength:500,
			},
			// image:  {
			// 	extension: "jpg|jpeg|png|JPG|PNG|JPEG",
			// 	filesize: 2097152,  // 2 MB
			// },
		},

	});



});


/*
|--------------------------------------------------------------------------
| JS for gallery
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
	
	$("#image").fileinput(img_fileinput_setting);


	$.validator.addMethod('filesize', function (value, element, param) {
		console.log(element.files[0].size)
	    return this.optional(element) || (element.files[0].size <= param)
	}, 'Maximum 2MB');


	$( "#storeGalleryInfo" ).validate({

		rules: {
			image:  {
				required: true,
				extension: "jpg|jpeg|png|JPG|PNG|JPEG",
				filesize: 2097152,  // 2 MB
			},
			title:  {
				required: true,
			},
			status: {
				required: true, 
			}
		},

	});

	$( "#editGalleryInfo" ).validate({

		rules: {
			image:  {
				extension: "jpg|jpeg|png|JPG|PNG|JPEG",
				filesize: 2097152,  // 2 MB
			},
			title:  {
				required: true,
			},
			status: {
				required: true, 
			}
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

		$.ajax({
		    type: 'POST',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/GalleryController/updateGalleryStatus',
		    data: {id:id,status:status},
		    async: false,
		    success: function(response){
		        toast(response);
		    }
		});
		e.stopImmediatePropagation();
		return false;
	})

});


function deleteGallery(id){
	if(confirm('Are you sure ?')){
		$.ajax({
		    type: 'POST',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/GalleryController/deleteGallery',
		    data: {id:id},
		    async: false,
		    success: function(response){
		    	$('.del'+id).closest('tr').remove();
		        toast(response);
		    }
		});
	}
}

function saveGalleryPosition() {

	var data = new Array();

	$('.row_position tr').each(function () {
		data.push($(this).attr("id"));
	});

	$.ajax({
		url: base_URL+'/'+'backoffice/GalleryController/gallerySorts',
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
/*
|--------------------------------------------------------------------------
| JS for item
|--------------------------------------------------------------------------
|
| Author : Emon Ahmed
| Version : 1.0.0
|
*/
function deleteItem(id){
	if(confirm('Are you sure ?')){
		$.ajax({
		    type: 'DELETE',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/food/item/'+id,
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

function deleteSubVarianceItem(id){
	// alert(id)
	if(confirm('Are you sure ?')){
		$.ajax({
		    type: 'GET',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/food/itemSVdelete/'+id,
		    data: {id:id},
		    async: false,
		    success: function(response){
		    	if(response.status == 'success'){
		    		$('.delsb'+id).closest('tr').remove();
		    	}
		        toast(response);
		    }
		});
	}
}


function deleteVarianceItem(id){
	// alert(id)
	if(confirm('Are you sure ?')){
		$.ajax({
		    type: 'GET',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/food/itemVdelete/'+id,
		    data: {id:id},
		    async: false,
		    success: function(response){
		    	if(response.status == 'success'){
		    		$('.delv'+id).closest('tr').remove();
		    	}
		        toast(response);
		    }
		});
	}
}

function saveItemPosition() {

	var data = new Array();

	$('.row_position tr').each(function () {
		data.push($(this).attr("id"));
	});

	$.ajax({
		url: base_URL+'/'+'backoffice/food/itemSorts',
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

function saveItemVariancePosition() {

  var data = new Array();

  $('.row_position tr').each(function () {
    data.push($(this).attr("id"));
  });

  $.ajax({
    url: base_URL+'/'+'backoffice/food/itemVarianceSorts',
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


$(document).ready(function () {
	if(document.getElementById("sort_save2")){
		document.getElementById("sort_save2").disabled = true;
	}
});
$('row_position2').sortable();

$(".row_position2").sortable({
    delay: 150,
    change: function () {
        var selectedIds2 = new Array();
        $('.row_position2>tr').each(function () {
            selectedIds2.push($(this).attr("id"));
            document.getElementById("sort_save2").disabled = false;
        });
    }
});

function saveSubVariancePosition() {

	var data = new Array();

	$('.row_position2 tr').each(function () {
		data.push($(this).attr("id"));
	});

	$.ajax({
		url: base_URL+'/'+'backoffice/food/subItemSorts',
		type: 'post',
		dataType: 'json',
		data: {position: data},
		success: function (response) {
			toast(response);
			document.getElementById("sort_save2").disabled = true;
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
		    url: base_URL+'/'+'backoffice/food/updateItemStatus',
		    data: {id:id,status:status},
		    async: false,
		    success: function(response){
		        toast(response);
		    }
		});
		e.stopImmediatePropagation();
		return false;
	})

	$.validator.addMethod('filesize', function (value, element, param) {
		console.log(element.files[0].size)
	    return this.optional(element) || (element.files[0].size <= param)
	}, 'Maximum 2MB');


	$( "#storeForm" ).validate({
		rules: {
			item_name:  {
				required: true,
			},
			item_new_price:  {
				required: true,
				number: true,
			},
			item_cat_id:  {
				required: true,
				digits: true,
			},
			item_delivery_type:  {
				required: true,
			},
			item_variance:  {
				required: true,
			},
			item_sub_menu:  {
				required: true,
			},
			item_sp_request_sts:  {
				required: true,
			},
			item_offer_include:  {
				required: true,
			},
			item_spice_level:  {
				required: true,
			},
			status:  {
				required: true,
			},
			item_description:  {
				maxlength:500,
			},
			image:  {
				extension: "jpg|jpeg|png|JPG|PNG|JPEG",
				// filesize: 2097152,  // 2 MB
			}
		},

	});



});


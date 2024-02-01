/*
|--------------------------------------------------------------------------
| JS for category
|--------------------------------------------------------------------------
|
| Author : Juman
| Version : 1.0.0
|
*/

function deleteCategory(id){
	if(confirm('Are you sure ?')){
		$.ajax({
		    type: 'DELETE',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/food/category/'+id,
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

function saveCategoryPosition() {

	var data = new Array();

	$('.row_position tr').each(function () {
		data.push($(this).attr("id"));
	});

	$.ajax({
		url: base_URL+'/'+'backoffice/food/categorySorts',
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


    $(document).on( 'click', '.btn-modal', function(e){
    	e.preventDefault();
    	var container = $(this).data("container");

    	$.ajax({
			url: $(this).data("href"),
			dataType: "html",
			success: function(result){
				$(container).html(result).modal('show');
			}
		});
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
		    url: base_URL+'/'+'backoffice/food/updateCategoryStatus',
		    data: {id:id,status:status},
		    async: false,
		    success: function(response){
		        toast(response);
		    }
		});
		e.stopImmediatePropagation();
		return false;
	})


  	$(document).on('click', '.edit_category_button', function(){

	     $( "div.category_modal" ).load( $(this).data('href'), function(){

	        $(this).modal('show');

	     });

    });

});


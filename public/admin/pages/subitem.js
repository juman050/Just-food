/*
|--------------------------------------------------------------------------
| JS for subitem
|--------------------------------------------------------------------------
|
| Author : Emon Ahmed
| Version : 1.0.0
|
*/

tableLoad();

function tableLoad(){
	$.ajax({
		method: "GET",
		url: base_URL+'/'+'backoffice/food/subItemTableData',
		dataType: "html",
		success: function(result){
			$('.TableData').html(result);
		}
	});
}


function deleteSubItem(id){
	if(confirm('Are you sure ?')){
		$.ajax({
		    type: 'DELETE',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/food/subitem/'+id,
		    data: {id:id},
		    async: false,
		    success: function(response){
		    	tableLoad();
		    	toast(response);
		    }
		});
	}
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


	$(document).on('submit', 'form#subitem_add_form', function(e){
		e.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: $(this).attr("action"),
			dataType: "json",
			data: data,
		    success: function(response){
		    	if(response.status == 'success'){
			    	tableLoad();
		    		$('div.subitem_modal').modal('hide');
		    	}
		        toast(response);
		    }

		});
	});


});


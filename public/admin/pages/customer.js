/*
|--------------------------------------------------------------------------
| JS for customer
|--------------------------------------------------------------------------
|
| Author : Juman
| Version : 1.0.0
|
*/

function deleteCustomer(id){
	if(confirm('Are you sure ?')){
		$.ajax({
		    type: 'GET',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/customer/'+id,
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


jQuery(function($){


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
		    url: base_URL+'/'+'backoffice/updateCustomerStatus',
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


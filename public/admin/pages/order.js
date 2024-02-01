/*
|--------------------------------------------------------------------------
| JS for order
|--------------------------------------------------------------------------
|
| Author : Juman
| Version : 1.0.0
|
*/
function moveStatus(id,status){
	if(confirm('Are you sure ?')){
		$.ajax({
		    type: 'POST',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/orders/changeStatus',
		    data: {id:id,status:status},
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

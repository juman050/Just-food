/*
|--------------------------------------------------------------------------
| JS for contact
|--------------------------------------------------------------------------
|
| Author : Juman
| Version : 1.0.0
|
*/
jQuery(function($){


	$( "#replyForm" ).validate({
		rules: {
			name:  {
				required: true,
			},
			email:  {
				required: true,
			},
			subject:  {
				required: true,
			},
			message:  {
				required: true,
			},
		},
	    submitHandler: function(form) {
	        var data =  new FormData($('#replyForm')[0]);

	        $.ajax({
	          type: "POST",
	          url: $('#replyForm').attr("action"),
	          dataType: "json",
	          data: data,
	          contentType: false,
	          processData: false,
	          success: function(response){
	              
	              if(response.status == 'success'){
	                $('#replyForm')[0].reset();
					$('#replyModel').modal('hide');
	              }
	            
	              toast(response);

	            }

	        });
	    }

	});


});


function viewMessage(name,email,subject,message){

	$('#viewModal').modal('show');
	$('#viewModal').find('.name').html(name);
	$('#viewModal').find('.email').html(email);
	$('#viewModal').find('.subject').html(subject);
	$('#viewModal').find('.message').html(message);
	
}

function replyMessage(id,name,email,subject){

	$('#replyModel').modal('show');
	$('#replyModel').find('.id').val(id);
	$('#replyModel').find('.name').val(name);
	$('#replyModel').find('.email').val(email);
	$('#replyModel').find('.subject').val(subject);
	
}

function deleteMessage(id){
	if(confirm('Are you sure ?')){
		$.ajax({
		    type: 'GET',
		    dataType: 'json',
		    url: base_URL+'/'+'backoffice/contact/delete',
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

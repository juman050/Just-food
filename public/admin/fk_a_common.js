/*
|--------------------------------------------------------------------------
| All common JS for admin section
|--------------------------------------------------------------------------
|
| Author : Juman
| Version : 1.0.0
|
*/

$(document).ready(function () {
	if(document.getElementById("sort_save")){
		document.getElementById("sort_save").disabled = true;
	}
});

function toast(response){
	if(response.status=='success'){
		iziToast.success({
			title: response.status,
			message: response.message,
			position: 'topRight',
			timeout: 3000,
			transitionIn: 'fadeInDown',
			transitionOut: 'fadeOut',
			transitionInMobile: 'fadeInUp',
			transitionOutMobile: 'fadeOutDown',
		});
	}
	if(response.status=='error'){
		iziToast.error({
			title: response.status,
			message: response.message,
			position: 'topRight',
			timeout: 3000,
			transitionIn: 'fadeInDown',
			transitionOut: 'fadeOut',
			transitionInMobile: 'fadeInUp',
			transitionOutMobile: 'fadeOutDown',
		});
	}

}

jQuery(function($){

	$('#Table').DataTable({
		'paging'      : true,
    	'pageLength'  : 25,
		'lengthChange': true,
		'searching'   : true,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : false
	});

	$('.select2').select2();

	$( "#register-form" ).validate({
		rules: {
			name: 'required',
			username:  {
				required: true,
				minlength: 5
			},
			email: {
				required: true,
				email: true,           
			},
			password: {
				required: true,
				minlength: 6
			},
			number: {
				required: true,
				minlength: 10,
				maxlength: 12
			},
		},
		messages: {
			name: "Name Must be field!",   
			username:{
				required: "User Name Required!",
				minlength: "Minimum 4 Charracters!"
			},    
			email: {
				required:"User Email Required!",
				email: "Please Type Correct Email",
			},
			password: {
				required: "User Password Required!",
				minlength: "Minimum 6 Charracters!"
			},
			number: {
				required: "Phone Number Required!",
				minlength: "Minimum 10 Charracters!",
				maxlength: "Minimum 12 Charracters!"
			} 
		}

	});


    $('row_position').sortable();

    $(".row_position").sortable({
        delay: 150,
        change: function () {
            var selectedIds = new Array();
            $('.row_position>tr').each(function () {
                selectedIds.push($(this).attr("id"));
                document.getElementById("sort_save").disabled = false;
            });
        }
    });

});


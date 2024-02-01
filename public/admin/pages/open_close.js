/*
|--------------------------------------------------------------------------
| JS for restaurant open close
|--------------------------------------------------------------------------
|
| Author : Emon Ahmed
| Version : 1.0.0
|
*/
jQuery(function($){


	$( "#openCloseForm" ).validate({
		rules: {
			openingTime:  {
				required: true,
				minlength: 6,
			},
			closingTime:  {
				required: true,
				minlength: 6,
			},
		},

	});


	$('.switch__input').change(function(e){
		e.preventDefault();
		if($(this).is(':checked')){
			var sts = 'Open';
			var status = 'open';
		}else{
			var sts = 'Close';
			var status = 'close';
		}

		var id = $(this).data('id');

		// if(confirm('Are you sure ? You want to '+sts+' it.')){
			$.ajax({
			    type: 'POST',
			    dataType: 'json',
			    url: base_URL+'/'+'backoffice/otherSettings/updateOpenCloseStatus',
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

	$('.openingTime').inputmask({ mask: "99:99:99", clearIncomplete: true });
	$('.closingTime').inputmask({ mask: "99:99:99", clearIncomplete: true });

});


function editOpenCloseTime(id,openingTime,closingTime,day){

	$('#openCloseModal').modal('show');
	$('#openCloseModal').find('#day').html(day);
	$('#openCloseForm').find('.id').val(id);
	$('#openCloseForm').find('.openingTime').val(openingTime);
	$('#openCloseForm').find('.closingTime').val(closingTime);
	
}

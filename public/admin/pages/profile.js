/*
|--------------------------------------------------------------------------
| JS for profile
|--------------------------------------------------------------------------
|
| Author : Juman
| Version : 1.0.0
|
*/

tableLoad();

function tableLoad(){
  $.ajax({
    method: "GET",
    url: base_URL+'/'+'backoffice/dashboard/tableData',
    dataType: "html",
    success: function(result){
      $('.TableData').html(result);
    }
  });
}


function deleteUser(id){
  if(confirm('Are you sure ?')){
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: base_URL+'/'+'backoffice/dashboard/userDelete/'+id,
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

  $( "#changePasswordForm" ).validate({
  
    rules: {
      old_password:  {
        required: true,
      },
      new_password:  {
        required: true,
        minlength:6,
      },
      confirm_password:  {
        required: true,
        minlength:6,
        equalTo: '#new_password',
      },
    },
    submitHandler: function(form) {
        var data =  new FormData($('#changePasswordForm')[0]);

        $.ajax({
          type: "POST",
          url: $('#changePasswordForm').attr("action"),
          dataType: "json",
          data: data,
          contentType: false,
          processData: false,
          success: function(response){
              
              if(response.status == 'success'){
                $('#changePasswordForm')[0].reset();
              }
            
              toast(response);

            }

        });
    }

  });


  $( "#registerUser" ).validate({

    rules: {
      name:  {
        required: true,
      },
      email:  {
        required: true,
        email: true,
      },
      role:  {
        required: true,
      },
      active:  {
        required: true,
      },
      password:  {
        required: true,
        minlength:6,
      },
      add_confirm_password:  {
        required: true,
        minlength:6,
        equalTo: '#password',
      },
    },
    submitHandler: function(form) {
        var data =  new FormData($('#registerUser')[0]);

        $.ajax({
          type: "POST",
          url: $('#registerUser').attr("action"),
          dataType: "json",
          data: data,
          contentType: false,
          processData: false,
          success: function(response){
              
              if(response.status == 'success'){
                $('#registerUser')[0].reset();
              }
            
              toast(response);
              tableLoad();

            }

        });
    }

  });

});


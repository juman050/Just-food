Use of jquery validate:

	1.Link it:

			<script src="<?php echo site_url().$options['public_resource']?>js/jquery.validate.min.js"></script>

	2.Html:

		<div class="container">
		    <div class="register">
		        <h3>&nbsp;&nbsp;&nbsp;Register Here :</h3>
		        <br>
		        <br>
		        <form action="" method="" id="register-form">

		            <div class="form-group col-md-8">
		                <label class="control-label" for="name">Name<span> *</span></label>
		                <input type="text" class="form-control" id="name" name="name">
		            </div>

		            <div class="form-group col-md-8">
		                <label class="control-label" for="username">Username<span> *</span></label>
		                <input type="text" class="form-control" id="username" name="username" required="required">
		            </div>

		            <div class="form-group col-md-8">
		                <label class="control-label" for="email">Email<span> *</span></label>
		                <div class="input-group">
		                    <span class="input-group-addon">@</span>
		                    <input type="email" class="form-control" id="email" name="email" required="required">
		                </div>
		            </div>

		            <div class="form-group col-md-8">
		                <label class="control-label" for="password">Password<span> *</span></label>
		                <input type="password" class="form-control" id="password" name="password" required="required">
		            </div>

		            <div class="form-group col-md-8">
		                <label class="control-label" for="confirm_password">Confirm Password<span> *</span></label>
		                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required="required">
		            </div>

		            <div class="form-group col-md-8">
		                <label class="control-label" for="number">Phone Number<span> *</span></label>
		                <input type="text" class="form-control" id="number" name="number" required="required">
		            </div>

		            <div class="form-group col-md-8">
		                <label class="control-label" for="delivery_address">Delivery Address</label>
		                <textarea rows="10" class="form-control" id="delivery_address" name="delivery_address"></textarea>
		            </div>

		            <div class="form-group col-md-8">
		                <label class="control-label" for="submit"></label>
		                <div class="input-group">
		                    <button type="submit" id="submit" class="btn btn-danger">Submit</button>
		                </div>
		            </div>


		        </form>
		    </div>

	3.js file:

		<script type="text/javascript">
		  jQuery(function($){
		    var response;
		    $.validator.addMethod(
		        "uniqueUserName", 
		        function(value, element) {
		            $.ajax({
		                type: "POST",
		                url: sitUrl+"public/user/checkUserName",
		                data: {
		                  checkUsername : value
		                },
		                dataType:"html",
		                success: function(msg)
		                {
		                    //If username exists, set response to true
		                    response = ( msg == 'true' ) ? true : false;
		                }
		             });
		            return response;
		        },
		        "Username is Already Taken"
		    );

		    var response_email;
		    $.validator.addMethod(
		        "uniqueUserEmail", 
		        function(value, element) {
		            $.ajax({
		                type: "POST",
		                url: sitUrl+"public/user/checkUserEmail",
		                data: {
		                  checkUserEmail : value
		                },
		                dataType:"html",
		                success: function(msg)
		                {
		                    //If username exists, set response to true
		                    response_email = ( msg == 'true' ) ? true : false;
		                }
		             });
		            return response_email;
		        },
		        "Email is Already Taken"
		    );

		      $( "#register-form" ).validate({
		        rules: {
		            name: 'required',
		            username:  {
		                 required: true,
		                 uniqueUserName: true,
		                 minlength: 5
		               },
		            email: {
		                 required: true,
		                 email: true,
		                 uniqueUserEmail: true               
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
		                uniqueUserName: "This Username is taken already",
		                minlength: "Minimum 4 Charracters!"

		              },    
		           email: {
		            required:"User Email Required!",
		            email: "Please Type Correct Email",
		            uniqueUserEmail: "This Email is taken already"

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
				});
		</script>


	4.Controller:

		function checkUserName(){
			$postedData =$this->input->post(NULL, true);
			$userName=$postedData['checkUsername'];
			$checkUsername=$this->mod_user->checkUsername($userName);
			if($checkUsername){
				echo 'false';
			}else{
				echo 'true';
			}
			return false;
		}

	5. Model :

		public function checkUsername($userName=""){
          $where = array(
            'username' => $userName, 
            'deleted' => 0
            );
          $result=$this->db->get_where('customer_username',$where);
           
           if ($result->num_rows()) {
               return $result->result_array();
           } else{
              return false;
           }
           
           
       }
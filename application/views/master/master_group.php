<p class="message" style="padding:15px 15px; display:none;"></p>
<form id="theForm"method="post" action="<?php echo base_url()?>master/ajax/create_group">
  <div class="form-group">
    <label>Group Name</label>
    <input type="text" class="form-control" name="group_name" maxlength="100" required>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Customer Country</label>
    <input type="text" class="form-control"  name="customer_country" maxlength="100">
  </div>

   <div class="form-group">
    <label for="exampleInputPassword1">Payment Date</label>
      	<input type="text" class="form-control" name="payment_date" id="dp1">
  
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Bussines Type</label>
    <input type="text" class="form-control"  name="bussines_type" maxlength="100">
  </div>

  <input type="submit" class="btn btn-success" value="add group" name="btn_add_group">
 
</form>




<script>

     $('#dp1').datepicker({
				format: 'dd-mm-yyyy'
			});

	
	$("#theForm").ajaxForm(
		{
			   dataType: 'json',       
		 	   success: function(data){    
				 	   	if(data.status == true) {    
				 	   	 	   $('.message').html(data.message).removeClass('alert alert-danger').addClass('alert alert-success').fadeIn(); 
				 	   	 	    setTimeout(function(){   
				 	   		 		 $('.message').fadeOut();
				 	   		 		 $('#theForm').trigger("reset");           
				 	   		 	},800);            

				 	   	} else{
				 	   			$('.message').html(data.message).addClass('alert alert-success').removeClass('alert alert-danger').fadeIn(); 
				 	   		  setTimeout(function(){   
				 	   		 		 $('.message').fadeOut();
				 	   		 	},800);            
				 	   	} 
		 	   	}          
		});

</script>
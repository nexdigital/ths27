<form method="post" id="add_role_form" action="<?php echo base_url('master/add_user_role/add_role') ?>">
		<div class="form-group">
		  <label>Type User <label class="required-filed">*</label></label>
		  <input type="text" class="form-control" id="type" name="type" required>
		</div>

		  <label>Role <label class="required-filed">*</label></label>
		
		  <?php 

		  $no = 1;
		  foreach ($this->master_user->get_role() as $key => $value) {
		  			
		  		echo ' <div class="form-group">

		  					  <input type="checkbox" name="role[]" value="'.$no++.'"> '.$value->access.'&nbsp;

		  				</div>
		  		';


		  } ?>
	


<div class="form-group">
		<label>Description <label class="required-filed"></label></label>
  		<textarea class="form-control" name="description" id="description"></textarea>
</div>

<div class="form-group">
  <input type="checkbox" name="status_active"> Active
</div>

		<label id="role[]-error" class="error" for="role[]" style="display: inline-block;"></label><br/>
		<input type="submit" class="btn btn-primary" value="Add Role" onclick="add_role();">
		<button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/add_user_role/index')">Cancel</button>
		<label id="alert-message" class="alert alert-success" style="display:none;padding-top: 5px;padding-bottom: 8px;"></label>
</form>



<script type="text/javascript">
$(document).ready(function(){
	 	$('form#add_role_form').validate({
	 			 rules: {
		            		'role[]': {
					                required: true,
					          
		            				}
        				},
		        messages: {
		           			 'role[]': {
					                required: "You must check at least 1 box",
					                maxlength: "Check no more than {0} boxes"
		            		}
        		}



	 	});
 	

});


function add_role(){


	$('form#add_role_form').ajaxForm({
				dataType:'json',
				success: function(data){
					
						
						$("#alert-message").html(data.message).fadeIn();
						  setTimeout(function(){
                			 		$('#alert-message').html(data.message).fadeOut();
                 					setPage('<?php echo base_url() ?>master/add_user_role/index') ;
              				},800);
							 
				
				}
			});
}




</script>
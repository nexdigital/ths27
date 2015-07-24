<form method="post" id="delete_role_form" action="<?php echo base_url('master/add_user_role/delete_role') ?>">
		<div class="form-group">

			<input type="hidden" name="id_type" value = "<?php echo $get_role->id_type ?>">
		  <label>Type User <label class="required-filed">*</label></label>
		  <input type="text" class="form-control" id="type" name="type"  value = "<?php echo $get_role->type ?>" disabled>
		</div>

		  <label>Role <label class="required-filed">*</label></label>
		
		  <?php  /*foreach ($get_checked as $key => $value) {
		  		
		  		echo ' <div class="form-group">

		 					<input type="checkbox" name="role[]" value="1"> '.$value->access.' &nbsp;
		 
						</div>';
		  }

		  		*/

		  	foreach ($this->master_user->get_role() as $key => $value) {
		  		  
		  		  $checked = "";
		  		foreach ($get_checked as $key => $row) {
		  		
		  			if($value->id == $row->access_level ){

		  				$checked .= 'checked';
							
		  			}else
		  			{	
		  				$checked .= '';
		  				//echo '<div class="form-group"><input type="checkbox" checked name="role[]"  value="'.$value->id.'"> '.$value->access.'&nbsp;</div>';
		  			}

		  				
		  	}
		  			
		  	
		  		echo '<div class="form-group"><input type="checkbox" '.$checked .' name="role[]" value="'.$value->id.'" disabled> '.$value->access.'&nbsp;</div>';	

		  } ?>


	<div class="form-group">
		<label>Description <label class="required-filed"></label></label>
  		<textarea class="form-control" name="description" id="description" disabled><?php echo $get_role->description ?></textarea>
	</div>

	<div class="form-group">
    		<input type="checkbox" name="status_active" disabled id="status_active" <?php echo ($get_role->status == 'active') ? 'checked="checked"' : ''?>> <label for="is_active">Active</label>
	</div>


	

		<label id="role[]-error" class="error" for="role[]" style="display: inline-block;"></label><br/>
		
		<input type="submit" class="btn btn-success" onclick="delete_role();" value="Yes">
		<button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url("master/add_user_role/edit_form/".$get_role->id_type)?>')">Cancel</button>
		<label id="alert-message" class="alert alert-success" style="display:none;padding-top: 5px;padding-bottom: 8px;"></label>
</form>



<script type="text/javascript">
$(document).ready(function(){
	 	$('form#delete_role_form').validate({
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


function delete_role(){


	$('form#delete_role_form').ajaxForm({
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
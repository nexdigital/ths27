<form method="post" id="edit_role_form" action="<?php echo base_url('master/add_user_role/edit_role') ?>">

		<div class="form-group">
		
		  <label>ID Type <label class="required-filed">*</label></label>
		  <input type="text" name="id_type" class="form-control" value = "<?php echo $get_role->id_type ?>" readonly>
		</div>

		<div class="form-group">

		 <!-- <input type="hidden" name="id_type" value = "<?php echo $get_role->id_type ?>"> -->
		  <label>Type User <label class="required-filed">*</label></label>
		  <input type="text" class="form-control" id="type" name="type" value = "<?php echo $get_role->type ?>">
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
		  			
		  	
		  		echo '<div class="form-group"><input type="checkbox" '.$checked .' name="role[]" value="'.$value->id.'"> '.$value->access.'&nbsp;</div>';	

		  } ?>


	<div class="form-group">
		<label>Description <label class="required-filed"></label></label>
  		<textarea class="form-control" name="description" id="description"><?php echo $get_role->description ?></textarea>
	</div>

	<div class="form-group">
    		<input type="checkbox" name="status_active" id="status_active" <?php echo ($get_role->status == 'active') ? 'checked="checked"' : ''?>> <label for="is_active">Active</label>
	</div>


	

		<label id="role[]-error" class="error" for="role[]" style="display: inline-block;"></label><br/>
		<input type="reset" class="btn btn-success" value="Create New" onclick="add_role();">
		<input type="submit" class="btn btn-success" value="Update" onclick="edit_role();">
		<button type="reset" class="btn btn-success btn-submit"  onClick="setPage('<?php echo base_url('master/add_user_role/delete_form/'.$get_role->id_type)?>')">Delete</button>

		<button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/add_user_role/index')">Cancel</button>
		<label id="alert-message" class="alert alert-success" style="display:none;padding-top: 5px;padding-bottom: 8px;"></label>
</form>



<script type="text/javascript">
$(document).ready(function(){
	 	$('form#edit_role_form').validate({
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

	setPage('<?php echo base_url() ?>master/add_user_role/add_form') ;
}


function edit_role(){


	$('form#edit_role_form').ajaxForm({
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
<form method="post" id="add_role_form" action="<?php echo base_url('master/add_user_role/add_role') ?>">

		<!-- <div class="form-group">
		  <label>ID Type <label class="required-filed">*</label></label>
		  <input type="text" class="form-control" id="id_type" name="id_type" maxlength="30" required>
		</div>
 -->

		<div class="form-group">
		  <label>Type User <label class="required-filed">*</label></label>
		  <input type="text" class="form-control" id="type" name="type" required>
		</div>

		  <label>Role <label class="required-filed">*</label></label>
		  <div class="form-group">
	     		 <input type="checkbox" onClick="toggle(this)" /> Select All<br/>
	 	 </div>
	 	 <hr/>
		  <?php 

		  $no = 1;
		  foreach ($this->master_user->get_role() as $key => $value) {
		  			
		  		echo '<div class="col-md-4"> <div class="form-group">

		  					  <label><input type="checkbox" id="role" name="role[]" value="'.$value->id.'"> '.$value->access.'</label>&nbsp;

		  				</div></div>
		  		';


		  } ?>
		  <label id="role[]-error" class="error" for="role[]" style="display: inline-block;"></label><br/>


<div class="form-group">
		<label>Description <label class="required-filed"></label></label>
  		<textarea class="form-control" name="description" id="description"></textarea>
</div>

<div class="form-group">
  <input type="checkbox" name="status_active"> Active
</div>

		
		<input type="submit" class="btn btn-success" value="Add Role" onclick="add_role();">
		<button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/add_user_role/index')">Cancel</button>
		<label id="alert-message" style="display:none;padding-top: 5px;padding-bottom: 8px;"></label>
</form>



<script type="text/javascript">

function toggle(source) {
    checkboxes = document.getElementsByName('role[]');
	  for(var i=0, n=checkboxes.length;i<n;i++) {
	    checkboxes[i].checked = source.checked;
	  }
}


$(document).ready(function(){

	$('input[name="id_type"]').autoComplete({
			    minChars: 1,
			    source: function(term, response){
			        try { xhr.abort(); } catch(e){}
			        xhr = $.getJSON('<?php echo base_url('master/add_user_role/autoComplete') ?>', { q: term }, function(data){ response(data); });
			    },
			    onSelect: function(e, term, item){
			      setPage('<?php echo base_url('master/add_user_role/edit_form')?>/' + term);
			    }
  		});


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
					
					if(data.status == false){

							 $('#alert-message').html(data.message).addClass('alert-danger').removeClass('alert-success').fadeIn();
							 setTimeout(function(){
                			 		$('#alert-message').html(data.message).fadeOut();
              				},800);
					}

					  else if(data.status == true){	
						//$("#alert-message").html(data.message).fadeIn();
						
						 $('#alert-message').html(data.message).addClass('alert-success').removeClass('alert-danger').fadeIn();
						  setTimeout(function(){
                			 		$('#alert-message').html(data.message).fadeOut();
                 					setPage('<?php echo base_url() ?>master/add_user_role/index') ;
              				},800);
						}	 
				
				}
			});
}




</script>
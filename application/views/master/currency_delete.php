<form id="form_currency" method="post" action="<?php  echo base_url()?>master/ajax/currency/delete">
	<input type="hidden" name="exchange_rate_id" value="<?php echo $data->exchange_rate_id ?>">
	<div class="form-group">
		<label>Currency Name <label class="required-filed">*</label></label>
		<input type="text" class="form-control" name="exchange_rate_name" value="<?php echo $data->exchange_rate_name ?>" readonly>
	</div>

	<div class="form-group">
		<label>Rate<label class="required-filed">*</label></label>
		<input type="text" class="form-control" name="exchange_rate_value" value="<?php echo $data->exchange_rate_value ?>" readonly>
	</div>

	<div class="form-group">
	
		 <button type="submit" class="btn btn-success btn-submit" data-loading-text="Process...">Yes</button>
		  <button type="reset" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/view/currency/edit/<?php echo $data->exchange_rate_id ?>')">Cancel</button>
		  <label class="alert-form"></label>
	</div>
</div>
</form>	

<script type="text/javascript">
		$(document).ready(function(){

				$('form#form_currency').ajaxForm({
				dataType:'json',
				success: function(result){
						if(result.status == "success"){

							  $('.alert-form').html('<div id="message_form"  class="alert alert-form alert-success" role="alert">'+result.message+'</div>');
							    $('form#form_country').resetForm();
							 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
							 	 setTimeout(function(){ 
							 	 	setPage('<?php echo base_url() ?>master/view/currency/index') 
							 	 }, 800); 
							},800);
						}else{
							  $('.alert-form').html('<div id="message_form"  class="alert alert-form alert-danger" role="alert">'+result.message+'</div>');
							  	 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
								  setTimeout(function(){ setPage('<?php echo base_url() ?>master/view/currency/index') }, 800); 
							},800);
						}
						 
				
				}
			});
	});	
</script>
<form id="form_country" method="post" action="<?php echo base_url()?>master/ajax/country/add">
<div class="form-group">
	<label>Country ID<label class="required-filed">*</label></label>
		<input type="text" class="form-control" id="country_id" name="country_id" value="" required>
</div>

<div class="form-group">
	<label>Country Name<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="country_name" name="country_name" required>
</div>

<div class="form-group">
	<label>Currency Symbol<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="curency_simbol" name="currency_symbol" required >
</div>

<div class="form-group">
	<label>Currency Name<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="currency_name" name="currency_name" required >
</div>

<div class="form-group">
	<label>Description</label>
	<textarea class="form-control" name="description"></textarea>
</div>

<div class="form-group">
	<input type="checkbox" name="is_active" value="active"> Active
</div>

<button type="submit" class="btn btn-success submit" data-loading-text="Saving...">Submit</button>
<button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('master/view/country/index')?>')">Cancel</button>
<label class="alert-form" ></label>
</form>
<script type="text/javascript">
	$(document).ready(function(){

		
		$('form#form_country').validate({
			rules: { country_name: { required: true, remote: "<?php echo base_url(); ?>master/ajax/country/check_available_country" } },
			messages: { country_name: { remote: 'Country has been added' } }			
		});

			$('form#form_country').ajaxForm({
				dataType:'json',
				success: function(result){
						if(result.status == true){
 
							$('.alert-form').html(result.message).addClass('alert-success').removeClass('alert-danger').fadeIn();
							    $('form#form_country').resetForm();
							 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
							 	 setPage('<?php echo base_url() ?>master/view/country/index');
							},800);
						}else {
							 $('.alert-form').html(result.message).addClass('alert-danger').removeClass('alert-success').fadeIn();
							  	 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
							},800);
						}
						 
				
				}
			});

	/*	$('form#form_country').ajaxForm({
			dataType:'json',
			success:function(data){			
				$('#message_form').remove();
				if(data.status == "success"){
					$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-success" role="alert">'+data.message+'</div>');
					$('form#form_country').resetForm();
				} else if(data.status == "warning") {
					$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-warning" role="alert">'+data.message+'</div>');				
				}
				$('#message_form').fadeIn('slow');
				$('button.submit').button('reset');
				setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
			},
			error:function(data){
				$('#message_form').remove();
				$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-danger" role="alert">Server Error!</div>');
				$('#message_form').fadeIn('slow');
				$('button.submit').button('reset');
				$('form#form_country').resetForm();
				setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
			},
			beforeSubmit:function(){
				$('button.submit-upload').button('loading');
			}
		}); */
	})	
</script>
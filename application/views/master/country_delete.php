<div class="toolbar">
  <label>Are you sure want delete this record?</table>
</div>
<form id="form_country" method="post" action="<?php echo base_url('master/ajax/country/delete/'.$get_country->country_id)?>">
<div class="form-group">
	<label>Country ID<label class="required-filed">*</label></label>
		<input type="text" class="form-control" id="country_id" name="country_id" value="<?php echo $get_country->country_id ?>" readonly >
</div>

<div class="form-group">
	<label>Country Name<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="country_name" name="country_name" value="<?php echo $get_country->country_name ?>"  readonly>
</div>

<div class="form-group">
	<label>Currency Symbol<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="curency_simbol" name="currency_symbol" value="<?php echo $get_country->currency_symbol ?>"  readonly >
</div>

<div class="form-group">
	<label>Currency Name<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="currency_name" name="currency_name" value="<?php echo $get_country->currency_name ?>" readonly >
</div>

<div class="form-group">
	<label>Description</label>
	<textarea class="form-control" name="description" readonly><?php echo $get_country->description ?></textarea>
</div>

<div class="form-group">
	      <input type="checkbox" name="is_active" id="is_active" <?php echo ($get_country->is_active == 'active') ? 'checked="checked"' : ''?>> <label for="is_active">Active</label>
</div>


  <button type="submit" class="btn btn-success btn-submit" data-loading-text="Process...">Yes</button>
  <button type="reset" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/country/edit/<?php echo $get_country->country_id ?>')">Cancel</button>
  <label class="alert-form"></label>
</form>
<script type="text/javascript">
	$(document).ready(function(){

				$('form#form_country').ajaxForm({
				dataType:'json',
				success: function(result){
						if(result.status == true){

							  $('.alert-form').html('<div id="message_form"  class="alert alert-form alert-success" role="alert">'+result.message+'</div>');
							    $('form#form_country').resetForm();
							 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
							 	 setTimeout(function(){ setPage('<?php echo base_url() ?>master/view/country/index') }, 800); 
							},3000);
						}else if(result.status == false){
							  $('.alert-form').html('<div id="message_form"  class="alert alert-form alert-danger" role="alert">'+result.message+'</div>');
							  	 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
								  setTimeout(function(){ setPage('<?php echo base_url() ?>master/view/country/index') }, 600); 
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
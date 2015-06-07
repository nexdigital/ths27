<form id="partner_form" method="post" action="<?php echo base_url()?>master/ajax/partner/partner_add">
<div class="form-group">
	<label>Partner ID<label class="required-filed">*</label></label>
		<input type="text" class="form-control" id="partner_id" name="partner_id" minlength="1"  required>
</div>

<div class="form-group">
	<label>Patner Name<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="partner_name" name="partner_name" required>
</div>


<div class="form-group">
	<label>Telephone Number<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="telephone" name="telephone" required>
</div>

<div class="form-group">
	<label>Email<label class="required-filed">*</label></label>
	<input type="email" class="form-control" id="email" name="email" required>
</div>

<div class="form-group">
	<label>Address<label class="required-filed">*</label></label>
	<textarea class="form-control" name="address" id="address" required></textarea>
</div>

<div class="form-group">
	<label>City<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="city" name="city" required>
</div>

<div class="form-group">
	<label>Country</label>
	<select class="form-control" name="country" id="country">
		<?php foreach ($this->tool_model->list_country() as $key => $value) {
			echo '<option value="'.$value->country_id.'">'.$value->country_name.'</option>';	
		} ?>
		
	</select>
</div>
<div class="form-group">
	<label>Zip Code</label>
	<input type="text" class="form-control" id="zipcode" name="zipcode">
</div>

<div class="form-group">
	<label>Description</label>
	<textarea class="form-control" name="description"></textarea>
</div>

<div class="form-group">
	<input type="checkbox" name="is_active" value="active"> Active
</div>

<button type="submit" class="btn btn-success submit" data-loading-text="Saving...">Submit</button>
<button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('master/partner/index')?>')">Cancel</button>
<label class="alert-form" ></label>
</form>
<script type="text/javascript">
	$(document).ready(function(){

		 $('input[name="partner_id"]').autoComplete({
			    minChars: 1,
			    source: function(term, response){
			        try { xhr.abort(); } catch(e){}
			        xhr = $.getJSON('<?php echo base_url('master/ajax/partner/autoComplete') ?>', { q: term }, function(data){ response(data); });
			    },
			    onSelect: function(e, term, item){
			      setPage('<?php echo base_url('master/partner/edit')?>/' + term);
			    }
  		});
		
		$('form#partner_form').validate({
			rules: { partner_name: { required: true, remote: "<?php echo base_url(); ?>master/ajax/partner/check_available_partner" } },
			messages: { partner_name: { remote: 'Partner has been added' } }			
		});

			$('form#partner_form').ajaxForm({
				dataType:'json',
				success: function(result){
						if(result.status == true){
 
							$('.alert-form').html(result.message).addClass('alert-success').removeClass('alert-danger').fadeIn();
							    $('form#partner_form').resetForm();
							 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
							 	 setPage('<?php echo base_url() ?>master/partner/index');
							},800);
						}else {
							 $('.alert-form').html(result.message).addClass('alert-danger').removeClass('alert-success').fadeIn();
							  	 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
							},800);
						}
						 
				
				}
			});
	})	
</script>
<form id="partner_form" method="post" action="<?php echo base_url()?>master/ajax/partner/edit">

	
<div class="form-group">
	<label>Patner ID<label class="required-filed">*</label></label>
		<input type="text" class="form-control" id="partner_id" name="partner_id" minlength="1"  value="<?php echo $get_partner->partner_id ?>" readonly>
</div>

<div class="form-group">
	<label>Patner Name<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="partner_name" name="partner_name" value="<?php echo $get_partner->company_name ?>" required>
</div>


<div class="form-group">
	<label>Telephone Number<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $get_partner->telephone_number ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
</div>

<div class="form-group">
	<label>First Email<label class="required-filed">*</label></label>
	<input type="email" class="form-control" id="email" name="email" value="<?php echo $get_partner->email ?>" required>
</div>

<div class="form-group">
	<label>Second Email</label>
	<input type="email" class="form-control" id="second_email" name="second_email" value="<?php echo $get_partner->second_email ?>" >
</div>

<div class="form-group">
	<label>Third Email</label>
	<input type="email" class="form-control" id="third_email" name="third_email" value="<?php echo $get_partner->third_email ?>" >
</div>

<div class="form-group">
	<label>Fourth Email</label>
	<input type="email" class="form-control" id="fourth_email" name="fourth_email" value="<?php echo $get_partner->fourth_email ?>" >
</div>

<div class="form-group">
	<label>Address<label class="required-filed">*</label></label>
	<textarea class="form-control" name="address" id="address" required><?php echo $get_partner->address ?></textarea>
</div>

<div class="form-group">
	<label>City<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="city" name="city" value="<?php echo $get_partner->city ?>"  required>
</div>

<div class="form-group">
	<label>Country</label><label class="required-filed">*</label></label>
	<select class="form-control" name="country" id="country" required>
		<option value="">-</option>
		<?php foreach ($this->tool_model->list_country() as $key => $value) {
			echo '<option value="'.$value->country_id.'">'.$value->country_name.'</option>';	
		} ?>
		
	</select>
</div>
<div class="form-group">
	<label>Zip Code</label>
	<input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php echo $get_partner->zipcode ?>" >
</div>

<div class="form-group">
	<label>Description</label>
		<textarea class="form-control" name="description" id="description"><?php echo $get_partner->description ?></textarea>
</div>

<div class="form-group">
    <input type="checkbox" name="is_active" id="is_active" <?php echo ($get_partner->is_active == 'active') ? 'checked="checked"' : ''?>> <label for="is_active">Active</label>
</div>

<button type="reset" class="btn btn-success btn-submit"  onclick="setPage('<?php echo base_url() ?>master/partner/add')">Create New</button>
<button type="submit" class="btn btn-success btn-update" data-loading-text="Process...">Update</button>
<button type="reset" class="btn btn-success btn-submit"  onclick="setPage('<?php echo base_url() ?>master/partner/delete/<?php echo $get_partner->partner_id ?>')">Delete</button>
<button type="reset" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/partner/index')">Cancel</button>
<label class="alert-form" ></label>
</form>
<script type="text/javascript">
	$(document).ready(function(){

		var val_country = "<?php echo $get_partner->country_id?>";
		$("#country").val(val_country);



		 $('input[name="country_id"]').autoComplete({
			    minChars: 1,
			    source: function(term, response){
			        try { xhr.abort(); } catch(e){}
			        xhr = $.getJSON('<?php echo base_url('master/ajax/country/autoComplete') ?>', { q: term }, function(data){ response(data); });
			    },
			    onSelect: function(e, term, item){
			      setPage('<?php echo base_url('master/country/edit')?>/' + term);
			    }
  		});
		
		// $('form#partner_form').validate({
		// 	rules: { partner_name: {	required: true, remote: "<?php echo base_url(); ?>master/ajax/partner/check_available_partner"  } },
		// 	messages: { partner_name: { remote: 'Partner has been added' } }			
		// });

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
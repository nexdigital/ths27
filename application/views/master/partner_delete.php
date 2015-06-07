<form id="partner_form" method="post" action="<?php echo base_url('master/ajax/partner/delete_partner/'.$get_partner->partner_id )?>">
<div class="form-group">
	<label>Partner ID<label class="required-filed">*</label></label>
		<input type="text" class="form-control" id="partner_id" name="partner_id" minlength="1"  value="<?php echo $get_partner->partner_id ?>" readonly>
</div>

<div class="form-group">
	<label>Patner Name<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="partner_name" name="partner_name" value="<?php echo $get_partner->company_name ?>" readonly>
</div>


<div class="form-group">
	<label>Telephone Number<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $get_partner->telephone_number ?>"  readonly>
</div>

<div class="form-group">
	<label>Email<label class="required-filed">*</label></label>
	<input type="email" class="form-control" id="email" name="email" value="<?php echo $get_partner->email ?>"  readonly>
</div>

<div class="form-group">
	<label>Address<label class="required-filed">*</label></label>
	<textarea class="form-control" name="address" id="address" readonly><?php echo $get_partner->address ?></textarea>
</div>

<div class="form-group">
	<label>City<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="city" name="city" value="<?php echo $get_partner->city ?>"  readonly>
</div>

<div class="form-group">
	<label>Country<label class="required-filed">*</label></label>
	<select class="form-control" name="country" id="country" readonly>
		<?php foreach ($this->tool_model->list_country() as $key => $value) {
			echo '<option value="'.$value->country_id.'">'.$value->country_name.'</option>';	
		} ?>
		
	</select>
</div>
<div class="form-group">
	<label>Zip Code</label>
	<input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php echo $get_partner->zipcode ?>"readonly>
</div>

<div class="form-group">
	<label>Description</label>
		<textarea class="form-control" name="description" id="description" readonly><?php echo $get_partner->description ?></textarea>
</div>

<div class="form-group">
    <input type="checkbox" name="is_active" id="is_active" <?php echo ($get_partner->is_active == 'active') ? 'checked="checked"' : ''?>> <label for="is_active">Active</label>
</div>

 <button type="submit" class="btn btn-success btn-submit" data-loading-text="Process...">Yes</button>
<button type="reset" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/partner/edit/<?php echo $get_partner->partner_id ?>')">Cancel</button>
<label class="alert-form"></label>
</form>

<script type="text/javascript">
	$(document).ready(function(){

				$('form#partner_form').ajaxForm({
				dataType:'json',
				success: function(result){
						if(result.status == true){

							  $('.alert-form').html('<div id="message_form"  class="alert alert-form alert-success" role="alert">'+result.message+'</div>');
							    $('form#partner_form').resetForm();
							 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
							 	 setPage('<?php echo base_url() ?>master/partner/index'); 
							},800);
						}else if(result.status == false){
							  $('.alert-form').html('<div id="message_form"  class="alert alert-form alert-danger" role="alert">'+result.message+'</div>');
							  	 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
								   setPage('<?php echo base_url() ?>master/partner/index'); 
							},800);
						}
						 
				
				}
			});
	
	})	
</script>
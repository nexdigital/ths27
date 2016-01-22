<div class="toolbar">
	<div class="btn-group" role="group">
	  <button type="button" class="btn btn-default" onCLick="setPage('<?php echo base_url('master/bank/index_bank_branch') ?>')"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></button>
	  <button type="button" class="btn btn-default" onCLick="setPage('<?php echo base_url('master/bank/edit_bank_branch/'.$data->bank_id) ?>')">Edit</button>
	  <button type="button" class="btn btn-default" onCLick="setPage('<?php echo base_url('master/bank/delete_bank_branch/'.$data->bank_id) ?>')">Delete</button>
	</div>
</div>

<div class="form-group">
  <label>Bank ID <label class="required-filed">*</label></label>
  <input type="text" class="form-control" name="bank_id" value="<?php echo $data->bank_id ?>" readonly>
</div>

<div class="form-group">
  <label>Bank Name <label class="required-filed">*</label></label>
  <input type="text" class="form-control" name="bank_name" value="<?php echo $data->bank_name ?>" readonly>
</div>

<div class="form-group">
  <label>Bank Swift Code <label class="required-filed">*</label></label>
  <input type="text" class="form-control" name="bank_swift_code" value="<?php echo $data->bank_swift_code ?>" readonly>
</div>

<div class="form-group">
  <label>Country <label class="required-filed">*</label></label>
  <input type="text" class="form-control" name="country_id" value="<?php echo $this->master_country->get_by_country_id($data->country_id)->country_name ?>" readonly>
</div>

<div class="form-group">
  <label>Description</label>
  <textarea class="form-control" name="description" readonly><?php echo $data->description ?></textarea>
</div>

<div class="form-group">
  <label><?php echo ($data->is_active == 'active') ? 'Active' : 'Inactive' ?></label>
</div>
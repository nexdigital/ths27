<div class="form-group">
  <label>Holiday ID<label class="required-filed">*</label></label>
  <input type="text" class="form-control">
</div>

<div class="form-group">
  <label>Country <label class="required-filed">*</label></label>
  <select name="currency_to" class="form-control">
  <?php foreach ($list_country as $row) {
  echo '<option value="'.$row->country_id.'">'.$row->country_name.'</option>';
  } ?>
  </select>
</div>

<div class="form-group">
  <label>Date<label class="required-filed">*</label></label>
  <input type="text" class="form-control datepicker">
</div>

<div class="form-group">
  <label>Description<label class="required-filed">*</label></label>
  <textarea class="form-control"></textarea>
</div>

<div class="form-group">
<input type="checkbox"> <label>Global</label>
</div>

<div class="form-group">
<input type="checkbox"> <label>Active</label>
</div>

<button type="submit" class="btn btn-success submit" data-loading-text="Saving...">Submit</button>
<button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('master/view/holiday/index')?>')">Cancel</button>

<script type="text/javascript">
$(document).ready(function(){
  $('.datepicker').datepicker();
})	
</script> 
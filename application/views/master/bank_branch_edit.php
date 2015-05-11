<form action="<?php echo base_url('master/ajax/bank/edit/'.$data->bank_id) ?>" method="post" id="form">
  <div class="form-group">
      <label>Bank ID <label class="required-filed">*</label></label>
      <input type="text" class="form-control" name="bank_id" value="<?php echo $data->bank_id ?>" readonly>
  </div>

  <div class="form-group">
      <label>Bank Name <label class="required-filed">*</label></label>
      <input type="text" class="form-control" name="bank_name" value="<?php echo $data->bank_name ?>" required>
  </div>

  <div class="form-group">
      <label>Bank Swift Code <label class="required-filed">*</label></label>
      <input type="text" class="form-control" name="bank_swift_code" value="<?php echo $data->bank_swift_code ?>" required>
  </div>

  <div class="form-group">
      <label>Country <label class="required-filed">*</label></label>
      <select name="country_id" class="form-control">
          <?php foreach ($list_country as $row) {
            $selected = ($row->country_id == $data->country_id) ? 'selected="selected"' : '';
            echo '<option value="'.$row->country_id.'" '.$selected.' required>'.$row->country_name.'</option>';
          } ?>
      </select>
  </div>

  <div class="form-group">
      <label>Description</label>
      <textarea class="form-control" name="description"><?php echo $data->description ?></textarea>
  </div>

  <div class="form-group">
      <label>&nbsp;</label>
      <input type="checkbox" name="is_active" id="is_active" <?php echo ($data->is_active == 'active') ? 'checked="checked"' : ''?>> <label for="is_active">Active</label>
  </div>

  <button type="reset" class="btn btn-success btn-submit"  onclick="setPage('<?php echo base_url() ?>master/bank/bank_branch_form')">Create New</button>
  <button type="submit" class="btn btn-success btn-submit" data-loading-text="Process...">Update</button>
  <button type="reset" class="btn btn-success btn-submit"  onclick="setPage('<?php echo base_url() ?>master/bank/delete_bank_branch/<?php echo $data->bank_id ?>')">Delete</button>
  <button type="reset" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/bank/index_bank_branch')">Cancel</button>
  <label class="alert-form"></label>
</form>

<script type="text/javascript">
$(document).ready(function(){
  $('form#form').validate();
  $('form#form').ajaxForm({
    dataType:'json',
    success:function(data){
        $('#message_form').remove();
        if(data.status == "success"){
            $('.alert-form').html('<div id="message_form" style="display:none;" class="alert alert-form alert-success" role="alert">'+data.message+'</div>');
        } else if(data.status == "warning") {
            $('.alert-form').html('<div id="message_form" style="display:none;" class="alert alert-form alert-warning" role="alert">'+data.message+'</div>');               
        }
        $('#message_form').fadeIn('slow');
        setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000); 
    }
  })
})
</script>
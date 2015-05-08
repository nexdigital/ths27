<div class="toolbar">
  <label>Are you sure want delete this record?</table>
</div>

<form action="<?php echo base_url('master/ajax/bank/delete/'.$data->bank_id) ?>" method="post" id="form">
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
      <label>Description</label>
      <textarea class="form-control" name="description" readonly><?php echo $data->description ?></textarea>
  </div>

  <div class="form-group">
      <label><?php echo ($data->is_active == 'active') ? 'Active' : 'Inactive' ?></label>
  </div>

  <button type="submit" class="btn btn-success btn-submit" data-loading-text="Process...">Yes</button>
  <button type="reset" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/bank/details_bank_branch/<?php echo $data->bank_id ?>')">Cancel</button>
</form>

<script type="text/javascript">
$(document).ready(function(){
  $('form#form').validate();
  $('form#form').ajaxForm({
    dataType:'json',
    success:function(data){
        $('#message_form').remove();
        if(data.status == "success"){
            $('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-success" role="alert">'+data.message+'</div>');
            setTimeout(function(){ setPage('<?php echo base_url() ?>master/bank/index_bank_branch') }, 4000); 
        } else if(data.status == "warning") {
            $('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-warning" role="alert">'+data.message+'</div>');               
        }
        $('#message_form').fadeIn('slow');
        setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000); 
    }
  })
})
</script>
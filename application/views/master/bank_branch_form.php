<form action="<?php echo base_url('master/ajax/bank/add') ?>" method="post" id="form">
  <div class="form-group">
      <label>Bank ID <label class="required-filed">*</label></label>
      <input type="text" class="form-control" name="bank_id" required>
  </div>

  <div class="form-group">
      <label>Bank Name <label class="required-filed">*</label></label>
      <input type="text" class="form-control" name="bank_name" required>
  </div>

  <div class="form-group">
      <label>Bank Swift Code <label class="required-filed">*</label></label>
      <input type="text" class="form-control" name="bank_swift_code" required>
  </div>

  <div class="form-group">
      <label>Description</label>
      <textarea class="form-control" name="description"></textarea>
  </div>

  <div class="form-group">
      <label>&nbsp;</label>
      <input type="checkbox" name="is_active" id="is_active"> <label for="is_active">Active</label>
  </div>

  <button type="submit" class="btn btn-success btn-submit" data-loading-text="Process...">Submit</button>
  <button type="reset" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/bank/index_bank_branch')">Cancel</button>
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
            $('form#form').resetForm();
        } else if(data.status == "warning") {
            $('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-warning" role="alert">'+data.message+'</div>');               
        }
        $('#message_form').fadeIn('slow');
        setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000); 
    }
  })
})
</script>
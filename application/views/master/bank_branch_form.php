<form action="<?php echo base_url('master/ajax/bank/add') ?>" method="post" id="form">
  <div class="form-group">
      <label>Bank ID <label class="required-filed">*</label></label>
      <input type="text" class="form-control" name="bank_id" minlength="3" required>
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
      <label>Country <label class="required-filed">*</label></label>
      <select name="country_id" class="form-control">
          <?php foreach ($list_country as $row) {
            echo '<option value="'.$row->country_id.'" required>'.$row->country_name.'</option>';
          } ?>
      </select>
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
  <label class="alert-form"></label>
</form>
<script type="text/javascript">
$(document).ready(function(){

  var xhr;
  var ajaxStatus = 'false';

  $('input[name="bank_id"]').autoComplete({
    minChars: 2,
    source: function(term, response){
        try { xhr.abort(); } catch(e){}
        xhr = $.getJSON('<?php echo base_url('master/ajax/bank/autoComplete') ?>', { q: term }, function(data){ response(data); });
    },
    onSelect: function(e, term, item){
      setPage('<?php echo base_url('master/bank/edit_bank_branch')?>/' + term);
    }
  });

  $('input[name=bank_id]').blur(function(){
    var id = $(this).val();
    $.get("master/ajax/bank/check_available_bank_id",{'bank_id':id},function(data){
        if(data === 'false' ) {
          if(ajaxStatus === 'true') {
            setTimeout(function(){
              setPage('<?php echo base_url('master/bank/edit_bank_branch')?>/' + id);
              $('.autocomplete-suggestions').remove();
            }, 5000);
          } else {
              setPage('<?php echo base_url('master/bank/edit_bank_branch')?>/' + id);
              $('.autocomplete-suggestions').remove();            
          }
        }
    })
  })

    $('form#form').validate({
      rules: {
          bank_id: {
              required: {
                  depends:function(){
                      $(this).val($.trim($(this).val()));
                      return true;
                  }
              }
          }
      }
    });

    $('form#form').ajaxForm({
    dataType:'json',
    success:function(data){
        $('#message_form').remove();
        if(data.status == "success"){
            $('.alert-form').html('<div id="message_form" style="display:none;" class="alert alert-form alert-success" role="alert">'+data.message+'</div>');
            $('form#form').resetForm();
        } else if(data.status == "warning") {
            $('.alert-form').html('<div id="message_form" style="display:none;" class="alert alert-form alert-warning" role="alert">'+data.message+'</div>');               
        }
        $('#message_form').fadeIn('slow');
        setTimeout(function(){ $('#message_form').fadeOut('slow').remove(); }, 5000); 
    },
    beforeSubmit: function(arr, $form, options) {
      ajaxStatus = 'true';
      var id = $('input[name=bank_id]').val();
      $.get("master/ajax/bank/check_available_bank_id",{'bank_id':id},function(data){
          setPage('<?php echo base_url('master/bank/edit_bank_branch')?>/' + id);
          return false;
        }
      })
    }
  })
})
</script>
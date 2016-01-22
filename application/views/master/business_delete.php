<form method="post" id="form_business" action="<?php echo base_url('master/ajax/business/delete/'.$get_business_row->business_id) ?>">

<div class="form-group">
    <label>Business Id <label class="required-filed">*</label></label>
    <input type="text" class="form-control"  name="business_id" id="business_id" value = "<?php echo $get_business_row->business_id ?>" readonly>
</div>

<div class="form-group">
    <label>Business Name <label class="required-filed">*</label></label>
    <input type="text" class="form-control" id="business_name" name="business_name" value = "<?php echo $get_business_row->business_name ?>"  readonly>
</div>

<div class="form-group">
    <label>Description</label>
    <textarea class="form-control" name="description" readonly><?php echo $get_business_row->description ?></textarea>
</div>

<div class="form-group">
    <label>&nbsp;</label>
  <input type="checkbox" name="is_active" id="is_active" <?php echo ($get_business_row->is_active == 'active') ? 'checked="checked"' : ''?>> <label for="is_active">Active</label>
</div>

  <button type="submit" class="btn btn-success btn-submit" data-loading-text="Process...">Yes</button>
  <button type="reset" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/business/edit_business/<?php echo $get_business_row->business_id ?>')">Cancel</button>
  <label class="alert-form"></label>

</form>


<script>



    $('form#form_business').ajaxForm({
        dataType:'json',
        success: function(result){ 
        	
        /*	alert(result.message);
        	if(result.status == false){
        	  $('.alert-form').html(result.message).addClass(' alert-danger').removeClass('alert-success').fadeIn();
                setTimeout(function(){
                    $('.alert-form').fadeOut();
                }, 800);

        	}else{

        	}*/
            if(result.status == true){
 
                  $('.alert-form').html(result.message).addClass('alert-success').removeClass('alert-danger').fadeIn();
                  $('form#form_tax').resetForm();
               setTimeout(function(){
                 $('.alert-form').html(result.message).fadeOut();
                 setPage('<?php echo base_url() ?>master/business/index') 
              },800);
            }else {
                $('.alert-form').html(result.message).addClass('alert-danger').removeClass('alert-success').fadeIn();
                   setTimeout(function(){
                 $('.alert-form').html(result.message).fadeOut();
                  setPage('<?php echo base_url() ?>master/business/index') 
              },800);
            }
          
          
          //alert(result.message);
         
        
        }
      });

/**/
</script>
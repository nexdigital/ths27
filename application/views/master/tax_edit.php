<form method="post" id="form_tax" action="<?php echo base_url('master/ajax/tax/edit_tax') ?>">
      <div class="form-group" >
            <label>Tax Id <label class="required-filed">*</label></label>
                     
            <input type="text" class="form-control" id="tax_id" name="tax_id" value="<?php echo $get_tax_row->tax_id?>" readonly>
                        
          </div>

    <div class="form-group">
      <label>Tax Name <label class="required-filed">*</label></label>
                        
      <input type="text" class="form-control" id="tax_name" name="tax_name" value="<?php echo $get_tax_row->tax_name?>"  required>
                      
      </div>

            <div class="form-group">
            <label>Tax base amount <label class="required-filed">*</label></label>
                      
          <input type="text" name="tax_base_amount" class="form-control" id="tax_base_amount" value=" <?php echo $get_tax_row->tax_base_amount?>" required>
                       
          </div>

          <div class="form-group">
                        <label >Tax rate <label class="required-filed">*</label></label>
                     
              <input type="text" class="form-control" id="tax_rate" name="tax_rate"  value="<?php echo $get_tax_row->tax_rate?>"required>
                       
          </div>

           <div class="form-group">
              <label>Description</label>
                       
                <textarea class="form-control" style="resize:none" id="description" name="description" ><?php echo $get_tax_row->description?></textarea>
                        
          </div>

            <div class="form-group">
                  <label>&nbsp;</label>
                  <input type="checkbox" name="is_active" id="is_active" <?php echo ($get_tax_row->is_active == 'active') ? 'checked="checked"' : ''?>> <label for="is_active">Active</label>
            </div>


           <div class="form-group">
                     <label></label>
                     <button type="reset" class="btn btn-success btn-submit"  onclick="setPage('<?php echo base_url() ?>master/tax/add_tax')">Create New</button>
                    <button type="submit" class="btn btn-success btn-update" data-loading-text="Process...">Update</button>
                    <button type="reset" class="btn btn-success btn-submit"  onclick="setPage('<?php echo base_url() ?>master/tax/delete_tax/<?php echo $get_tax_row->tax_id ?>')">Delete</button>
                    <button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/tax/index')">Cancel</button>

                    <label class="alert-form"></label> 
          </div>
</form>    
  		



 <script>

 		$('.level').select2();

    $('form#form_tax').validate();

   
    $('form#form_tax').ajaxForm({
        dataType:'json',
        success: function(result){ 
            if(result.status == true){
 
                 $('.alert-form').html(result.message).addClass('alert-success').removeClass('alert-danger').fadeIn();
                  $('form#form_tax').resetForm();
                    
                    setTimeout(function(){ 
                          $('.alert-form').html(result.message).fadeOut();
                          setPage('<?php echo base_url() ?>master/tax/index') 

                    }, 800); 
            
            }else {
                $('.alert-form').html(result.message).addClass('alert-danger').removeClass('alert-success').fadeIn();
                   setTimeout(function(){
                 $('.alert-form').html(result.message).fadeOut();
              },800);
            }
            
          
         
        
        }
      });

 </script>
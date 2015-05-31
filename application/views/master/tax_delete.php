<div class="toolbar">
  <label>Are you sure want delete this record?</table>
</div>
<form method="post" id="form_tax" action="<?php echo base_url('master/ajax/tax/delete_tax/'.$get_tax_row->tax_id) ?>">
      <div class="form-group" style="display:none">
                        <label>Tax Id <label class="required-filed">*</label></label>
                     
                            <input type="text" class="form-control" id="tax_id" name="tax_id" value="<?php echo $get_tax_row->tax_id?>" readonly>
                        
          </div>

           <div class="form-group">
                        <label>Tax Name <label class="required-filed">*</label></label>
                        
                            <input type="text" class="form-control" id="tax_name" name="tax_name" value="<?php echo $get_tax_row->tax_name?>" readonly>
                      
          </div>


           <div class="form-group">
                        <label>Description</label>
                       
                            <textarea class="form-control" style="resize:none" id="description"  name="description" readonly><?php echo $get_tax_row->tax_name?> </textarea>
                        
          </div>


            <div class="form-group">
                        <label>Tax base amount <label class="required-filed">*</label></label>
                      
                            <input type="text" name="tax_base_amount" class="form-control" id="tax_base_amount"  value="<?php echo $get_tax_row->tax_base_amount?>" readonly>
                       
          </div>

          <div class="form-group">
                        <label >Tax rate <label class="required-filed">*</label></label>
                     
                             <input type="text" class="form-control" id="tax_rate" name="tax_rate" value="<?php echo $get_tax_row->tax_rate?>" readonly>
                       
          </div>

           <div class="form-group">
                     <label></label>
                    
              	   <button type="submit" class="btn btn-success btn-submit" data-loading-text="Process...">Yes</button>
				  <button type="reset" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/tax/edit_tax/<?php echo $get_tax_row->tax_id ?>')">Cancel</button>
				  <label class="alert-form"></label>
          </div>
</form>    
  		



 <script>

 		$('.level').select2();
    $('form#form_tax').validate({
      rules: { tax_name: { required: true, remote: "<?php echo base_url(); ?>master/ajax/tax/check_available_tax" } },
      messages: { tax_name: { remote: 'tax has been added' } }      
    });



    $('form#form_tax').ajaxForm({
        dataType:'json',
        success: function(result){ 
            if(result.status == true){
 
                  $('.alert-form').html('<div id="message_form"  class="alert alert-form alert-success" role="alert">'+result.message+'</div>');
                  $('form#form_tax').resetForm();
               setTimeout(function(){
                 $('.alert-form').html(result.message).fadeOut();
                 setPage('<?php echo base_url() ?>master/tax/index') 
              },800);
            }else {
                $('.alert-form').html('<div id="message_form"  class="alert alert-form alert-danger" role="alert">'+result.message+'</div>');
                   setTimeout(function(){
                 $('.alert-form').html(result.message).fadeOut();
                   setPage('<?php echo base_url() ?>master/tax/index') 
              },800);
            }
            
          
         
        
        }
      });
    
   
 </script>
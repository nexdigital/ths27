<form method="post" id="form_business" action="<?php echo base_url('master/ajax/business/add') ?>">

<div class="form-group">
    <label>Business Id <label class="required-filed">*</label></label>
    <input type="text" class="form-control"  name="business_id" id="business_id">
</div>

<div class="form-group">
    <label>Business Name <label class="required-filed">*</label></label>
    <input type="text" class="form-control" id="business_name" name="business_name" required>
</div>

<div class="form-group">
    <label>Description</label>
    <textarea class="form-control" name="description"></textarea>
</div>

<div class="form-group">
    <label>&nbsp;</label>
    <input type="checkbox" name="is_active" id="is_active"> <label for="is_active">Active</label>
</div>
<input type="submit" value="Add business" class="btn btn-success">
<button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/business/index')">Cancel</button>
<label class="alert-form"></label> 

</form>


<script>



    $('form#form_business').validate({
     		rules: { business_name:
     				 { 
     				 	required: true, 
     				 	remote: "<?php echo base_url(); ?>master/ajax/business/check_available" }
     				 },
      messages: {
      			 business_name: { 
      			 		remote: 'business has been added' }
      			 	}      
    });




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
              },800);
            }
          
          
          //alert(result.message);
         
        
        }
      });

/**/
</script>
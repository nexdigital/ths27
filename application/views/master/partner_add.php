<form id="partner_form" method="post" action="<?php echo base_url()?>partner/add_proses">
<div class="form-group">
	<label>Partner ID<label class="required-filed">*</label></label>
		<input type="text" class="form-control" id="partner_id" name="partner_id" minlength="1" value="<?php echo $this->partner_model->partner_new_id(); ?>"  required>
</div>

<div class="form-group">
	<label>Patner Name<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="partner_name" name="partner_name" maxlength="100" placeholder="max 100 character" required>
</div>

 <div class="row">

               <div class="col-md-2">
                  <div class="form-group" >
                    <label>Code Phone</label> <label class="required-filed">*</label>
                    <input class="form-control" maxlength="10" placeholder="max 10 character" id="c_phone" name="c_phone" type="text"  required>
                  </div>
              </div>
              <div class="col-md-10">
                  <div class="form-group" >
                    <label>Phone</label> <label class="required-filed">*</label>
                    <input class="form-control" maxlength="20" placeholder="max 20 character" id="telephone" name="telephone" type="text" required>
                  </div>
              </div>
            </div>

<div class="form-group">
	<label>First Email<label class="required-filed">*</label></label>
	<input type="email" class="form-control" id="email" name="email" maxlength="100" placeholder="max 100 character"  required>
</div>

<div class="form-group">
	<label>Second Email</label>
	<input type="email" class="form-control" id="second_email" maxlength="100" placeholder="max 100 character" name="second_email" >
</div>

<div class="form-group">
	<label>Third Email</label>
	<input type="email" class="form-control" id="third_email" maxlength="100" placeholder="max 100 character" name="third_email" >
</div>

<div class="form-group">
	<label>Fourth Email</label>
	<input type="email" class="form-control" id="fourth_email" maxlength="100" placeholder="max 100 character" name="fourth_email">
</div>


 <div class="form-group">
     <label>Address</label> <label class="required-filed">*</label>
      <textarea class="form-control" maxlength="200" placeholder="max 200 character" name="address" style="resize:none" required></textarea>
    </div>

<div class="form-group">
	<label>City<label class="required-filed">*</label></label>
	<input type="text" class="form-control" maxlength="100" placeholder="max 100 character"  id="city" name="city" required>
</div>

<div class="form-group">
	<label>Country</label><label class="required-filed">*</label></label>
	<select class="form-control" name="country" id="country" required>
		<option value="">-</option>
		<?php foreach ($this->tool_model->list_country() as $key => $value) {
			echo '<option value="'.$value->country_id.'">'.$value->country_name.'</option>';	
		} ?>
		
	</select>
</div>
<div class="form-group">
	<label>Zip Code</label>
	<input type="text" class="form-control" id="zipcode"  placeholder="max 20 character"  maxlength="20" name="zipcode">
</div>

<div class="form-group">
	<label>Description</label>
	<textarea class="form-control" maxlength="100" placeholder="max 100 character"  id="remark" name="description" rows="1" style="resize:none"></textarea>
</div>

<!-- <div class="form-group">
	<input type="checkbox" name="is_active" value="active"> Active
</div> -->

<button type="submit" class="btn btn-success submit" data-loading-text="Saving...">Submit</button>
<button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('partner/index')?>')">Cancel</button>
<label class="alert-form" ></label>
</form>

<div class="modal fade" id="no_available_modal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
         
         
        </div>
        <div class="modal-body">
           <center><p class="message_available"></p></center>
        </div>
      
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	$(document).ready(function(){

		 $('input[name="partner_id"]').autoComplete({
			    minChars: 1,
			    source: function(term, response){
			        try { xhr.abort(); } catch(e){}
			        xhr = $.getJSON('<?php echo base_url('partner/autoComplete') ?>', { q: term }, function(data){ response(data); });
			    },
			    onSelect: function(e, term, item){
			      setPage('<?php echo base_url('partner/edit_form')?>/' + term);
			    }
  		});

		 $('input[name="partner_name"]').autoComplete({
			    minChars: 1,
			    source: function(term, response){
			        try { xhr.abort(); } catch(e){}
			        xhr = $.getJSON('<?php echo base_url('partner/autoCompleteName') ?>', { q: term }, function(data){ response(data); });
			    }
  		});


var regex=/^[0-9A-Za-z]+$/;
jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || regex.test(value);
}, "Letters and numbers only please");


		$('form#partner_form').validate({
			rules: { partner_name: { 
										required: true, remote: "<?php echo base_url(); ?>partner/check_available_partner" 
									}, 

					partner_id: { 
										required: true, 
										alphanumeric:true 
								   },

					  c_phone :
                	{

					                  required: true,
					                  number: true
               		},

                 		telephone :
                	{

					                  required: true,
					                  number: true
            		},				
				},
			messages: { partner_name: { remote: 'Partner has been added' } }			
		});

			$('form#partner_form').ajaxForm({
				dataType:'json',
				success: function(result){
						if(result.status == true){
 
							$('.alert-form').html(result.message).addClass('alert-success').removeClass('alert-danger').fadeIn();
							    $('form#partner_form').resetForm();
							 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
							 	 setPage('<?php echo base_url() ?>partner/index');
							},800);
						}else if(result.status == "no_available"){

			     			  $("#no_available_modal").modal("show");
			                  $(".message_available").html(result.message);
				                   setTimeout(function(){   
				                        $("#no_available_modal").modal("hide");
				                  },800);   
			                   $("#partner_id").val(result.new_id);
			                   $(".submit").removeClass('disabled').html('Submit');
						}


						else {
							 $('.alert-form').html(result.message).addClass('alert-danger').removeClass('alert-success').fadeIn();
							  	 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
							},800);
						}
						 
				
				},

				 error : function(){

                   alert("wrong format. Please check all field");  
                   $(".submit").removeClass('disabled').html('Submit');
                   location.reload();

            }
			});
	})	
</script>
<form id="add_customer">
<?php if(isset($data_host)) {?>
                <div class="alert alert-warning" role="alert"><?php echo $data_host->$customer_type ?></div>
                <?php } ?>

                           <div class="form-group">
                              <label>Reference Id</label> <label class="required-filed">*</label>
                              <input id="reference_id" maxlength="20" placeholder="max 20 character" name="reference_id"  type="text"  class="form-control" value="<?php echo $reference_id ?>">
                             
                            </div>

                            <div class="form-group">
                              <label>Name</label> <label class="required-filed">*</label>
                              <input id="name" name="name" maxlength="100" placeholder="max 100 character"  type="text" class="form-control" required>
                            </div>

                            <div class="form-group">
                             <label>Attn</label> <label class="required-filed">*</label>
                              <input id="attn" name="attn" maxlength="100" placeholder="max 100 character" type="text" class="form-control" required>
                            </div>     

                            <!-- <div id="target_to"> -->
                            <div class="form-group" >
                               <label >E-mail</label> <label class="required-filed">*</label>
                                  <input id="email" name="email" maxlength="100" placeholder="max 100 character" type="email" class="form-control" required>
                            </div>

                              <div class="form-group" >
                               <label >Second E-mail</label> 
                                  <input id="second_email" name="second_email" maxlength="100" placeholder="max 100 character" type="email" class="form-control">
                            </div>

                              <div class="form-group" >
                               <label >Third E-mail</label> 
                                  <input id="third_email" name="third_email" maxlength="100" placeholder="max 100 character" type="email" class="form-control">
                            </div>
                           
                          <!-- </div> -->
                           <!--  <div class="form-group">
                                   <button type="button" class="btn btn-warning" onClick="add_email()">Add Email</button>
                            </div> -->
                            <div class="form-group">
                             <label>Address</label> <label class="required-filed">*</label>
                              <textarea class="form-control" maxlength="200" placeholder="max 200 character" name="address" style="resize:none" required></textarea>
                            </div>

                            <div class="form-group">
                              <label>City</label>
                              <input id="city" name="city" type="text" maxlength="100" placeholder="max 100 character" class="form-control">
                            </div>

                            <div class="form-group">
                             <label>Country</label> <label class="required-filed">*</label>
                              <select class="form-control bfh-states country" id="country" name="country" required>

                               <option value="">-</option> 
                              <?php
                               foreach ($this->tool_model->list_country() as $key => $value) { 
                                  $selected = (strtolower($value) == 'indonesia') ? 'selected' : '';
                                  echo '<option value="'.$value->country_id.'" '.$selected.'>'.$value->country_name.'</option>';
                              }
                              ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label >Zip Code</label>
                              <input id="post_code" name="zip_code" maxlength="20" placeholder="max 20 character" type="text" class="form-control"  maxlength="20">
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
                                    <input class="form-control" maxlength="20" placeholder="max 20 character" id="phone" name="phone" type="text" required>
                                  </div>
                              </div>
                            </div>

                             <div class="row">

                               <div class="col-md-2">
                                  <div class="form-group" >
                                    <label>Second Code Phone</label> 
                                    <input class="form-control" maxlength="10" placeholder="max 10 character" id="second_c_phone" name="second_c_phone" type="text" >
                                  </div>
                              </div>
                              <div class="col-md-10">
                                  <div class="form-group" >
                                    <label>Second Phone</label>
                                    <input class="form-control" maxlength="20" placeholder="max 20 character" id="second_phone" name="second_phone" type="text" >
                                  </div>
                              </div>
                            </div>

                             <div class="row">

                               <div class="col-md-2">
                                  <div class="form-group" >
                                    <label>Third Code Phone</label>
                                    <input class="form-control" maxlength="10" placeholder="max 10 character" id="third_c_phone" name="third_c_phone" type="text"  >
                                  </div>
                              </div>
                              <div class="col-md-10">
                                  <div class="form-group" >
                                    <label>Third Phone</label> 
                                    <input class="form-control" maxlength="20" placeholder="max 20 character" id="third_phone" name="third_phone" type="text"  >
                                  </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label >Mobile</label>
                              <input id="mobile" name="mobile" maxlength="20" placeholder="max 20 character"  type="text" class="form-control"  maxlength="15" >
                            </div>

                            <div class="form-group">
                              <label >Fax</label>
                              <input id="fax" name="fax" type="text" maxlength="20" placeholder="max 20 character"  class="form-control" maxlength="15"  >
                            </div>

                      <div class="form-group" style="margin-top:10px;">
                              <label >Tax Class</label> <label class="required-filed">*</label>
                              <select class="form-control tax_class" id="tax_class" name="tax_class" required>
                                <option value="">-</option>
                                <option value="0">none</option>
                                <?php
                                    foreach ($this->tool_model->get_tax() as $key => $value) {
                                        echo "<option value='".$value->tax_id."'>".$value->tax_name."</option>";
                                    }



                                 ?>

                              </select>
                            </div>

                           <!-- <div class="form-group group_by">
                              <label>Group by</label>
                                    <select class="form-control group_by" name="id_group">
                                           <option></option>
                                           <?php 
                                                    foreach ($get_group as $key => $value) {
                                                         
                                                        echo "<option value='".$value->id_group."'>".$value->business_type."</option>";       

                                                    }


                                           ?>


                                    </select>
                            </div> -->

                           

                            <div class="form-group">
                              <label>Status</label> <label class="required-filed">*</label>
                              <select class="form-control" name="status" required>
                                <option value="">-</option>
                                <option value="0">None regular</option>
                                <option value="regular">regular customer</option>
                              </select>
                            </div>

                            

                           <!--  <div class="form-group">
                              <label >Register Date</label>
                              <div class='input-group date' id='datetimepicker1'>
                                <input type="text" class="form-control" name="payment_date" id="dp1" readonly>
                                <span class="input-group-addon datapicker"><i class="glyphicon glyphicon-th"></i></span>
                              </div>
                            </div>  -->

                            <div class="form-group">
                              <label >Description</label>
                              <textarea class="form-control" maxlength="100" placeholder="max 100 character"  id="remark" name="description" rows="5" style="resize:none"></textarea>
                            </div>
     <input type="hidden" name="hawb_no" value="<?php echo (isset($_GET['hawb_no'])) ? $_GET['hawb_no'] : ''?>">
     <input type="hidden" name="customer_type" value="<?php echo (isset($_GET['customer_type'])) ? $_GET['customer_type'] : ''?>">

     <button type="submit" class="btn btn-success submit" data-loading-text="Saving..." onClick="add_customer();">Submit</button>
     <button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('customers/home')?>')">Cancel</button>
     <label class="alert-form" ></label>

</form>

<script type="text/javascript">


     $('input[name="name"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete') ?>', { q: term }, function(data){ response(data); });
          }
      });




var regex=/^[0-9A-Za-z]+$/;
jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || regex.test(value);
}, "Letters and numbers only please");

$('form#add_customer').validate({
      rules: { reference_id: 
                { 
  								required: true, 
  								remote: "<?php echo base_url(); ?>customers/ajax/check_available_customers",
  								alphanumeric:true 
							  },

                name :
                {
                    required: true, 
                    remote: "<?php echo base_url(); ?>customers/ajax/check_available_name"
                },

                c_phone :
                {

                  required: true,
                  number: true
                },

                 phone :
                {

                  required: true,
                  number: true
                },

                 second_c_phone :
                {

                 
                  number: true
                },

                second_phone :
                {

               
                  number: true
                },

                 third_c_phone :
                {

               
                  number: true
                },

                 third_phone :
                {

                
                  number: true
                },

                  mobile :
                {

               
                  number: true
                },


                fax :
                {

               
                  number: true
                }




				
			 },
      messages: { reference_id: {

                         remote: 'Reference Id has been used. Please try another Reference Id' 
                  }, 
                      name : {  
                          remote: 'name has been created. Please try another name'  
                      } 
                }      
    });


// $('#country').select2();

  $('#dp1').datepicker({
                format: 'dd-mm-yyyy'
            });


function add_customer(){


    $('form#add_customer').ajaxForm({
            url: '<?php echo base_url()?>customers/ajax/add_customer',
            type: 'post',
            dataType: 'json',
            beforeSubmit : function(){
                    $(".submit").addClass('disabled').html('Submit...');
            },
            success: function(json) {
              if(json.status == 'success') {
                     $('.alert-form').html(json.message).removeClass('alert alert-danger').addClass('alert alert-success').fadeIn(); 
                      setTimeout(function(){   
                        $('.alert-form').fadeOut();
                        setPage('<?php echo base_url() ?>customers/home');
                       
                        },800);    
              } 
              else if(json.status == 'redirect') {
                setPage(json.message);
              }else if(json.status=='unsuccess'){
                    $('.alert-form').html(json.message).removeClass('alert alert-success').addClass('alert alert-danger').fadeIn(); 
                   setTimeout(function(){   
                     $(".submit").removeClass('disabled').html('Submit');
                    $('.alert-form').fadeOut();
                  },800);    
              }
            },

            error : function(){

                   alert("wrong format. Please check all field");

                   $(".submit").removeClass('disabled').html('Submit');
            }
          });


}



function add_email(){
    var D = new Date();
    var elm = $("#target_to");

    var elm_id = D.getTime();
  

    // alert(get_number());

if(elm.find('input.form-control').length < 5) {
     alert( global_counter++);
     elm.append( "<div class='input-group' id='target_to"+global_counter+"'><input id='to' placeholder='Input email'  name='email'  type='email'  class='form-control to' required ><span class='input-group-btn'><button class='btn btn-default' type='button' onClick='delete_target(\""+elm_id+"\")'>Delete</button><label id='to-error' class='error' for='to'></label></span></div>");
    
  }
  else{

      $("#message_email").html("add email cannot more than 5 textbox").fadeIn();
      setTimeout(function(){
        $("#message_email").fadeOut();
      },800);
      return false;
    }

 var global_counter = 0;

    // if(elm.find('input.form-control').length < 5) {
    //   elm.append(" <br/><div class='input-group'><input class='form-control' name='to[]' type='email' id='"+elm_id+"' required> <span class='input-group-btn'><button class='btn btn-default' id='"+elm_id+"' type='reset' onClick=\"$('input#"+elm_id+", button#"+elm_id+", label#"+elm_id+"-error').remove(); return false;\">Delete</button></span></div>");
    // }else{

    //   $("#message_email").html("add email cannot more than 5 textbox").fadeIn();
    //   setTimeout(function(){
    //     $("#message_email").fadeOut();
    //   },800);
    //   return false;
    // }

  

  }

 function delete_target(id)
  {
      $("#target_to"+id+"").remove(); 
      return false;
  }


</script>
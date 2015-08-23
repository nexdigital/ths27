<form id="add_customer">
<?php if(isset($data_host)) {?>
                <div class="alert alert-warning" role="alert"><?php echo $data_host->$customer_type ?></div>
                <?php } ?>

                           <div class="form-group">
                              <label>Reference Id</label> <label class="required-filed">*</label>
                              <input id="reference_id"  name="reference_id"  type="text"  class="form-control" value="<?php echo $reference_id ?>">
                             
                            </div>

                            <div class="form-group">
                              <label>Name</label> <label class="required-filed">*</label>
                              <input id="name" name="name"  type="text" class="form-control" required>
                            </div>

                            <div class="form-group">
                             <label>Attn</label> <label class="required-filed">*</label>
                              <input id="attn" name="attn" type="text" class="form-control" required>
                            </div>     

                            <div class="form-group">
                               <label >E-mail</label> <label class="required-filed">*</label>
                              <input id="email" name="email" type="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                             <label>Address</label> <label class="required-filed">*</label>
                              <textarea class="form-control" name="address" style="resize:none" required></textarea>
                            </div>

                            <div class="form-group">
                              <label>City</label>
                              <input id="city" name="city" type="text" class="form-control">
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
                              <input id="post_code" name="zip_code" type="text" class="form-control">
                            </div>

                            <div class="form-group" >
                              <label>Phone</label> <label class="required-filed">*</label>
                             
                              <input class="form-control" id="phone" name="phone" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>

                            <div class="form-group">
                              <label >Mobile</label>
                              <input id="mobile" name="mobile" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                              <label >Fax</label>
                              <input id="fax" name="fax" type="text" class="form-control">
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
                                <option value="0">None</option>
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
                              <textarea class="form-control" id="remark" name="description" rows="5" style="resize:none"></textarea>
                            </div>
     <input type="hidden" name="hawb_no" value="<?php echo (isset($_GET['hawb_no'])) ? $_GET['hawb_no'] : ''?>">
     <input type="hidden" name="customer_type" value="<?php echo (isset($_GET['customer_type'])) ? $_GET['customer_type'] : ''?>">

     <button type="submit" class="btn btn-success submit" data-loading-text="Saving..." onClick="add_customer();">Submit</button>
     <button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('customers/home')?>')">Cancel</button>
     <label class="alert-form" ></label>

</form>

<script type="text/javascript">

jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
}, "Letters, numbers, and underscores only please");

$('form#add_customer').validate({
      rules: { reference_id: { required: true, remote: "<?php echo base_url(); ?>customers/ajax/check_available_customers",alphanumeric:true } },
      messages: { reference_id: { remote: 'Reference Id has been used. Please try another Reference Id' } }      
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
           
            success: function(json) {
              if(json.status == 'success') {
                     $('.message').html(json.message).removeClass('alert alert-danger').addClass('alert alert-success').fadeIn(); 
                      setTimeout(function(){   
                          $('.message').fadeOut();
                        setPage('<?php echo base_url() ?>customers/home');
                        },800);    
              } 
              else if(json.status == 'redirect') {
                setPage(json.message);
              }else if(json.status=='unsuccess'){
                    $('.message').html(json.message).removeClass('alert alert-success').addClass('alert alert-danger').fadeIn(); 
                   setTimeout(function(){   
                    $('.message').fadeOut();
                  },800);    
              }
            }
          });


}

</script>
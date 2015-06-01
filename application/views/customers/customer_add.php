<style>

.stepwizard-step p {
    margin-top: 10px;
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}

.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;

}

.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}



</style>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Customer Form
                    </div>
                    <div class="panel-body">
                    <p class="message" style="padding:15px 15px; display:none;"></p>
                      <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                          <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle step-1 step-button" step="1">1</a>
                            <p>Step 1</p>
                          </div>
                          <div class="stepwizard-step">
                            <a href="#step-2" type="button" class="btn btn-default btn-circle step-2 step-button" step="2">2</a>
                            <p>Step 2</p>
                          </div>
                          <div class="stepwizard-step">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle step-3 step-button" step="3">3</a>
                            <p>Step 3</p>
                          </div>
                        </div>
                      </div>


                     

                      <div class="row setup-content step-content" id="step-1">
                        <form id="form_step_1">
                        <div class="col-xs-12">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Reference Id</label>
                              <input id="reference_id"  name="reference_id"  type="text"  class="form-control" value="<?php echo $reference_id ?>">
                            </div>

                            <div class="form-group">
                              <label>Name</label>
                              <input id="name" name="name"  type="text" class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label >E-mail</label>
                              <input id="email" name="email" type="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label>Address</label>
                              <textarea class="form-control" name="address" style="resize:none" required></textarea>
                            </div>

                            <div class="form-group">
                              <label>Attn</label>
                              <input id="attn" name="attn" type="text" class="form-control" required>
                            </div>     

                            <div class="form-group">
                              <label>City</label>
                              <input id="city" name="city" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                              <label>Country</label>
                              <select class="form-control bfh-states country" name="country">
                              <?php
                              foreach ($this->master_country->list_country() as $key => $value) {
                                  $selected = (strtolower($value) == 'indonesia') ? 'selected' : '';
                                  echo '<option value="'.$value->country_name.'" '.$selected.'>'.$value->country_name.'</option>';
                              }
                              ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label >Zip Code</label>
                              <input id="post_code" name="zip_code" type="text" class="form-control">
                            </div>
                            <nav>
                              <ul class="pager">
                                <li class="next"><a href="#" step="1">Next <span aria-hidden="true">&rarr;</span></a></li>
                              </ul>
                            </nav>
                          </div>
                        </div>
                        </form>
                      </div>
                      <div class="row setup-content step-content" id="step-2" style="display:none;">
                        <form id="form_step_2">
                        <div class="col-xs-12">
                          <div class="col-md-12">
                            <div class="form-group" >
                              <label>Phone</label>
                              <input id="phone" name="phone" type="phone" class="form-control" required >
                            </div>

                            <div class="form-group">
                              <label >Mobile</label>
                              <input id="mobile" name="mobile" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                              <label >Fax</label>
                              <input id="fax" name="fax" type="text" class="form-control">
                            </div>

                            
                            <nav>
                              <ul class="pager">
                                <li class="previous"><a href="#" step="2"><span aria-hidden="true">&larr;</span> Back</a></li>
                                <li class="next"><a href="#" step="2">Next <span aria-hidden="true">&rarr;</span></a></li>
                              </ul>
                            </nav>
                          </div>
                        </div>
                        </form>
                      </div>
                      <div class="row setup-content step-content" id="step-3" style="display:none;">
                        <form id="form_step_3">
                        <div class="col-xs-12">
                          <div class="col-md-12">
                            <div class="form-group" style="margin-top:10px;">
                              <label >Tax Class</label>
                              <select class="form-control tax_class" name="tax_class">
                                <option value="0">None</option>
                                <option value="1">1%</option>
                                <option value="10">10%</option>
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
                              <label>Status</label>
                              <select class="form-control" name="status" >
                                <option value="0">None</option>
                                <option value="regular">regular customer</option>
                              </select>
                            </div>

                            

                            <div class="form-group">
                              <label >Register Date</label>
                              <div class='input-group date' id='datetimepicker1'>
                                <input type="text" class="form-control" name="payment_date" id="dp1" readonly>
                                <span class="input-group-addon datapicker"><i class="glyphicon glyphicon-th"></i></span>
                              </div>
                            </div> 

                          

                           
                            <div class="form-group">
                              <label>Payment Type</label>
                              <select class="form-control" name="payment_type" class="payment-type">
                                <option value="cash">Cash</option>
                                <option value="transfer">transfer</option>
                              </select>
                            </div>


                            <div class="form-group">
                              <label>Group</label>
                              <select class="form-control" name="group" id="group">
                                  <option></option>
                                 <option>online shop</option>
                                 <option>tekstil</option>

                              </select>
                            </div>


                            <div class="form-group">
                              <label >Description</label>
                              <textarea class="form-control" id="remark" name="description" rows="5" style="resize:none"></textarea>
                            </div>
                            <input type="hidden" name="hawb_no" value="<?php echo (isset($_GET['hawb_no'])) ? $_GET['hawb_no'] : ''?>">
                            <input type="hidden" name="customer_type" value="<?php echo (isset($_GET['customer_type'])) ? $_GET['customer_type'] : ''?>">
                            <nav>
                              <ul class="pager">
                                <li class="previous"><a href="#" step="3"><span aria-hidden="true">&larr;</span> Back</a></li>
                                <li class="next"><a href="#" step="3">Register</a></li>
                              </ul>
                            </nav>
                          </div>
                        </div>
                        </form>
                      </div>



                       



           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">




$('#group').select2();

  $('#dp1').datepicker({
                format: 'dd-mm-yyyy'
            });

 
 // $('.group_by').select2();
  var step_elm = $('.stepwizard-step');
  var step_cont = $('.step-content');
 /* $('.input-group.date').datepicker({
    format: "yyyy-m-d",
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true
  });*/
  $('li.next a').click(function(){
    step = $(this).attr('step');
    next = parseInt(step) + 1;
    if(step <= 3) {
      if($('#form_step_' + step).valid()) {
        if(step == 3) {
          data = $('#form_step_1, #form_step_2, #form_step_3').serialize();
          $.ajax({
            url: '<?php echo base_url()?>customers/ajax/add_customer',
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(json) {
              if(json.status == 'success') {
                     $('.message').html(json.message).removeClass('alert alert-danger').addClass('alert alert-success').fadeIn(); 
                      setTimeout(function(){   
                          $('.message').fadeOut();
                          $('#form_step_1,#form_step_2,#form_step_3 ').trigger("reset");

                          step_elm.find('a').removeClass('btn-primary').addClass('btn-default');
                          step_elm.find('.step-1').addClass('btn-primary');
                          step_cont.hide();
                          $('#step-1').show();           
                        },800);    
              } else if(json.status == 'redirect') {
                setPage(json.message);
              }
            }
          })
        } else {
          step_elm.find('a').removeClass('btn-primary').addClass('btn-default');
          step_elm.find('.step-' + next).addClass('btn-primary');
          step_cont.hide();
          $('#step-' + next).show();
        }

      }
    }
  })
  $('li.previous a').click(function(){
    step = $(this).attr('step');
    prev = parseInt(step) - 1;
    if(step > 1) {
      step_elm.find('a').removeClass('btn-primary').addClass('btn-default');
      step_elm.find('.step-' + prev).addClass('btn-primary');
      step_cont.hide();
      $('#step-' + prev).show();
    }
  })

$('a.step-button').click(function(){
  var goto_step = $(this).attr('step');
  var step_now = $('.stepwizard-step').find('.btn-primary').attr('step');
  if(step_now == 1) {
    if($('#form_step_1').valid()) {
      step_elm.find('a').removeClass('btn-primary').addClass('btn-default');
      step_elm.find('.step-2').addClass('btn-primary');
      step_cont.hide();
      $('#step-2').show();

      if($('#form_step_2').valid()) {
        step_elm.find('a').removeClass('btn-primary').addClass('btn-default');
        step_elm.find('.step-' + goto_step).addClass('btn-primary');
        step_cont.hide();
        $('#step-' + goto_step).show();
      }
    }
  } else if(step_now == 2) {
      if($('#form_step_2').valid()) {
        step_elm.find('a').removeClass('btn-primary').addClass('btn-default');
        step_elm.find('.step-' + goto_step).addClass('btn-primary');
        step_cont.hide();
        $('#step-' + goto_step).show();
      }
  } else {
    step_elm.find('a').removeClass('btn-primary').addClass('btn-default');
    step_elm.find('.step-' + goto_step).addClass('btn-primary');
    step_cont.hide();
    $('#step-' + goto_step).show();    
  }
})

</script>
  

<style>
    .alert{
        padding: 5px;
    }
     #editor {overflow:scroll; max-height:300px}



</style>


 <form  id="edit_customer">  
  <input type="hidden" value="<?php echo $get_customers->reference_id ?>" id="Reference" class="form-control" name="reference" >  
    <div class="form-group">
            <label>Name<label class="required-filed">*</label></label>
            <input type="text"  value="<?php echo $get_customers->name ?>" id="name" class="form-control" name="name" required>
    </div>


  <div class="form-group">
            <label>Attn<label class="required-filed">*</label></label>
            <input type="text" value="<?php echo $get_customers->attn ?>" id="attn" class="form-control" name="attn" required>
    </div>

    <div class="form-group">
            <label>Email<label class="required-filed">*</label></label>
            <input type="text" value="<?php echo $get_customers->email ?>" id="email" class="form-control" name="email" required>
    </div>

     <div class="form-group">
            <label>Address<label class="required-filed">*</label></label>
            <textarea id="address" class="form-control" name="address" required><?php echo $get_customers->address ?></textarea>
    </div>


    <div class="form-group">
            <label>City</label>
            <input type="text" value="<?php echo $get_customers->city ?>" id="city" class="form-control" name="city">
    </div>

     <div class="form-group">
            <label>Country<label class="required-filed">*</label></label>
           <select class="form-control" id="country" name="country" required>
                            <option value=""></option>
                            <?php foreach ($this->tool_model->list_country() as $key => $value) { 
                                    echo "<option value='".$value->country_id."'>".$value->country_name."</option>";


                            } ?>
            </select>
    </div>

      <div class="form-group">
            <label>Pos Code</label>
            <input type="text" value="<?php echo $get_customers->pos_code ?>" id="pos_code" class="form-control" name="post_code">
    </div>

     <div class="form-group">
            <label>Phone<label class="required-filed">*</label></label>
            <input type="text" value="<?php echo $get_customers->phone ?>" id="phone" class="form-control" name="phone">
    </div>

     <div class="form-group">
            <label>Mobile</label>
           <input type="text" value="<?php echo $get_customers->mobile ?>" id="mobile" class="form-control" name="mobile">
    </div>

      <div class="form-group">
            <label>Fax</label>
            <input type="text" value="<?php echo $get_customers->fax ?>" id="fax" class="form-control" name="fax">
    </div>

      <div class="form-group">
            <label>Tax Class<label class="required-filed">*</label></label>
            <select class="form-control" id="tax_class"name="tax_class">

                                <option>-</option>
                                <option value="0">none</option>
                                    <?php foreach ($this->tool_model->get_tax() as $key => $value) {
                                          echo "<option value ='".$value->tax_id."'>".$value->tax_name."</option>";
                                      }
                                    ?>
            </select>

    </div>

      <div class="form-group">
            <label>Description</label>
             <textarea name="description" id="description" class="form-control" style=" resize: none;"><?php echo $get_customers->description ?></textarea>
    </div>

     <div class="form-group">
          
            <input type="checkbox" name="is_active" id="is_active" <?php echo ($get_customers->status_active == 'Active') ? 'checked="checked"' : ''?>> <label for="is_active">Active</label>
    </div>


            <button type="button"  class="btn btn-info" onClick="open_modal()" id="show_modal"><i class="glyphicon glyphicon-envelope"></i> Email</button>
            <button type="reset" class="btn btn-success" onClick="add_new();">Create New</button></a>    
            <button class="btn btn-success btn_edit" onClick="edit_customer();"> Update</button>
            <button type="reset" class="btn btn-success btn-submit"  onClick="setPage('<?php echo base_url('customers/delete_customer/'.$get_customers->reference_id)?>')">Delete</button>
            <?php 
                $name = $get_customers->name ;
                $attn = $get_customers->attn;
                $address = $get_customers->address;
                $phone = $get_customers->phone;
                $country = $get_customers->country;

            //    $parameter = 

            ?>
            <button type="reset" class="btn btn-success" onClick="print_label('<?php echo $name?>','<?php echo $attn ?>','<?php echo $address ?>','<?php echo $phone ?>','<?php echo $country ?>');">Print Label</button>  
            <button type="reset" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>customers/home')">Cancel</button>
            <label class="result-message"></label>

 </form>   



      


<div class="modal fade bs-example-modal-lg" id="modal_email" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Email Form</h4>
      </div>

    <center><label class="alert alert-danger" id="message_email" style="display:none"></label></center>
  <form id="send_email_form">
      <div class="modal-body">  
              <div class="input-group" id="target_to" style="display: block;">
                <span class="">*</span> <label>To</label>
                <input id="to"  value="<?php echo $get_customers->email ?>" name="to[]"  type="email"  class="form-control to" required> 
              </div>

              <span style="float:right;"><span class="btn btn-warning" onClick="add_email()">Add</span></span>
              <br/>
              <div class="form-group">
                  <span class="">*</span> <label>Subject</label>
                  <input id="subject"  name="subject"  type="text"  class="form-control" required>
             
            </div>

        <div class="form-group">
               <span class="">*</span><label>Message</label>
               <textarea id="message" name="message" class="form-control" style="resize:none;" required>


                <div>
                  <br/>
                  <br/>
                  <br/>

                  <b>PT. TATA HARMONI SARANATAMA</b><br/>
                  Taman Dutamas Blok B1 No.27<br/>
                  Jl.P.Tubagus Angke , Jakarta Barat .<br/>
                  Tel.: 021-567 8289  <br/>   
                  Fax.: 021-567 6536<br/>
                  Email.: tatahasa@dnet.net.id<br/>
                  Website: http://www.tataharmoni.com available for tracking your shipment now
              </div>
               </textarea>
                
        </div>
        <center><div class="alert-email"></div></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onClick="close_email()">Close</button>
        <button type="submit" class="btn btn-success send-email" onClick="send_email();">Send Email</button>
      </div>

    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->                   


    <script>
    

           

$(document).ready(function(){
            
jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
}, "Letters, numbers, and underscores only please");

$('#edit_customer').validate({
      rules: { 
				name:		  {
								required	 : true,
								alphanumeric : true
							  },
				attn :		  {
								required     : true,
								alphanumeric : true
									
							  },
				city  :       {
								required     : true,
								alphanumeric : true
							  },
				zip_code :    {

								required     : true,
								alphanumeric : true
							  },
				mobile   :    {
		
								required     : true,
								alphanumeric : true
							
							  },
			   fax		:     {

								required     : true,
								alphanumeric : true

							  }
				
			 },
      messages: { }      
    });

            
           // $('#send_email_form').validate();
            $('#message').wysihtml5();
            var tax_class = "<?php echo $get_customers->tax_class ?>";  
            var payment_type = "<?php echo $get_customers->payment_type ?>"; 
            var country = "<?php echo $get_customers->country ?>";           
          
            if(tax_class ==  0 ){
                 $("#tax_class").val('0');
            }else{

                 $("#tax_class").val(tax_class);
            }
           
            $("#payment_type").val(payment_type);
            $("#country").val(country);





});


      function add_new(){

            setPage('<?php echo base_url()?>customers/add_customer');
        }


        function edit_customer(){



             $('form#edit_customer').ajaxForm({

                 
                    url         : "<?php echo base_url()?>customers/ajax/edit_customer",
                    type        : "POST",
                    dataType    : "json",
                    success     : function(result){

                            //alert(result.message);
                            if(result.status == true){

                                    $('.result-message').html(result.message).addClass('alert alert-success').fadeIn();

                            setTimeout(function(){
                               
                                   setPage('<?php echo base_url() ?>customers/home');
                            },800);
                                  

                            }else{

                                ('.result-message').html(result.message).addClass('alert alert-success').fadeIn();
                            }
                    },
                    error: function( error )
                    {

                         alert( "There's something wrong with update customers.Please contact Admin" );

                    }

              });

        }

        function delete_user(){

            $.ajax({

                    type        : "POST",
                    url         : siteurl +"customers/ajax/delete_user",
                 //   data        : {reference_id : reference_id},
                    dataType    : "json",
                    success     : function(result){

                            alert(result.message);
                    },
                    error: function( error )
                    {

                         alert( error );

                    }

            });
        }


      
        function send_email(){


              $('form#send_email_form').ajaxForm({

                 
                    url         : "<?php echo base_url()?>customers/ajax/send_email",
                    type        : "POST",
                    dataType    : "json",
                    beforeSubmit: function(){

                                    $(".send-email").addClass('disabled').html('Sending...');

                    },
                    success     : function(result){

                           if(result.status == true){

                                    $('.alert-email').html(result.message).addClass('alert alert-success').fadeIn();
                            setTimeout(function(){
                                    
                                    $('form#send_email_form').resetForm();
                                    $('.alert-email').fadeOut();
                                    $(".send-email").removeClass('disabled').html('Send');
                                    $("#modal_email").modal("hide");
                            },800);
                                  

                            }else{
                                    $('.alert-email').html(result.message).removeClass('alert alert-success').addClass('alert alert-danger').fadeIn();
                            setTimeout(function(){
                               
                                    $('.alert-email').html(result.message).fadeOut();
                                    $(".send-email").removeClass('disabled').html('Send');
                            },800);

                            }  
                          
                           
                    },
                    error: function( error )
                    {

                         $('.alert-email').html("Wrong Email !! Please check all email field. ").removeClass('alert alert-success').addClass('alert alert-danger').fadeIn();
                         setTimeout(function(){
                             $('.alert-email').fadeOut();
                             $(".send-email").removeClass('disabled').html('Send');
                        },1000);
                    }

              });
           
        }
  
         

  function open_modal(){

            $("#modal_email").modal('show');


  }

  function print_label(name,attn,address,phone,country) {
  $.ajax({
    url         : "<?php echo base_url()?>customers/ajax/print_label",
    data        : 'name='+name+'&attn='+attn+'&address='+address+'&phone='+phone+'&country='+country,
    type        : "POST",
    dataType    : "json",
    success     : function(result){
      window.open(result.redirect,'_blank');
    }
  });
  }

  function add_email(){
    var D = new Date();
    var elm = $("#target_to");

    var elm_id = D.getTime();


if(elm.find('input.form-control').length < 5) {
     elm.append( "<div class='input-group' id='target_to"+elm_id+"'><input id='to' placeholder='Input email'  name='to[]'  type='email'  class='form-control to' required ><span class='input-group-btn'><button class='btn btn-default' onClick='delete_target(\""+elm_id+"\")'>Delete</button><label id='to-error' class='error' for='to'></label></span></div>");
  }
  else{

      $("#message_email").html("add email cannot more than 5 textbox").fadeIn();
      setTimeout(function(){
        $("#message_email").fadeOut();
      },800);
      return false;
    }


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


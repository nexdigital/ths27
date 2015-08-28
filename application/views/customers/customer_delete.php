<style>
    .alert{
        padding: 5px;
    }

</style>

<div class="toolbar">
  <label>Are you sure want delete this record?</label>
</div>
 <form  id="delete_customer">  
  <input type="hidden" value="<?php echo $get_customers->reference_id ?>" id="Reference" class="form-control" name="reference" >  
    <div class="form-group">
            <label>Name<label class="readonly-filed">*</label></label>
            <input type="text"  value="<?php echo $get_customers->name ?>" id="name" class="form-control" name="name" readonly>
    </div>


  <div class="form-group">
            <label>Attn<label class="readonly-filed">*</label></label>
            <input type="text" value="<?php echo $get_customers->attn ?>" id="attn" class="form-control" name="attn" readonly>
    </div>

    <div class="form-group">
            <label>Email<label class="readonly-filed">*</label></label>
            <input type="text" value="<?php echo $get_customers->email ?>" id="email" class="form-control" name="email" readonly>
    </div>

     <div class="form-group">
            <label>Address<label class="readonly-filed">*</label></label>
            <input type="text" value="<?php echo $get_customers->address ?>" id="address" class="form-control" name="address" readonly>
    </div>

    <div class="form-group">
            <label>City<label class="readonly-filed">*</label></label>
            <input type="text" value="<?php echo $get_customers->city ?>" id="city" class="form-control" name="city" readonly>
    </div>

     <div class="form-group">
            <label>Country<label class="readonly-filed">*</label></label>
           <select class="form-control" id="country" name="country" readonly>
                                <option value=""></option>
                            <?php foreach ($this->tool_model->list_country() as $key => $value) { 
                                    echo "<option value='".$value->country_id."'>".$value->country_name."</option>";


                            } ?>
            </select>
    </div>

      <div class="form-group">
            <label>Pos Code<label class="readonly-filed">*</label></label>
            <input type="text" value="<?php echo $get_customers->pos_code ?>" id="pos_code" class="form-control" name="post_code" readonly>
    </div>

     <div class="form-group">
            <label>Phone<label class="readonly-filed">*</label></label>
            <input type="text" value="<?php echo $get_customers->phone ?>" id="phone" class="form-control" name="phone" readonly>
    </div>

     <div class="form-group">
            <label>Mobile<label class="readonly-filed">*</label></label>
           <input type="text" value="<?php echo $get_customers->mobile ?>" id="mobile" class="form-control" name="mobile" readonly>
    </div>

      <div class="form-group">
            <label>Fax<label class="readonly-filed">*</label></label>
            <input type="text" value="<?php echo $get_customers->fax ?>" id="fax" class="form-control" name="fax" readonly>
    </div>

      <div class="form-group">
            <label>Tax Class<label class="readonly-filed">*</label></label>
            <select class="form-control" id="tax_class"name="tax_class" readonly>

                                <option>-</option>
                                <option value="0">none</option>
                                    <?php foreach ($this->tool_model->get_tax() as $key => $value) {
                                          echo "<option value ='".$value->tax_id."'>".$value->tax_name."</option>";
                                      }
                                    ?>
            </select>

    </div>

      <div class="form-group">
            <label>Description<label class="readonly-filed">*</label></label>
             <textarea name="description" readonly id="description" class="form-control" style=" resize: none;"><?php echo $get_customers->description ?></textarea>
    </div>

     <div class="form-group">
          
            <input type="checkbox" readonly name="is_active" id="is_active" <?php echo ($get_customers->status_active == 'Active') ? 'checked="checked"' : ''?> disabled> <label for="is_active">Active</label>
    </div>

                <button class="btn btn-success" onclick="delete_user();">Yes</button>
                <button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url("customers/view_customer/".$get_customers->reference_id)?>')">Cancel</button>
                <label class="result-message"></label>

 </form>   



      


<div class="modal fade bs-example-modal-lg" id="modal_email" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Email Form</h4>
      </div>

  <form id="send_email_form">
      <div class="modal-body">  
           <div class="form-group">
                  <span class="">*</span> <label>To</label>
                  <input id="to"  name="to"  type="email"  class="form-control" readonly>
             
            </div>

              <div class="form-group">
                  <span class="">*</span> <label>Subject</label>
                  <input id="subject"  name="subject"  type="text"  class="form-control" readonly>
             
            </div>

        <div class="form-group">
               <span class="">*</span><label>Message</label>
               <textarea id="message" name="message" class="form-control" style="resize:none;" readonly></textarea>
                
        </div>
        <center><div class="alert-email"></div></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" onClick="send_email();">Send Email</button>
      </div>

    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->                   


 
    <script>
    

           

        $(document).ready(function(){
            
   
            var tax_class = "<?php echo $get_customers->tax_class ?>";  
            var payment_type = "<?php echo $get_customers->payment_type ?>"; 
            var country = "<?php echo $get_customers->country ?>";           

            $("#tax_class").val(tax_class);
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
                                  

                            }
                    },
                    error: function( error )
                    {

                         alert( error );

                    }

              });

        }

        function delete_user(){

            $('form#delete_customer').ajaxForm({

                 
                    url         : "<?php echo base_url()?>customers/ajax/delete_customer",
                    type        : "POST",
                    dataType    : "json",
                    success     : function(result){

                            //alert(result.message);
                            if(result.status == true){

                                    $('.result-message').html(result.message).addClass('alert alert-success').fadeIn();
                            setTimeout(function(){
                               
                                   setPage('<?php echo base_url() ?>customers/home');
                            },800);
                                  

                            }
                    },
                    error: function( error )
                    {

                         alert( error );

                    }

              });

        }

         


       
    </script>




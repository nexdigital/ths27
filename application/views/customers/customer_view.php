<style>
    .alert{
        padding: 5px;
    }

</style>

        <form  id="edit_customer">    
          
                    <table class="table table-striped">
    <tbody>
                <input type="hidden" value="<?php echo $get_customers->reference_id ?>" id="Reference" class="form-control" name="reference" >
                <tr>
                    <td>Name</td>
                    <td><input type="text" i value="<?php echo $get_customers->name ?>" id="name" class="form-control" name="name"></td> 

                </tr>


                <tr>
                    <td>Attn</td>
                    <td><input type="text" value="<?php echo $get_customers->attn ?>" id="attn" class="form-control" name="attn"></td> 

                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" value="<?php echo $get_customers->email ?>" id="email" class="form-control" name="email"></td>   

                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type="text" value="<?php echo $get_customers->address ?>" id="address" class="form-control" name="address"></td>   

                </tr>

                <tr>
                    <td>City</td>
                    <td><input type="text" value="<?php echo $get_customers->city ?>" id="city" class="form-control" name="city"></td> 

                </tr>
                <tr>
                    <td>Country</td>
                    <td>
                            <select class="form-control" id="country" name="country">
                                <option value=""></option>
                            <?php foreach ($this->tool_model->list_country() as $key => $value) { 
                                    echo "<option value='".$value->country_id."'>".$value->country_name."</option>";


                            } ?>
                        </select>

                    </td>   

                </tr>

                <tr>
                    <td>Pos Code</td>
                    <td><input type="text" value="<?php echo $get_customers->pos_code ?>" id="pos_code" class="form-control" name="post_code"></td>   

                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input type="text" value="<?php echo $get_customers->phone ?>" id="phone" class="form-control" name="phone"></td>   

                </tr>
                <tr>
                    <td>Mobile</td>
                    <td><input type="text" value="<?php echo $get_customers->mobile ?>" id="mobile" class="form-control" name="mobile"></td> 

                </tr>

                <tr>
                    <td>Fax</td>
                    <td><input type="text" value="<?php echo $get_customers->fax ?>" id="fax" class="form-control" name="fax"></td>   

                </tr>

                

            <tr>
                    <td>Tax Class</td>


                            <td>
                            <select class="form-control" id="tax_class"name="tax_class">

                                <option>-</option>
                                    <?php foreach ($this->tool_model->get_tax() as $key => $value) {
                                          echo "<option value ='".$value->tax_id."'>".$value->tax_name."</option>";
                                      }
                                    ?>
                                  </select>




                    </td>



                </tr>
                 <tr>
                    <td>Payment Type</td>
                  

                            <td>
                            <select class="form-control" id="payment_type" name="payment_type" id="payment_type">
                                    <option value="cash">Cash </option>
                                    <option value="transfer">Transfer</option>


                            </select>

                    </td>   

                   

                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" id="description" class="form-control" style=" resize: none;"><?php echo $get_customers->description ?></textarea>
                    </td>   

                </tr>

                 <tr>
                    <td>Status Active</td>
                    <td>   <input type="checkbox" name="is_active" id="is_active" <?php echo ($get_customers->status_active == 'Active') ? 'checked="checked"' : ''?>> <label for="is_active">Active</label></td> 

                </tr>





        </tbody>

       </table>
                                <button type="reset"   class="btn btn-info" onClick="open_modal()" id="show_modal"><i class="glyphicon glyphicon-envelope"></i> Email</button>
                               <button type="reset" class="btn btn-success" onClick="add_new();">Create New</button></a>    
                               <button class="btn btn-success btn_edit" onClick="edit_customer();"> Update</button>
                                <button type="reset" class="btn btn-success btn-submit"  onClick="setPage('<?php echo base_url('customers/delete_customer/'.$get_customers->reference_id)?>')">Delete</button>
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

  <form id="send_email_form">
      <div class="modal-body">  
           <div class="form-group">
                  <span class="">*</span> <label>To</label>
                  <input id="to"  name="to"  type="email"  class="form-control" required>
             
            </div>

              <div class="form-group">
                  <span class="">*</span> <label>Subject</label>
                  <input id="subject"  name="subject"  type="text"  class="form-control" required>
             
            </div>

        <div class="form-group">
               <span class="">*</span><label>Message</label>
               <textarea id="message" name="message" class="form-control" style="resize:none;" required></textarea>
                
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
            


            $('form#send_email_form').validate();
            $('#message').wysihtml5();
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


        function open_modal(){

            $("#modal_email").modal("show");


        }

        function send_email(){


              $('form#send_email_form').ajaxForm({

                 
                    url         : "<?php echo base_url()?>customers/ajax/send_email",
                    type        : "POST",
                    dataType    : "json",
                    success     : function(result){

                           if(result.status == true){

                                    $('.alert-email').html(result.message).addClass('alert alert-success').fadeIn();
                            setTimeout(function(){
                                    
                                   $('form#send_email_form').resetForm();
                                   $("#modal_email").modal("hide");
                            },800);
                                  

                            }else{
                                    $('.alert-email').html(result.message).removeClass('alert alert-success').addClass('alert alert-danger').fadeIn();
                            setTimeout(function(){
                               
                                     $('.alert-email').html(result.message).fadeOut();
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


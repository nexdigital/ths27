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
                                <a href="#" onClick="setPage('<?php echo base_url('customers/email')?>')"><button class="btn btn-primary btn_email"><i class="fa fa-envelope"></i> Email</button></a>
                                <button class="btn btn-success btn_edit"><i class="fa fa-pencil-square-o"></i> Edit</button>
                            
                                <button class="btn btn-danger btn_disable" onClick="delete_user();"><i class="fa fa-trash"></i> Disable</button>   
                                <label class="result-message"></label>
    </form>

                         


    <script>
    

           

        $(document).ready(function(){
            



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

               
            var tax_class = "<?php echo $get_customers->tax_class ?>";  
            var payment_type = "<?php echo $get_customers->payment_type ?>"; 
            var country = "<?php echo $get_customers->country ?>";           

            $("#tax_class").val(tax_class);
            $("#payment_type").val(payment_type);
            $("#country").val(country);
            


        });


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

         


       
    </script>


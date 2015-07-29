<style>
    .alert{
        padding: 5px;
    }

</style>

        <form  id="delete_customer">    
          
                    <table class="table table-striped">
    <tbody>
                <input type="hidden" value="<?php echo $get_customers->reference_id ?>" id="Reference" class="form-control" name="reference" >
                <tr>
                    <td>Name</td>
                    <td><input type="text" i value="<?php echo $get_customers->name ?>" id="name" class="form-control" name="name" readonly></td> 

                </tr>


                <tr>
                    <td>Attn</td>
                    <td><input type="text" value="<?php echo $get_customers->attn ?>" id="attn" class="form-control" name="attn" readonly></td> 

                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" value="<?php echo $get_customers->email ?>" id="email" class="form-control" name="email" readonly></td>   

                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type="text" value="<?php echo $get_customers->address ?>" id="address" class="form-control" name="address" readonly></td>   

                </tr>

                <tr>
                    <td>City</td>
                    <td><input type="text" value="<?php echo $get_customers->city ?>" id="city" class="form-control" name="city" readonly></td> 

                </tr>
                <tr>
                    <td>Country</td>
                    <td>
                            <select class="form-control" id="country" name="country" readonly>
                                <option value=""></option>
                            <?php foreach ($this->tool_model->list_country() as $key => $value) { 
                                    echo "<option value='".$value->country_id."'>".$value->country_name."</option>";


                            } ?>
                        </select>

                    </td>   

                </tr>

                <tr>
                    <td>Pos Code</td>
                    <td><input type="text" value="<?php echo $get_customers->pos_code ?>" id="pos_code" class="form-control" name="post_code" readonly></td>   

                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input type="text" value="<?php echo $get_customers->phone ?>" id="phone" class="form-control" name="phone" readonly> </td>   

                </tr>
                <tr>
                    <td>Mobile</td>
                    <td><input type="text" value="<?php echo $get_customers->mobile ?>" id="mobile" class="form-control" name="mobile" readonly></td> 

                </tr>

                <tr>
                    <td>Fax</td>
                    <td><input type="text" value="<?php echo $get_customers->fax ?>" id="fax" class="form-control" name="fax" readonly></td>   

                </tr>

                

            <tr>
                    <td>Tax Class</td>


                            <td>
                            <select class="form-control" id="tax_class"name="tax_class" readonly>

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
                            <select class="form-control" id="payment_type" name="payment_type" id="payment_type" readonly>
                                    <option value="cash">Cash </option>
                                    <option value="transfer">Transfer</option>


                            </select>

                    </td>   

                   

                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" id="description" class="form-control" style=" resize: none;" readonly><?php echo $get_customers->description ?></textarea>
                    </td>   

                </tr>

                 <tr>
                    <td>Status Active</td>
                    <td>   <input type="checkbox" readonly name="is_active" id="is_active" <?php echo ($get_customers->status_active == 'Active') ? 'checked="checked"' : ''?>> <label for="is_active">Active</label></td> 

                </tr>





        </tbody>

       </table>
                             <button class="btn btn-success" onclick="delete_user();">Yes</button>
							 <button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url("master/add_user_role/edit_form/".$get_customers->reference_id)?>')">Cancel</button>
                             <label class="result-message"></label>
    </form>

                         


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


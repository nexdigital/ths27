<style>

.well-primary {
color: rgb(255, 255, 255);
background-color: rgb(66, 139, 202);
border-color: rgb(53, 126, 189);
}
.glyphicon { margin-right:5px; }

</style>

    <div class="row">
        <div class="col-md-12">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="fa fa-user">
                            </span> View Profile</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table table-striped">
                                            <tbody>
                                                        <tr>
                                                            <td>Reference ID</td>
                                                            <td><input type="text" value="Reference Id" class="form-control" name="Reference" readonly></td>    
                                                        </tr>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td><input type="text" value="Name" class="form-control" name="Name" readonly></td> 

                                                        </tr>


                                                        <tr>
                                                            <td>Attn</td>
                                                            <td><input type="text" value="Attn" class="form-control" name="Attn" readonly></td> 

                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td><input type="text" value="Email" class="form-control" name="email" readonly></td>   

                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td><input type="text" value="Address" class="form-control" name="Address" readonly></td>   

                                                        </tr>

                                                        <tr>
                                                            <td>City</td>
                                                            <td><input type="text" value="City" class="form-control" name="City" readonly></td> 

                                                        </tr>
                                                        <tr>
                                                            <td>Country</td>
                                                            <td><input type="text" value="Country" class="form-control" name="Country" readonly></td>   

                                                        </tr>

                                                        <tr>
                                                            <td>Post Code</td>
                                                            <td><input type="text" value="Post Code" class="form-control" name="post_code" readonly></td>   

                                                        </tr>
                                                        <tr>
                                                            <td>Phone</td>
                                                            <td><input type="text" value="Phone" class="form-control" name="Phone" readonly></td>   

                                                        </tr>
                                                        <tr>
                                                            <td>Mobile</td>
                                                            <td><input type="text" value="Mobile" class="form-control" name="Mobile" readonly></td> 

                                                        </tr>

                                                        <tr>
                                                            <td>Fax</td>
                                                            <td><input type="text" value="Fax" class="form-control" name="Fax" readonly></td>   

                                                        </tr>

                                                        

                                                        <tr>
                                                            <td>Tax Class</td>
                                                          

                                                                    <td>
                                                                    <select class="form-control" name="status" disabled>
                                                                            <option>Non Regular</option>
                                                                            <option>Regular</option>


                                                                    </select>

                                                            </td>   

                                                           

                                                        </tr>

                                                         <tr>
                                                            <td>Payment Type</td>
                                                          

                                                                    <td>
                                                                    <select class="form-control" name="payment_type" disabled>
                                                                            <option>Cash </option>
                                                                            <option>Transfer</option>


                                                                    </select>

                                                            </td>   

                                                           

                                                        </tr>


                                                        <tr>
                                                            <td>Status</td>
                                                            <td>
                                                                    <select class="form-control" name="status" disabled>
                                                                            <option>Non Regular</option>
                                                                            <option>Regular</option>


                                                                    </select>

                                                            </td>   

                                                        </tr>

                                                        <tr>
                                                            <td>Group</td>
                                                            <td>
                                                                    <select class="form-control" id="group"name="status" disabled>
                                                                            <option>online shop</option>
                                                                            <option>tekstil</option>


                                                                    </select>

                                                            </td>   

                                                        </tr>

                                                        <tr>
                                                            <td>Description</td>
                                                            <td>
                                                                <textarea name="description" class="form-control" style=" resize: none;"></textarea>
                                                            </td>   

                                                        </tr>

                                                         <tr>
                                                            <td>Status Active</td>
                                                            <td><input type="text" value="Active" class="form-control"  name="Mobile" readonly></td> 

                                                        </tr>





                                                </tbody>

                                </table>
                                <a href="#" onClick="setPage('<?php echo base_url('customers/email')?>')"><button class="btn btn-primary btn_email"><i class="fa fa-envelope"></i> Email</button></a>
                                <button class="btn btn-success btn_edit"><i class="fa fa-pencil-square-o"></i> Edit</button>
                                <button class="btn btn-danger btn_disable"><i class="fa fa-trash"></i> Disable</button>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" class="sidebar-toggle" href="#collapseTwo"><span class="fa fa-line-chart">
                            </span> View Transaction</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">

                            <div class="form-group">
                                <div class="row">
                                       <div class="col-md-2">
                                             <input type="text" class="form-control" placeholder="hawb no">
                                    </div>

                                     <div class="col-md-4">
                                           <div class="input-group merged">
                       
                                              <span class="add-on"><i class="icon-calendar"></i></span><input class="form-control"type="text" name="selectdaterange" id="selectdaterange" placeholder="Search by Date"/>
                                             <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    </div>
                                    </div>
                                      
                                 </div>       
                             </div> 
                 

                            <table class="table table-bordered table-striped table-hovered">
                                    <thead>
                                            <th></th>
                                            <th>Hawb No</th>
                                            <th>shipper</th>
                                            <th>Consignee</th>
                                            <th>Dead Line</th>
                                            <th>Payment Status</th>
                                            <th>User Upload</th>
                                    </thead>
                                    <tbody>
                                            <tr>
                                            
                                            <td><input type="checkbox"></td>
                                            <td>123</td>
                                            <td>test</td>
                                            <td>test</td>
                                            <td>23 November 2015</td>
                                            <td>Paid</td>
                                            <td>user 1</td>
                                            </tr>   
                                    </tbody>




                            </table>   

                            <button class="btn btn-primary">Print</button>
                        
                        </div>
                    </div>
                </div>

                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" class="sidebar-toggle" href="#collapseThree"><span class="fa fa-line-chart">
                                            </span> View Payment History</a>
                                        </h4>
                                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">

                            <div class="form-group">
                                <div class="row">
                                       <div class="col-md-2">
                                             <input type="text" class="form-control" placeholder="Invoice No">
                                    </div>

                                     <div class="col-md-4">
                                           <div class="input-group merged">
                       
                                              <span class="add-on"><i class="icon-calendar"></i></span><input class="form-control"type="text" name="selectdaterange" id="selectdaterange2" placeholder="Search by Date"/>
                                             <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    </div>
                                    </div>
                                      
                                 </div>       
                             </div> 
                            <table class="table table-striped">
                                       <thead>
                                            <th></th>
                                            <th>Invoice No</th>
                                            <th>Hawb No</th>
                                            <th>Payment Date</th>
                                            <th>Payment Amount</th>
                                            <th>Payment Type</th>
                                            <th>User Upload</th>
                                    </thead>

                                    <tbody>
                                            <tr>
                                                 <td><input type="checkbox"></td>
                                                 <td>123</td>
                                                 <td>123</td>
                                                 <td>23 January 2015</td>
                                                 <td>12345</td>
                                                 <td>Cash</td> 
                                                 <td>user 12345</td>     
                                            </tr>

                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>

$(document).ready(function() {


            $('#group').select2();
            $('#selectdaterange,#selectdaterange2').daterangepicker();
            $('.btn_edit').click(function (){
                $('input[type="text"]').attr("readonly", false);
                $('input[type="text"]').attr("readonly", false);

            });

});
    </script>


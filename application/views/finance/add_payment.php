 <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">

                     <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Invoice Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="concept" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Hawb No</label>
                        <div class="col-sm-9">
                               <select class="form-control hawb_no" id="hawb_no">
                                        <option></option>
                                        <option>123</option>
                                        <option>345</option>

                               </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Customer</label>
                        <div class="col-sm-9">
                            <select class="form-control customer" id="customer">
                                        <option></option>
                                        <option>PT XYZ</option>
                                        <option>PT ACB</option>

                               </select>
                        </div>
                    </div> 
                  
                     <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Payment Type</label>
                        <div class="col-sm-9">
                             <input type="radio" name="type_payment" value="cash" id="cash"checked> Cash
                             <input type="radio" name="type_payment" value="transfer" id="transfer"> Transfer
                        </div>
                    </div>

                    <div class="form-group" style="display:none" id="bank_type">
                        <label for="amount" class="col-sm-3 control-label">Bank</label>
                        <div class="col-sm-9">
                            <select class="form-control bank" id="bank">
                                        <option></option>
                                        <option>BCA</option>
                                        <option>Mandiri</option>

                               </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">Currency</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="status" name="status">
                                <option>NT</option>
                                <option>Rupiah</option>
                                <option>Dollar</option>
                            </select>
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">Currency Rate</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="Rp.9000" readonly>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">Tax</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="status" name="status">
                                <option>None</option>
                                <option>1%</option>
                                <option>10%</option>
                                <option>20%</option>
                            </select>
                        </div>
                    </div>
                      <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Payment Amount</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="amount" name="amount">
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Total</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="amount" name="amount" readonly>
                        </div>
                    </div> 

                    
                    <div class="form-group" style="margin-left: 25%;">
                         <div class="col-sm-9">
                            <button type="button" class="btn btn-success">
                                <span class="glyphicon glyphicon-plus"></span> Add Payment
                            </button>
                             <button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>finance/home')">Cancel</button>
                        </div>
                    </div>

        

                </div>
            </div>            


    <script>
         $('.bank').select2({ placeholder: "Search Bank...", });
         $('#hawb_no').select2({ placeholder: "Search Hawb No...", });
         $('#customer').select2({ placeholder: "Search Customer...", });

          $('#transfer').click(function() {
            
                    $('#bank_type').fadeIn();
          });

           $('#cash').click(function() {
            
                    $('#bank_type').fadeOut();
          });
        
    </script>

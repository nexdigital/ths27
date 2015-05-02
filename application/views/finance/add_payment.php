 <style>
/***
Bootstrap Line Tabs by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
***/

/* Tabs panel */
.tabbable-panel {
  border:1px solid #eee;
  padding: 10px;
}

/* Default mode */
.tabbable-line > .nav-tabs {
  border: none;
  margin: 0px;
}
.tabbable-line > .nav-tabs > li {
  margin-right: 2px;
}
.tabbable-line > .nav-tabs > li > a {
  border: 0;
  margin-right: 0;
  color: #737373;
}
.tabbable-line > .nav-tabs > li > a > i {
  color: #a6a6a6;
}
.tabbable-line > .nav-tabs > li.open, .tabbable-line > .nav-tabs > li:hover {
  border-bottom: 4px solid #fbcdcf;
}
.tabbable-line > .nav-tabs > li.open > a, .tabbable-line > .nav-tabs > li:hover > a {
  border: 0;
  background: none !important;
  color: #333333;
}
.tabbable-line > .nav-tabs > li.open > a > i, .tabbable-line > .nav-tabs > li:hover > a > i {
  color: #a6a6a6;
}
.tabbable-line > .nav-tabs > li.open .dropdown-menu, .tabbable-line > .nav-tabs > li:hover .dropdown-menu {
  margin-top: 0px;
}
.tabbable-line > .nav-tabs > li.active {
  border-bottom: 4px solid #f3565d;
  position: relative;
}
.tabbable-line > .nav-tabs > li.active > a {
  border: 0;
  color: #333333;
}
.tabbable-line > .nav-tabs > li.active > a > i {
  color: #404040;
}
.tabbable-line > .tab-content {
  margin-top: -3px;
  background-color: #fff;
  border: 0;
  border-top: 1px solid #eee;
  padding: 15px 0;
}
.portlet .tabbable-line > .tab-content {
  padding-bottom: 0;
}

/* Below tabs mode */

.tabbable-line.tabs-below > .nav-tabs > li {
  border-top: 4px solid transparent;
}
.tabbable-line.tabs-below > .nav-tabs > li > a {
  margin-top: 0;
}
.tabbable-line.tabs-below > .nav-tabs > li:hover {
  border-bottom: 0;
  border-top: 4px solid #fbcdcf;
}
.tabbable-line.tabs-below > .nav-tabs > li.active {
  margin-bottom: -2px;
  border-bottom: 0;
  border-top: 4px solid #f3565d;
}
.tabbable-line.tabs-below > .tab-content {
  margin-top: -10px;
  border-top: 0;
  border-bottom: 1px solid #eee;
  padding-bottom: 15px;
}


 </style>

 <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">

                        <div class="tabbable-panel">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_default_1" data-toggle="tab">
                            Cash  </a>
                        </li>
                        <li>
                            <a href="#tab_default_2" data-toggle="tab">
                            Bank Transfer </a>
                        </li>
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                          <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Invoice Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="concept" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Hawb No</label>
                        <div class="col-sm-9">
                               <select class="form-control hawb_no" id="hawb">
                                        <option></option>
                                        <option>123</option>
                                        <option>345</option>

                               </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Customer</label>
                        <div class="col-sm-9">
                            <select class="form-control customer" id="customers">
                                        <option></option>
                                        <option>PT XYZ</option>
                                        <option>PT ACB</option>

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
                        <div class="tab-pane" id="tab_default_2">
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
                  
                   

                    <div class="form-group" id="bank_type">
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
                        <label for="status" class="col-sm-3 control-label">Cash on Type</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="status" name="status">
                                <option>-</option>
                                <option>Cash on hand IDR</option>
                                <option>Cash on hand NT</option>
                                <option>Cash on hand USD</option>
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
                </div>
            </div>
                     
        

                </div>
            </div>            


    <script>
         $('.bank').select2({ placeholder: "Search Bank...", });
         $('#hawb_no,#hawb').select2({ placeholder: "Search Hawb No...", });
         $('#customer,#customers').select2({ placeholder: "Search Customer...", });
         // $('#hawb').select2({ placeholder: "Search Hawb No...", });

          $('#transfer').click(function() {
            
                    $('#bank_type').fadeIn();
          });

           $('#cash').click(function() {
            
                    $('#bank_type').fadeOut();
          });
        
    </script>

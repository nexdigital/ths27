<div class="panel panel-default">


    <div class="panel-body form-horizontal user-form">
         <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Cashbook Type</label>
                        <div class="col-sm-9">
                             <input type="radio" name="cb_type" id="cash" checked> Cash 
                             <input type="radio" name="cb_type" id="bank"> Bank
                        </div>
          </div>
        <div class="cash"> 
           


           <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">CashBook Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="concept">
                        </div>
          </div>

            <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Currency</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="concept">
                        </div>
          </div>

          <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" style="resize:none">

                            </textarea>
                        </div>
          </div>

        </div>

         
         <!-- if type is transfer -->

         <div class="transfer" style="display:none">
           <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Bank Id</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="concept">
                        </div>
          </div>

          <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Bank Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="concept">
                        </div>
          </div>

              <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Account Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="concept">
                        </div>
          </div>

           <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Account Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="concept">
                        </div>
          </div>

          <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Bank Branch</label>
                        <div class="col-sm-9">
                           <select class="form-control" id="bank_branch">

                           <select>
                        </div>
          </div>

         


           
        </div>
        <div class="form-group">
                     <label for="concept" class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                           <button class="btn btn-success">Add Book</button>
                              <button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/bank/index')">Cancel</button>
                        </div>
          </div>

    
      

  </div>
</div>


 <script>
      $('#bank_branch').select2({ placeholder: "Search Bank...", });

      $('#bank').click(function() {
            
                    $('.transfer').fadeIn();
                    $('.cash').fadeOut();
      });

      $('#cash').click(function() {
                  
                    $('.transfer').fadeOut();
                    $('.cash').fadeIn();
      });

        

 </script>
<div class="panel panel-default">


  	<div class="panel-body form-horizontal user-form">

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
                        <label for="concept" class="col-sm-3 control-label">Swift Code</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="concept" name="concept">
                        </div>
          </div>

         
           <div class="form-group">
                     <label for="concept" class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                        	 <button class="btn btn-success">Add Tax</button>
                        	    <button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/bank/index_bank_branch')">Cancel</button>
                        </div>
          </div>
    
  		

	</div>
</div>


 <script>
 		$('.level').select2();

 </script>
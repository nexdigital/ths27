<div class="panel panel-default">


  	<div class="panel-body form-horizontal user-form">

           <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Tax Name</label>
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


            <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Tax base amount</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="concept" name="concept">
                        </div>
          </div>

          <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Tax rate</label>
                        <div class="col-sm-9">
                             <input type="email" class="form-control" id="concept" name="concept">
                        </div>
          </div>

           <div class="form-group">
                     <label for="concept" class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                        	 <button class="btn btn-success">Add Tax</button>
                        	    <button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/tax/index')">Cancel</button>
                        </div>
          </div>
    
  		

	</div>
</div>


 <script>
 		$('.level').select2();

 </script>
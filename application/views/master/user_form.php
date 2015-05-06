<div class="panel panel-default">


  	<div class="panel-body form-horizontal user-form">
  		 <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">User ID <label class="required-filed">*</label></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="concept" readonly>
                        </div>
          </div>

           <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Name <label class="required-filed">*</label></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="concept">
                        </div>
          </div>


           <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Password <label class="required-filed">*</label></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="Password" name="Password">
                        </div>
          </div>


            <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Email <label class="required-filed">*</label></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="concept" name="concept">
                        </div>
          </div>

          <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">User Level <label class="required-filed">*</label></label>
                        <div class="col-sm-9">
                        	<select class="form-control level">
	                            <option></option>
	                            <option>Finance</option>
	                            <option>Accouting</option>
	                            <option>Super User</option>
	                            <option>Admin</option>
                           </select>
                        </div>
          </div>

           <div class="form-group">
                     <label for="concept" class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                        	 <button class="btn btn-success">Add User</button>
                        	    <button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/user/index')">Cancel</button>
                        </div>
          </div>
    
  		

	</div>
</div>


 <script>
 		$('.level').select2();

 </script>
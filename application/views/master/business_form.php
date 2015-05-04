 <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">

                    <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Business Id</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="concept" readonly>
                        </div>
                    </div>
					 <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Business Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="concept">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Business Description</label>
                        <div class="col-sm-9">
                           <textarea class="form-control" style="resize:none">


                           </textarea>
                        </div>
                    </div>

                    <div class="form-group" style="margin-left:24%">
                       
                        <div class="col-sm-9">
                            <button class="btn btn-success">Add</button>
                             <button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/business')">Cancel</button>
                        </div>
                    </div>
                   
                </div>
  </div>
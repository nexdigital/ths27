 <div class="form-group">
                        <label>Airlines ID<label class="required-filed">*</label></label>
                      
                            <input type="text" class="form-control" id="concept" name="concept" readonly>
                      
  </div>

   <div class="form-group">
                        <label>Airlines Name<label class="required-filed">*</label></label>
                      
                            <input type="text" class="form-control" id="concept" name="concept" >
                      
          </div>

           <div class="form-group">
                        <label>Airlines Code<label class="required-filed">*</label></label>
                      
                            <input type="text" class="form-control" id="concept" name="concept" >
                      
          </div>

           <div class="form-group">
                        <label>Country <label class="required-filed">*</label></label>
                      
                         <select name="currency_to" class="form-control">
								<?php foreach ($list_country as $row) {
									echo '<option value="'.$row->country_id.'">'.$row->country_name.'</option>';
								} ?>
						</select>
                      
          </div>

          <div class="form-group">
                        <label>Description</label>
                      
                         <textarea class="form-control" required></textarea>
                      
          </div>

           <div class="form-group">
                <input type="checkbox">Active
                      
          </div>

            <div class="form-group">
               <button type="submit" class="btn btn-success submit" data-loading-text="Saving...">Submit</button>
					<button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('master/view/country/index')?>')">Cancel</button>
                      
          </div>


<script type="text/javascript">
	$(document).ready(function(){
		$('.datepicker').datepicker();
	})	
</script>
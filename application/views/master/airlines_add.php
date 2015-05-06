<!--<form id="form_country" method="post" action="<?php echo base_url('master/ajax/country/add')?>">
	<table class="table table-bordered table-striped">
		<tbody>
			<tr>
				<td width="150px">Airlines ID <label class="required-filed">*</label></td>
				<td><input type="text" name="country_id" class="form-control" required></td>
			</tr>
			<tr>
				<td width="150px">Airlines Name <label class="required-filed">*</label></td>
				<td><input type="text" name="country_name" class="form-control" required></td>
			</tr>
			<tr>
				<td>Airlines Code <label class="required-filed">*</label></td>
				<td><input type="text" name="currency_symbol" class="form-control" required></td>
			</tr>
			<tr>
				<td>Country <label class="required-filed">*</label></td>
				<td>
					<select name="currency_to" class="form-control">
						<?php foreach ($list_country as $row) {
							echo '<option value="'.$row->country_id.'">'.$row->country_name.'</option>';
						} ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Description</td>
				<td><textarea class="form-control" required></textarea></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="checkbox"> Active</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<button type="submit" class="btn btn-success submit" data-loading-text="Saving...">Submit</button>
					<button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('master/view/country/index')?>')">Cancel</button>
				</td>
			</tr>
		</tbody>
	</table>
</form>  -->

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
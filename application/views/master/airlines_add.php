<form id="form_country" method="post" action="<?php echo base_url('master/ajax/country/add')?>">
	<table class="table table-bordered table-striped">
		<tbody>
			<tr>
				<td width="150px">Airlines ID</td>
				<td><input type="text" name="country_id" class="form-control" required></td>
			</tr>
			<tr>
				<td width="150px">Airlines Name</td>
				<td><input type="text" name="country_name" class="form-control" required></td>
			</tr>
			<tr>
				<td>Airlines Code</td>
				<td><input type="text" name="currency_symbol" class="form-control" required></td>
			</tr>
			<tr>
				<td>Country</td>
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
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('.datepicker').datepicker();
	})	
</script>
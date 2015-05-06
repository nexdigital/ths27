<form id="form_country" method="post" action="<?php echo base_url('master/ajax/country/add')?>">
	<table class="table table-bordered table-striped">
		<tbody>
			<tr>
				<td width="150px">TOP ID <label class="required-filed">*</label></td>
				<td><input type="text" name="country_id" class="form-control" required></td>
			</tr>
			<tr>
				<td width="150px">TOP Name <label class="required-filed">*</label></td>
				<td><input type="text" name="country_name" class="form-control" required></td>
			</tr>
			<tr>
				<td>Currency Symbol <label class="required-filed">*</label></td>
				<td><input type="text" name="currency_symbol" class="form-control" required></td>
			</tr>
			<tr>
				<td>Due Days <label class="required-filed">*</label></td>
				<td><input type="text" name="currency_name" class="form-control datepicker" required></td>
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
					<button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('master/view/term_of_payment/index')?>')">Cancel</button>
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
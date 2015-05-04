<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="100px">&nbsp;</th>
			<th>TOP ID</th>
			<th>TOP Name</th>
			<th>Description</th>
			<th>Due Days</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<button class="btn btn-primary" title="Edit" onCLick="setPage(\''.base_url().'master/view/currency/edit\')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
				<button class="btn btn-primary" title="Delete" onCLick="alert(\'Deleted\')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			</td>
			<td>TOP ID</td>
			<td>TOP Name</td>
			<td>Description</td>
			<td>2015-04-13</td>
			<td>Active / Inactive</td>
		</tr>
	</tbody>
</table>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/term_of_payment/add'?>')">Add Term Of Payment</button>

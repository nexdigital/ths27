<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="100px">&nbsp;</th>
			<th>Airlines ID</th>
			<th>Name</th>
			<th>Code</th>
			<th>Country</th>
			<th>Status</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<button class="btn btn-primary" title="Edit" onCLick="setPage(\''.base_url().'master/view/currency/edit\')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
				<button class="btn btn-primary" title="Delete" onCLick="alert(\'Deleted\')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			</td>
			<th>Airlines ID</th>
			<th>Name</th>
			<th>Code</th>
			<th>Country</th>
			<th>Status</th>
			<th>Description</th>
		</tr>
	</tbody>
</table>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/airlines/add'?>')">Add Airlines</button>

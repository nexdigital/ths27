

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="50px">&nbsp;</th>
			<th>Bank Id</th>
			<th>Bank Name</th>
			<th>Description</th>
			<th>Swift Code</th>
			<th>Country</th>
			<th>Status</th>
			<th>Entry date</th>
			<th>Enty by</th>
		</tr>
	</thead>
	<tbody>
			<td>
				<button class="btn btn-primary" title="Delete" onCLick="alert('Deleted')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			</td>
			<td><a href="javascipr:;">Bank ID</a></td>
			<td>Loren Ipsum</td>
			<td>Loren Ipsum</td>
			<td>Loren Ipsum</td>
			<td>Loren Ipsum</td>
			<td>Loren Ipsum</td>
			<td>Loren Ipsum</td>
			<td>Loren Ipsum</td>
	</tbody>
</table>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/bank/bank_branch_form'?>')">Add Bank</button>
<button class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print to CSV</button>
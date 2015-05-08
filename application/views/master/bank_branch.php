<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Bank Id</th>
			<th>Bank Name</th>
			<th>Swift Code</th>
			<th>Description</th>
			<th>Status</th>
			<th>Entry date</th>
			<th>Enty by</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $row) {
			echo '
				<tr>
					<td><a href="javascript:;" onClick="setPage(\''.base_url('master/bank/details_bank_branch/'.$row->bank_id.'').'\')">'.$row->bank_id.'</a></td>
					<td>'.$row->bank_name.'</a></td>
					<td>'.$row->bank_swift_code.'</a></td>
					<td>'.$row->description.'</a></td>
					<td>'.$row->is_active.'</a></td>
					<td>'.$row->entry_date.'</a></td>
					<td>'.$row->entry_by.'</a></td>
				</tr>
			';
		}?>
	</tbody>
</table>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/bank/bank_branch_form'?>')">Add Bank</button>
<button class="btn btn-primary">Save to CSV</button>
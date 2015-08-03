<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Currency</th>
			<th>Rate</th>
			<th>Entry Date</th>
			<th>Entry By</th>
			<th>Update Date</th>
			<th>Update By</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($list_currency as $row){
		echo '
			<tr>
				<td><a href="javascript:;" onClick="setPage(\''.base_url().'master/view/currency/edit?id='.$row->exchange_rate_id.'\')">'.$row->exchange_rate_name.'</a></td>
				<td>'.number_format($row->exchange_rate_value).'</td>
				<td>'.$row->entry_date.'</td>
				<td>'.$row->entry_by.'</td>
				<td>'.$row->update_date.'</td>
				<td>'.$row->update_by.'</td>
			</tr>
		';
	}?>
	</tbody>
</table>
<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/currency/add'?>')">Add Currency</button>

<script>
$(document).ready( function () {
    $('table.table').DataTable();
});
</script>
<table class="table table-striped" id="table_currency">
	<thead>
		<tr>
			<th>Currency</th>
			<th>Rate</th>
			<th>Entry By</th>
			<th>Entry Date</th>
			<th>Modified By</th>
			<th>Modified Date</th>
			<th>Status</th>
			
		</tr>
	</thead>
	<tbody>
	<?php foreach($list_currency as $row){
		echo '
			<tr>
				<td><a href="javascript:;" onClick="setPage(\''.base_url().'master/view/currency/edit?id='.$row->exchange_rate_id.'\')">'.$row->exchange_rate_name.'</a></td>
				<td>Rp.'.number_format($row->exchange_rate_value).'</td>
				<td>'.$row->entry_by.'</td>
				<td>'.$row->entry_date.'</td>
				<td>'.$row->update_by.'</td>
				<td>'.$row->update_date.'</td>
				<td>'.$row->status.'</td>
			
			</tr>
		';
	}?>
	</tbody>
</table>
<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/currency/add'?>')">Add Currency</button>

<script>
$(document).ready( function () {
    $('#table_currency').DataTable();
});
</script>
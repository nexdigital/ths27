<table class="table table-striped">
	<thead>
		<tr>
			<th>Currency Id</th>
			<th>Currency type</th>
			<th>Created by</th>
			<th>Created date </th>
			<th>Update by </th>
			<th>Update date</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($list_currency_type as $row){
		echo '
			<tr>
				<td><a href="javascript:;">'.$row->currency_type_id.'</a></td>
				<td>'.$row->currency_type_name.'</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		';
	}?>
	</tbody>
</table>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/currency/add_type'?>')">Add Rate Type</button>
<button class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print to CSV</button>


<script>
	$(document).ready(function(){

			$('table.table').dataTable();

	});


</script>
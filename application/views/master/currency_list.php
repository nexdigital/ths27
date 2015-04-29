<div class="toolbar"><button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/currency/add'?>')">Add Currency</button></div>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Currency From</th>
			<th>Currency To</th>
			<th>Rate Type</th>
			<th>Rate Date</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($data as $row){
		echo '
			<tr>
				<td>'.$row->currency_from.'</td>
				<td>'.$row->currency_to.'</td>
				<td>'.$row->currency_type.'</td>
				<td>'.$row->currency_date.'</td>
			</tr>
		';
	}?>
	</tbody>
</table>
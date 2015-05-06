

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="50px">&nbsp;</th>
			<th>Currency From</th>
			<th>Currency To</th>
			<th>Rate Type</th>
			<th>Rate Date</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($list_currency as $row){
		echo '
			<tr>
				<td>
					<button class="btn btn-primary" title="Delete" onCLick="alert(\'Deleted\')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				</td>
				<td><a href="javascript:;">'.$row->currency_from.'</a></td>
				<td>'.$row->currency_to.'</td>
				<td>'.$row->currency_type.'</td>
				<td>'.$row->currency_date.'</td>
			</tr>
		';
	}?>
	</tbody>
</table>


	<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/currency/add'?>')">Add Currency Rate</button>
	<button class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print to CSV</button>

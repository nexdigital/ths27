<div class="toolbar">
	<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/currency/add'?>')">Add Currency Rate</button>
</div>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="100px">&nbsp;</th>
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
					<button class="btn btn-primary" title="Edit" onCLick="setPage(\''.base_url().'master/view/currency/edit\')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
					<button class="btn btn-primary" title="Delete" onCLick="alert(\'Deleted\')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				</td>
				<td>'.$row->currency_from.'</td>
				<td>'.$row->currency_to.'</td>
				<td>'.$row->currency_type.'</td>
				<td>'.$row->currency_date.'</td>
			</tr>
		';
	}?>
	</tbody>
</table>


<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="50px">&nbsp;</th>
			<th>Currency Id</th>
			<th>Currency Type</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($list_currency_type as $row){
		echo '
			<tr>
				<td>
					<button class="btn btn-primary" title="Delete" onCLick="alert(\'Deleted\')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				</td>
				<td><a href="javascript:;">'.$row->currency_type_id.'</a></td>
				<td>'.$row->currency_type_name.'</td>
			</tr>
		';
	}?>
	</tbody>
</table>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/currency/add_type'?>')">Add Rate Type</button>
<button class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print to CSV</button>

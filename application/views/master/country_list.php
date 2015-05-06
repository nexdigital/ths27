<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="60px">&nbsp;</th>
			<th>Country Name</th>
			<th width="20%">Currency Symbol</th>
			<th width="20%">Currency Name</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($data as $row){
		echo '
			<tr>
				<td>
					<button class="btn btn-primary" title="Delete" onCLick="alert(\'Deleted\')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				</td>
				<td><a href="javascript:;">'.$row->country_name.'</a></td>
				<td>'.$row->currency_symbol.'</td>
				<td>'.$row->currency_name.'</td>
			</tr>
		';
	}?>
	</tbody>
</table>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/country/add'?>')">Add Country</button>
<button class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print to CSV</button>
<div class="toolbar"><button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/country/add'?>')">Add Country</button></div>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Country Name</th>
			<th width="20%">Currency Symbol</th>
			<th width="20%">Currency Name</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($data as $row){
		echo '
			<tr>
				<td>'.$row->country_name.'</td>
				<td>'.$row->currency_symbol.'</td>
				<td>'.$row->currency_name.'</td>
			</tr>
		';
	}?>
	</tbody>
</table>
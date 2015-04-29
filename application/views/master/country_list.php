<div class="toolbar"><button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/country/add'?>')">Add Country</button></div>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Country Name</th>
			<th width="20%">Country Symbol</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($data as $row){
		echo '
			<tr>
				<td>'.$row->country_name.'</td>
				<td>'.$row->country_symbol.'</td>
			</tr>
		';
	}?>
	</tbody>
</table>
<table id='table_country' class="table table-striped">
	<thead>
		<tr>
			<th>Country Name</th>
			<th width="20%">Currency Symbol</th>
			<th width="20%">Currency Name</th>
			<th width="20%">Created By</th>
			<th width="20%">Status</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($data as $row){
		echo '
			<tr>
				<td><a href="javascript:;" onClick="setPage(\''.base_url('master/country/edit/'.$row->country_id.'').'\')">'.$row->country_name.'</a></td>
				<td>'.$row->currency_symbol.'</td>
				<td>'.$row->currency_name.'</td>
				<td>'.$row->created_by.'</td>
				<td>'.$row->is_active.'</td>
			</tr>
		';
	}?>
	</tbody>
</table>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/country/add'?>')">Add Country</button>
<button class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print to CSV</button>

<script>
$(document).ready( function () {
    $('#table_country').DataTable();
});



$("#delete").click(function(){

	alert('ad');
})


</script>
<table id='table_partner' class="table table-striped" style="width:100%">
	<thead>
		<tr>
			<th>Partner ID</th>
			<th>Partner Name</th>
			
		<!--<th>Address</th>
			<th>City</th> -->
			<th>Country</th>
		<!--	<th>Zipcode</th>-->
			<th>Telephone</th>
		
		<!--	<th>Description</th>-->
			<th>Entry By</th>
			<th>Entry Date</th>
			<th>Modified By</th>
			<th>Modified Date</th>
			<th>Status</th>	


		</tr>
	</thead>
	<tbody>

		<?php
				foreach ($get_partner as $key => $value) {
					echo '
							<tr>
							<td><a href="javascript:;" onClick="setPage(\''.base_url('master/partner/edit/'.$value->partner_id.'').'\')">'.$value->partner_id.'</a></td>
							<td>'.$value->company_name.'</td>
							<td>'.$value->country_name.'</td>
							<td>'.$value->telephone_number.'</td>
							<td>'.$value->entry_by.'</td>
							<td>'.$value->entry_date.'</td>
							<td>'.$value->update_by.'</td>
							<td>'.$value->update_date.'</td>
							<td>'.$value->is_active.'</td>
							</tr>

					';
				}
		 ?>

	</tbody>
</table>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/partner/add'?>')">Add Partner</button>


<script>
$(document).ready( function () {
    $('table#table_partner').DataTable();
});


</script>
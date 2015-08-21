<table id='table_partner' class="table table-striped" style="text-align:center">
	<thead>
		<tr>
			<th>Id</th>
			<th>Partner Name</th>
			<th widht="20%">Email</th>
		<!--<th>Address</th>
			<th>City</th> -->
			<th>Country</th>
		<!--	<th>Zipcode</th>-->
			<th>Telephone</th>
		
		<!--	<th>Description</th>-->
			<th>Created By</th>
			<th>Created Date</th>
			<th>Update By</th>
			<th>Update Date</th>
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
							<td widht="20%">'.$value->email.'</td>
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
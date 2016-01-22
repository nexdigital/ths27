<table id='table_business' class="table table-striped">
		<thead>
				
				<th>Business Id</th>
				<th>Business Name</th>
				<th>Description</th>
				<th>Created by</th>
				<th>Created Date</th>
				<th>Update by</th>
				<th>Update Date</th>
				<th>Status</th>

		</thead>

		<tbody>
			<?php foreach ($get_business as $key => $value) {
				echo '
					<tr>
						<td><a href="javascript:;" onClick="setPage(\''.base_url('master/business/edit_business/'.$value->business_id.'').'\')">'.$value->business_id.'</a></td>
						<td>'.$value->business_name.'</td>
						<td>'.$value->description.'</td>
						<td>'.$value->created_by.'</td>
						<td>'.$value->created_date.'</td>
						<td>'.$value->update_by.'</td>
						<td>'.$value->update_date.'</td>
						<td>'.$value->is_active.'</td>
					</tr>
				';

			}

			?>
		</tbody>



</table>
<a href="#" onClick="setPage('<?php echo base_url('master/business/add_business')?>')"><button class="btn btn-primary">Add Business</button></a> 
<button class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print to CSV</button>
  
<script>
$(document).ready( function () {
    $('#table_business').DataTable();
});


</script>
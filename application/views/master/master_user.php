<table id="table_user" class="table  table-striped table-hovered">
	<thead>
		
		<th>User Id</th>
		<th>Name</th>
		<th>Email</th>
		<th>Level</th>
		
		<th>Created by</th>
		<th>Created date</th>
		<th>Updated by</th>
		<th>Updated date</th>
		<th>Status</th>
		
		
	</thead>

	<tbody>
			
			<?php 
					foreach ($get_user as $key => $value) {
							
							echo '<tr>';
							//echo '<td>'.$value->user_id.'</td>';
							echo '<td><a href="javascript:;" onClick="setPage(\''.base_url('master/user/update/'.$value->user_id).'\')">'.$value->user_id.'</a></td>';
							echo '<td>'.$value->username.'</td>';
							echo '<td>'.$value->email.'</td>';
							echo '<td>'.$value->type.'</td>';
							
							echo '<td>'.$value->created_by.'</td>';
							echo '<td>'.$value->created_date.'</td>';
							echo '<td>'.$value->update_by.'</td>';
							echo '<td>'.$value->update_date.'</td>';
							echo '<td>'.$value->status.'</td>';
							echo '</tr>';	
					}


			?>
		
	</tbody>


</table>

<a href="#" onClick="setPage('<?php echo base_url('master/user/add_user')?>')"><button class="btn btn-primary">Add User</button></a> 
<button class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print to CSV</button>


<script>
		
		$(document).ready(function(){

				$("#table_user").dataTable();
		})
	

</script>
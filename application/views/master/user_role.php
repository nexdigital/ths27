<table id="table_user_role" class="table table-striped table-hovered">
		<thead>
				<th>Type</th>
				<th>Created by</th>
				<th>Created date</th>
				<th>Update by</th>
				<th>Update date</th>
				<th>Status</th>
		</thead>

		<tbody>

			<?php  


				foreach ($get_type as $key => $value) {
							echo "<tr>";	
							echo '<td><a href="javascript:;" onClick="setPage(\''.base_url('master/add_user_role/edit_form/'.$value->id_type).'\')">'.$value->type.'</a></td>';
							echo "<td>".$value->created_by."</td>";	
							echo "<td>".$value->created_date."</td>";	
							echo "<td>".$value->update_by."</td>";	
							echo "<td>".$value->update_date."</td>";
							echo "<td>".$value->status."</td>";	
							echo "</tr>";		
				}



			 ?>
		</tbody>



</table>

<a href="#" onClick="setPage('<?php echo base_url('master/add_user_role/add_form')?>')"><button class="btn btn-primary">Add Role</button></a> 
<button class="btn btn-primary">Print CSV</button>

<script>	

	$("#table_user_role").dataTable();

</script>
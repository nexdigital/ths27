<table  class="table table-bordered table-striped table-hovered">
	<thead>
		<th width="50px">&nbsp;</th>
		<th>User Id</th>
		<th>Name</th>
		<th>Email</th>
		<th>Level</th>
		<th>Entry date</th>
		<th>Entry by</th>
		
		
	</thead>

	<tbody>
		<td>
			<button class="btn btn-primary" title="Delete" onCLick="alert('Deleted')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
		</td>
		<td><a href="javascipr:;">ID</a></td>
		<td>User 2</td>
		<td>user2@gmail.com</td>
		<td>Super User</td>
		<td>23 January 2015</td>
		<td>User 1</td>
		
	</tbody>


</table>

<a href="#" onClick="setPage('<?php echo base_url('master/user/add_user')?>')"><button class="btn btn-primary">Add User</button></a> 
<button class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print to CSV</button>
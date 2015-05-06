<table class="table table-bordered table-striped table-hovered">
		<thead>
				<th width="50px">&nbsp;</th>
				<th>Business Id</th>
				<th>Business Name</th>
				<th>Business Description</th>
				<th>Entry date</th>
				<th>Entry by</th>

		</thead>

		<tbody>
			<tr>
				<td>
					<button class="btn btn-primary" title="Delete" onCLick="alert('Deleted')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				</td>
				<td><a href="javascipr:;">ID</a></td>
				<td>Online Shop</td>
				<td>Loren Ipsum</td>
				<td>23 November 2015</td>
				<td>user 1</td>
				
			</tr>

		</tbody>



</table>
<a href="#" onClick="setPage('<?php echo base_url('master/add_business')?>')"><button class="btn btn-primary">Add Business</button></a> 
<button class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print to CSV</button>
  
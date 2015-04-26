<div class="toolbar"><button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/currency/add'?>')">Add Currency</button></div>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="100px">Currency</th>
			<th>Type</th>
			<th>Exhange Rate</th>
			<th>Last Update</th>
		</tr>
	</thead>
	<tbody>
	<?php $no=1; foreach($data as $row){
		$rowspan = ($no == 1) ? 'rowspan="2"' : '';
		echo '<tr>';
		
		if($no == 1) { 
			echo '<td '.$rowspan.$no.'>
				<div class="btn-group">
				  <button type="button" class="btn btn-default btn-sm">'.$row->currency_name.'</button>
				  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height:30px;">
				    <span class="caret"></span>
				    <span class="sr-only">Toggle Dropdown</span>
				  </button>
				  <ul class="dropdown-menu" role="menu">
				    <li><a href="#" class="select-edit" currency_name="'.$row->currency_name.'" currency_type="'.$row->currency_type.'">Edit</a></li>
				    <li><a href="#" class="select-delete" currency_name="'.$row->currency_name.'" currency_type="'.$row->currency_type.'">Delete</a></li>
				  </ul>
				</div>
			</td>';
		}
		
		echo '<td>'.$row->currency_type.'</td>
				<td>'.number_format($row->currency_value).'</td>
				<td>'.$row->modified_date.'</td>
			</tr>
		';
		$no++;
		if($no == 3) $no = 1;
	}?>
	</tbody>
</table>
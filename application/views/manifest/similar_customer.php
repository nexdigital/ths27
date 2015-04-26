<table class="table table-bordered border-striped">
	<thead>
		<tr>
			<th>Reference ID</th>
			<th>Name</th>
			<th>Attn</th>
			<th>Address</th>
			<th>City</th>
			<th>Country</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data_similar as $row) {
			echo '
				<tr>
					<td><button type="button" class="btn btn-default btn-sm select-similar">'.$row->reference_id.'</button></td>
					<td>'.$row->name.'</td>
					<td>'.$row->attn.'</td>
					<td>'.$row->address.'</td>
					<td>'.$row->city.'</td>
					<td>'.$row->country.'</td>
				</tr>
			';
		} ?>
	</tbody>
</table>
<div class="btn-group" role="group">
  <button type="button" class="btn btn-success" onCLick="setPage('<?php echo base_url().'manifest/view/verification_details?mawb_no='.urlencode($data->mawb_no); ?>')"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back</button>
</div>
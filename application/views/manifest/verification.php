<table class="table table-bordered table-striped table-hovered">
	<thead>
		<tr>
			<th>Mawb No</th>
			<th>Filename</th>
			<th>Upload Date</th>
			<th>Upload By</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $row) {
			echo '
			<tr>
				<td><a href="javascript:;" onClick="setPage(\''.base_url().'manifest/view/verification_details?mawb_no='.urlencode($row->mawb_no).'\')">'.$row->mawb_no.'</td>
				<td>'.$row->file_name.'</td>
				<td>'.$row->created_date.'</td>
				<td>'.$row->user_id.'</td>
			</tr>
			';
		} ?>
	</tbody>
</table>
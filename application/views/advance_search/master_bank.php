<?php foreach($data as $row) {
	echo '
		<tr>
			<td><a href="javascript:;" onClick="setPage(\''.base_url('master/bank/edit_bank_branch/'.$row->bank_id.'').'\')">'.$row->bank_id.'</a></td>
			<td>'.$row->bank_name.'</a></td>
			<td>'.$row->bank_swift_code.'</a></td>
			<td>'.$this->master_country->get_by_country_id($row->country_id)->country_name.'</a></td>
			<td>'.$row->description.'</a></td>
			<td>'.$row->is_active.'</a></td>
			<td>'.$row->entry_date.'</a></td>
			<td>'.$row->entry_by.'</a></td>
			<td>'.$row->update_date.'</a></td>
			<td>'.$row->update_by.'</a></td>
		</tr>
	';
}?>
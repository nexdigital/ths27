
<div class="toolbar">
  <table>
    <tr>
      <td>
        <input type="text" class="form-control sumoselect" placeholder="Bank ID">
      </td>
      <td>
          <select class="form-control sumoselect" multiple="" placeholder="Select Country">
          	<?php foreach ($list_country as $row) {
          		echo '<option value="'.$row->country_id.'">'.$row->country_name.'</option>';
          	}?>
          </select>
      </td>
      <td>
        <input type="text" class="form-control sumoselect" placeholder="Search Name">
      </td>
      <td>
        <button class="btn btn-success" id="submit">Submit</button>
      </td>
    </tr>
  </table>
</div>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Bank Id</th>
			<th>Bank Name</th>
			<th>Swift Code</th>
			<th>Country</th>
			<th>Description</th>
			<th>Status</th>
			<th>Entry date</th>
			<th>Enty by</th>
			<th>Update date</th>
			<th>Update by</th>
		</tr>
	</thead>
	<tbody>
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
	</tbody>
</table>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/bank/bank_branch_form'?>')">Add Bank</button>
<button class="btn btn-primary">Save to CSV</button>

<script type="text/javascript">
$(document).ready(function(){
  $('select.sumoselect').SumoSelect();
});
</script>
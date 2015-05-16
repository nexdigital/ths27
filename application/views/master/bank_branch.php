<div class="toolbar">
  <table>
    <tr>
      <td>
        <strong>Bank ID</strong><br/>
        <input type="text" id="bank_id" class="form-control sumoselect" placeholder="Bank ID" value="<?php echo $this->session->userdata('master_bank_bank_id')?>">
      </td>
      <td>
          <strong>Country</strong><br/>
          <select id="country" class="form-control sumoselect" multiple="" placeholder="Select Country">
          	<?php foreach ($list_country as $row) {
              $selected = (in_array($row->country_id,$this->session->userdata('master_bank_country'))) ? 'selected="selected"' : '';
          		echo '<option value="'.$row->country_id.'" '.$selected.'>'.$row->country_name.'</option>';
          	}?>
          </select>
      </td>
      <td>
        <strong>Bank Name</strong><br/>
        <input type="text" id="bank_name" class="form-control sumoselect" placeholder="Search Name" value="<?php echo $this->session->userdata('master_bank_bank_id')?>">
      </td>
      <td>
        <strong>Limit</strong><br/>
        <select id="limit" class="form-control sumoselect">
          <option value="50" <?php if($this->session->userdata('master_bank_limit') == 50) echo 'selected="selected"'?>>50</option>
          <option value="100" <?php if($this->session->userdata('master_bank_limit') == 100) echo 'selected="selected"'?>>100</option>
          <option value="250" <?php if($this->session->userdata('master_bank_limit') == 250) echo 'selected="selected"'?>>250</option>
          <option value="500" <?php if($this->session->userdata('master_bank_limit') == 500) echo 'selected="selected"'?>>500</option>
        </select>
      </td>
      <td>
        <strong>&nbsp;</strong><br/>
        <button class="btn btn-success" id="search_submit">Submit</button>
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
	<tbody id="data_master_bank"></tbody>
</table>

<div class="pagination_box"></div>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/bank/bank_branch_form'?>')">Add Bank</button>
<button class="btn btn-primary">Save to CSV</button>
<script type="text/javascript">

var page = 1;
$(document).ready(function(){
  $('select.sumoselect').SumoSelect();
  search_advance();
  $('#search_submit').click(function(){
    page = 1;
	  search_advance();
  })
})

function gotopage(i) {
    page = i;
    search_advance();  
}
function search_advance(){
  //$('#data_master_bank, .pagination_box').html('');
  $.post('<?php echo base_url('master/server/master_bank') ?>',
	{
		'bank_id':$('#bank_id').val(),
		'country':$('#country').val(),
		'bank_name':$('#bank_name').val(),
    'limit':$('#limit').val(),
    'page':page
	},function(data){
		data = JSON.parse(data);
		$('#data_master_bank').html(data.data);
    $('.pagination_box').html(data.paging);
    return false;
	})
}
</script>
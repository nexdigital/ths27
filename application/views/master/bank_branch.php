
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom:30px;">
 
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo" style="background-color:#3c8dbc">
      <h4 class="panel-title">
        <a class="collapsed" style="color:white" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <span class="glyphicon glyphicon-search"></span> Advance Search
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
       <table class="table">
    <tr>
      <td>
        <strong>Bank ID</strong><br/>
        <input type="text" id="bank_id" class="form-control input-sumoselect" value="<?php echo $this->session->userdata('master_bank_bank_id')?>">
      </td>
      <td>
        <strong>Bank Name</strong><br/>
        <input type="text" id="bank_name" class="form-control input-sumoselect" value="<?php echo $this->session->userdata('master_bank_bank_id')?>">
      </td>
    </tr>
    <tr>
      <td>
          <strong>Country</strong><br/>
          <select id="country" class="form-control sumoselect" multiple="">
            <?php foreach ($list_country as $row) {
              $selected = (in_array($row->country_id,$this->session->userdata('master_bank_country'))) ? 'selected="selected"' : '';
              echo '<option value="'.$row->country_id.'" '.$selected.'>'.$row->country_name.'</option>';
            }?>
          </select>
      </td>
      <td>
        <strong>Swift Code</strong><br/>
        <input type="text" id="swift_code" class="form-control input-sumoselect" value="<?php echo $this->session->userdata('master_bank_swift_code')?>">
      </td>
    </tr>
    <tr>
      <td>
        <strong>Entry Date</strong><br/>
        <div class="input-daterange">
          <input type="text" id="entry_date_start" class="form-control input-sumoselect"/>
          <span class="add-on" style="height:30px; line-height:24px;">to</span>
          <input type="text" id="entry_date_end" class="form-control input-sumoselect"/>
        </div>        
      </td>
      <td>
        <strong>Entry By</strong><br/>
        <input type="text" class="form-control input-sumoselect" id="entry_by" value="<?php echo $this->session->userdata('master_bank_entry_by')?>">
      </td>
    </tr>
    <tr>
      <td>
        <strong>Update Date</strong><br/>
        <div class="input-daterange">
          <input type="text" id="update_date_start" class="form-control input-sumoselect"/>
          <span class="add-on" style="height:30px; line-height:24px;">to</span>
          <input type="text" id="update_date_end" class="form-control input-sumoselect"/>
        </div>        
      </td>
      <td>
        <strong>Update By</strong><br/>
        <input type="text" class="form-control input-sumoselect" id="update_by" value="<?php echo $this->session->userdata('master_bank_update_by')?>">
      </td>
    </tr>
    <tr>
      <td>
        <strong>Limit</strong><br/>
        <select id="limit" class="form-control" style="width:200px;">
          <option value="50" <?php if($this->session->userdata('master_bank_limit') == 50) echo 'selected="selected"'?>>50</option>
          <option value="100" <?php if($this->session->userdata('master_bank_limit') == 100) echo 'selected="selected"'?>>100</option>
          <option value="250" <?php if($this->session->userdata('master_bank_limit') == 250) echo 'selected="selected"'?>>250</option>
          <option value="500" <?php if($this->session->userdata('master_bank_limit') == 500) echo 'selected="selected"'?>>500</option>
        </select>
      </td>
      <td>
        <strong>&nbsp;</strong><br/>
      </td>
    </tr>
    <tr>      
      <td>
        <strong>&nbsp;</strong><br/>
        <button class="btn btn-success" id="search_submit">Search</button>
      </td>
      <td>
        <strong>&nbsp;</strong><br/>
      </td>
    </tr>
  </table>
      </div>
    </div>
  </div>
  
</div>


<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th class="sort" field="bank_id">Bank Id</th>
			<th class="sort" field="bank_name">Bank Name</th>
			<th class="sort" field="bank_swift_code">Swift Code</th>
			<th class="sort" field="country_id">Country</th>
			<th class="sort" field="description">Description</th>
			<th class="sort" field="status">Status</th>
			<th class="sort" field="entry_date">Entry date</th>
			<th class="sort" field="entry_by">Enty by</th>
			<th class="sort" field="update_date">Update date</th>
			<th class="sort" field="update_by">Update by</th>
		</tr>
	</thead>
	<tbody id="data_master_bank"></tbody>
</table>

<div class="pagination_box"></div>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/bank/bank_branch_form'?>')">Add Bank</button>
<button class="btn btn-primary">Save to CSV</button>
<script type="text/javascript">

var page = 1;
var sort_by = 'bank_id';
var sort_order = 'desc';

$(document).ready(function(){
  $('select.sumoselect').SumoSelect();
  $('.input-daterange').datepicker({ format: 'yyyy-mm-dd' });
  search_advance();
  $('#search_submit').click(function(){
    page = 1;
	  search_advance();
  })

  $('th.sort').click(function(){
    $('.table thead tr th').removeClass('sort-asc').removeClass('sort-desc');

    sort_by = $(this).attr('field');
    var sort = $(this).attr('sort');
    if(sort == undefined) {
      $(this).attr('sort','asc');
      $(this).addClass('sort-asc').removeClass('sort-desc');
      sort_order = 'asc';
    } else if(sort == 'asc') {
      $(this).attr('sort','desc');
      $(this).addClass('sort-desc').removeClass('sort-asc');
      sort_order = 'desc';      
    } else {
      $(this).attr('sort','asc');
      $(this).addClass('sort-asc').removeClass('sort-desc');
      sort_order = 'asc';
    }
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
    'swift_code':$('#swift_code').val(),
    'entry_date_start':$('#entry_date_start').val(),
    'entry_date_end':$('#entry_date_end').val(),
    'entry_by':$('#entry_by').val(),
    'update_date_end':$('#update_date_end').val(),
    'update_by':$('#update_by').val(),
    'limit':$('#limit').val(),
    'sort_by':sort_by,
    'sort_order':sort_order,
    'page':page
	},function(data){
		data = JSON.parse(data);
		$('#data_master_bank').html(data.data);
    $('.pagination_box').html(data.paging);
    return false;
	})
}
</script>
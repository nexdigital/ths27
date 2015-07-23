<div class="col-lg-6 col-md-12 col-xs-12">
	<div class="panel panel-danger">
	  <div class="panel-heading">Deadlines</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>	
				<th>No.</th>
				<th>Hawb No</th>
				<th>Shipper</th>
				<th>Consignee</th>
				<th>Deadline</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$no = 1;
				foreach($deadline->result() as $row) {
					echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row->hawb_no.'</td>
							<td>'.$row->shipper.'</td>
							<td>'.$row->consignee.'</td>
							<td>'.$row->deadline.'</td>
						</tr>
					';
					$no++;
				}
			?>
		</tbody>
	</table>
</div>
<div class="col-lg-6 col-md-12 col-xs-12">
	<div class="panel panel-info">
	  <div class="panel-heading">New Manifest Uploaded</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Mawb No</th>
				<th>Filename</th>
				<th>Upload Date</th>
				<th>Upload By</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($new_manifest as $row) {
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
</div>
<div class="col-lg-12 col-md-12 col-xs-12" style="margin-top:30px;">
	<div class="panel panel-primary">
	  <div class="panel-heading">Charts</div>
	</div>
	<div class="toolbar" style="display:none;">
		<table>
			<tr>
				<td>
					<select class="sumoselect" placeholder="Select Type" name="type_data">
					    <option value="column">Column</option>
					    <option value="pie">Pie</option>
					</select>
				</td>
				<td>
					<select class="sumoselect" placeholder="Sorting By">
					    <option value="total_kg">Total KG</option>
					    <option value="total_transaction">Total Transaction</option>
					</select>
				</td>
				<td>
					<select class="sumoselect" placeholder="Sorting By">
					    <option value="asc">Lower to Higher</option>
					    <option value="desc">Higher to Lower</option>
					</select>
				</td>
				<td>
					<select class="sumoselect" placeholder="Limit">
					    <option value="50">50</option>
					    <option value="100">100</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="sandbox-container"><div class="input-daterange input-group" id="datepicker">
					    <input type="text" class="input-lg form-control input-sumoselect" name="start_date" placeholder="Start date">
					    <span class="input-group-addon">to</span>
					    <input type="text" class="input-lg form-control input-sumoselect" name="end_date" placeholder="End date">
					</div></div>
				</td>
			</tr>
			<tr>
				<td>
					<button class="btn btn-success" id="submit">Submit</button>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-lg-12 charts-container" style="padding-top:15px; border-top:1px solid #c2c2c2; height:430px; background-color:#e2e2e2;"></div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('table.table').dataTable();

	$('select.sumoselect').SumoSelect();
	$('#sandbox-container .input-daterange').datepicker({
	    format: "yyyy-mm-dd"
	})
	$('button#submit').click(function(){
		$.get('<?php echo base_url() ?>manifest/get/master_data',{'data_type':'','status':'','start_date':'','end_date':''},function(data){
			alert(data);
		})
	})

	$.get('<?php echo base_url() ?>master/charts',{'chart':'column','sort_by':'total_kg','sort_order':'desc','limit':'50'},function(data){
		$('.charts-container').html(data);
	})
})
</script>
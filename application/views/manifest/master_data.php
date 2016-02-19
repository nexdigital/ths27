<table id="table_data" class="table table-striped">
	<thead>
		<tr>
			<th width="15%">Hawb No</th>
			<th width="35%">Shipper</th>
			<th width="35%">Consignee</th>
			<th width="10%">Type</th>
			<th width="10%">Status</th>
			<th width="10%">Created Date</th>
			<th width="10%">Created By</th>
			<th width="10%">Last Updated</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$query = $this->db->query("select * from manifest_data_table where lower(status) in ('verified','hold','success','finish')");
			foreach($query->result() as $row) {
				$shipper = $this->db->query("select * from customer_table where reference_id = '".$row->shipper."'");
				$consignee = $this->db->query("select * from customer_table where reference_id = '".$row->consignee."'");
				echo '
					<tr>
						<td>
							<!-- Split button -->
							<div class="btn-group">
							  <button type="button" class="btn btn-default btn-sm" onCLick="setPage(\''.base_url('manifest/view/details?hawb_no='.$row->hawb_no).'\')">'.$row->hawb_no.'</button>
							  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height:30px;">
							    <span class="caret"></span>
							    <span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
							    <li><a href="javascript:;" onCLick="setPage(\''.base_url('manifest/view/details?hawb_no='.$row->hawb_no).'\')">Details</a></li>
							    <li class="hidden"><a href="javascript:;">Payment</a></li>
							  </ul>
							</div>
						</td>
						<td>'.$shipper->row('name').'</td>
						<td>'.$consignee->row('name').'</td>
						<td>'.$row->manifest_type.'</td>
						<td>'.$row->status.'</td>
						<td>'.$row->created_date.'</td>
						<td>'.$row->user_id.'</td>
						<td>'.$row->last_update.'</td>
					</tr>
				';
			}
		?>
	</tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){

	$("#table_data").DataTable();	
	$('select.sumoselect').SumoSelect();
	$('#sandbox-container .input-daterange').datepicker({
	    format: "yyyy-mm-dd"
	})
	// $('button#submit').click(function(){
	// 	$.get('<?php echo base_url() ?>manifest/get/master_data',{'data_type':'','status':'','start_date':'','end_date':''},function(data){
	// 		alert(data);
	// 	})
	// })
})
</script>
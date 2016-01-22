<h3>Unverified File</h3>
<table id="table_verification" class="table table-striped">
	<thead>
		<tr>
			<th>Mawb No</th>
			<th>Filename</th>
			<th>Upload Date</th>
			<th>Upload By</th>
			<th>Last Update</th>
			<th>Update By</th>
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
				<td>'.$row->last_update.'</td>
				<td>'.$row->update_by.'</td>
			</tr>
			';
		} ?>
	</tbody>
</table>
<hr/>
<h3>List Hold Data</h3>
<table id="table_ver_detail" class="table table-striped">
	<thead>
		<tr>
			<th width="20%;">Hawb No</th>
			<th width="30%;">Shipper</th>
			<th width="30%;">Consignee</th>
			<th>Pp</th>
			<th>Cc</th>
			<th>Pkg</th>
			<th>Pcs</th>
			<th>Kg</th>
			<th>Desc</th>
			<th>Remarks</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data_hold as $row) {
			$total_similar_shipper = ($this->manifest_model->get_similar_customer($row->hawb_no,'shipper')) ? count($this->manifest_model->get_similar_customer($row->hawb_no,'shipper')) : 0;
			$total_similar_consignee = ($this->manifest_model->get_similar_customer($row->hawb_no,'consignee')) ? count($this->manifest_model->get_similar_customer($row->hawb_no,'consignee')) : 0;

			echo '
			<tr>
				<td text-align="center">
					<!-- Split button -->
					<div class="btn-group">
					  <button type="button" class="btn btn-default btn-sm">'.$row->hawb_no.'</button>
					  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height:30px;">
					    <span class="caret"></span>
					    <span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <ul class="dropdown-menu" role="menu">
					    <li><a href="#" class="select-verified" hawb_no="'.$row->hawb_no.'" onCLick="verifiedHost(\''.$row->hawb_no.'\')">Verified</a></li>
					    <li><a href="#" class="select-hold" hawb_no="'.$row->hawb_no.'" onCLick="rejectHost(\''.$row->hawb_no.'\')">Reject</a></li>
					  </ul>
					</div>
				</td>
				<td class="shipper-'.$row->hawb_no.'">';
					if($this->customers_model->get_by_id($row->shipper) == false) {
						echo '
							<div class="customer-details-unverified">'.$row->shipper.'</div>
							<div class="btn-group" role="group" aria-label="...">';
						echo ($total_similar_shipper) ? '<button type="button" class="btn btn-xs btn-success" onClick="setPage(\''.base_url().'manifest/view/similar_question?hawb_no='.$row->hawb_no.'&customer_type=shipper\')">Similar ['.$total_similar_shipper.']</button>' : '';
						echo '<button type="button" class="btn btn-xs btn-primary" onClick="setPage(\''.base_url('customers/add_customer?hawb_no='.$row->hawb_no.'&customer_type=shipper').'\')">Add Customer</button>
							</div>';
					} else {
						$shipper = $this->customers_model->get_by_id($row->shipper);
						echo '<div class="customer-details-unverified">'.$shipper->name .'<br/>'.$shipper->address.'<br/>'.$shipper->phone.'</div>';
					}
				echo '
				</td>
				<td class="consignee-'.$row->hawb_no.'">';
					if($this->customers_model->get_by_id($row->consignee) == false) {
						echo '
							<div class="customer-details-unverified">'.$row->consignee.'</div>
							<div class="btn-group" role="group" aria-label="...">';
						echo ($total_similar_consignee) ? '<button type="button" class="btn btn-xs btn-success" onClick="setPage(\''.base_url().'manifest/view/similar_question?hawb_no='.$row->hawb_no.'&customer_type=consignee\')">Similar ['.$total_similar_consignee.']</button>' : '';
						echo '<button type="button" class="btn btn-xs btn-primary" onClick="setPage(\''.base_url('customers/add_customer?hawb_no='.$row->hawb_no.'&customer_type=consignee').'\')">Add Customer</button>
							</div>';
					} else {
						$consignee = $this->customers_model->get_by_id($row->consignee);
						echo '<div class="customer-details-unverified">'.$consignee->name .'<br/>'.$consignee->address.'<br/>'.$consignee->phone.'</div>';
					}
				echo '
				</td>
				<td>'.$row->prepaid.'</td>
				<td>'.$row->collect.'</td>
				<td>'.$row->pkg.'</td>
				<td>'.$row->pcs.'</td>
				<td>'.$row->kg.'</td>
				<td>'.$row->description.'</td>
				<td>'.$row->remarks.'</td>
			</tr>
			';
		} ?>
	</tbody>
</table>
<hr/>
<h3>Rejected Data</h3>
<table id="table_ver_detail" class="table table-striped">
	<thead>
		<tr>
			<th width="20%;">Hawb No</th>
			<th width="30%;">Shipper</th>
			<th width="30%;">Consignee</th>
			<th>Pp</th>
			<th>Cc</th>
			<th>Pkg</th>
			<th>Pcs</th>
			<th>Kg</th>
			<th>Desc</th>
			<th>Remarks</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data_rejected as $row) {
			$total_similar_shipper = ($this->manifest_model->get_similar_customer($row->hawb_no,'shipper')) ? count($this->manifest_model->get_similar_customer($row->hawb_no,'shipper')) : 0;
			$total_similar_consignee = ($this->manifest_model->get_similar_customer($row->hawb_no,'consignee')) ? count($this->manifest_model->get_similar_customer($row->hawb_no,'consignee')) : 0;

			echo '
			<tr>
				<td text-align="center">
					<!-- Split button -->
					<div class="btn-group">
					  <button type="button" class="btn btn-default btn-sm">'.$row->hawb_no.'</button>
					</div>
				</td>
				<td class="shipper-'.$row->hawb_no.'">';
					if($this->customers_model->get_by_id($row->shipper) == false) {
						echo '
							<div class="customer-details-unverified">'.$row->shipper.'</div>';
					} else {
						$shipper = $this->customers_model->get_by_id($row->shipper);
						echo '<div class="customer-details-unverified">'.$shipper->name .'<br/>'.$shipper->address.'<br/>'.$shipper->phone.'</div>';
					}
				echo '
				</td>
				<td class="consignee-'.$row->hawb_no.'">';
					if($this->customers_model->get_by_id($row->consignee) == false) {
						echo '
							<div class="customer-details-unverified">'.$row->consignee.'</div>';
					} else {
						$consignee = $this->customers_model->get_by_id($row->consignee);
						echo '<div class="customer-details-unverified">'.$consignee->name .'<br/>'.$consignee->address.'<br/>'.$consignee->phone.'</div>';
					}
				echo '
				</td>
				<td>'.$row->prepaid.'</td>
				<td>'.$row->collect.'</td>
				<td>'.$row->pkg.'</td>
				<td>'.$row->pcs.'</td>
				<td>'.$row->kg.'</td>
				<td>'.$row->description.'</td>
				<td>'.$row->remarks.'</td>
			</tr>
			';
		} ?>
	</tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){
$('#table_ver_detail').DataTable();
})

function verifiedHost(hawb_no){
	$.ajax({
	    url:'<?php echo base_url('manifest/ajax/verification_host') ?>',
	    type:'post',
	    data:{'hawb_no':hawb_no},
	    dataType:'json',
	    success:function(a){
	    	alert(a.message);
	    }
	  })	
}

function holdHost(hawb_no){
	$.ajax({
	    url:'<?php echo base_url('manifest/ajax/hold_host') ?>',
	    type:'post',
	    data:{'hawb_no':hawb_no},
	    dataType:'json',
	    success:function(a){
	    	alert(a.message);
	    }
	  })	
}
function rejectHost(hawb_no){
	$.ajax({
	    url:'<?php echo base_url('manifest/ajax/reject_host') ?>',
	    type:'post',
	    data:{'hawb_no':hawb_no},
	    dataType:'json',
	    success:function(a){
	    	alert(a.message);
	    }
	  })	
}
</script>
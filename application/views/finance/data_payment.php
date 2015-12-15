
<table class="table table-striped table-hovered">
		<thead>
				
				<th>No</th>
				<th>Hawb No</th>
				<th>Customer Payment</th>
				<th>Total Payment Type</th>
				<th>Payment Amount</th>
				<th>Remaining Payment</th>
				<th>Date Payment</th>
				<th>Created By</th>
				<th>Status</th>
				
		</thead>

		<tbody>
			  
				<?php 
					$get_manifest_finish = $this->finance_payment->get_data_payment();
					$no = 1;
					foreach ($get_manifest_finish as $key => $value) {

						echo '<tr><td>'.$no.'</td>';
						echo '<td>'.$value->hawb_no.'</td>';
						echo '<td>'.$value->name.'</td>';
						echo '<td>Rp. '.$value->total_payment.'</td>';
						echo '<td>Rp. '.$value->payment_amount.'</td>';
						echo '<td>Rp. '.$value->remaining_payment.'</td>';
						echo '<td>'.$value->date_payment.'</td>';
						echo '<td>'.$value->username.'</td>';

						
						if($value->status == "partially"){
								$status = '<span class="label label-danger">'.$value->status.'</span>';
						}else{
								$status = '<span class="label label-success">'.$value->status.'</span>';
						}
						echo '<td>'.$status.'</td>';
						$no++;
					}


				?>


		</tbody>

</table>

 <a href="#" onClick="setPage('<?php echo base_url('finance/payment/add_payment')?>')"><button class="btn btn-primary">Add Payment</button></a> 


<script type="text/javascript">
$(document).ready(function() {

	$("table.table").dataTable();
    $('#selectdaterange').daterangepicker();
});
</script>
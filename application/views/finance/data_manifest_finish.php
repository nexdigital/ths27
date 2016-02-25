<table class="table table-striped table-hovered">
		<thead>
				
				
				<th>Hawb No</th>
				<th>Shipper</th>
				<th>Consignee</th>
				<th>Total Payment</th>
				<th>Deadline Payment</th>
				<th>Host Date</th>
				
		</thead>

		<tbody>
				<?php 
					$get_finish = $this->finance_payment->get_finish();
					foreach ($get_finish as $key => $value) {

						$shipper = $this->customers_model->get_by_id($value->shipper);
						$consignee = $this->customers_model->get_by_id($value->consignee);
						echo '
								<tr>
								<td><a href="javascript:;" onClick="setPage(\''.base_url('finance/payment/edit_payment/'.$value->hawb_no.'').'\')">'.$value->hawb_no.'</a></td>
								<td>'.$shipper->name.'</td>
								<td>'.$consignee->name.'</td>
								<td>Rp. '.$this->manifest_model->subtotal($value->hawb_no).'</td>
								<td>'.$value->deadline.'</td>
								<td>'.$value->created_date.'</td>

						';
					}

				?>
		</tbody>

<script>
		
		$("table.table").dataTable();
		
</script>		
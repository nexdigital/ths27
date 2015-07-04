<?php
	$shipper = $this->db->query("select * from customer_table where reference_id = '$data->shipper'");
	$consignee = $this->db->query("select * from customer_table where reference_id = '$data->consignee'");
?>

<div class="toolbar">
    <div class="btn-group" role="group" aria-label="...">
        <button type="button" class="btn btn-default btn-back" onCLick="setPage('<?php echo base_url('manifest/view/details?hawb_no='.$data->hawb_no) ?>')">Back</button>
        <button type="button" class="btn btn-default" onCLick="setPage('<?php echo base_url('manifest/view/invoice?hawb_no='.$data->hawb_no) ?>')">Print</button>
    </div>
</div>

<form id="invoice" method="post" method="post" action="<?php echo base_url().'invoice/save' ?>">
	<input type="hidden" name="invoice_id" value="<?php echo $invoice_id ?>">
	<input type="hidden" name="hawb_no" value="<?php echo $data->hawb_no ?>">
	<div class="col-lg-6 col-sm-6 col-xs-6">
		<div class="form-group">
		    <label>Shipper</label>
		    <input class="form-control" value="<?php echo $shipper->row('name') ?>" name="shipper_name">
		    <textarea class="form-control" style="height:100px; resize:none;" name="shipper_address"><?php echo $shipper->row('address')."\n".$shipper->row('city')."\n".$shipper->row('country') ?></textarea>
		    <input class="form-control" value="<?php echo $shipper->row('attn') ?>" name="shipper_attn">
		</div>

		<div class="form-group">
		    <label>Consignee</label>
		    <input class="form-control" value="<?php echo $consignee->row('name') ?>" name="consignee_name">
		    <textarea class="form-control" style="height:100px; resize:none;" name="consignee_address"><?php echo $consignee->row('address')."\n".$consignee->row('city')."\n".$consignee->row('country') ?></textarea>
		    <input class="form-control" value="<?php echo $consignee->row('attn') ?>" name="consignee_attn">
		</div>

		<div class="form-group">
		    <label>Description</label>
		    <textarea class="form-control"></textarea>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-6">
		<div class="form-group">
		    <label>KG</label>
		    <input class="form-control" value="<?php echo $data->kg ?>" disabled>
		</div>
		<div class="form-group">
		    <label>RATE / KG</label>
		    <input class="form-control" value="<?php echo $data->rate ?>" disabled>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6" style="padding:0px 5px 0px 0px;">
			<div class="form-group">
			    <label>Currency</label>
			    <input class="form-control" value="<?php echo $data->currency ?>" disabled>
				<!--<select class="form-control txt-currency" id="select-payment" name="currency" required>
					<?php foreach($this->master_currency->get_exchange_rate_list() as $row) {
						$selected_currency = ($row->exchange_rate_name == $data->currency) ? 'selected="selected"' : '';
						echo '<option value="'.$row->exchange_rate_name.'" '.$selected_currency.'>'.$row->exchange_rate_name.'</option>';
					} ?>
				</select>-->
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6" style="padding:0px 0px 0px 5px;">
			<div class="form-group">
			    <label>Exchange Rate</label>
			    <input class="form-control" value="<?php echo number_format($data->exchange_rate) ?>" disabled>
			</div>
		</div>
		<div class="form-group">
		    <label>Price</label>
		    <p class="form-control"><?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'normal')) ?></p>
		</div>
		<div class="form-group">
		    <label>Discount</label>
		    <p class="form-control"><?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'discount')) ?></p>
		</div>
		<div class="form-group">
		    <label>Extra Charge</label>
		    <p class="form-control"><?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'charge')) ?></p>
		</div>
		<div class="form-group">
		    <label>Subtotal</label>
		    <p class="form-control"><?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'all')) ?></p>
		</div>
	</div>
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <button type="submit" class="btn btn-success btn-sm submit-upload-single" data-loading-text="Saving...">Save</button>
    </div>
</form>


<div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top:50px;">
	<div class="toolbar">
		<h3>History Invoice</h3>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function(){
		$('table.table').dataTable();

		$('#invoice').ajaxForm({
			dataType:'json',
			success:function(data){
				alert('test');
			}
		})
	})

</script>
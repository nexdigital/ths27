<?php
	$shipper = $this->db->query("select * from customer_table where reference_id = '$data->shipper'");
	$consignee = $this->db->query("select * from customer_table where reference_id = '$data->consignee'");
?>

<div class="toolbar">
    <div class="btn-group" role="group" aria-label="...">
        <button type="button" class="btn btn-default btn-back" onCLick="setPage('<?php echo base_url('manifest/view/details?hawb_no='.$data->hawb_no) ?>')">Back</button>
    </div>
</div>

<form method="post">
	<div class="col-lg-6 col-sm-6 col-xs-6">
		<div class="form-group">
		    <label>Shipper</label>
		    <input class="form-control" value="<?php echo $shipper->row('name') ?>">
		    <textarea class="form-control"><?php echo $shipper->row('address')."\n".$shipper->row('city')."\n".$shipper->row('country') ?></textarea>
		    <input class="form-control" value="<?php echo $shipper->row('attn') ?>">
		</div>

		<div class="form-group">
		    <label>Consignee</label>
		    <input class="form-control" value="<?php echo $consignee->row('name') ?>">
		    <textarea class="form-control"><?php echo $consignee->row('address')."\n".$consignee->row('city')."\n".$consignee->row('country') ?></textarea>
		    <input class="form-control" value="<?php echo $consignee->row('attn') ?>">
		</div>

		<div class="form-group">
		    <label>Description</label>
		    <textarea class="form-control"></textarea>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-6">
		<div class="form-group">
		    <label>KG</label>
		    <input class="form-control" value="<?php echo $data->kg ?>">
		</div>
		<div class="form-group">
		    <label>RATE / KG</label>
		    <input class="form-control" value="<?php echo $data->rate ?>">
		</div>
		<div class="form-group">
		    <label>EXCHANGE RATE</label>
		    <input class="form-control" value="<?php echo $data->exchange_rate ?>">
		</div>
	</div>
</form>

<div class="col-lg-12">
	<div class="toolbar">
		<h3>History Invoice</h3>
	</div>
</div>
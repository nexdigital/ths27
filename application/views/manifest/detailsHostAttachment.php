<link href="<?php echo base_url()?>style/css/bootstrap.css" rel="stylesheet" type="text/css" />
<?php
$shipper = $this->db->query("select * from customer_table where reference_id = '".$data->shipper."'");
$consignee = $this->db->query("select * from customer_table where reference_id = '".$data->consignee."'");
?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Type</label>
                <p class="form-control"><?php echo $data->manifest_type; ?></p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Hawb No</label>
                <p class="form-control"><?php echo $data->hawb_no; ?></p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Currency</label>
                <p class="form-control"><?php echo $data->currency . '   [Rp.'.$data->exchange_rate.']'; ?></p>
            </div>
        </div>
   		<div class="col-sm-3">
            <div class="form-group">
                <label>Payment</label>
                <p class="form-control"><?php echo ($data->collect) ? 'Collect' : 'Prepaid'; ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
        <div class="col-lg-6" style="padding:0px;">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Pkg</label>
                    <p class="form-control"><?php echo $data->pkg; ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Pcs</label>
                    <p class="form-control"><?php echo $data->pcs; ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Value</label>
                    <p class="form-control"><?php echo $data->value; ?></p>
                </div>
            </div>
        </div>
       	<div class="col-lg-6" style="padding:0px;">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>KG</label>
                    <p class="form-control"><?php echo $data->kg; ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Rate / Kg</label>
                    <p class="form-control"><?php echo number_format($data->rate); ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Amount</label>
                    <p class="form-control"><?php echo (trim($data->collect)) ? number_format($data->collect) : number_format($data->prepaid); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Shipper</label>
                <textarea class="form-control" rows="2" name="description" style="resize:none;" readonly> <?php echo $shipper->row('name') ?></textarea>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Consignee</label>
                <textarea class="form-control" rows="2" name="description" style="resize:none;" readonly> <?php echo $consignee->row('name'); ?></textarea>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" rows="2" name="description" style="resize:none;" readonly> <?php echo $data->description; ?></textarea>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Remarks</label>
            <textarea class="form-control" rows="2" name="description" style="resize:none;" readonly> <?php echo $data->remarks; ?></textarea>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Other Charge Tata</label>
                <p class="form-control"><?php echo $data->other_charge_tata; ?></p>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Other Charge PML</label>
            <p class="form-control"><?php echo $data->other_charge_pml; ?></p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Total</label>
            <p class="form-control">Rp. <?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'normal')) ?></p>
        </div>
        <div class="col-sm-6" style="padding:0px;">
            <label>Discount</label>
            <p class="form-control">Rp. <?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'discount')) ?></p>
        </div>
        <div class="col-sm-6">
            <label>Charge</label>
            <p class="form-control">Rp. <?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'charge')) ?></p>
        </div>
        <div class="form-group">
            <label>Subtotal</label>
            <p class="form-control">Rp. <?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'all')) ?></p>
        </div>
    </div>
</div>
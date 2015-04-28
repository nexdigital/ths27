<div class="toolbar">
    <div class="btn-group" role="group" aria-label="...">
      <button type="button" class="btn btn-default">Edit</button>
      <button type="button" class="btn btn-default">Add Extra Charge</button>
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          Invoice
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#">Edit</a></li>
          <li><a href="#">Print</a></li>
        </ul>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Upload Type</label>
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
                <p class="form-control"><?php echo $data->currency; ?></p>
            </div>
        </div>
   		<div class="col-sm-3">
            <div class="form-group">
                <label>Select Payment</label>
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
                    <label>Rate</label>
                    <p class="form-control"><?php echo $data->rate; ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Amount</label>
                    <p class="form-control"><?php echo ($data->collect) ? $data->collect : $data->prepaid; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Shipper</label>
                <textarea class="form-control" rows="2" name="description" style="resize:none;" readonly> <?php echo $data->shipper; ?></textarea>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Consignee</label>
                <textarea class="form-control" rows="2" name="description" style="resize:none;" readonly> <?php echo $data->consignee; ?></textarea>
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
            <label>Subtotal</label>
            <p class="form-control">Rp. 1.234.567.890</p>
        </div>
    </div>
</div>
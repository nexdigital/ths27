<style type="text/css">
.tab-pane { padding: 10px 20px; border-left: 1px solid #e2e2e2; border-right: 1px solid #e2e2e2; border-bottom: 1px solid #e2e2e2; }
</style>

<div id="page-wrapper">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist" id="request_tab">
          <li role="presentation" class="active"><a href="#tab-import" role="tab" data-toggle="tab">Import</a></li>
          <li role="presentation"><a href="#tab-export" role="tab" data-toggle="tab">Single Item</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab-import">
                <form id="form_upload_manifest" method="post" action="<?=site_url('manifest/ajax/upload')?>">
                <div class="row">
                	<div class="col-lg-12" style="padding:0px;">
	                    <div class="col-lg-6">
	                        <div class="form-group">
	                            <label>Mawb No</label>
	                            <input class="form-control" name="mawb_no" required>
	                        </div>
	                    </div>
	                    <div class="col-lg-6">
	                        <div class="form-group">
	                            <label>Consign To</label>
	                            <input class="form-control" name="consign_to" required>
	                        </div>
	                    </div>
	                </div>
                    <div class="col-lg-12" style="padding:0px;">
		                <div class="col-lg-6">
	                        <div class="form-group">
	                            <label>Flight No</label>
	                            <input class="form-control" name="flight_no" required>
	                        </div>
	                    </div>
	                    <div class="col-lg-6">
	                        <div class="form-group">
	                            <label>Gross Weight</label>
	                            <input class="form-control" name="gross_weight" required>
	                        </div>
	                    </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Partner</label>
                            <select class="form-control flight_from" name="partner_id">
                                         
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12" style="padding:0px;">
	                    <div class="col-lg-6">
	                        <div class="form-group">
	                            <label>From</label>
	                            <select class="form-control flight_from" name="flight_from" required>
	                            	<?php
	                            		foreach($this->tool_model->list_country() as $row){
	                            			echo '<option value="'.$row.'">'.$row.'</option>';
	                            		}
	                            	?>
	                            </select>                                     
	                        </div>
	                    </div>
		                <div class="col-lg-6">
	                        <div class="form-group">
	                            <label>To</label>
	                            <select class="form-control flight_to" name="flight_to" required>
	                            	<?php
	                            		foreach($this->tool_model->list_country() as $row){
	                            			echo '<option value="'.$row.'">'.$row.'</option>';
	                            		}
	                            	?>
	                            </select>                                  
	                        </div>
	                    </div>
	                </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input id="fileupload" type="file" name="userfile" required>
                        </div>
                        <input type="hidden" name="manifest_type" value="import">
                        <button type="submit" class="btn btn-success btn-sm submit-upload">Upload</button>
                    </div>
                </div>
                </form>
            </div>

            <div role="tabpane1" class="tab-pane fade in" id="tab-export">
                <form method="post" action="<?=base_url()?>manifest/ajax/insert" id="form_upload_manifest_single">
                <div class="row">
                    <div class="col-lg-12" style="padding:0px;">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Upload Type</label>
                                <select class="form-control upload_type" name="manifest_type" required>
                                    <option value="import">Import</option>
                                    <option value="export">Export</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Hawb No</label>
                                <input class="form-control" type="text" name="hawb_no" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="padding:0px;">
	                    <div class="col-lg-6" style="padding:0px;">
	                        <div class="col-sm-2">
	                            <div class="form-group">
	                                <label>Pkg</label>
	                                <input class="form-control text-pkg" type="text" name="pkg" required>
	                            </div>
	                        </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Pcs</label>
                                    <input class="form-control text-pcs" type="text" name="pcs" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Value</label>
                                    <input class="form-control text-value" type="text" name="value" required>
                                </div>
                            </div>
	                        <div class="col-sm-3">
	                            <div class="form-group">
	                                <label>KG</label>
	                                <input class="form-control text-kg" type="text" name="kg" required>
	                            </div>
	                        </div>
	                        <div class="col-sm-3">
	                            <div class="form-group">
	                                <label>Rate</label>
	                                <input class="form-control text-rate" type="text" name="rate" required>
	                            </div>
	                        </div>
	                    </div>
	                   	<div class="col-lg-6" style="padding:0px;">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Currency</label>
                                    <select class="form-control" id="select-payment" name="currency" required>
                                        <option value="nt">NT</option>
                                        <option value="usd">USD</option>
                                        <option value="id">IDR</option>
                                    </select>
                                </div>
                            </div>
	                   		<div class="col-sm-4">
	                            <div class="form-group">
	                                <label>Select Payment</label>
	                                <select class="form-control" id="select-payment" name="type_payment" required>
		                                <option value="">Select</option>
		                                <option value="prepaid">Prepaid</option>
		                                <option value="collect">Collect</option>
	                                </select>
	                            </div>
	                        </div>
	                        <div class="col-sm-4">
	                            <div class="form-group">
	                                <label>Amount</label>
	                                <input class="form-control text-amount" type="text" disabled="disabled" required>
	                                <input class="form-control text-amount" type="hidden" name="amount" required>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                    <div class="col-sm-12" style="padding:0px;">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Shipper</label>
                                <p class="selected-shipper-text"></p>
                                <input type="hidden" name="shipper" class="selected-shipper" required>
                                <button type="button" class="btn btn-default btn-xs submit-upload select-customer" data_type="shipper">Select shipper</button>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Consignee</label>
                                <p class="selected-consignee-text"></p>
                                <input type="hidden" name="consignee" class="selected-consignee" required>
                                <button type="button" class="btn btn-default btn-xs submit-upload select-customer" data_type="consignee">Select consignee</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="2" name="description" style="resize:none;"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" rows="2" name="remarks" style="resize:none;"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Other Charge Tata</label>
                            <input class="form-control" type="text" name="other_charge_tata">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Other Charge PML</label>
                            <input class="form-control" type="text" name="other_charge_pml">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success btn-sm submit-upload-other">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>style/js/jquery.min.js"></script>
<script src="<?php echo base_url()?>style/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/js/jquery.form.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
	/*Form upload manfiest*/
	$('form#form_upload_manifest').validate({
		rules: { mawb_no: { required: true, remote: "manifest/ajax/check_available_mawb" } },
		messages: { mawb_no: { remote: 'Hawb no has been used' } }
	});
	$('form#form_upload_manifest').ajaxForm();
	/*Form upload manfiest End*/
});
</script>
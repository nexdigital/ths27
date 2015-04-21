<style type="text/css">
.tab-pane { padding: 10px 20px; border-left: 1px solid #e2e2e2; border-right: 1px solid #e2e2e2; border-bottom: 1px solid #e2e2e2; }
</style>
<ul class="nav nav-tabs" role="tablist" id="request_tab">
  <li role="presentation" class="active"><a href="#tab-import" role="tab" data-toggle="tab">Import</a></li>
  <li role="presentation"><a href="#tab-export" role="tab" data-toggle="tab">Single Item</a></li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="tab-import">
        <form id="form_upload_manifest" method="post" action="<?=site_url('manifest/ajax/upload')?>">
        <div class="row">
        	<div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <label>Mawb No</label>
                        <input class="form-control" name="mawb_no" required>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <label>Consign To</label>
                        <input class="form-control" name="consign_to" value="Tata Harmoni Saranatama" required>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <label>Flight No</label>
                        <input class="form-control" name="flight_no" required>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <label>Gross Weight</label>
                        <input class="form-control" name="gross_weight" required>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label>Partner</label>
                    <select class="form-control flight_from" name="partner_id" required>
                                 
                    </select>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
                <div class="col-lg-6 col-sm-6 col-xs-6">
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
                <div class="col-lg-6 col-sm-6 col-xs-6">
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
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <input id="fileupload" type="file" name="userfile" required>
                </div>
                <button type="submit" class="btn btn-success btn-sm submit-upload" data-loading-text="Uploading...">Upload</button>
            </div>
        </div>
        </form>
    </div>

    <div role="tabpane1" class="tab-pane fade in" id="tab-export">
        <form method="post" action="<?=base_url()?>manifest/ajax/insert" id="form_upload_manifest_single">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Upload Type</label>
                        <select class="form-control upload_type" name="manifest_type" required>
                            <option value="import">Import</option>
                            <option value="export">Export</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Hawb No</label>
                        <input class="form-control txt-hawb" type="text" name="hawb_no" required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Currency</label>
                        <select class="form-control txt-currency" id="select-payment" name="currency" required>
                        	<?php foreach($this->master_currency->list_currency('Kurs Transaction') as $row) {
                        		echo '<option value="'.$row->currency_name.'">'.$row->currency_name.' ('.number_format($row->currency_value).')</option>';
                        	} ?>
                        </select>
                    </div>
                </div>
           		<div class="col-sm-3">
                    <div class="form-group">
                        <label>Select Payment</label>
                        <select class="form-control" id="select-payment" name="type_payment" required>
                            <option value="">Select</option>
                            <option value="prepaid">Prepaid</option>
                            <option value="collect">Collect</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
                <div class="col-lg-6" style="padding:0px;">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Pkg</label>
                            <input class="form-control text-pkg" type="text" name="pkg" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Pcs</label>
                            <input class="form-control text-pcs" type="text" name="pcs" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Value</label>
                            <input class="form-control text-value" type="text" name="value" required>
                        </div>
                    </div>
                </div>
               	<div class="col-lg-6" style="padding:0px;">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>KG</label>
                            <input class="form-control txt-kg" type="text" name="kg" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Rate</label>
                            <input class="form-control txt-rate" type="text" name="rate" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Amount</label>
                            <input class="form-control txt-amount" type="text" name="amount" readonly required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Shipper</label>
                        <input class="form-control" name="shipper" id="select_shipper" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Consignee</label>
                        <input class="form-control" name="consignee" id="select_consignee" required>
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
                    <input class="form-control txt-charge-tata" type="text" name="other_charge_tata">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Other Charge PML</label>
                    <input class="form-control txt-charge-pml" type="text" name="other_charge_pml">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Subtotal</label>
                    <input type="text" class="form-control txt-subtotal" readonly>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-success btn-sm submit-upload-single" data-loading-text="Saving...">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>

<script src="<?php echo base_url()?>style/js/jquery.min.js"></script>
<script src="<?php echo base_url()?>style/lib/select2/select2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/js/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/js/jquery.site.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	/*Form upload manfiest*/
	$('form#form_upload_manifest').validate({
		rules: { mawb_no: { required: true, remote: "manifest/ajax/check_available_mawb" } },
		messages: { mawb_no: { remote: 'Hawb no has been used' } }
	});
	$('form#form_upload_manifest').ajaxForm({
		dataType:'json',
		success:function(data){			
			$('#message_form').remove();
			if(data.status == "success"){
				$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-success" role="alert">'+data.message+'</div>');
				$('form#form_upload_manifest').resetForm();
			} else if(data.status == "warning") {
				$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-warning" role="alert">'+data.message+'</div>');				
			}
			$('#message_form').fadeIn('slow');
			$('button.submit-upload').button('reset');
			setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
		},
		error:function(data){
			$('#message_form').remove();
			$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-danger" role="alert">Server Error!</div>');
			$('#message_form').fadeIn('slow');
			$('button.submit-upload').button('reset');
			$('form#form_upload_manifest').resetForm();
			setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
		},
		beforeSubmit:function(){
			$('button.submit-upload').button('loading');
		}
	});
	/*Form upload manfiest End*/

	$('#select_shipper').select2({
		placeholder: "Search shipper...",
        minimumInputLength: 3,
        quietMillis: 100,
        ajax: {
            url: '<?php echo base_url('manifest/get/customer')?>',
            dataType: 'json',
            data: function (term) {
	            return {
	                term: term
	            };
	        },
	        results: function (data) {
	            return {
	                results: data
	            };
	        }
        },
        formatResult: function (option) {
        	var result = "<table width='100%' style='font-family:Tahoma; font-size:12px;'>";
        	result += "<tr><td width='25%'><strong>Ref. ID</strong></td><td>" + option.id + "</td>";
        	result += "<tr><td><strong>Name</strong></td><td>" + option.name + "</td>";
        	result += "<tr><td><strong>Full Address</strong></td><td>" + option.address +"</td>";
        	result += "</table>";
            return result;
        },
        formatSelection: function (option) {
            return option.id + " (" + option.name + ")";
        }
	})
	
	$('#select_consignee').select2({
		placeholder: "Search Consignee...",
        minimumInputLength: 3,
        quietMillis: 100,
        ajax: {
            url: '<?php echo base_url('manifest/get/customer')?>',
            dataType: 'json',
            data: function (term) {
	            return {
	                term: term
	            };
	        },
	        results: function (data) {
	            return {
	                results: data
	            };
	        }
        },
        formatResult: function (option) {
        	var result = "<table width='100%' style='font-family:Tahoma; font-size:12px;'>";
        	result += "<tr><td width='25%'><strong>Ref. ID</strong></td><td>" + option.id + "</td>";
        	result += "<tr><td><strong>Name</strong></td><td>" + option.name + "</td>";
        	result += "<tr><td><strong>Full Address</strong></td><td>" + option.address +"</td>";
        	result += "</table>";
            return result;
        },
        formatSelection: function (option) {
            return option.id + " (" + option.name + ")";
        }
	})
	
	$('select.upload_type').on('change',function(){
		var val = $(this).val();
		if(val != 'import') {
			$.get('<?php echo base_url('manifest/get/generate_hawb')?>',function(data){
				$('.txt-hawb').val(data);
			});
		}
	})
	$('.txt-rate, .txt-kg, .txt-currency, .txt-charge-tata, .txt-charge-pml').blur(function(){
		var rate 	= $('.txt-rate').val(), 
			kg 		= $('.txt-kg').val(),
			currency = $('.txt-currency').val(),
			charge_tata = $('.txt-charge-tata').val(),
			charge_pml = $('.txt-charge-pml').val();

		$.post('<?php echo base_url('manifest/get/sum_amount_host') ?>',{'rate':rate,'kg':kg,'currency':currency},function(data){
			$('.txt-amount').val(data);
		})

		$.post('<?php echo base_url('manifest/get/sum_total_host') ?>',{'rate':rate,'kg':kg,'currency':currency,'charge_tata':charge_tata,'charge_pml':charge_pml},function(data){
			$('.txt-subtotal').val(data);
		})		

	})

	$('form#form_upload_manifest_single').validate();
	$('form#form_upload_manifest_single').ajaxForm({
		dataType:'json',
		success:function(data){			
			$('#message_form').remove();
			if(data.status == "success"){
				$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-success" role="alert">'+data.message+'</div>');
				$('form#form_upload_manifest_single').resetForm();
		} else if(data.status == "warning") {
				$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-warning" role="alert">'+data.message+'</div>');				
			}
			$('#message_form').fadeIn('slow');
			$('button.submit-upload-single').button('reset');
			setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
		},
		error:function(data){
			$('#message_form').remove();
			$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-danger" role="alert">Server Error!</div>');
			$('#message_form').fadeIn('slow');
			$('button.submit-upload-single').button('reset');
			$('form#form_upload_manifest_single').resetForm();
			setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
		},
		beforeSubmit:function(){
			$('button.submit-upload-single').button('loading');
		}
	});
});
</script>
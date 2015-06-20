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
                <input type="text" class="form-control txt-hawb" name="hawb_no" required>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Currency</label>
                <select class="form-control txt-currency" id="select-payment" name="currency" required>
                	<?php foreach($this->master_currency->get_exchange_rate_list() as $row) {
                		echo '<option value="'.$row->exchange_rate_name.'">'.$row->exchange_rate_name.' ('.number_format($row->exchange_rate_value).')</option>';
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


<script type="text/javascript">
$(document).ready(function(){
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
            $('button.submit-upload-single').removeClass('disabled');
			setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
		},
		error:function(data){
			$('#message_form').remove();
			$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-danger" role="alert">Server Error!</div>');
			$('#message_form').fadeIn('slow');
            $('button.submit-upload-single').removeClass('disabled');
			$('form#form_upload_manifest_single').resetForm();
			setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
		},
		beforeSubmit:function(){
			$('button.submit-upload-single').addClass('disabled');
		}
	});
});
</script>
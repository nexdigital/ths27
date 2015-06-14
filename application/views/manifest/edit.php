<?php
    $shipper = $this->db->query("select * from customer_table where reference_id = '".$data->shipper."'");
    $consignee = $this->db->query("select * from customer_table where reference_id = '".$data->consignee."'");

?>

<div class="toolbar">
    <div class="btn-group" role="group" aria-label="...">
        <!-- Split button -->
        <button type="button" class="btn btn-default" onclick="setPage('<?php echo base_url('manifest/view/details?hawb_no='.$data->hawb_no) ?>')">Back</button>
    </div>
</div>

<form method="post" action="<?=base_url()?>manifest/ajax/update?hawb_no=<?php echo $data->hawb_no ?>" id="form_upload_manifest_single">
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Upload Type</label>
                <select class="form-control upload_type" name="manifest_type" disabled="">
                    <option value="import" <?php if($data->manifest_type == 'import') echo 'selected="selected"' ?>>Import</option>
                    <option value="export" <?php if($data->manifest_type == 'export') echo 'selected="selected"' ?>>Export</option>
                    <option value="other" <?php if($data->manifest_type == 'other') echo 'selected="selected"' ?>>Other</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Hawb No</label>
                <input class="form-control txt-hawb" type="text" name="hawb_no" value="<?php echo $data->hawb_no ?>" disabled>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Currency</label>
                <select class="form-control txt-currency" id="select-payment" name="currency" required>
                    <?php foreach($this->master_currency->get_exchange_rate_list() as $row) {
                        $selected_currency = (strtolower($row->exchange_rate_name) == strtolower($data->currency)) ? 'selected="selected"' : '';
                        echo '<option value="'.$row->exchange_rate_name.'" '.$selected_currency.'>'.$row->exchange_rate_name.' ('.number_format($row->exchange_rate_value).')</option>';
                    } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Select Payment</label>
                <select class="form-control" id="select-payment" name="type_payment" required>
                    <option value="prepaid" <?php if($data->prepaid) echo 'selected="selected"' ?>>Prepaid</option>
                    <option value="collect" <?php if($data->collect) echo 'selected="selected"' ?>>Collect</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
        <div class="col-lg-6" style="padding:0px;">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Pkg</label>
                    <input class="form-control text-pkg" type="text" name="pkg" value="<?php echo $data->pkg ?>" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Pcs</label>
                    <input class="form-control text-pcs" type="text" name="pcs" value="<?php echo $data->pcs ?>" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Value</label>
                    <input class="form-control text-value" type="text" name="value" value="<?php echo $data->value ?>" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6" style="padding:0px;">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>KG</label>
                    <input class="form-control txt-kg" type="text" name="kg" value="<?php echo $data->kg ?>" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Rate</label>
                    <input class="form-control txt-rate" type="text" name="rate" value="<?php echo $data->rate ?>" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Amount</label>
                    <input class="form-control txt-amount" type="text" name="amount" value="<?php echo ($data->collect) ? number_format($data->collect) : number_format($data->prepaid); ?>" readonly required>
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
            <textarea class="form-control" rows="2" name="description" style="resize:none;"><?php echo $data->description ?></textarea>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Remarks</label>
            <textarea class="form-control" rows="2" name="remarks" style="resize:none;"><?php echo $data->remarks ?></textarea>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Other Charge Tata</label>
            <input class="form-control txt-charge-tata" type="text" name="other_charge_tata" value="<?php echo $data->other_charge_tata ?>">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Other Charge PML</label>
            <input class="form-control txt-charge-pml" type="text" name="other_charge_pml" value="<?php echo $data->other_charge_pml ?>">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Subtotal</label>
            <input type="text" class="form-control txt-subtotal" value="<?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'all')) ?>" readonly>
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
        var rate    = $('.txt-rate').val(), 
            kg      = $('.txt-kg').val(),
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
        } else if(data.status == "warning") {
                $('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-warning" role="alert">'+data.message+'</div>');               
            }
            $('#message_form').fadeIn('slow');
            $('button.submit-upload-single').removeClass('disabled');
            setTimeout(function(){ 
                $('#message_form').fadeOut('slow');
                setPage('<?php echo base_url('manifest/view/details?hawb_no='.$data->hawb_no) ?>')
             }, 5000);
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

            var rate    = $('.txt-rate').val(), 
            kg      = $('.txt-kg').val(),
            currency = $('.txt-currency').val(),
            charge_tata = $('.txt-charge-tata').val(),
            charge_pml = $('.txt-charge-pml').val();


            $.post('<?php echo base_url('manifest/get/sum_amount_host') ?>',{'rate':rate,'kg':kg,'currency':currency},function(data){
                $('.txt-amount').val(data);
            })

            $.post('<?php echo base_url('manifest/get/sum_total_host') ?>',{'rate':rate,'kg':kg,'currency':currency,'charge_tata':charge_tata,'charge_pml':charge_pml},function(data){
                $('.txt-subtotal').val(data);
            })
        }
    });
});
</script>
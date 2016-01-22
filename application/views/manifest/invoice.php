<form method="post" action="<?=base_url()?>manifest/ajax/print" id="form_print">
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Mawb No</label>
                <select class="form-control" name="master">
                <?php
                    echo '<option value="">Select Mawb No</option>';
                    $this->db->select('mawb_no as id,file_name,flight_no,flight_from,flight_to');
                    $get = $this->db->get('manifest_file_table');
                    foreach($get->result() as $row) {
                        echo '<option value="'.$row->id.'">'.$row->id.' [Flight No: '.$row->flight_no.' From: '.$row->flight_to.' To: '.$row->flight_to.']</option>';
                    }
                ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Hawb No</label>
                <select class="form-control" name="host[]" multiple="multiple">
                <?php
                    $this->db->select('hawb_no as id');
                    $get = $this->db->get('manifest_data_table');
                    foreach($get->result() as $row) {
                        echo '<option value="'.$row->id.'">'.$row->id.'</option>';
                    }                    
                ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <button type="submit" class="btn btn-success btn-sm submit-print-invoice" data-loading-text="Printing ...">Print</button>
    </div>
</div>
</form>


<script type="text/javascript">
$(document).ready(function(){
    $('select.form-control').select2();
	$('#master').select2({
		placeholder: "Search mawb no",
        minimumInputLength: 1,
        quietMillis: 100,
        multiple: true,
        ajax: {
            url: '<?php echo base_url('manifest/get/master_manifest')?>',
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
            var result = "<span>" + option.id + "</span>";
            return result;
        },
        formatSelection: function (option) {
            return option.id;
        }
	})
	
	$('#host').select2({
		placeholder: "Search hawb no",
        minimumInputLength: 1,
        quietMillis: 100,
        multiple: true,
        ajax: {
            url: '<?php echo base_url('manifest/get/host_manifest')?>',
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
        	var result = "<span>" + option.id + "</span>";
            return result;
        },
        formatSelection: function (option) {
            return option.id;
        }
	})

    $("#form_print").validate();
    $("#form_print").ajaxForm({
        dataType:'json',
        success:function(data){
            $('button.submit-print-invoice').removeClass('disabled');
            for(hawb in data.host) {
                window.open("<?php echo base_url() ?>asset/invoice/" + data.host[hawb] + ".pdf","_blank");
            }
        },
        beforeSubmit:function(){
            $('button.submit-print-invoice').addClass('disabled');
        }
    });
});
</script>
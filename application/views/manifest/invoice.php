<form method="post" action="<?=base_url()?>manifest/ajax/print" id="form_print">
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Master</label>
                <input class="form-control" name="master" id="master" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Host</label>
                <input class="form-control" name="host" id="host" required>
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
	$('#master').select2({
		placeholder: "Search Master Manifest",
        minimumInputLength: 3,
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
		placeholder: "Search Host Manifest",
        minimumInputLength: 2,
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
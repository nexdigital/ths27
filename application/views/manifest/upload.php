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
            <select class="form-control flight_from" name="partner_id">
                         
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
                			echo '<option value="'.$row->country_id.'">'.$row->country_name.'</option>';
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
                            echo '<option value="'.$row->country_id.'">'.$row->country_name.'</option>';
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
            $('.submit-upload').removeClass('disabled');
			$('#message_form').fadeIn('slow');
			setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
		},
		error:function(data){
			$('#message_form').remove();
			$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-danger" role="alert">Server Error!</div>');
			$('#message_form').fadeIn('slow');
            $('.submit-upload').removeClass('disabled');
			$('form#form_upload_manifest').resetForm();
			setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
		},
		beforeSubmit:function(){
            $('.submit-upload').addClass('disabled');
        }
	});
	/*Form upload manfiest End*/
});
</script>
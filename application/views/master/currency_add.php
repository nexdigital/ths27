<form id="form_currency" method="post" action="<?php  echo base_url()?>master/ajax/currency/add">

	<div class="form-group">
		<label>Currency ID <label class="required-filed">*</label></label>
		<input type="text" class="form-control" id="currency_id" name="currency_id" required>
	</div>


	<div class="form-group">
		<label>Currency <label class="required-filed">*</label></label>
		<input type="text" class="form-control" id="currency" name="currency" required>
	</div>

	<div class="form-group">
		<label>Rate<label class="required-filed">*</label></label>
		<input type="text" class="form-control" id="rate" name="rate" required>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success submit" data-loading-text="Saving...">Submit</button>
		<button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')">Cancel</button>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$("#form_currency").validate();


		$('.datepicker').datepicker({
	        format: "yyyy-mm-dd"
	    })
		$('form#form_currency').ajaxForm({
			dataType:'json',
			success:function(data){			
				$('#message_form').remove();
				if(data.status == "success"){
					$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-success" role="alert">'+data.message+'</div>');
					$('form#form_currency').resetForm();
				} else if(data.status == "warning") {
					$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-warning" role="alert">'+data.message+'</div>');				
				}
				$('#message_form').fadeIn('slow');
				setTimeout(function(){ 
					$('#message_form').fadeOut('slow');
					setPage('<?php echo base_url('master/view/currency/index')?>')
				}, 5000);
			},
			error:function(data){
				$('#message_form').remove();
				$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-danger" role="alert">Server Error!</div>');
				$('#message_form').fadeIn('slow');
				$('form#form_currency').resetForm();
				setTimeout(function(){ 
					$('#message_form').fadeOut('slow');
					setPage('<?php echo base_url('master/view/currency/index')?>')
				}, 5000);
			},
			beforeSubmit:function(){
				$('button.submit-upload').button('loading');
			}
		});
	})	
</script>
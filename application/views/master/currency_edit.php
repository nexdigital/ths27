<form id="form_currency" method="post" action="<?php  echo base_url()?>master/ajax/currency/edit">
	<input type="hidden" name="exchange_rate_id" value="<?php echo $data->exchange_rate_id ?>">
	<div class="form-group">
		<label>Currency Name <label class="required-filed">*</label></label>
		<input type="text" class="form-control" name="exchange_rate_name" value="<?php echo $data->exchange_rate_name ?>" readonly>
	</div>

	<div class="form-group">
		<label>Rate<label class="required-filed">*</label></label>
		<input type="text" class="form-control" name="exchange_rate_value" value="<?php echo $data->exchange_rate_value ?>">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success submit" data-loading-text="Saving...">Update</button>
		<!-- <button type="button" class="btn btn-success delete" exchange_rate_id="<?php echo $data->exchange_rate_id ?>">Delete</button> -->
		 <!--<button type="reset" class="btn btn-success btn-submit"  onclick="setPage('<?php echo base_url() ?>master/view/currency/delete/<?php echo $data->exchange_rate_id ?>')">Delete</button>-->
		<button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')">Cancel</button>
		<label class="alert-form" ></label>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.datepicker').datepicker({
	        format: "yyyy-mm-dd"
	    })
		$('form#form_currency').ajaxForm({
			dataType:'json',
			success:function(data){			
				$('#message_form').remove();
				if(data.status == "success"){
					$('.alert-form').prepend('<div id="message_form" style="display:none;" class="alert alert-success" role="alert">'+data.message+'</div>');
					$('form#form_currency').resetForm();
				} else if(data.status == "warning") {
					$('.alert-form').prepend('<div id="message_form" style="display:none;" class="alert alert-warning" role="alert">'+data.message+'</div>');				
				}
				$('#message_form').fadeIn('slow');
				setTimeout(function(){ 
					$('#message_form').fadeOut('slow');
					setPage('<?php echo base_url('master/view/currency/index')?>')
				}, 1200);
			},
			error:function(data){
				$('#message_form').remove();
				$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-danger" role="alert">Server Error!</div>');
				$('#message_form').fadeIn('slow');
				$('form#form_currency').resetForm();
				setTimeout(function(){ 
					$('#message_form').fadeOut('slow');
					setPage('<?php echo base_url('master/view/currency/index')?>')
				}, 1200);
			},
			beforeSubmit:function(){
				$('button.submit-upload').button('loading');
			}
		});

		$(".delete").click(function(){
			if(confirm('You want delete this currency?')){
				$.post("<?php echo base_url() ?>master/ajax/currency/delete",{exchange_rate_id:'<?php echo $data->exchange_rate_id ?>'},function(){
					setPage('<?php echo base_url('master/view/currency/index')?>');
				})
			}
		})
	})	
</script>
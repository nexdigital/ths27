<form id="form_currency" method="post" action="<?php  echo base_url()?>master/ajax/currency/add">
<div class="form-group">
		<label>Country From</label><label class="required-filed">*</label></label>
		<select class="form-control" name="country_from" id="country_from" onChange="get_name();"required>
			<option value="">-</option>
			
			<?php foreach ($this->tool_model->get_country_to_currency() as $key => $value) {
				 echo '<option value="'.$value->country_name.'">'.$value->country_name.'</option>';	
			} ?>
			
		</select>
</div>


<div class="form-group">
		<label>Country From</label><label class="required-filed">*</label></label>
		<select class="form-control" name="country_to" id="country_to" required>
			<option value="indonesia">Indonesia</option>
		</select>
</div>

<div class="form-group">
		<label>Currency Name <label class="required-filed">*</label></label>
		<input type="text" class="form-control" id="currency_name" name="currency_name" readonly required>

</div>

<div class="form-group">
		<label>Rate<label class="required-filed">*</label></label>
		<input type="text" class="form-control" id="rate" name="rate" required>
</div>

<div class="form-group">
		<button type="submit" class="btn btn-success submit" data-loading-text="Saving...">Submit</button>
		<button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')">Cancel</button>
		<label class="alert-form" ></label>
</div>

</form>

<script>


$(document).ready(function() {


	$("#form_currency").validate({

		rules: { currency_name: { required: true, remote: "<?php echo base_url(); ?>master/ajax/currency/check_available_currency" },
					
			   },
	 messages: { 
	 			currency_name: { remote: 'currency name has been added' } }	
	});


    $("#rate").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


    $('form#form_currency').ajaxForm({
			dataType:'json',
			success:function(data){			
				$('#message_form').remove();
				if(data.status == "success"){
					$('.alert-form').prepend('<div id="message_form" style="display:none;" class="alert alert-success" role="alert">'+data.message+'</div>');
				
					$('#message_form').fadeIn('slow');
					setTimeout(function(){ 
						$('#message_form').fadeOut('slow');
						$('form#form_currency').resetForm();
						 setPage('<?php echo base_url('master/view/currency/index')?>')
					}, 1200);


				} else if(data.status == "warning") {
					$('.alert-form').prepend('<div id="message_form" style="display:none;" class="alert alert-danger" role="alert">'+data.message+'</div>');				
					$('#message_form').fadeIn('slow');
				setTimeout(function(){ 
					$('#message_form').fadeOut('slow');
					 // setPage('<?php echo base_url('master/view/currency/index')?>')
				}, 1200);
				}
				
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



});
		
		function get_name()
		{
			var country_from = $("#country_from").val();
			var country_to   = $("#country_to").val();

			if(country_from != "" && country_to != "")
			{

				if(country_to == country_from)
				{

					$("#country_from").val("");
					$("#currency_name").val("");
				}
				else
				{
					$("#currency_name").val(country_from +" - "+country_to);

				}
				
			}
			

		}


</script>
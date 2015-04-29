<form id="form_country" method="post" action="<?php echo base_url('master/ajax/country/add')?>">
	<table class="table table-bordered table-striped">
		<tbody>
			<tr>
				<td width="150px">Country Name</td>
				<td><input type="text" name="country_name" class="form-control" required></td>
			</tr>
			<tr>
				<td>Country Symbol</td>
				<td><input type="text" name="country_symbol" class="form-control" required></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><button type="submit" class="btn btn-success submit" data-loading-text="Saving...">Submit</button></td>
			</tr>
		</tbody>
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('form#form_country').validate({
			rules: { country_name: { required: true, remote: "<?php echo base_url(); ?>master/ajax/country/check_available_country" } },
			messages: { country_name: { remote: 'Country has been added' } }			
		});
		$('form#form_country').ajaxForm({
			dataType:'json',
			success:function(data){			
				$('#message_form').remove();
				if(data.status == "success"){
					$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-success" role="alert">'+data.message+'</div>');
					$('form#form_country').resetForm();
				} else if(data.status == "warning") {
					$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-warning" role="alert">'+data.message+'</div>');				
				}
				$('#message_form').fadeIn('slow');
				$('button.submit').button('reset');
				setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
			},
			error:function(data){
				$('#message_form').remove();
				$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-danger" role="alert">Server Error!</div>');
				$('#message_form').fadeIn('slow');
				$('button.submit').button('reset');
				$('form#form_country').resetForm();
				setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
			},
			beforeSubmit:function(){
				$('button.submit-upload').button('loading');
			}
		});
	})	
</script>
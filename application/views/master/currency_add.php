<form id="form_currency" method="post" action="<?php echo base_url('master/ajax/currency/add')?>">
	<table class="table table-bordered table-striped">
		<tbody>
			<tr>
				<td width="150px">Currency From <label class="required-filed">*</label></td>
				<td>
					<select name="currency_from" class="form-control">
						<?php foreach ($list_country as $row) {
							echo '<option value="'.$row->country_id.'">'.$row->country_name.' - '.$row->currency_name.' - '.$row->currency_symbol.'</option>';
						} ?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="150px">Currency To <label class="required-filed">*</label></td>
				<td>
					<select name="currency_to" class="form-control">
						<?php foreach ($list_country as $row) {
							echo '<option value="'.$row->country_id.'">'.$row->country_name.' - '.$row->currency_name.' - '.$row->currency_symbol.'</option>';
						} ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Rate Type <label class="required-filed">*</label></td>
				<td>
					<select name="currency_type" class="form-control">
						<?php foreach ($list_currency_type as $row) {
							echo '<option value="'.$row->currency_type_id.'">'.$row->currency_type_name.'</option>';
						} ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Rate Date <label class="required-filed">*</label></td>
				<td><input type="text" name="currency_date" class="form-control datepicker" value="<?php echo date('Y-m-d') ?>" required></td>
			</tr>
			<tr>
				<td>Exhange Rate <label class="required-filed">*</label></td>
				<td><input type="text" name="currency_rate" class="form-control" required></td>
			</tr>
			<tr>
				<td>Description</td>
				<td><textarea class="form-control" required></textarea></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<button type="submit" class="btn btn-success submit" data-loading-text="Saving...">Submit</button>
					<button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')">Cancel</button>
				</td>
			</tr>
		</tbody>
	</table>
</form>

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
					$('section.content').prepend('<div id="message_form" style="display:none;" class="alert alert-success" role="alert">'+data.message+'</div>');
					$('form#form_currency').resetForm();
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
				$('form#form_currency').resetForm();
				setTimeout(function(){ $('#message_form').fadeOut('slow'); }, 5000);
			},
			beforeSubmit:function(){
				$('button.submit-upload').button('loading');
			}
		});
	})	
</script>
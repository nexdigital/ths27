<table>
	<tr>
		<td>
			<select class="sumoselect" placeholder="Select Type" name="type_data">
			    <option value="master">Master</option>
			    <option value="host">Host</option>
			</select>
		</td>
		<td>
			<select class="sumoselect" placeholder="Select Status" multiple="" name="status">
			    <option value="new">New</option>
			    <option value="on_progress">On Progress</option>
			    <option value="delivered">Delivered</option>
			    <option value="closing">Closing</option>
			</select>
		</td>
		<td>
			<div id="sandbox-container"><div class="input-daterange input-group" id="datepicker">
			    <input type="text" class="input-lg form-control input-sumoselect" name="start_date" placeholder="Start date upload">
			    <span class="input-group-addon">to</span>
			    <input type="text" class="input-lg form-control input-sumoselect" name="end_date" placeholder="End date upload">
			</div></div>
		</td>
		<td>
			<button class="btn btn-success" id="submit">Submit</button>
		</td>
	</tr>
</table>
<div class="content-master-data" style="margin-top:20px; margin-bottom:20px; border-top:2px solid #ccc;"></div>
<script type="text/javascript">
$(document).ready(function(){
	$('select.sumoselect').SumoSelect();
	$('#sandbox-container .input-daterange').datepicker({
	    format: "yyyy-mm-dd"
	})
	$('button#submit').click(function(){
		$.get('<?php echo base_url() ?>manifest/get/master_data',{'data_type':'','status':'','start_date':'','end_date':''},function(data){
			alert(data);
		})
	})
})
</script>
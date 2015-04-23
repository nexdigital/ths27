<table>
	<tr>
		<td>
			<select class="sumoselect" placeholder="Select Type">
			    <option value="master">Master</option>
			    <option value="host">Host</option>
			</select>
		</td>
		<td>
			<select class="sumoselect" placeholder="Select Status" multiple="">
			    <option value="new">New</option>
			    <option value="on_progress">On Progress</option>
			    <option value="delivered">Delivered</option>
			    <option value="closing">Closing</option>
			</select>
		</td>
		<td>
			<div class="SumoSelect" tabindex="0">
				<input type="text" class="CaptionCont SlectBox SlectBox_ex datepicker" placeholder="Upload Date">
			</div>
		</td>
		<td>
			<button class="btn btn-success">Process</button>
		</td>
	</tr>
</table>

<script type="text/javascript">
$(document).ready(function(){
	$('select.sumoselect').SumoSelect();
	$('input.datepicker').datepicker();
})
</script>
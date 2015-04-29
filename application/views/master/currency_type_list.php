<div class="toolbar">
	<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'master/view/currency/add_type'?>')">Add Rate Type</button>
</div>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="60px">&nbsp;</th>
			<th>Currency Type</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($list_currency_type as $row){
		echo '
			<tr>
				<td><button class="btn btn-primary" title="Edit" onCLick="setPage(\''.base_url().'master/view/currency/edit_type\')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
				<td>'.$row->currency_type_name.'</td>
			</tr>
		';
	}?>
	</tbody>
</table>
<div class="toolbar">
    <div class="btn-group" role="group" aria-label="...">
        <button type="button" class="btn btn-default" onclick="setPage('<?php echo base_url('manifest/view/master') ?>')">Back</button>
    </div>
</div>
<div class="form-group">
	<label>Hawb No<label class="required-filed">*</label></label>
	<input type="text" class="form-control" id="hawb_no" name="hawb_no" minlength="1"  required>
</div>

<table id="table_data" class="table table-striped">
	<thead>
		<tr>
			<th width="15%">Hawb No</th>
			<th width="35%">Shipper</th>
			<th width="35%">Consignee</th>
			<th width="10%">Type</th>
			<th width="10%">Status</th>
			<th width="10%">Created Date</th>
			<th width="10%">Created By</th>
			<th width="10%">Last Updated</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$query = $this->db->query("select * from manifest_data_table where file_id = ? and  lower(status) in ('verified','hold','success','finish')",array($fileid));
			foreach($query->result() as $row) {
				$shipper = $this->db->query("select * from customer_table where reference_id = '".$row->shipper."'");
				$consignee = $this->db->query("select * from customer_table where reference_id = '".$row->consignee."'");
				echo '
					<tr>
						<td>
							<!-- Split button -->
							<div class="btn-group">
							  <button type="button" class="btn btn-default btn-sm" onCLick="setPage(\''.base_url('manifest/view/details?hawb_no='.$row->hawb_no).'\')">'.$row->hawb_no.'</button>
							  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height:30px;">
							    <span class="caret"></span>
							    <span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
							    <li><a href="javascript:;" onCLick="setPage(\''.base_url('manifest/view/details?hawb_no='.$row->hawb_no).'\')">Details</a></li>
							    <li class="hidden"><a href="javascript:;">Payment</a></li>
							  </ul>
							</div>
						</td>
						<td>'.$shipper->row('name').'</td>
						<td>'.$consignee->row('name').'</td>
						<td>'.$row->manifest_type.'</td>
						<td>'.$row->status.'</td>
						<td>'.$row->created_date.'</td>
						<td>'.$row->user_id.'</td>
						<td>'.$row->last_update.'</td>
					</tr>
				';
			}
		?>
	</tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){
     $('input[name="hawb_no"]').autoComplete({
		minChars: 1,
		source: function(term, response){
			xhr = $.getJSON('<?php echo base_url('manifest/findhawb') ?>', { q: term }, function(data){ response(data); });
		},
		onSelect: function(e, term, item){
	    	var $fileid = '<?php echo $fileid ?>';
	    	$.get('<?php echo base_url('manifest/addhostmanifest') ?>',{file_id:$fileid,hawb_no:term},function(data){
	    		$data = JSON.parse(data);
	    		if($data.status == 'ok')
	    			setPage('<?php echo base_url('manifest/view/getdetailsmanifest?file_id='.$fileid)?>');
	    	});
		}
    });  
});  
</script>

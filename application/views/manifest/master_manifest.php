<table id="table_data" class="table table-striped">
	<thead>
		<tr>
			<th width="15%">Mawb No</th>
			<th width="35%">Consignee To</th>
			<th width="25%">Flight From</th>
			<th width="25%">Flight To</th>
			<th>Total Host</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$query = $this->db->query("select * from manifest_file_table order by created_date desc");
			foreach($query->result() as $row) {
				$totalhost = $this->db->query("select * from manifest_data_table where file_id = ?",array($row->file_id))->num_rows();
				echo '
					<tr>
						<td>
							<!-- Split button -->
							<div class="btn-group">
							  <button type="button" class="btn btn-default btn-sm" id="detailsmanifest" data-mawbno="'.$row->mawb_no.'">'.$row->mawb_no.'</button>
							</div>
						</td>
						<td>'.$row->consign_to.'</td>
						<td>'.$row->flight_to.'</td>
						<td>'.$row->flight_from.'</td>
						<td><a href="javascript:void(0);" onClick="setPage(\''.base_url('manifest/view/getdetailsmanifest?file_id='.$row->file_id).'\')">'.$totalhost.'</a></td>
					</tr>
				';
			}
		?>
	</tbody>
</table>

<button type="button" class="btn btn-primary" id="createmanifest">Create New</button>


<!-- Modal -->
<div class="modal fade" id="modalcreatemanifest" role="dialog">
<form id="formcreatemanifest" method="post" action="<?=site_url('manifest/ajax/createmanifest')?>">
<input type="hidden" name="file_id">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
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
		                <?php foreach ($this->tool_model->list_partner() as $key => $value) {
		                    echo "<option value='".$value->partner_id."'>".$value->company_name."</option>";
		                } ?>          
		            </select>
		        </div>
		    </div>
		    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
		        <div class="col-lg-6 col-sm-6 col-xs-6">
		            <div class="form-group">
		                <label>From</label>
		                <select class="form-control flight_from" name="flight_from" required>
		                    <option value="indonesia">Indonesia</option>
		                    <option value="vietnam">Vietnam</option>
		                    <option value="taiwan">Taiwan</option>
		                    <option value="china">China</option>
		                    <option value="hongkong">Hongkong</option>
		                	<!--<?php
		                		foreach($this->tool_model->list_country() as $row){
		                			echo '<option value="'.$row->country_id.'">'.$row->country_name.'</option>';
		                		}
		                	?>-->
		                </select>                                     
		            </div>
		        </div>
		        <div class="col-lg-6 col-sm-6 col-xs-6">
		            <div class="form-group">
		                <label>To</label>
		                <select class="form-control flight_to" name="flight_to" required>
		                    <option value="indonesia">Indonesia</option>
		                    <option value="vietnam">Vietnam</option>
		                    <option value="taiwan">Taiwan</option>
		                    <option value="china">China</option>
		                    <option value="hongkong">Hongkong</option>
		                	<!--<?php
		                        foreach($this->tool_model->list_country() as $row){
		                            echo '<option value="'.$row->country_id.'">'.$row->country_name.'</option>';
		                        }
		                    ?>-->
		                </select>                                  
		            </div>
		        </div>
		    </div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</form>
</div>


<script type="text/javascript">
$(document).ready(function(){
	var $modal = $('#modalcreatemanifest');

	$("#table_data").DataTable();	
	$(document).on('click','.close-modal',function(){
		$modal.modal('hide');
		$('.modal-backdrop').remove();
	});
	$(document).on('click','#createmanifest',function(){
		$modal.find('.modal-title').text("Create Manifest");
		$modal.find('input').val('').removeAttr("disabled");
		$modal.modal('show');
	});
	$(document).on('click','#detailsmanifest',function(){
		var $this = $(this);
		var $mawbno = $this.data('mawbno');

		$.get('<?php base_url() ?>manifest/ajax/getfilemanifest',{mawbno:$mawbno},function(data){
			var $data = JSON.parse(data);
			console.log($data);

			$modal.find('input[name=file_id]').val($data.file_id);
			$modal.find('input[name=mawb_no]').val($data.mawb_no).attr("disabled", "disabled");
			$modal.find('input[name=consign_to]').val($data.consign_to);
			$modal.find('input[name=flight_no]').val($data.flight_no);
			$modal.find('select[name=flight_from]').val($data.flight_from);
			$modal.find('select[name=flight_to]').val($data.flight_to);
			$modal.find('input[name=partner_id]').val($data.partner_id);
			$modal.find('input[name=gross_weight]').val($data.gross_weight);
			$modal.find('.modal-title').text("Details Manifest #" + $data.mawb_no);
			$modal.modal('show');
		});
	});	

	$('form#formcreatemanifest').validate({
		rules: { mawb_no: { required: true, remote: "manifest/ajax/check_available_mawb" } },
		messages: { mawb_no: { remote: 'Hawb no has been used' } }
	});
	$('form#formcreatemanifest').ajaxForm({
		dataType:'json',
		success:function(data){
			$data = data;

			if($data.status == 'ok'){
				$modal.modal('hide');
				$('.modal-backdrop').remove();
				setTimeout(function(){
					setPage('<?php echo base_url() ?>manifest/view/master');
				},2000);
			}
			else
				alert('Something wrong');
		}
	})
})
</script>
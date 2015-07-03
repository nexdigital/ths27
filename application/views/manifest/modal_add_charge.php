<div class="modal-dialog">
    <div class="modal-content">
    <form id="form_add_charge" method="post" action="<?php echo base_url().'manifest/ajax/add_charge' ?>">
      <input type="hidden" value="<?php echo $data->hawb_no ?>" name="hawb_no">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Charge</h4>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Type</label>
                <select class="form-control discount_type" name="type" required>
                    <option value="PIBK">PIBK</option>
                    <option value="PDRI">PDRI</option>
                    <option value="OTHER">OTHER</option>
                </select>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" style="resize:none;" required></textarea>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>Currency</label>
                <select name="currency" class="form-control">
                    <option value="IDR">IDR</option>
                    <option value="<?php echo $data->currency ?>"><?php echo $data->currency ?></option>
                </select>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>Value</label>
                <input class="form-control" name="value" required>
            </div>
        </div>

      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary submit_add_discount">Save</button>
      </div>
    </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#form_add_charge').validate();
        $('#form_add_charge').ajaxForm({
            success:function(){
                $('#modal_box').modal('hide');
                setTimeout(function(){
                    setPage('<?php echo base_url('manifest/view/details?hawb_no='.$data->hawb_no) ?>');                    
                },1500);                
            }
        })
    })
</script>
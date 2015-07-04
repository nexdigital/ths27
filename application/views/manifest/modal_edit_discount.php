<div class="modal-dialog">
  <div class="modal-content">
  <form id="form_add_discount" method="post" action="<?php echo base_url().'manifest/ajax/edit_discount?discount_id='.$discount->discount_id ?>">
    <input type="hidden" value="<?php echo $data->hawb_no ?>" name="hawb_no">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Edit Discount #<?php echo $discount->discount_id ?></h4>
    </div>
    <div class="modal-body">
    <div class="row">
      <div class="col-sm-6">
          <div class="form-group">
              <label>Type</label>
              <select class="form-control discount_type" name="type" required>
                  <option value="rate" <?php echo ($discount->type == 'rate') ? 'selected="selected"' : '' ?>>rate</option>
                  <option value="kurs" <?php echo ($discount->type == 'kurs') ? 'selected="selected"' : '' ?>>kurs</option>
                  <option value="total" <?php echo ($discount->type == 'total') ? 'selected="selected"' : '' ?>>total</option>
              </select>
          </div>
      </div>

      <div class="col-sm-6">
          <div class="form-group">
              <label>Discount Value</label>
              <input type="text" class="form-control discount-value" name="value" value="<?php echo $discount->value ?>" required>
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
        $('#form_add_discount').validate();
        $('#form_add_discount').ajaxForm({
            success:function(){
                $('#modal_box').modal('hide');
                setTimeout(function(){
                    setPage('<?php echo base_url('manifest/view/details?hawb_no='.$data->hawb_no) ?>');                    
                },1500);
            }
        })
    })
</script>
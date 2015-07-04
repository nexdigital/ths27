<div class="modal-dialog">
  <div class="modal-content">
  <form id="form_add_discount" method="post" action="<?php echo base_url().'manifest/ajax/add_discount' ?>">
    <input type="hidden" value="<?php echo $data->hawb_no ?>" name="hawb_no">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Add Discount</h4>
    </div>
    <div class="modal-body">
    <div class="row">
      <div class="col-sm-6">
          <div class="form-group">
              <label>Type</label>
              <select class="form-control discount_type" name="type" required>
                  <option value="rate">rate</option>
                  <option value="kurs">kurs</option>
                  <option value="total">total</option>
              </select>
          </div>
      </div>

      <div class="col-sm-6">
          <div class="form-group">
              <label>Discount Value</label>
              <input type="text" class="form-control discount-value" name="value" required>
          </div>
      </div>

      <div class="col-sm-6">
          <div class="form-group">
              <label>Normal Price</label>
              <p class="form-control discount-normal-price"><?php echo 'Rp. ' . number_format($this->manifest_model->subtotal($data->hawb_no,'all')) ?></p>
          </div>
      </div>

      <div class="col-sm-6">
          <div class="form-group">
              <label>Discount Price</label>
              <p class="form-control discount-after-price"></p>
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
        $('.discount-value').keyup(function(){
            var type = $('.discount_type').val();
            var value = $(this).val();

            $.post('<?php echo base_url('manifest/get/sum_total_after_discount') ?>',{'hawb_no':'<?php echo $data->hawb_no ?>','type':type,'value':value},function(data){
                $('.discount-after-price').html(data);
            })
        })
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
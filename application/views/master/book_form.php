<div class="form-group">
  <label>CashBook Id <label class="required-filed">*</label></label>
  <input type="text" class="form-control" id="concept" name="concept" readonly>
</div>

<div class="form-group">
  <label>Cashbook Type </label>
  <input type="radio" name="cb_type" id="cash" checked> Cash 
  <input type="radio" name="cb_type" id="bank"> Bank
</div>

<div class="form-group">
  <label>Currency <label class="required-filed">*</label></label>
  <select name="currency_from" class="form-control" id="currency">
  <option value=""></option>
  <?php foreach ($list_country as $row) {
  echo '<option value="'.$row->country_id.'">'.$row->country_name.' - '.$row->currency_name.' - '.$row->currency_symbol.'</option>';
  } ?>
  </select>
</div>

<div class="cash"> 
  <div class="form-group">
    <label>CashBook Name <label class="required-filed">*</label></label>
    <input type="text" class="form-control" id="concept" name="concept">
  </div>

  <div class="form-group">
    <label>Description</label>
    <textarea class="form-control" style="resize:none"></textarea>
  </div>
</div>

<!-- if type is transfer -->

<div class="transfer" style="display:none">
  <div class="form-group">
    <label>Bank Id <label class="required-filed">*</label></label>
    <input type="text" class="form-control" id="concept" name="concept">
  </div>

  <div class="form-group">
    <label>Bank Name <label class="required-filed">*</label></label>
    <select class="form-control" id="bank_name">
      <option></option>
      <option>BCA</option>
      <option>MANDIRI</option>
      <option>BNI</option>
    </select>
  </div>

  <div class="form-group">
    <label>Account Number <label class="required-filed">*</label></label>
    <input type="text" class="form-control" id="concept" name="concept">
  </div>

  <div class="form-group">
    <label>Account Name <label class="required-filed">*</label></label>
    <input type="text" class="form-control" id="concept" name="concept">
  </div>

  <div class="form-group">
    <label>Bank Branch <label class="required-filed">*</label></label>
    <input type="text" class="form-control">
  </div>
</div>

<button class="btn btn-success">Add Cash / Bank book</button>
<button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/bank/index')">Cancel</button>


<script>
  $('#bank').click(function() {
    $('.cash').hide(function(){      
      $('.transfer').fadeIn();
    });
  });

  $('#cash').click(function() {                  
    $('.transfer').hide(function(){
      $('.cash').fadeIn();
    });
  });
</script>
<div class="form-group">
    <label>Bank ID <label class="required-filed">*</label></label>
    <input type="text" class="form-control">
</div>

<div class="form-group">
    <label>Bank Name <label class="required-filed">*</label></label>
    <input type="text" class="form-control">
</div>

<div class="form-group">
    <label>Bank Swift Code <label class="required-filed">*</label></label>
    <input type="text" class="form-control">
</div>

<div class="form-group">
    <label>Description</label>
    <textarea class="form-control"></textarea>
</div>

<div class="form-group">
    <label>&nbsp;</label>
    <input type="checkbox"> Active
</div>

<button class="btn btn-success">Add Bank</button>
<button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/bank/index')">Cancel</button>
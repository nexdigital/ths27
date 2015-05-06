<div class="form-group">
    <label>Business Id <label class="required-filed">*</label></label>
    <input type="text" class="form-control">
</div>

<div class="form-group">
    <label>Business Name <label class="required-filed">*</label></label>
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
<button type="button" class="btn btn-primary">Submit</button>
<button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/business')">Cancel</button>
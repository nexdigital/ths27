<div class="form-group">
  <label>User ID <label class="required-filed">*</label></label>
  <input type="text" class="form-control" id="concept" name="concept" readonly>
</div>

<div class="form-group">
  <label>Name <label class="required-filed">*</label></label>
  <input type="text" class="form-control" id="concept" name="concept">
</div>

<div class="form-group">
  <label >Password <label class="required-filed">*</label></label>
  <input type="password" class="form-control" id="Password" name="Password">
</div>

<div class="form-group">
  <label >Email <label class="required-filed">*</label></label>
  <input type="email" class="form-control" id="concept" name="concept">
</div>

<div class="form-group">
  <label >User Level <label class="required-filed">*</label></label>
  <select class="form-control sumoselect">
    <option>Finance</option>
    <option>Accouting</option>
    <option>Super User</option>
    <option>Admin</option>
  </select>
</div>

<div class="form-group">
  <label >Description</label>
  <textarea class="form-control"></textarea>
</div>

<div class="form-group">
  <input type="checkbox"> Active
</div>

<button class="btn btn-success">Add User</button>
<button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/user/index')">Cancel</button>

<script type="text/javascript">
$(document).ready(function(){
 		$('select.sumoselect').sumoselect();
})
</script>
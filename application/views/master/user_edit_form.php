
<form id="edit_user_form" method="post" action="<?php echo base_url('master/user/update_user')?>">

 <input type="hidden" class="form-control" id="user_id" name="user_id"  value= "<?php echo $get_user->user_id ?>">

<div class="form-group">
  <label>Name <label class="required-filed">*</label></label>
  <input type="text" class="form-control" id="username" name="username" value= "<?php echo $get_user->username ?>" required>
</div>

<div class="form-group">
  <label >Password <label class="required-filed">*</label></label>
  <input type="password" class="form-control" id="password" name="password" value= "<?php echo $get_user->password ?>">
</div>

<div class="form-group">
  <label >Email <label class="required-filed">*</label></label>
  <input type="email" class="form-control" id="email" name="email" value= "<?php echo $get_user->email ?>" required>
</div>

<div class="form-group">
  <label >User Level <label class="required-filed">*</label></label>
  <select class="form-control" id="user_level" name="user_level" required>
          <option value=""></option>
          <?php 
          foreach ($get_type as $key => $value) {
              echo "<option value='".$value->id_type."'>".$value->type."</option>";
          }
             


          ?>


  </select>
</div>

<div class="form-group">
  <label >Description</label>
  <textarea class="form-control" name="description" id="description"><?php echo $get_user->description ?></textarea>
</div>

<div class="form-group">
  <input type="checkbox" name="status_active" id="status_active" <?php echo ($get_user->status == 'active') ? 'checked="checked"' : ''?>> <label for="status_active">Active</label>
</div>

<button type="reset" class="btn btn-success btn-submit"  onClick="setPage('<?php echo base_url('master/user/add_user')?>')">Create New</button>
<button class="btn btn-success" onclick= "edit_user();">Update User</button>
<button type="reset" class="btn btn-success btn-submit"  onClick="setPage('<?php echo base_url('master/user/delete/'.$get_user->user_id)?>')">Delete</button>

<button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/user/index')">Cancel</button>
<label id="alert-message" class="alert alert-success" style="display:none;padding-bottom:5px;padding-top:5px;padding-right:5px;padding-left:5px;"></label>
</form>


<script type="text/javascript">
$(document).ready(function(){
 		
    $('form#edit_user_form').validate();



    var user_level = "<?php echo $get_user->type ?>";

    $("#user_level").val(user_level);
    
});


function edit_user(){


   $('form#edit_user_form').ajaxForm({
        dataType:'json',
        success: function(data){
            
            if(data.status == true){

                 $('#alert-message').removeClass("alert alert-danger").addClass("alert alert-success").html(data.message).fadeIn();

                setTimeout(function(){
                          $('#alert-message').html(data.message).fadeOut();
                          setPage('<?php echo base_url() ?>master/user/index') ;
                      },800);
            }else{

                $('#alert-message').removeClass("alert alert-success").addClass("alert alert-danger").html(data.message).fadeIn();
                   setTimeout(function(){
                          $('#alert-message').html(data.message).fadeOut();
                      },800);
            }
             
      }
  });
}

</script>
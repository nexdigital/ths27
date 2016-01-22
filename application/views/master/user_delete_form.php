
<form id="delete_user_form" method="post" action="<?php echo base_url('master/user/delete_user')?>">

  <input type="hidden" class="form-control" id="user_id" name="user_id"  value= "<?php echo $get_user->user_id ?>">

<div class="form-group">
  <label>Name <label class="disabled-filed">*</label></label>
  <input type="text" class="form-control" id="username" name="username" value= "<?php echo $get_user->username ?>" disabled>
</div>

<div class="form-group">
  <label >Password <label class="disabled-filed">*</label></label>
  <input type="password" class="form-control" id="password" name="password" value= "<?php echo $get_user->password ?>" disabled>
</div>

<div class="form-group">
  <label >Email <label class="disabled-filed">*</label></label>
  <input type="email" class="form-control" id="email" name="email" value= "<?php echo $get_user->email ?>" disabled>
</div>

<div class="form-group">
  <label >User Level <label class="disabled-filed">*</label></label>
  <select class="form-control" id="user_level" name="user_level" disabled>
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
  <textarea class="form-control" name="description" disabled id="description"><?php echo $get_user->description ?>disabled></textarea>
</div>

<div class="form-group">
  <input type="checkbox" name="status_active" id="status_active" disabled <?php echo ($get_user->status == 'active') ? 'checked="checked"' : ''?>> <label for="status_active">Active</label>
</div>

<button class="btn btn-success" onclick= "delete_user();">Yes</button>
<button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url("master/user/update/".$get_user->user_id)?>')">Cancel</button>
<label id="alert-message" class="alert alert-success" style="display:none;padding-bottom:5px;padding-top:5px;padding-right:5px;padding-left:5px;"></label>
</form>


<script type="text/javascript">
$(document).ready(function(){
 		
    $('form#edit_user_form').validate();

    var user_level = "<?php echo $get_user->type ?>";

    $("#user_level").val(user_level);
    
});


function delete_user(){


  $('form#delete_user_form').ajaxForm({
        dataType:'json',
        success: function(data){
          
                 $('#alert-message').html(data.message).fadeIn();

                setTimeout(function(){
                          $('#alert-message').html(data.message).fadeOut();
                          setPage('<?php echo base_url() ?>master/user/index') ;
                      },800);
      }
  });
}

</script>
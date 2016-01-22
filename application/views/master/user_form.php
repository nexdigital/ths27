
<form id="create_user_form" method="post" action="<?php echo base_url('master/user/insert_user')?>">
<div class="form-group">

  <?php $get_user_id = $this->master_user->user_new_id() ?>
  <label>User ID <label class="required-filed">*</label></label>
    <input type="text" class="form-control" id="user_id" name="user_id"  value= "<?php echo $get_user_id ?>"required>

</div>

<div class="form-group">
  <label>Name <label class="required-filed">*</label></label>
  <input type="text" class="form-control" id="username" name="username" required>
</div>

<div class="form-group">
  <label >Password <label class="required-filed">*</label></label>
  <input type="password" class="form-control" id="password" name="password" required>
</div>

<div class="form-group">
  <label >Email <label class="required-filed">*</label></label>
  <input type="email" class="form-control" id="email" name="email" required>
</div>

<div class="form-group">
  <label >User Level <label class="required-filed">*</label></label>
  <select class="form-control" name="user_level" required>
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
  <textarea class="form-control" name="description" id="description"></textarea>
</div>

<div class="form-group">
  <input type="checkbox" name="status_active"> Active
</div>

<button class="btn btn-success" onclick= "add_user();">Add User</button>
<button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/user/index')">Cancel</button>
<label id="alert-message" style="display:none;padding-bottom:5px;padding-top:5px;padding-right:5px;padding-left:5px;"></label>
</form>
<script type="text/javascript">
$(document).ready(function(){

     $('input[name="user_id"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('master/user/autoComplete') ?>', { q: term }, function(data){ response(data); });
          },
          onSelect: function(e, term, item){
            setPage('<?php echo base_url('master/user/update')?>/' + term);
          }
      });
    $("#create_user_form").validate();

});


function add_user(){


  $('form#create_user_form').ajaxForm({
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
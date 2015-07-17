<link href="<?php echo base_url()?>style/css/bootstrap.css" rel="stylesheet" type="text/css" />
<style>
    body {
    background-color: white;
}

#loginbox {
    margin-top: 30px;
}

#loginbox > div:first-child {
    padding-bottom: 10px;
}

.iconmelon {
    display: block;
    margin: auto;
}

#form > div {
    margin-bottom: 25px;
}

#form > div:last-child {
    margin-top: 10px;
    margin-bottom: 10px;
}

.panel {
    background-color: transparent;
}

.panel-body {
    padding-top: 30px;
    background-color: rgba(2555,255,255,.3);
}

#particles {
    width: 100%;
    height: 100%;
    overflow: hidden;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    position: absolute;
    z-index: -2;
}

.iconmelon,
.im {
  position: relative;
  width: 150px;
  height: 150px;
  display: block;
  fill: #525151;
}

.iconmelon:after,
.im:after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}


</style>
<div class="container">

    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">

        <div class="row">
            <div class="iconmelon">
              <svg viewBox="0 0 32 32">
                <g filter="">
                  <use xlink:href="#git"></use>
                </g>
              </svg>
            </div>
        </div>

        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title text-center">Login</div>
            </div>

            <div class="panel-body" >

                 <div  id="alert-form" style="display:none"></div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="user" type="text" class="form-control" name="username" value="" placeholder="User">
                    </div>
                        <br/>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                       <br/>
                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                           <button onclick="login()" class="btn btn-primary">Sign in</button>
                        </div>
                    </div>



            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url()?>style/js/jquery-1.11.2.min.js"></script>

<script src="<?php echo base_url()?>style/js/bootstrap.min.js" type="text/javascript"></script>

<script>

 function login(){

        var base_url  = "<?php echo base_url()?>";
        var username  = $("#user").val();
        var password  = $("#password").val();

     	$.ajax({
                url         : base_url + "login/sbt_login",
                type        : "POST",
               	dataType    :'json',
                data        : { username: username, password: password },
                success: function(data){
                       
                        if(data.status == true){
                               $('#alert-form').removeClass("alert alert-danger").addClass("alert alert-success").html(data.message).fadeIn();
                               setTimeout(function(){
                                    $('#alert-form').html(data.message).fadeOut();
                                      location.reload();
                                },1000);
                         }else{
                              $('#alert-form').removeClass("alert alert-success").addClass("alert alert-danger").html(data.message).fadeIn();
                              setTimeout(function(){
                                    $('#alert-form').html(data.message).fadeOut();
          
                                },800);
                         }
                }
        });

 }

</script>
<script src="<?php echo base_url()?>style/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo base_url()?>style/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url()?>style/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/js/jquery-ui.min.js" type="text/javascript"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url()?>style/js/raphael-min.js"></script>
<script src="<?php echo base_url()?>style/js/plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo base_url()?>style/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo base_url()?>style/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url()?>style/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url()?>style/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker 
<script src="<?php echo base_url()?>style/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url()?>style/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url()?>style/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url()?>style/js/AdminLTE/app.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="<?php echo base_url()?>style/js/AdminLTE/dashboard.js" type="text/javascript"></script> -->

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>style/js/AdminLTE/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/js/jquery.site.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>style/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/js/jquery.form.js" type="text/javascript"></script>   
<script src="<?php echo base_url()?>style/js/bootstrap-datepicker.js" type="text/javascript"></script>   
<script src="<?php echo base_url()?>style/lib/select2/select2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/lib/sumoselect/jquery.sumoselect.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/lib/autocomplete/jquery.auto-complete.js" type="text/javascript"></script>
<script type="text/javascript">
setPage('<?php echo base_url('master/dashboard') ?>');
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script> 
<script type="text/javascript">
jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
}, "Letters, numbers, and underscores only please");
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;

</script> 
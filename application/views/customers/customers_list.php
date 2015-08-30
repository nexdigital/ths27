
<table id="example2" class="table  table-striped table-hovered">         
  <thead>
    <th>Reference ID</th>
    <th>Name</th>
    <th>Attn</th>
    <th>Country</th>
    <th>Telepon Number</th>
    <th>Entry by</th>
    <th>Entry date</th>
    <th>Modified by</th>
    <th>Modified date</th>
    <th>Status</th>

  </thead>

  <tbody>
    <?php 
      foreach($get_customers as $key => $val){

      if(strlen($val->name) >20 ){ $name = substr($val->name,0,20).'...';}else{ $name = $val->name; }
      if(strlen($val->phone) >20 ){ $phone = substr($val->phone,0,20).'...';}else{$phone = $val->phone; }
      if(strlen($val->attn) >20 ){ $attn = substr($val->attn,0,20).'...';}else{$attn = $val->attn; }

      echo '<tr>
      <td><a href="javascript:;" onClick="setPage(\''.base_url('customers/view_customer/'.$val->reference_id.'').'\')">'.$val->reference_id.'</a></td>
      <td>'.$name.'</td>
      <td>'.$attn.'</td>
      <td>'.$val->country_name.'</td>
      <td>('.$val->code_phone.') '.$phone.'</td>
      <td>'.$val->create_by.'</td>
      <td>'.$val->create_date.'</td>
      <td>'.$val->update_by.'</td>
      <td>'.$val->update_date.'</td>
      <td>'.$val->status_active.'</td>
      </tr>';
      } ?>
  </tbody>
</table>
<a href="#" onClick="setPage('<?php echo base_url('customers/add_customer')?>')"><button class="btn btn-primary">Add Customer</button></a>              

<script type="text/javascript">
$(document).ready(function(){ 

  $('table.table').dataTable({
     "bFilter": false
  });
  $('select.sumoselect').SumoSelect();
  $("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
});
</script>
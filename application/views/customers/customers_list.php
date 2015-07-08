<div class="toolbar">
  <table>
    <tr>
      <td>
          <select class="form-control sumoselect" multiple="" placeholder="Select Group">
            <option value="Group 1">Group 1</option>
            <option value="Group 2">Group 2</option>
            <option value="Group 3">Group 3</option>
            <option value="Group 4">Group 4</option>
          </select>
      </td>
      <td>
        <input type="text" class="form-control sumoselect" placeholder="Search Name">
      </td>
      <td>
        <button class="btn btn-success" id="submit">Submit</button>
      </td>
    </tr>
  </table>
</div>

<table id="example2" class="table table-bordered table-striped table-hovered">         
  <thead>
   
    <th>Reference ID</th>
    <th>Name</th>
    <th>Address</th>
    <th>City</th>
    <th>Country</th>
    <th>Email</th>
    <th>Status</th>
  </thead>

  <tbody>
    <?php 
      foreach($get_customers as $key => $val){
      echo '<tr>
      <td><a href="javascript:;" onClick="setPage(\''.base_url('customers/view_customer/'.$val->reference_id.'').'\')">'.$val->reference_id.'</a></td>
      <td>'.$val->name.'</td>
      <td>'.$val->address.'</td>
      <td>'.$val->city.'</td>
      <td>'.$val->country.'</td>
      <td>'.$val->email.'</td>
      <td>'.$val->status_active.'</td>
      </tr>';
      } ?>
  </tbody>
</table>
<a href="#" onClick="setPage('<?php echo base_url('customers/add_customer')?>')"><button class="btn btn-success">Add Customer</button></a>              

<script type="text/javascript">
$(document).ready(function(){ 

  $('#example2').dataTable();
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

<div class="panel panel-default">

  <div class="panel-heading">
                    
                    </div>

  <div class="panel-body">
      <div class="row">

          <div class="col-md-4">
              <select class="form-control" id="sort_by">
                    <option></option>

              </select>
          </div>

          <div class="col-xs-6 col-sm-3">
              <div class="form-group">
                  <div class="input-group merged">
                        <input class="form-control" placeholder="Reference ID">
                  </div>
              </div>

        </div>

        <div class="col-xs-6 col-sm-3" style="margin-left:-10%">
              <div class="form-group">
                  <div class="input-group merged">
                       
                        <input class="form-control" placeholder="Customer Name...">
                         <span class="input-group-addon"><i class="fa fa-search"></i></span>
                  </div>
              </div>

        </div>
         
      </div>

</div>
</div>




<div class="table-responsive">

          <table  class="table table-bordered table-striped table-hovered">         
                   <thead>
                          <th>Reference ID</th>
                          <th>Name</th>
                          <th>Address</th>
                          <th>City</th>
                        <!--  <th>State</th> -->
                          <th>Country</th>
                          <th>Email</th>
                          <th>Status</th>
                        
                   </thead>
    <tbody>
            <?php 
              if($get_customers > 0 ){
              foreach($get_customers as $key => $val){
              echo '<tr>
                      <td><a href="javascript:;"onClick="setPage(\''.base_url().'customers/view_customer/\')">'.$val->reference_id.'</a></td>
                      <td>'.$val->name.'</td>
                      <td>'.$val->address.'</td>
                      <td>'.$val->city.'</td>
                      <td>'.$val->country.'</td>
                      <td>'.$val->email.'</td>
                      <td>'.$val->status_active.'</td>
                    </tr>';
                  }

          }else echo "empty"; ?>
       
        
   
    
    </tbody>
        
</table>
  <a href="#" onClick="setPage('<?php echo base_url('customers/add_customer')?>')"><button class="btn btn-success">Add Customer</button></a>              
      </div>
            
</div>






<script>
$(document).ready(function(){

  $('#sort_by').select2({
    placeholder: "sort by group...",

  });
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
<table id="table_tax"  class="table table-bordered table-striped table-hovered">
  <thead>
     <th>ID</th>
     <th>Tax Name</th>
     <th>Description</th>
     <th>Tax base amount</th>
     <th>Tax rate</th>
     <th>Enty by</th>
     <th>Status</th>
  </thead>

  <tbody>
      <?php 
          foreach ($get_tax as $key => $value) {
              echo ' 

                  <tr>
                      <td><a href="javascript:;" onClick="setPage(\''.base_url('master/tax/edit_tax/'.$value->tax_id.'').'\')">'.$value->tax_id.'</a></td>
                      <td>'.$value->tax_name.'</td>
                      <td>'.$value->description.'</td>
                      <td>'.$value->tax_base_amount.'</td>
                      <td>'.$value->tax_rate.'</td>
                      <td>'.$value->created_by.'</td>
                      <td>'.$value->is_active.'</td>
                </tr>



              ';
          }

      ?>

  </tbody>


</table>

<a href="#" onClick="setPage('<?php echo base_url('master/tax/add_tax')?>')"><button class="btn btn-primary">Add Tax</button></a> 
<button class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print to CSV</button>

<script>
  $('#table_tax').DataTable();

</script>
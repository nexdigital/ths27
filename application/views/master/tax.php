<table  class="table table-bordered table-striped table-hovered">
  <thead>
    <th width="50px">&nbsp;</th>
     <th>Tax Id</th>
     <th>Tax Name</th>
     <th>Description</th>
     <th>Tax base amount</th>
     <th>Tax rate</th>
     <th>Entry date</th>
     <th>Enty by</th>
  </thead>

  <tbody>
    <td>
      <button class="btn btn-primary" title="Delete" onCLick="alert('Deleted')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
    </td>
    <td><a href="javascipr:;">ID</a></td>
    <td>test test</td>
    <td>1123</td>
    <td>Super User</td>
    <td>100</td>
    <td>23 January 2015</td>
    <td>User 1</td>
  </tbody>


</table>

<a href="#" onClick="setPage('<?php echo base_url('master/tax/add_tax')?>')"><button class="btn btn-primary">Add Tax</button></a> 
<button class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print to CSV</button>
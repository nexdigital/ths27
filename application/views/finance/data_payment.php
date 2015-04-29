<div class="panel panel-default">

  <div class="panel-heading">
                    
                    </div>

  <div class="panel-body">
      <div class="row">

          <div class="col-md-4">
              
               <fieldset>
					  <div class="form-group">
					    
					      <div class="controls">
					        <div class="input-prepend">
					          <span class="add-on"><i class="icon-calendar"></i></span><input class="form-control"type="text" name="selectdaterange" id="selectdaterange" placeholder="Search by Date"/>
					        </div>
					      </div>
					    </div>
					  </fieldset>
          </div>

          <div class="col-xs-6 col-sm-3">
              <div class="form-group">
                  <div class="input-group merged">
                        <input class="form-control" placeholder="Hawb No">
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
<table class="table table-bordered table-striped table-hovered">
		<thead>
				<th>Action</th>
				<th>No</th>
				<th>Invoice No</th>
				<th>Hawb No</th>
				<th>Customer</th>
				<th>Payment Type</th>
				<th>Date Payment</th>
				<th>Currency</th>
				<th>payment amount</th>
				<th>Total</th>
				<th>User</th>
				<th>Status</th>

		</thead>

		<tbody>
			    <td> <a href="#"><button class="btn btn-primary"  data-toggle="tooltip" title="print"><i class="fa fa-print"></i></button></a>
			    	<a href="#"><button class="btn btn-primary" data-toggle="tooltip" title="verification"><i class="fa fa-check"></i></button></a></td>
				<td>1</td>
				<td>123</td>
				<td>PT XYX</td>
				<td>500 NT</td>
				<td>Cash</td>
				<td>25 January 2015</td>
				<td>NT</td>
				<td>123</td>
				<td>12300</td>
				<td>User 1</td>
				<td><font class="alert-warning">unverified</font></td>



		</tbody>

</table>

 <a href="#" onClick="setPage('<?php echo base_url('finance/ajax/add_payment')?>')"><button class="btn btn-primary">Add Payment</button></a> 


<script type="text/javascript">
$(document).ready(function() {
    $('#selectdaterange').daterangepicker();
});
</script>
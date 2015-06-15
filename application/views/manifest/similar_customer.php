<div class="toolbar">
    <div class="btn-group" role="group" aria-label="...">
        <button type="button" class="btn btn-default btn-back" onClick="setPage('<?php echo base_url().'manifest/view/verification_details?mawb_no='.urlencode($file->mawb_no)?>')">Back</button>
    </div>
</div>
<div class="alert alert-warning" role="alert"><?php echo $data->$customer_type ?></div>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Reference Id</th>
      <th>Name</th>
      <th>Attn</th>
      <th>Address</th>
      <th>City</th>
      <th>Country</th>
      <th>Phone</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($similar_customer as $row) {
      echo '
      <tr>
        <td><a href="javascript:;" class="btn btn-primary btn-sm select-customer" reference_id="'.$row->reference_id.'">'.$row->reference_id.'</td>
        <td>'.$row->name.'</td>
        <td>'.$row->attn.'</td>
        <td>'.$row->address.'</td>
        <td>'.$row->city.'</td>
        <td>'.$row->country.'</td>
        <td>'.$row->phone.'</td>
        <td>'.$row->email.'</td>
      </tr>
      ';
    } ?>
  </tbody>
</table>

<script type="text/javascript">
$('a.select-customer').click(function(){
  var reference_id = $(this).attr('reference_id');
  $.ajax({
    url:'<?php echo base_url('manifest/ajax/set_customer') ?>',
    type:'post',
    data:{'hawb_no':'<?php echo $data->hawb_no?>','customer_type':'<?php echo $customer_type ?>','reference_id':reference_id},
    dataType:'json',
    success:function(a){
      $('.btn-back').click();
    }
  })
})
</script>
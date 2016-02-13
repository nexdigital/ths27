<?php
    $shipper = $this->db->query("select * from customer_table where reference_id = '".$data->shipper."'");
    $consignee = $this->db->query("select * from customer_table where reference_id = '".$data->consignee."'");
?>

<div class="toolbar">
    <div class="btn-group" role="group" aria-label="...">
        <!-- Split button -->
          <button type="button" class="btn btn-default" onclick="setPage('<?php echo base_url('manifest/view/data')?>')">Back</button>
          <?php if($data->status == 'verified') { ?><button type="button" class="btn btn-default" onclick="setPage('<?php echo base_url('manifest/view/edit?hawb_no='.$data->hawb_no) ?>')">Edit</button> <?php } ?>
          <button type="button" class="btn btn-default send-email">Send Email</button>
          <button type="button" class="btn btn-default">Invoice</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height:30px;">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="javascript:;" onCLick="setPage('<?php echo base_url('invoice/edit/'.$data->hawb_no) ?>')" style="display:none;">Edit</a></li>
            <li><a href="javascript:;" class="print">Print</a></li>
          </ul>
    </div>
</div>
<div class="row" style="margin-bottom:20px;">
    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Type</label>
                <p class="form-control"><?php echo $data->manifest_type; ?></p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Hawb No</label>
                <p class="form-control"><?php echo $data->hawb_no; ?></p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Currency</label>
                <p class="form-control"><?php echo $data->currency . '   [Rp.'.$data->exchange_rate.']'; ?></p>
            </div>
        </div>
   		<div class="col-sm-3">
            <div class="form-group">
                <label>Payment</label>
                <p class="form-control"><?php echo ($data->collect) ? 'Collect' : 'Prepaid'; ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
        <div class="col-lg-6" style="padding:0px;">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Pkg</label>
                    <p class="form-control"><?php echo $data->pkg; ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Pcs</label>
                    <p class="form-control"><?php echo $data->pcs; ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Value</label>
                    <p class="form-control"><?php echo $data->value; ?></p>
                </div>
            </div>
        </div>
       	<div class="col-lg-6" style="padding:0px;">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>KG</label>
                    <p class="form-control"><?php echo $data->kg; ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Rate / Kg</label>
                    <p class="form-control"><?php echo number_format($data->rate); ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Amount</label>
                    <p class="form-control"><?php echo (trim($data->collect)) ? number_format($data->collect) : number_format($data->prepaid); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Shipper</label>
                <textarea class="form-control" rows="2" name="description" style="resize:none;" readonly> <?php echo $shipper->row('name') ?></textarea>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Consignee</label>
                <textarea class="form-control" rows="2" name="description" style="resize:none;" readonly> <?php echo $consignee->row('name'); ?></textarea>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" rows="2" name="description" style="resize:none;" readonly> <?php echo $data->description; ?></textarea>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Remarks</label>
            <textarea class="form-control" rows="2" name="description" style="resize:none;" readonly> <?php echo $data->remarks; ?></textarea>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Other Charge Tata</label>
                <p class="form-control"><?php echo $data->other_charge_tata; ?></p>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Other Charge PML</label>
            <p class="form-control"><?php echo $data->other_charge_pml; ?></p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Total <em>Exclude handling jakarta and PPN</em></label>
            <p class="form-control">Rp. <?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'normal')) ?></p>
        </div>
        <div class="col-sm-6 hidden" style="padding:0px;">
            <label>Discount</label>
            <p class="form-control">Rp. <?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'discount')) ?></p>
        </div>
        <div class="col-sm-6 hidden">
            <label>Charge</label>
            <p class="form-control">Rp. <?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'charge')) ?></p>
        </div>
        <div class="form-group">
            <label>Subtotal <em>Exclude handling jakarta and PPN</em></label>
            <p class="form-control">Rp. <?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'all')) ?></p>
        </div>
    </div>
</div>

<div class="col-lg-6 col-sm-6 col-xs-6 hidden" style="padding:0px 5px 0px 0px;">
<div class="toolbar">
    <div class="btn-group" role="group" aria-label="...">
        <!-- Split button -->
        <div class="btn-group">
          <button type="button" class="btn btn-info">Extra Charge</button>
          <?php if($data->status == 'verified') { ?>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height:30px;">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="javascript:;" class="add_charge">Add Charge</a></li>
          </ul>
          <?php } ?>
        </div>
    </div>

    <span class="pull-right"><h5><strong>Total charge:</strong> Rp.<?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'charge')) ?></h5></span>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Description</th>
            <th>Currency</th>
            <th>Value</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
        <?php 
            if($extra_charge) {
                foreach($extra_charge as $row) {
                    echo '
                        <tr>
                            <td>'.$row->charge_id.'</td>
                            <td>'.$row->type.'</td>
                            <td>'.$row->description.'</td>
                            <td>'.$row->currency.'</td>
                            <td>'.number_format($row->value).'</td>
                            <td align="right">';
                            if($data->status == 'verified') {
                            echo '
                            <a href="javascript:;" title="Edit" class="edit-charge" charge_id="'.$row->charge_id.'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                            <a href="javascript:;" title="Delete" class="delete-charge" charge_id="'.$row->charge_id.'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
                            }
                            echo '
                            </td>
                        </tr>
                    ';
                }
            }
        ?>
    <tbody>
    </tbody>
</table>
</div>

<div class="col-lg-6 col-sm-6 col-xs-6 hidden" style="padding:0px 0px 0px 5px;">
<div class="toolbar">
    <div class="btn-group" role="group" aria-label="...">
        <div class="btn-group">
          <button type="button" class="btn btn-info">Discount</button>
          <?php if($data->status == 'verified') { ?>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height:30px;">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="javascript:;" class="add_discount">Add Discount</a></li>
          </ul>
          <?php } ?>
        </div>
    </div>
    <span class="pull-right"><h5><strong>Total discount:</strong> Rp.<?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'discount')) ?></h5></span>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Value</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php if($discount) { foreach($discount as $row) {
            echo '
                <tr>
                    <td>'.$row->discount_id.'</td>
                    <td>'.$row->type.'</td>
                    <td>'.number_format($row->value).'</td>
                    <td align="right">';
                    if($data->status == 'verified') {
                    echo ' 
                    <a href="javascript:;" title="Edit" class="edit-discount" discount_id="'.$row->discount_id.'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                    <a href="javascript:;" title="Delete" class="delete-discount" discount_id="'.$row->discount_id.'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
                    }
                    echo '
                    </td>
                </tr>
                ';
        } } ?>
    </tbody>
</table>
</div>

<div id="modal_box" class="modal fade"></div>

<script type="text/javascript">
    $(document).ready(function(){
        var hawb_no = '<?php echo $data->hawb_no ?>';

        $('table.table').dataTable();
        $('.add_discount').click(function(){
            $.get('<?php echo base_url().'manifest/modal/add_discount?hawb_no='.$data->hawb_no ?>',function(data){
                $('#modal_box').html(data);
            });
            $('#modal_box').modal('show')
        })
        $('.add_charge').click(function(){
            $.get('<?php echo base_url().'manifest/modal/add_charge?hawb_no='.$data->hawb_no ?>',function(data){
                $('#modal_box').html(data);
            });
            $('#modal_box').modal('show');
        })

        $('a.delete-charge').click(function(){
            var charge_id = $(this).attr('charge_id');
            var ask = confirm('Are you sure want delete this charge?');
            if(ask) {
                $.post('<?php echo base_url().'manifest/ajax/delete_charge' ?>',{'charge_id':charge_id},function(data){
                    setPage('<?php echo base_url('manifest/view/details?hawb_no='.$data->hawb_no) ?>');
                })
            }
        })
        $('a.delete-discount').click(function(){
            var discount_id = $(this).attr('discount_id');
            var ask = confirm('Are you sure want delete this discount?');
            if(ask) {
                $.post('<?php echo base_url().'manifest/ajax/delete_discount' ?>',{'discount_id':discount_id},function(data){
                    setPage('<?php echo base_url('manifest/view/details?hawb_no='.$data->hawb_no) ?>');
                })
            }
        })
        $('a.edit-discount').click(function(){
            var discount_id = $(this).attr('discount_id');
            $.get('<?php echo base_url().'manifest/modal/edit_discount?hawb_no='.$data->hawb_no.'&discount_id='?>' + discount_id,function(data){
                $('#modal_box').html(data);
            });
            $('#modal_box').modal('show')
        })
        $('a.edit-charge').click(function(){
            var charge_id = $(this).attr('charge_id');
            $.get('<?php echo base_url().'manifest/modal/edit_charge?hawb_no='.$data->hawb_no.'&charge_id='?>' + charge_id,function(data){
                $('#modal_box').html(data);
            });
            $('#modal_box').modal('show')
        })

        $('a.print').click(function(){
            window.open("<?php echo base_url('invoice/priview/'.$data->hawb_no) ?>","_blank");
            setTimeout(function(){
                setPage('<?php echo base_url('manifest/view/details?hawb_no='.$data->hawb_no) ?>');
            },5000);
        })
        $('.send-email').click(function(){
            $.get('<?php echo base_url().'manifest/modal/send_email?hawb_no='.$data->hawb_no ?>',function(data){
                $('#modal_box').html(data);
            });
            $('#modal_box').modal('show');
        })
    })
</script>
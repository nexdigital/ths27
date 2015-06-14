<?php
    $shipper = $this->db->query("select * from customer_table where reference_id = '".$data->shipper."'");
    $consignee = $this->db->query("select * from customer_table where reference_id = '".$data->consignee."'");

?>

<div class="toolbar">
    <div class="btn-group" role="group" aria-label="...">
        <!-- Split button -->
          <button type="button" class="btn btn-default" onclick="setPage('<?php echo base_url('manifest/view/data')?>')">Back</button>
          <button type="button" class="btn btn-default" onclick="setPage('<?php echo base_url('manifest/view/edit?hawb_no='.$data->hawb_no) ?>')">Edit</button>
          <button type="button" class="btn btn-default">Invoice</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height:30px;">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="javascript:;" onCLick="setPage('<?php echo base_url('invoice/edit/'.$data->hawb_no) ?>')">Edit</a></li>
            <li><a href="javascript:;" onCLick="setPage('<?php echo base_url('invoice/print/'.$data->hawb_no) ?>')">Print</a></li>
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
                    <p class="form-control"><?php echo ($data->collect) ? number_format($data->collect) : number_format($data->prepaid); ?></p>
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
            <label>Subtotal</label>
            <p class="form-control">Rp. <?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'all')) ?></p>
        </div>
    </div>
</div>

<div class="col-lg-6 col-sm-6 col-xs-6" style="padding:0px 5px 0px 0px;">
<div class="toolbar">
    <div class="btn-group" role="group" aria-label="...">
        <!-- Split button -->
        <div class="btn-group">
          <button type="button" class="btn btn-info">Extra Charge</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height:30px;">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="javascript:;" class="add_charge">Add Charge</a></li>
          </ul>
        </div>
    </div>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Description</th>
            <th>Currency</th>
            <th>Value</th>
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
                        </tr>
                    ';
                }
            }
        ?>
    <tbody>
    </tbody>
</table>
</div>

<div class="col-lg-6 col-sm-6 col-xs-6" style="padding:0px 0px 0px 5px;">
<div class="toolbar">
    <div class="btn-group" role="group" aria-label="...">
        <!-- Split button -->
        <div class="btn-group">
          <button type="button" class="btn btn-info">Discount</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height:30px;">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="javascript:;" class="add_discount">Add Discount</a></li>
          </ul>
        </div>
    </div>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php if($discount) { foreach($discount as $row) {
            echo '
                <tr>
                    <td>'.$row->discount_id.'</td>
                    <td>'.$row->type.'</td>
                    <td>'.number_format($row->value).'</td>
                </tr>
                ';
        } } ?>
    </tbody>
</table>
</div>

<div id="modal_add_charge" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
        <form id="form_add_charge" method="post" action="<?php echo base_url().'manifest/ajax/add_charge' ?>">
          <input type="hidden" value="<?php echo $data->hawb_no ?>" name="hawb_no">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Charge</h4>
          </div>
          <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Type</label>
                    <select class="form-control discount_type" name="type" required>
                        <option value="PIBK">PIBK</option>
                        <option value="PDRI">PDRI</option>
                        <option value="OTHER">OTHER</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" style="resize:none;" required></textarea>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Currency</label>
                    <select name="currency" class="form-control">
                        <option value="IDR">IDR</option>
                        <option value="<?php echo $data->currency ?>"><?php echo $data->currency ?></option>
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Value</label>
                    <input class="form-control" name="value" required>
                </div>
            </div>

          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary submit_add_discount">Save</button>
          </div>
        </form>
        </div>
      </div>
</div>

<div id="modal_add_discount" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
        <form id="form_add_discount" method="post" action="<?php echo base_url().'manifest/ajax/add_discount' ?>">
          <input type="hidden" value="<?php echo $data->hawb_no ?>" name="hawb_no">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Discount</h4>
          </div>
          <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Type</label>
                    <select class="form-control discount_type" name="type" required>
                        <option value="rate">rate</option>
                        <option value="kurs">kurs</option>
                        <option value="total">total</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Discount Value</label>
                    <input type="text" class="form-control discount-value" name="value" required>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Normal Price</label>
                    <p class="form-control discount-normal-price"><?php echo 'Rp. ' . number_format($this->manifest_model->subtotal($data->hawb_no,'all')) ?></p>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Discount Price</label>
                    <p class="form-control discount-after-price"></p>
                </div>
            </div>

          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary submit_add_discount">Save</button>
          </div>
        </form>
        </div>
      </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('table.table').dataTable();

        $('.add_discount').click(function(){
            $('#modal_add_discount').modal('show');
        })
        $('.discount-value').keyup(function(){
            var type = $('.discount_type').val();
            var value = $(this).val();

            $.post('<?php echo base_url('manifest/get/sum_total_after_discount') ?>',{'hawb_no':'<?php echo $data->hawb_no ?>','type':type,'value':value},function(data){
                $('.discount-after-price').html(data);
            })
        })
        $('#form_add_discount').validate();
        $('#form_add_discount').ajaxForm({
            success:function(){
                $('#modal_add_discount').modal('hide');
                setTimeout(function(){
                    setPage('<?php echo base_url('manifest/view/details?hawb_no='.$data->hawb_no) ?>');                    
                },1500);
            }
        })

        $('.add_charge').click(function(){
            $('#modal_add_charge').modal('show');
        })
        $('#form_add_charge').validate();
        $('#form_add_charge').ajaxForm({
            success:function(){
                $('#modal_add_charge').modal('hide');
                setTimeout(function(){
                    setPage('<?php echo base_url('manifest/view/details?hawb_no='.$data->hawb_no) ?>');                    
                },1500);                
            }
        });
          
    })
</script>
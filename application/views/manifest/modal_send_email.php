<?php
$shipper = $this->db->query("select * from customer_table where reference_id = '".$data->shipper."'");
$consignee = $this->db->query("select * from customer_table where reference_id = '".$data->consignee."'");
?>
<div class="modal-dialog">
    <div class="modal-content">
    <form id="form_send_email" method="post" action="<?php echo base_url().'mail/send' ?>">
      <input type="hidden" value="send_detail_host" name="method">
      <input type="hidden" value="<?php echo $data->hawb_no ?>" name="hawb_no">
      <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>*To</label>
                    <input type="email" name="to" class="form-control" value="<?php $consignee->row('email');?>" required>
                    <br/>CC: <input type="email" name="cc" class="form-control">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>*Subject</label>
                    <input type="text" name="subject" class="form-control" value="Notification Delivery (DO NOT REPLY!!)" required>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>*Message</label>
                    <?php
                    $term = ($data->collect) ? 'COLLECT' : 'PREPAID';
                    ?>
                    <textarea id="message" name="message" class="form-control" style="height:230px; resize:none;" required><?php echo "Pemberitahuan kedatangan barang :<br/><br/>Shipper:<br/>".$shipper->row('name')."<br/>Reff#: ".$data->hawb_no."<br/>Consignee: ".$consignee->row('name')." Attn: ".$consignee->row('attn').". = ".$consignee->row('phone')."<br/>Total: ".$data->pkg." Carton/Doc/Roll<br/>Berat: ".$data->kg." Kg<br/>Term: ".$term."<br/>ETA JKT: ".$data->created_date."<br/><br/>Untuk lebih jelas hub: 021-5678289 email: tatahasa@dnet.net.id dengan mencamtumkan subject no Reff#:".$data->hawb_no."
Untuk kepastian waktu tiba perlu dikonformasi ulang ! Terima kasih"?></textarea>
                </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary submit_add_discount">Send</button>
      </div>
    </form>
    </div>
</div>

<script src="<?php echo base_url()?>style/lib/select2/select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('textarea#message').wysihtml5();
        //$('#to').Select2();
        var form = $('#form_send_email');
        form.validate();
        form.ajaxForm({
            dataType:'json',
            success:function(a){
                if(a.status == 'success'){
                    $('#modal_box').modal('hide');
                    setTimeout(function(){
                        setPage('<?php echo base_url('manifest/view/details?hawb_no='.$data->hawb_no) ?>');                    
                    },1500);                
                } else {
                    alert(a.message);
                }
            }
        })
    })
</script>
<?php 

	$shipper = $this->customers_model->get_by_id($get_manifest->shipper);
	$consignee = $this->customers_model->get_by_id($get_manifest->consignee);
?>

<form id="form_payment" method="post" action="<?php echo base_url()?>finance/payment/insert_payment">
<div class="form-group">
    <label>Hawb No<label class="required-filed">*</label></label>
        <input type="text" class="form-control" id="hawb_no" name="hawb_no" minlength="1" value="<?php echo $get_manifest->hawb_no ?>" readonly>
</div>


<div class="form-group">
    <label>Shipper<label class="required-filed">*</label></label>
        <input type="text" class="form-control" id="shipper" name="shipper" minlength="1" value="<?php echo $shipper->name ?>" readonly>
</div

<div class="form-group">
    <label>consignee<label class="required-filed">*</label></label>
        <input type="text" class="form-control" id="consignee" name="consignee" minlength="1" value="<?php echo $consignee->name  ?>"  readonly>
</div>


<div class="form-group">
    <label>Customer Payment<label class="required-filed">*</label></label>
   	<select class="form-control" id="customer" name="customer" required>
   		<option></option>
   		<?php 

   			$customer = $this->customers_model->get_customer_active();
   			foreach ($customer as $key => $value) {

   				echo "<option value='".$value->reference_id."'>".$value->name."</option>";
   			}
   		?>
   	</select>
</div>


<div class="form-group">
    <label>Exchange Rate<label class="required-filed">*</label></label>
        <input type="text" class="form-control" id="exchange_rate" name="exchange_rate" minlength="1" value="<?php echo $get_manifest->exchange_rate ?>"  readonly>
</div>

<div class="form-group">
    <label>Currency<label class="required-filed">*</label></label>
        <input type="text" class="form-control" id="currency" name="currency" minlength="1" value="<?php echo $get_manifest->currency ?>"  readonly	>
</div>

<div class="form-group">
    <label>Deadline<label class="required-filed">*</label></label>
    <input type="text" class="form-control" id="deadline" name="deadline" value="<?php echo $get_manifest->deadline ?>" readonly >
</div>
<div class="form-group">
    <label>Total<label class="required-filed">*</label></label>
    <input type="text" class="form-control" id="total_payment" name="total_payment" value="<?php echo $this->manifest_model->subtotal($get_manifest->hawb_no) ?>" readonly >
</div>

<div class="form-group">
    <label>Payment Amount<label class="required-filed">*</label></label>
    <input type="text" class="form-control" id="payment_amount" name="payment_amount" required >
</div>

<div class="form-group">
    <label>Remaining Payment<label class="required-filed">*</label></label>
    <input type="text" class="form-control" id="remaining" name="remaining" value="<?php echo $this->manifest_model->subtotal($get_manifest->hawb_no) ?>" readonly >
</div>



<button type="submit" class="btn btn-success submit" data-loading-text="Saving..." onClick="add_payment();">Submit</button>
<button type="button" class="btn btn-danger" onClick="setPage('<?php echo base_url('finance/home')?>')">Cancel</button>
<label class="alert-form" ></label>

</form>
<script type="text/javascript">
    $(document).ready(function(){

    	$('form#form_payment').validate();
         $('input[name="hawb_no"]').autoComplete({
                minChars: 1,
                source: function(term, response){
                    try { xhr.abort(); } catch(e){}
                    xhr = $.getJSON('<?php echo base_url('finance/payment/autoComplete') ?>', { q: term }, function(data){ response(data); });
                },
                onSelect: function(e, term, item){
                  setPage('<?php echo base_url('master/country/edit')?>/' + term);
                }
        });
        
       
    });  


function add_payment(){

		$('form#form_payment').ajaxForm({
				dataType:'json',
				success: function(result){
						if(result.status == true){
 
							$('.alert-form').html(result.message).addClass('alert-success').removeClass('alert-danger').fadeIn();
							    $('form#form_country').resetForm();
							 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
							 	 setPage('<?php echo base_url() ?>finance/home');
							},800);
						}else {
							 $('.alert-form').html(result.message).addClass('alert-danger').removeClass('alert-success').fadeIn();
							  	 setTimeout(function(){
								 $('.alert-form').html(result.message).fadeOut();
							},800);
							
						}
						 
				
				}
			});

}

</script>
<form id="form_country" method="post" action="<?php echo base_url()?>master/ajax/country/add">
<div class="form-group">
    <label>Hawb No<label class="required-filed">*</label></label>
        <input type="text" class="form-control" id="hawb_no" name="hawb_no" minlength="1"  required>
</div>

</form>
<script type="text/javascript">
    $(document).ready(function(){

         $('input[name="hawb_no"]').autoComplete({
                minChars: 1,
                source: function(term, response){
                    try { xhr.abort(); } catch(e){}
                    xhr = $.getJSON('<?php echo base_url('finance/payment/autoComplete') ?>', { q: term }, function(data){ response(data); });
                },
                onSelect: function(e, term, item){
                  setPage('<?php echo base_url('finance/payment/edit_payment')?>/' + term);
                }
        });
        
       
    });  
</script>
<div class="panel panel-default">


  	<div class="panel-body form-horizontal user-form">

      <form id="add_bank" method="post" action="<?php echo base_url('master/bank/add_bank')?>">
           <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Bank Id</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="bank_id" name="bank_id" required>
                        </div>
          </div>


           <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Bank Name</label>
                        <div class="col-sm-9">
                             <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                        </div>
          </div>

         <!--  <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Currency</label>
                        <div class="col-sm-9">
                              <select name="currency_from" class="form-control required" id="currency" >
                                <option value=""></option>
                                <?php foreach ($list_country as $row) {
                                  echo '<option value="'.$row->country_id.'">'.$row->country_name.' - '.$row->currency_name.' - '.$row->currency_symbol.'</option>';
                                } ?>
                          </select>
                        </div>
          </div> -->
         

            <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Swift Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="concept" name="swift_code">
                        </div>
          </div>

            <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                             <textarea class="form-control" style="resize:none">

                             </textarea>
                        </div>
          </div>



         
           <div class="form-group">
                     <label for="concept" class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                        	 <button class="btn btn-success">Add Bank</button>
                        	    <button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/bank/index_bank_branch')">Cancel</button>
                        </div>
          </div>
    
  		</form>

	</div>
</div>


 <script>
 		
   /* $('form#add_bank').validate({
        rules: { mawb_no: { required: true, remote: "manifest/ajax/check_available_mawb" } },
        messages: { mawb_no: { remote: 'Hawb no has been used' } }
    }); */

$('form#add_bank').validate({
    rules:{
      currency_from:{required:true}
    }
});
     $('#add_bank').ajaxForm({
        dataType: 'json',
          success: function(data){
              alert(data.test);
        }
    })


 </script>
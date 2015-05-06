

      <div class="form-group">
                        <label>Tax Id <label class="required-filed">*</label></label>
                     
                            <input type="text" class="form-control" id="concept" name="concept" readonly>
                        
          </div>

           <div class="form-group">
                        <label>Tax Name <label class="required-filed">*</label></label>
                        
                            <input type="text" class="form-control" id="concept" name="concept">
                      
          </div>


           <div class="form-group">
                        <label>Description</label>
                       
                            <textarea class="form-control" style="resize:none">


                            </textarea>
                        
          </div>


            <div class="form-group">
                        <label>Tax base amount <label class="required-filed">*</label></label>
                      
                            <input type="email" class="form-control" id="concept" name="concept">
                       
          </div>

          <div class="form-group">
                        <label >Tax rate <label class="required-filed">*</label></label>
                     
                             <input type="email" class="form-control" id="concept" name="concept">
                       
          </div>

           <div class="form-group">
                     <label></label>
                    
                        	 <button class="btn btn-success">Add Tax</button>
                        	    <button type="button" class="btn btn-danger" onclick="setPage('<?php echo base_url() ?>master/tax/index')">Cancel</button>
                     
          </div>
    
  		



 <script>
 		$('.level').select2();

 </script>
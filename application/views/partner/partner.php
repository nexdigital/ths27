  <div class="panel panel-default">
  <div class="panel-heading"  data-toggle="collapse" data-target="#demo"><a href="#">Advance Search</a></div>
  <div class="panel-body collapse" id="demo">
  <form id="search_form" method="post" action="<?php echo base_url('partner/search') ?>"> 
 	
  		   <table class="table" style="width:100%" border="0"> 
  			<tbody>
  				<tr>
  					<td><input type="text" class="form-control" id="partner_id" name="partner_id" placeholder="partner ID"></td>
					<td><input type="text" class="form-control" id="partner_name" name="partner_name" placeholder="partner name"></td>
					<td>
							 <select class="form-control" id="country" name="country">
                                  <option value="">Select Country</option>
                                        <?php foreach ($this->tool_model->list_country() as $key => $value) { 
                                                echo "<option value='".$value->country_id."'>".$value->country_name."</option>";


                                        } ?>
                                  </select>

					</td>
					<td><input type="text" name="email" id="email" class="form-control" placeholder="email"></td>
  				</tr>

  				<tr>
  					<td><input type="text" class="form-control" id="phone" name="phone" placeholder="Telephone Number"></td>
  					<td><div class="input-daterange" id="datepicker"><input type="text" name="entry_date" id="entry_date" class="form-control" placeholder="Entry Date"></div></td>
  					  <td>
                              <select class="form-control" name="entry_by" id="entry_by">
                                    <option value="">Entry By</option>
                                     <?php foreach ($this->users_model->get_username() as $key => $value) { 
                                                echo "<option value='".$value->username."'>".$value->username."</option>";


                                        } ?>
                              </select> 

                        </td>
                     <td><div class="input-daterange " id="datepicker"><input type="text" name="modified_date" id="modified_date" class="form-control" placeholder="Modified Date"></div></td>    
  				</tr>
  				<tr>
  					 <td>

                             <select class="form-control" name="modified_by" id="modified_by">
                                    <option value="">Modified By</option>
                                     <?php foreach ($this->users_model->get_username() as $key => $value) { 
                                                echo "<option value='".$value->username."'>".$value->username."</option>";


                                        } ?>
                              </select> 
                      </td>

                      <td>
                            <select class="form-control" name="status" id="status">
                                <option value="">Select Status</option>
                                <option value="Active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="deleted">Deleted</option>
                            </select>
                        </td>
  				</tr>

  				<tr>
                         <td><button class="btn btn-default" type="submit">Search!</button>
                            <button class="btn btn-danger" onClick ="reset_search()" type="submit">Reset</button>
                         </td>
                         
                     </tr> 
  			</tbody>
  		</table>

     </form> 
  </div>
</div>


<div id="search_result"></div>

<button class="btn btn-primary" onCLick="setPage('<?php echo base_url().'partner/partner_form'?>')">Add Partner</button>


<script>
$(document).ready( function () {

	get_advsearch_cookie();
	$.post('<?php echo base_url('partner/search') ?>',$('form#search_form').serializeArray(),function(data){
    result = JSON.parse(data);
    if(result.status == true){
      $("#search_result").html(result.message);                             
      $("#example2").dataTable({"bFilter": true,
                                  "bInfo" : false,
                                  "autoWidth": false,
                                  "pagingType": "full_numbers",
                                  "scrollX": true,
                                  stateSave: true,
                                  });
      }else{

        $("#search_result").html(result.message); 
           
      } 
  })


$('form#search_form').ajaxForm({
      dataType  : 'json',
      beforeSubmit: function(arr,form,options){
        $.each(arr, function(key,val){
          $.cookie('advsearch_' + val.name,val.value);
        })
      },
      success: function(result){
        if(result.status == true){
          	
          	$("#search_result").html(result.message);
          	$("#example2").dataTable({"bFilter": true,
                                  "bInfo" : false,
                                  "autoWidth": false,
                                  "pagingType": "full_numbers",
                                  "scrollX": true,
                                  stateSave: true,
            });	
          
          }else{
        
            $("#search_result").html(result.message);
          } 
      },
      error: function(){
        alert("File corrupt. Please refresh and try again");
      }
  });

    $('table#table_partner').DataTable();



  $('.input-daterange').datepicker({
        format: "yyyy-mm-dd"
  });


});

function reset_search()
{
  $('#search_form')[0].reset();
}


function get_advsearch_cookie(){

 	$('input[name=partner_id]').val($.cookie('advsearch_partner_id'));
 	$('input[name=partner_name]').val($.cookie('advsearch_partner_name'));
 	$('select[name=country]').val($.cookie('advsearch_country'));
 	$('input[name=email]').val($.cookie('advsearch_email'));
 	$('input[name=phone]').val($.cookie('advsearch_phone'));
 	$('input[name=entry_date]').val($.cookie('advsearch_partner_entry_date'));
 	$('select[name=entry_by]').val($.cookie('advsearch_partner_entry_by'));
 	$('input[name=modified_date]').val($.cookie('advsearch_partner_modified_date'));
 	$('input[name=modified_by]').val($.cookie('advsearch_partner_modified_by'));
 	$('select[name=status]').val($.cookie('advsearch_partner_status'));
}


</script>
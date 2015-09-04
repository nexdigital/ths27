 <div class="col-lg-6" style="float:right">
    <div class="input-group">
      <input type="text" id="search_input" name="search_input" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onClick="search();">Go!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
<table id="example2" class="table  table-striped table-hovered">         
  <thead>
    <th>Reference ID</th>
    <th>Name</th>
    <th>Attn</th>
    <th>Country</th>
    <th>Telepon Number</th>
    <th>Entry by</th>
    <th>Entry date</th>
    <th>Modified by</th>
    <th>Modified date</th>
    <th>Status</th>

  </thead>

  <tbody id="result_search">
    <?php 
      foreach($get_customers as $key => $val){

      if(strlen($val->name) >20 ){ $name = substr($val->name,0,20).'...';}else{ $name = $val->name; }
      if(strlen($val->phone) >20 ){ $phone = substr($val->phone,0,20).'...';}else{$phone = $val->phone; }
      if(strlen($val->attn) >20 ){ $attn = substr($val->attn,0,20).'...';}else{$attn = $val->attn; }

      echo '<tr>
      <td><a href="javascript:;" onClick="setPage(\''.base_url('customers/view_customer/'.$val->reference_id.'').'\')">'.$val->reference_id.'</a></td>
      <td>'.$name.'</td>
      <td>'.$attn.'</td>
      <td>'.$val->country_name.'</td>
      <td>('.$val->code_phone.') '.$phone.'</td>
      <td>'.$val->create_by.'</td>
      <td>'.$val->create_date.'</td>
      <td>'.$val->update_by.'</td>
      <td>'.$val->update_date.'</td>
      <td>'.$val->status_active.'</td>
      </tr>';
      } ?>
  </tbody>
</table>
<a href="#" onClick="setPage('<?php echo base_url('customers/add_customer')?>')"><button class="btn btn-primary">Add Customer</button></a>              
<a href="#" onClick="print_csv();"><button class="btn btn-primary">Print CSV</button></a>     
<span id="button_download"></span> 


<script type="text/javascript">
$(document).ready(function(){ 

   $('table.table').dataTable({
     "bFilter": false,
      "bInfo" : false
  });
  $('select.sumoselect').SumoSelect();
  $("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
});


function search()
{
      
      var search_input = $("#search_input").val();

      $.ajax({

            url       : "<?php echo base_url()?>customers/ajax/search",
            data      : "search_input="+search_input,
            type      : "post",
            dataType  : "json",
             beforeSend : function(){

                            $("#button_download").html( "" ).fadeOut("fast");
            },
            success   : function(result){

                        $("#result_search").empty();
                        setTimeout(function(){   
                             $("#result_search").html( result.message);
                        },2);
            }

      });

}


function print_csv()
{

      var search_input = $("input[name=search_input]").val();

      $.ajax({

            url       : "<?php echo base_url()?>customers/ajax/print_csv",
            data      : "search_input="+search_input,
            type      : "post",
            dataType  : "json",
            beforeSend : function(){

                            $("#button_download").html( "" ).fadeOut("fast");
            },
            success   : function(result){

                if(result.status == true )
                {
                    $("#button_download").html( result.button ).fadeIn("slow");
                }else
                {
                  alert("there's no available data");
                }
                       //$("#result_search").empty();
                       
                          //   $("#result_search").html( result.message);
                            
                     
            }

      });
}
</script>



  <div class="panel panel-default">
  <div class="panel-heading"  data-toggle="collapse" data-target="#demo"><a href="#">Advance Search</a></div>
  <div class="panel-body collapse" id="demo">
  <form id="search_form" method="post" action="<?php echo base_url()?>customers/ajax/search" > 
   <table class="table" style="width:100%">
            <tbody>
                    <tr>
                        <td> <input type="text" id="search_input" name="search_input" class="form-control" placeholder="Search for..."></td>
                        <td><input type="text" name="name" class="form-control" placeholder="Name"></td>
                        <td><input type="text" name="attn" class="form-control" placeholder="Attn"></td>
                        <td>
                                <select class="form-control" id="country" name="country">
                                  <option value=""></option>
                                        <?php foreach ($this->tool_model->list_country() as $key => $value) { 
                                                echo "<option value='".$value->country_id."'>".$value->country_name."</option>";


                                        } ?>
                                  </select>


                        </td>
                        <td><input type="text" name="phone" class="form-control" placeholder="Telephone Number"></td>
                    </tr>

                    <tr>
                        <td><input type="text" name="entry_date" class="form-control" placeholder="Entry Date"></td>
                        <td><input type="text" name="entry_by" class="form-control" placeholder="Entry By"></td>
                        <td><input type="text" name="modified_by" class="form-control" placeholder="Modified By"></td>
                        <td><input type="text" name="modified_date" class="form-control" placeholder="Modified Date"></td>
                        <td><input type="text" name="status" class="form-control" placeholder="Status"></td>
                    </tr>
                     <tr>
                         <td><button class="btn btn-default" type="submit">Search!</button></td>
                     </tr> 
            </tbody>

     </table> 
     </form> 
  </div>
</div>










    


<table id="example2" class="table  table-striped table-hovered">         
  <thead>
    <th>Referaence ID</th>
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
<a id="MyLinks" onClick="print_csv();"><button class="btn btn-primary" id="Print_csv">Print CSV</button></a>    
<a id="download_all" style="display:none;"><button id="button_all">Download</button> </a>



<script type="text/javascript">

$("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#search_form").submit();
    }
});

$(document).ready(function(){ 


   $('#example2').dataTable({
     "bFilter": false,
      "bInfo" : false,
      "autoWidth": false,
       stateSave: true
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


     $('form#search_form').ajaxForm({
        
            dataType  : 'json',
            beforeSubmit  : function(){
                            $("#MyLinks").removeAttr("onClick");
                            $("#button_download").html( "" ).fadeOut("fast");
            },
            success   : function(result){

                if(result.status == true){

                        $("#result_search").empty();
                         $("#Print_csv").removeAttr("Disabled")
                        $("#MyLinks").attr({
                                              href    : result.link_result,
                                              target  :"_blank" 
                                           });
                        setTimeout(function(){   
                             $("#result_search").html( result.message);
                        },2);

                    }else{

                        $("#result_search").empty();
                        $("#Print_csv").attr("Disabled","disabled")
                        setTimeout(function(){   
                             $("#result_search").html( result.message);
                        },2);
                    }
                       
            },
              error   : function(){

                    alert("File corrupt. Please refresh and try again");
              }
            

        });

   // var search_input = $("#search_input").val();


           
            // url       : "<?php echo base_url()?>customers/ajax/search",
            // data      : "search_input="+search_input,
            // type      : "post",
            // dataType  : "json",
            //  beforeSend : function(){
            //                 $("#MyLinks").removeAttr("onClick");
            //                 $("#button_download").html( "" ).fadeOut("fast");
            // },
            // success   : function(result){

            //         if(result.status == true){

            //            $("#result_search").empty();
            //              $("#Print_csv").removeAttr("Disabled")
            //             $("#MyLinks").attr({
            //                                   href    : result.link_result,
            //                                   target  :"_blank" 
            //                                });
            //             setTimeout(function(){   
            //                  $("#result_search").html( result.message);
            //             },2);

            //         }else{

            //             $("#result_search").empty();
            //             $("#Print_csv").attr("Disabled","disabled")
            //             setTimeout(function(){   
            //                  $("#result_search").html( result.message);
            //             },2);
            //         }
                       
            // },
            // error   : function(){

            //       alert("File corrupt. Please refresh and try again");
            // }


      
});


// function search()
// {
      
    

//       $.ajax({

//             url       : "<?php echo base_url()?>customers/ajax/search",
//             data      : "search_input="+search_input,
//             type      : "post",
//             dataType  : "json",
//              beforeSend : function(){
//                             $("#MyLinks").removeAttr("onClick");
//                             $("#button_download").html( "" ).fadeOut("fast");
//             },
//             success   : function(result){

//                     if(result.status == true){

//                        $("#result_search").empty();
//                          $("#Print_csv").removeAttr("Disabled")
//                         $("#MyLinks").attr({
//                                               href    : result.link_result,
//                                               target  :"_blank" 
//                                            });
//                         setTimeout(function(){   
//                              $("#result_search").html( result.message);
//                         },2);

//                     }else{

//                         $("#result_search").empty();
//                         $("#Print_csv").attr("Disabled","disabled")
//                         setTimeout(function(){   
//                              $("#result_search").html( result.message);
//                         },2);
//                     }
                       
//             },
//             error   : function(){

//                   alert("File corrupt. Please refresh and try again");
//             }

//       });

// }

function print_csv()
{

      var search_input = $("input[name=search_input]").val();

      $.ajax({

            url       : "<?php echo base_url()?>customers/ajax/print_csv",
            data      : "search_input="+search_input,
            type      : "post",
            dataType  : "json",
            success   : function(result){

                     if(result.status ==  true){

                          $("#download_all").attr({
                                              href    : result.link_result,
                                              target  :"_blank" 
                          });
                        $('#button_all').click();

                     }else{

                        alert(result.message);
                     }   
                  


            },
            error   : function(){

                  alert("File corrupt. Please refresh and try again");
            }

      });
}


//
</script>
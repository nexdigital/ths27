  <div class="panel panel-default">
  <div class="panel-heading"  data-toggle="collapse" data-target="#demo"><a href="#">Advance Search</a></div>
  <div class="panel-body collapse" id="demo">
  <form id="search_form" method="post" action="<?php echo base_url('customers/ajax/search') ?>"> 
   <table class="table" style="width:100%" border="0">
            <tbody>
                    <tr>
                       <!--  <td> <input type="text" id="search_input" name="search_input" class="form-control" placeholder="Search for..."></td> -->
                         <td> <input type="text" id="reference_id" name="reference_id" class="form-control" placeholder="Reference ID"></td>
                        <td><input type="text" name="name" class="form-control" placeholder="Name"></td>
                        <td><input type="text" name="attn" class="form-control" placeholder="Attn"></td>
                        <td>
                                <select class="form-control" id="country" name="country">
                                  <option value="">Select Country</option>
                                        <?php foreach ($this->tool_model->list_country() as $key => $value) { 
                                                echo "<option value='".$value->country_id."'>".$value->country_name."</option>";


                                        } ?>
                                  </select>


                        </td>
                         <td><input type="text" name="phone" id="phone" class="form-control" placeholder="Telephone Number"></td>
                    </tr>

                    <tr>
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
                          <td><input type="email" name="first_email" id="first_email" placeholder="First Email" class="form-control"></td>
                        <!--   <td><input type="email" name="second_email" id="second_email" placeholder="Second Email" class="form-control"></td>
                          <td><input type="email" name="third_email" id="third_email" placeholder="Third Email" class="form-control"></td> -->
                          <td><input type="text" name="city" id="city" placeholder="city" class="form-control"></td>
                          <td><input type="text" name="zip_code" id="zip_code" placeholder="Zip Code" class="form-control"></td>
                          <td><input type="text" name="mobile" id="mobile" placeholder="Mobile" class="form-control"></td>
                          <td><input type="text" name="fax" id="fax" placeholder="fax" class="form-control"></td>
                   </tr>
                       
                       <!--  <td><input type="text" name="second_phone" id="second_phone" placeholder="Second Phone" class="form-control"></td>
                        <td><input type="text" name="third_phone" id="third_phone" placeholder="Third Phone" class="form-control"></td> -->
                        
                   

                    <tr>
                        <td>
                            <select class="form-control tax_class" id="tax_class" name="tax_class">
                                <option value="">-</option>
                                <option value="0">none</option>
                                <?php
                                    foreach ($this->tool_model->get_tax() as $key => $value) {
                                        echo "<option value='".$value->tax_id."'>".$value->tax_name."</option>";
                                    }



                                 ?>

                              </select>
                        </td>
                        <td>
                            <select class="form-control" name="status_regular">
                                <option value="">-</option>
                                <option value="none">None regular</option>
                                <option value="regular">regular customer</option>
                              </select>
                        </td>
                    </tr>
                    <!-- <tr>
                    
                         <td> <textarea class="form-control" maxlength="100" placeholder="description"  id="remark" name="description" rows="1" style="resize:none"></textarea></td>
                        <td> <textarea class="form-control" maxlength="100" placeholder="address"  id="address" name="address" rows="1" style="resize:none"></textarea></td>

                    </tr> -->
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



<div id="hasil_pertama"></div>


<script type="text/javascript">
$("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#search_form").submit();
    }
});

$('input[name="reference_id"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoCompleteID') ?>', { q: term }, function(data){ response(data); });
          }
      });

     $('input[name="name"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete') ?>', { q: term }, function(data){ response(data); });
          }
      });

     $('input[name="attn"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete_attn') ?>', { q: term }, function(data){ response(data); });
          }
      });

    $('input[name="phone"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete_phone') ?>', { q: term }, function(data){ response(data); });
          }
      });

      $('input[name="first_email"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete_email') ?>', { q: term }, function(data){ response(data); });
          }
      });
// second_email

 $('input[name="second_email"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete_secondemail') ?>', { q: term }, function(data){ response(data); });
          }
      });

 $('input[name="third_email"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete_thirdemail') ?>', { q: term }, function(data){ response(data); });
          }
      });

 $('input[name="city"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete_city') ?>', { q: term }, function(data){ response(data); });
          }
      });

 $('input[name="zip_code"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete_zip') ?>', { q: term }, function(data){ response(data); });
          }
      });

 $('input[name="zip_code"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete_zip') ?>', { q: term }, function(data){ response(data); });
          }
      });

 $('input[name="mobile"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete_mobile') ?>', { q: term }, function(data){ response(data); });
          }
      });

  $('input[name="fax"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete_fax') ?>', { q: term }, function(data){ response(data); });
          }
      });

  /*$('input[name="second_phone"]').autoComplete({
          minChars: 1,
          source: function(term, response){
              try { xhr.abort(); } catch(e){}
              xhr = $.getJSON('<?php echo base_url('customers/ajax/autoComplete_second_phone') ?>', { q: term }, function(data){ response(data); });
          }
      });*/


$(document).ready(function(){
  get_advsearch_cookie();
  $.post('<?php echo base_url('customers/ajax/search') ?>',$('form#search_form').serializeArray(),function(data){
    result = JSON.parse(data);
    if(result.status == true){
      $("#hasil_pertama").html(result.message);                             
      $("#example2").dataTable({"bFilter": true,
                                  "bInfo" : false,
                                  "autoWidth": false,
                                  "pagingType": "full_numbers",
                                  "scrollX": true,
                                  stateSave: true,
                                  });
      }else{

        $("#hasil_pertama").html(result.message); 

      } 
  })
  $('form#search_form').ajaxForm({
      dataType  : 'json',
      beforeSubmit: function(arr,form,options){
        $.each(arr, function(key,val){
          $.cookie('advsearch_customer_' + val.name,val.value);
        })
      },
      success: function(result){
        if(result.status == true){
          $("#hasil_pertama").html(result.message);                             
          $("#example2").dataTable({"bFilter": true,
                                      "bInfo" : false,
                                      "autoWidth": false,
                                      "pagingType": "full_numbers",
                                      "scrollX": true,
                                      stateSave: true,
                                      });
          }else{
        
                $("#hasil_pertama").html(result.message);    
          } 
      },
      error: function(){
        alert("File corrupt. Please refresh and try again");
      }
  });


  $('.input-daterange').datepicker({
        format: "yyyy-mm-dd"
  });


   $('#example2 tfoot th').each( function () {
        var title = $('#example2 thead th').eq( $(this).index() ).text();
        var row_name = $('#example2 thead th').eq( $(this).index() ).attr('row_name');
        var cookie_value = ($.cookie(row_name) && $.cookie(row_name) !== '') ? $.cookie(row_name) : '';

        $(this).html( '<input type="text" placeholder="Search '+title+'" id="'+ row_name +'" value="'+ cookie_value +'" />' );
    } );



// var table = $('#example2').DataTable();

/*$("#example2").dataTable({
     "bFilter": true,
      "bInfo" : false,
      "autoWidth": false,
      "bSort": false,
      "pagingType": "full_numbers",
      "scrollX": true,
      stateSave: true,
});
*/
 $('#example2').DataTable().columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
          var cookie_name = $(this).attr('id');
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
                    $.cookie(cookie_name,this.value);
                    console.log(this.value);
            }
        } );
    } );
$('form#search_form').validate({
      rules: { phone:
                {
                  number: true
                }
              }
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

function reset_search()
{
  $('#search_form')[0].reset();
}

function fnResetAllFilters() {
     //state.clear()
   var table = $('#example2').DataTable();
    $('input[type="text"]').val('');

}
//

function reset_search_table(){
  var table = $('#example2').DataTable();
  table
    .search('')
    .columns().search('')
    .draw();
  
  $('#example2 tfoot th').each( function () {
        var title = $('#example2 thead th').eq( $(this).index() ).text();
        var row_name = $('#example2 thead th').eq( $(this).index() ).attr('row_name');
        $.removeCookie(row_name);
        $('input#' + row_name).val('');
  });
}

function get_advsearch_cookie(){
 $('input[name=reference_id]').val($.cookie('advsearch_customer_reference_id'));
 $('input[name=name]').val($.cookie('advsearch_customer_name'));
 $('input[name=attn]').val($.cookie('advsearch_customer_attn'));
 $('select[name=country]').val($.cookie('advsearch_customer_country'));
 $('input[name=phone]').val($.cookie('advsearch_customer_phone'));
 $('input[name=entry_date]').val($.cookie('advsearch_customer_entry_date'));
 $('select[name=entry_by]').val($.cookie('advsearch_customer_entry_by'));
 $('input[name=modified_date]').val($.cookie('advsearch_customer_modified_date'));
 $('select[name=modified_by]').val($.cookie('advsearch_customer_modified_by'));
 $('select[name=status]').val($.cookie('advsearch_customer_status'));
 $('input[name=first_email]').val($.cookie('advsearch_customer_first_email'));
 $('input[name=city]').val($.cookie('advsearch_customer_city'));
 $('input[name=zip_code]').val($.cookie('advsearch_customer_zip_code'));
 $('input[name=mobile]').val($.cookie('advsearch_customer_mobile'));
 $('input[name=fax]').val($.cookie('advsearch_customer_fax'));
 $('select[name=tax_class]').val($.cookie('advsearch_customer_tax_class'));
 // $('select[name=status]').val($.cookie('advsearch_customer_status'));
 $('select[name=status_regular]').val($.cookie('advsearch_customer_status_regular'));
}
</script>
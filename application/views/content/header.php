 <head>
        <meta charset="UTF-8">
        <title>THS 27</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo base_url()?>style/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>style/css/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>style/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url()?>style/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url()?>style/css/ionicons.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo base_url() ?>style/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo base_url() ?>style/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker 
        <link href="<?php echo base_url() ?>style/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />-->
        <!-- Daterange picker -->
        <link href="<?php echo base_url() ?>style/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url() ?>style/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url() ?>style/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>style/lib/select2/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>style/lib/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>style/lib/sumoselect/sumoselect.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url() ?>style/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>style/lib/autocomplete/jquery.auto-complete.css">
       
    </head>

<style>
.sidebar .sidebar-menu .active .treeview-menu {
    display: block;
}


::-webkit-scrollbar {
    -webkit-appearance: none;
}

::-webkit-scrollbar:vertical {
    width: 12px;
}

::-webkit-scrollbar:horizontal {
    height: 12px;
}

::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, .5);
    border-radius: 10px;
    border: 2px solid #ffffff;
}

::-webkit-scrollbar-track {
    border-radius: 10px;  
    background-color: #ffffff; 
}

</style>

    <header class="header">
            <a href="<?php echo base_url() ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                THS 27
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                       
                        <!-- Notifications: style can be found in dropdown.less -->
                       
                        <!-- Tasks: style can be found in dropdown.less -->
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Jane Doe <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        Jane Doe - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>


         <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
               <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> <i class="fa fa-angle-left pull-right"></i> Manifest</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                      <a href="#" onClick="setPage('<?php echo base_url('manifest/view/upload')?>')"><i class="fa fa-angle-double-right"></i> Upload File</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" onClick="setPage('<?php echo base_url('manifest/view/create_host')?>')"><i class="fa fa-angle-double-right"></i> Create Host</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" onClick="setPage('<?php echo base_url('manifest/view/data')?>')"><i class="fa fa-angle-double-right"></i> Data</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       <a href="#" onClick="setPage('<?php echo base_url('manifest/view/verification')?>')"><i class="fa fa-angle-double-right"></i> Verification </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                       <a href="#" onClick="setPage('<?php echo base_url('manifest/view/download')?>')"><i class="fa fa-angle-double-right"></i> Download Data </a>
                                    </td>
                                </tr>

                                 <tr>
                                    <td>
                                       <a href="#" onClick="setPage('<?php echo base_url('manifest/view/download')?>')"><i class="fa fa-angle-double-right"></i> Report Snow </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Finance</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <a href="javascript:;"  onClick="setPage('<?php echo base_url('finance/home')?>')"><i class="fa fa-angle-double-right"></i> Data Payment</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')"><i class="fa fa-angle-double-right"></i> Currency Rate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')"><i class="fa fa-angle-double-right"></i> Invoice</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')"><i class="fa fa-angle-double-right"></i> Debit None</a>
                                    </td>
                                </tr>

                                 <tr>
                                    <td>
                                        <a href="#" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')"><i class="fa fa-angle-double-right"></i> Credit Note</a>
                                    </td>
                                </tr>

                                 <tr>
                                    <td>
                                        <a href="#" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')"><i class="fa fa-angle-double-right"></i> Payment Invoice</a>
                                    </td>
                                </tr>

                                 <tr>
                                    <td>
                                        <a href="#" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')"><i class="fa fa-angle-double-right"></i> Cash/Bank Transfer</a>
                                    </td>
                                </tr>


                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Master</a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <a href="javascript:;"  onClick="setPage('<?php echo base_url('customers/home')?>')"><i class="fa fa-angle-double-right"></i> Customers</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="javascript:;"  onClick="setPage('<?php echo base_url('master/partner/index')?>')"><i class="fa fa-angle-double-right"></i> Partner</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" onClick="setPage('<?php echo base_url('master/view/country/index')?>')"><i class="fa fa-angle-double-right"></i> Country</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       <a href="#" onClick="setPage('<?php echo base_url('master/view/currency/type_index')?>')"><i class="fa fa-angle-double-right"></i> Rate Type</a>
                                    </td>
                                </tr>

                                 <tr>
                                    <td>
                                       <a href="#" onClick="setPage('<?php echo base_url('master/business/index')?>')"><i class="fa fa-angle-double-right"></i> Business</a>
                                    </td>
                                </tr>

                                 <tr>
                                    <td>
                                       <a href="#" onClick="setPage('<?php echo base_url('master/tax/index')?>')"><i class="fa fa-angle-double-right"></i> Tax</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
              
                  
                   
                <!-- /.sidebar -->
            </aside>

<script type="text/javascript">


</script>   
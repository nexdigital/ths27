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
       
    <script type="text/javascript" src="http://demo.webexplorar.com/codeigniter/application/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>style/js/chat.js"></script>
  
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url()?>style/css/chat.css" />
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url()?>style/css/screen.css" />
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
                        <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success"><?php

                 $user_id = $this->session->userdata('user_id');  
                 $user_login = $this->master_user->get_user_login($user_id);

                   echo count($user_login); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header"><?php  echo count($user_login) ?> User Login </li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                      
                        <?php 

                                foreach ($user_login as $key => $value) {
                                   
                                        echo " <li>
                                                    <a href='javascript:void(0)' onClick='javascript:chatWith(\"$value->username\")'>
                                                      <div class='pull-left'>
                                                        <i class='glyphicon glyphicon-user'></i>
                                                      </div>
                                                      <h4>
                                                        ".$value->username."
                                                       
                                                      </h4>
                                                     
                                                    </a>
                                                  </li><!-- end message -->";


                                }




                        ?>
                     
                      
                    </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 131.147540983607px; background: rgb(0, 0, 0);"></div>
                    <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
                </div>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
                        



                        
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $this->session->userdata("username")?> <i class="caret"></i></span>
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
                                        <a href="<?php echo base_url()?>logout" class="btn btn-default btn-flat">Sign out</a>
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
                <section class="sidebar" style="overflow: scroll;">
                    <!-- Sidebar user panel -->
                    
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Manifest</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#" onClick="setPage('<?php echo base_url('manifest/view/upload')?>')"><i class="fa fa-angle-double-right"></i>Upload File</a></li>
                                <li><a href="#" onClick="setPage('<?php echo base_url('manifest/view/create_host')?>')"><i class="fa fa-angle-double-right"></i>Create Host</a></li>
                                <li><a href="#" onClick="setPage('<?php echo base_url('manifest/view/data')?>')"><i class="fa fa-angle-double-right"></i> Data</a></li>
                                <li><a href="#" onClick="setPage('<?php echo base_url('manifest/view/verification')?>')"><i class="fa fa-angle-double-right"></i> Verification </a></li>
                                <li><a href="#" onClick="setPage('<?php echo base_url('manifest/view/download')?>')"><i class="fa fa-angle-double-right"></i> Download Data </a></li>
                                <li><a href="#" onClick="setPage('<?php echo base_url('manifest/view/report')?>')"><i class="fa fa-angle-double-right"></i> Report Snow </a></li>
                                <li><a href="#" onClick="setPage('<?php echo base_url('manifest/view/invoice')?>')"><i class="fa fa-angle-double-right"></i> Print Invoice </a></li>
                            </ul>
                        </li>
                     <!--    <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Customers</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                              
                                <li><a href="javascript:;"  onClick="setPage('<?php echo base_url('customers/home')?>')"><i class="fa fa-angle-double-right"></i>All Customers</a></li>
                            </ul>
                        </li>
                        -->
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Finance</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="javascript:;"  onClick="setPage('<?php echo base_url('finance/home')?>')"><i class="fa fa-angle-double-right"></i>Data Payment</a></li>
                                <li><a href="#" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')"><i class="fa fa-angle-double-right"></i>Currency Rate</a></li>
                                <li><a href="#" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')"><i class="fa fa-angle-double-right"></i>Invoice</a></li>
                                <li><a href="#" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')"><i class="fa fa-angle-double-right"></i>Debit None</a></li>
                                <li><a href="#" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')"><i class="fa fa-angle-double-right"></i>Credit Note</a></li>
                                <li><a href="#" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')"><i class="fa fa-angle-double-right"></i>Payment Invoice</a></li>
                                <li><a href="#" onClick="setPage('<?php echo base_url('master/view/currency/index')?>')"><i class="fa fa-angle-double-right"></i>Cash/Bank Transfer</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Master</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="javascript:;"  onClick="setPage('<?php echo base_url('customers/home')?>')"><i class="fa fa-angle-double-right"></i>Customers</a></li>
                                <li><a href="javascript:;"  onClick="setPage('<?php echo base_url('master/partner/index')?>')"><i class="fa fa-angle-double-right"></i>Partner</a></li>
                              <!--<li id="upload_menu"><a href="#" onClick="setPage('<?php echo base_url('master/master_customer_group')?>')"><i class="fa fa-angle-double-right"></i>Customer Group</a></li>-->
                                <li id="upload_menu"><a href="#" onClick="setPage('<?php echo base_url('master/view/country/index')?>')"><i class="fa fa-angle-double-right"></i>Country</a></li>
                                <li id="upload_menu"><a href="#" onClick="setPage('<?php echo base_url('master/view/currency/type_index')?>')"><i class="fa fa-angle-double-right"></i>Rate Type</a></li>
                             <!--   <li id="upload_menu"><a href="#" onClick="setPage('<?php echo base_url('master/view/airlines/index')?>')"><i class="fa fa-angle-double-right"></i>Airlines</a></li> -->
                               <!-- <li id="upload_menu"><a href="#" onClick="setPage('<?php echo base_url('master/view/term_of_payment/index')?>')"><i class="fa fa-angle-double-right"></i>Term Of Payment</a></li> -->
                                <li id="upload_menu"><a href="#" onClick="setPage('<?php echo base_url('master/business/index')?>')"><i class="fa fa-angle-double-right"></i>Business</a></li>
                               <!--   <li id="upload_menu"><a href="#" onClick="setPage('<?php echo base_url('master/view/holiday/index')?>')"><i class="fa fa-angle-double-right"></i>Holiday</a></li> -->
                                <li id="upload_menu"><a href="#" onClick="setPage('<?php echo base_url('master/user/index')?>')"><i class="fa fa-angle-double-right"></i>User</a></li>
                                <li id="upload_menu"><a href="#" onClick="setPage('<?php echo base_url('master/add_user_role/index')?>')"><i class="fa fa-angle-double-right"></i>User Role</a></li>
                               <!-- <li id="upload_menu"><a href="#" onClick="setPage('<?php echo base_url('master/bank/index_bank_branch')?>')"><i class="fa fa-angle-double-right"></i>Bank</a></li>
                             <!--   <li id="upload_menu"><a href="#" onClick="setPage('<?php echo base_url('master/bank/index')?>')"><i class="fa fa-angle-double-right"></i>Cash/Bank Book</a></li>-->
                                <li id="upload_menu"><a href="#" onClick="setPage('<?php echo base_url('master/tax/index')?>')"><i class="fa fa-angle-double-right"></i>Tax</a></li>
                            </ul>

                            <ul class="treeview-menu">
                              
                              
                            </ul>
                        </li>                       
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            

<script type="text/javascript">


</script>   
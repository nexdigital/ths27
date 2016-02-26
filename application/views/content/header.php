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
     <link href="<?php echo base_url('style/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>" rel="stylesheet" type="text/css" />            
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
                              
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                   
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
                       
                         <?php 
                            $id_type = $this->session->userdata('type');

                            $get_list_menu = $this->db->query("select * from user_access_table where parent = 0");
                            foreach($get_list_menu->result() as $key => $row){
                                $get_list_menu_parent = $this->db->query("select * from user_access_table where parent = '".$row->id."'");

                                $show_main_menu = false;
                                $elm_menu_item = false;
                                foreach($get_list_menu_parent->result() as $key_parent => $row_parent) {
                                    $check_role = $this->db->query("select * from user_role_table where id_type='".$id_type."' and access_level = '".$row_parent->id."'");
                                    if($check_role->num_rows() > 0){
                                        $show_main_menu = true;
                                        $elm_menu_item .= '<li><a href="#"  onClick="setPage(\''.base_url("".$row_parent->link."").'\')"><i class="fa fa-angle-double-right"></i>'.$row_parent->access.'</a></li>';
                                    }
                                }

                                if($show_main_menu){
                                    echo '<li class="treeview"><a href="#"  onClick="setPage(\''.base_url("".$row->link."").'\')"><i class="fa fa-angle-double-right"></i>'.$row->access.'</a>';
                                    echo ' <ul class="treeview-menu">';
                                    echo $elm_menu_item;
                                    echo '</ul>';                                   
                                }
                            }

                            /* DISABLE


                               $id_type = $this->session->userdata('type');
                               foreach ($this->users_model->get_menu($id_type) as $key => $value) {
                                        
                                    // echo $value->access;
                                    // echo $this->db->last_query();

                                  
                                    echo '<li class="treeview"><a href="#"  onClick="setPage(\''.base_url("".$value->link."").'\')"><i class="fa fa-angle-double-right"></i>'.$value->access.'</a>';
                                 
                                    echo ' <ul class="treeview-menu">';

                                    foreach ($this->users_model->get_child($id_type,$value->id) as $key => $row) {
                                                
                                            echo '<li><a href="#"  onClick="setPage(\''.base_url("".$row->link."").'\')"><i class="fa fa-angle-double-right"></i>'.$row->access.'</a></li>';

                                    }
                                    echo '</ul></li>';

                               } 

                               ;

                            */
                               ?>
                       

                    </ul>

                </section>
                <!-- /.sidebar -->
            </aside>

            

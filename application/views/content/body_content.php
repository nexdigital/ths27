<?php 
    include('header.php');
    echo    "<body class='skin-blue'>
             <div class='wrapper row-offcanvas row-offcanvas-left'>
              
                  <aside class='right-side'> 

                     <section class='content-header'>
                                        <h1 class=\"header-title\">
                                            ".$heading."
                                            <small>Control panel</small>
                                        </h1>
                                        <ol class='breadcrumb'>
                                            <li><a href='#''><i class='fa fa-dashboard'></i> Home</a></li>
                                            <li class='active'>Dashboard</li>
                                        </ol>
                                    </section>
                   <section class='content'>
                     <div class='loading' style='display:none'><center><img src='".base_url()."style/img/ajax-loader.gif'></cemter></div>";
   include(dirname(__FILE__) .'/../'.$view.'.php');    
    echo "</section></aside>/div></div>";
    include('footer.php');
?>

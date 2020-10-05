<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>APPKU cPANEL</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?= base_url()?>asset_cpanel/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?= base_url()?>asset_cpanel/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="<?= base_url()?>asset_cpanel/css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="<?= base_url()?>asset_cpanel/css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="<?= base_url()?>asset_cpanel/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?= base_url()?>asset_cpanel/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?= base_url()?>asset_cpanel/css/custom.css">
    <!-- Favicon-->
    <link href="<?= base_url()?>asset_cpanel/img/favicon.png" rel="icon">
    <link href="<?= base_url()?>asset_cpanel/img/favicon.png" rel="apple-touch-icon">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="<?= base_url()?>asset_cpanel/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="<?= base_url()?>asset_cpanel/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" integrity="sha512-UDJtJXfzfsiPPgnI5S1000FPLBHMhvzAMX15I+qG2E2OAzC9P1JzUwJOfnypXiOH7MRPaqzhPbBGDNNj7zBfoA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js" integrity="sha512-ueNXF8tuPFVg1phQMcmpRunNtnVseyjeP1kVdA9YdVoRjB4ePFTS6Pg5+j5VVcOhaYYOiYdKAO+jVtrIOrhkjA==" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>


  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="https://image.flaticon.com/icons/svg/1484/1484861.svg" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5"><?= $this->session->userdata('first_name')?></h2><span>Developer</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="<?= base_url()?>cpanel/menu_project" class="brand-small text-center"> <strong style="font-size: 12px;">C</strong><strong class="text-primary" style="font-size: 12px;">PANEL</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">MODULE GENERATOR</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">
            <li><a href="<?= base_url()?>cpanel/creator"> <i class="icon-home"></i>Creator</a></li>
            <li><a href="<?= base_url()?>cpanel/list_module"> <i class="icon-home"></i>List Module</a></li>
          </ul>

          <h5 class="sidenav-heading">TEXT EDITOR</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="<?= base_url()?>cpanel/text_editor"> <i class="icon-home"></i>Write Code</a></li>
          </ul>


          <h5 class="sidenav-heading">DATA MANAGEMENT</h5>
          
          <ul id="side-main-menu" class="side-menu list-unstyled">     
            <li> 
              <a href='#exampledropdownDropdown122' aria-expanded='false' data-toggle='collapse'> <i class='icon-interface-windows'></i>
              Database</a>
              <ul id='exampledropdownDropdown122' class='collapse list-unstyled '>

                <li><a href='<?= base_url()?>Cpanel/create_table'> <i class="fa fa-angle-right"></i> Create Table</a></li>
                <li><a href='<?= base_url()?>Cpanel/list_table'> <i class="fa fa-angle-right"></i> List Table</a></li>

              </ul>
            </li>             
            <li><a href="<?= base_url()?>cpanel/lookup_helper"> <i class="icon-home"></i>Data Lookup</a></li>
          </ul>

          <!-- NEW FUNCTION -->
          <h5 class="sidenav-heading">GRAPH MANAGEMENT</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">  
            <li> 
              <a href='#exampledropdownDropdown77' aria-expanded='false' data-toggle='collapse'> <i class='icon-interface-windows'></i>
              Graph Visual</a>
              <ul id='exampledropdownDropdown77' class='collapse list-unstyled '>

                <li><a href='<?= base_url()?>Cpanel/create_graph'> <i class="fa fa-angle-right"></i> Create Graph</a></li>
                <li><a href='<?= base_url()?>Cpanel/list_graph'> <i class="fa fa-angle-right"></i> List Graph</a></li>

              </ul>
            </li>
          </ul>
          <!-- END -->


          <h5 class="sidenav-heading">PAGE MANAGEMENT</h5>
          <ul id='side-main-menu' class='side-menu list-unstyled'>
          <li> 
            <a href='#exampledropdownDropdown128' aria-expanded='false' data-toggle='collapse'> <i class='icon-interface-windows'></i>
            Main Page</a>
            <ul id='exampledropdownDropdown128' class='collapse list-unstyled '>

              <li><a href='<?= base_url()?>Cpanel/set_theme'> <i class="fa fa-angle-right"></i> Set Theme</a></li>
              <li><a href='<?= base_url()?>Cpanel/theme_editor'> <i class="fa fa-angle-right"></i> Editor</a></li>

            </ul>
          </li>
          <li> 
            <a href='#exampledropdownDropdown129' aria-expanded='false' data-toggle='collapse'> <i class='icon-interface-windows'></i>
            Extra Page</a>
            <ul id='exampledropdownDropdown129' class='collapse list-unstyled '>

              <li><a href='<?= base_url()?>Cpanel/create_page'> <i class="fa fa-angle-right"></i> Create Page</a></li>
              <li><a href='<?= base_url()?>Cpanel/list_page'> <i class="fa fa-angle-right"></i> List Page</a></li>

            </ul>
          </li>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="<?= base_url()?>cpanel/page_dashboard"> <i class="icon-home"></i>Dashboard</a></li>
          </ul>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="<?= base_url()?>cpanel/page_login"> <i class="icon-home"></i>Login</a></li>
          </ul>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="<?= base_url()?>cpanel/page_register"> <i class="icon-home"></i>Register</a></li>
          </ul>
          </ul>


        </div>
      </div>
    </nav>

    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span>C </span><strong class="text-primary">PANEL</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Log out-->
                <li class="nav-item"><a href="<?= base_url()?>cpanel/menu_project" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cyber Security Malaysia</title>
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
    <link rel="shortcut icon" href="<?= base_url()?>asset_cpanel/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="<?= base_url()?>asset_cpanel/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="<?= base_url()?>asset_cpanel/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="<?= base_url()?>asset_cpanel/img/avatar-7.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5">Sufian</h2><span>Auditor</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="<?= base_url()?>asset_cpanel/index.html" class="brand-small text-center"> <strong>C</strong><strong class="text-primary">SM</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Navigation</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="<?= base_url()?>asset_cpanel/index.html"> <i class="icon-home"></i>Home</a></li>
          </ul>

          <h5 class="sidenav-heading">Audit Application</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">   
            <li><a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Audit Application </a>
              <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
                <li><a href="#">View Application</a></li>
                <li><a href="#">New Application</a></li>
                <li><a href="#">Manage Application</a></li>
                <li><a href="#">PWS</a></li>
                <li><a href="#">Quotation</a></li>
              </ul>
            </li>
          </ul>

          <h5 class="sidenav-heading">Audit Management</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">
            <li><a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Pre </a>
              <ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
                <li><a href="#">Acceptance</a></li>
                <li><a href="#">APP</a></li>
                <li><a href="#">Audit Appointment</a></li>
                <li><a href="#">Audit Plan</a></li>
                <li><a href="#">Audit Calendar</a></li>
              </ul>
            </li>

            <li><a href="#exampledropdownDropdown3" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Post Audit </a>
              <ul id="exampledropdownDropdown3" class="collapse list-unstyled ">
                <li><a href="#">Audit Records</a></li>
                <li><a href="#">Action Plan</a></li>
                <li><a href="#">Peer Review</a></li>
              </ul>
            </li>


            <li><a href="<?= base_url()?>asset_cpanel/index.html"> <i class="icon-home"></i>Certify</a></li>

          </ul>



          <h5 class="sidenav-heading">Client Management</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">
            <li><a href="#">Client Management</a></li>
          </ul>


          <h5 class="sidenav-heading">Compliance Management</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">
            <li><a href="#">Compliance Management</a></li>
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
                  <div class="brand-text d-none d-md-inline-block"><span>Bootstrap </span><strong class="text-primary">Dashboard</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Log out-->
                <li class="nav-item"><a href="login.html" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      
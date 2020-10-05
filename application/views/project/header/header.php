<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= project_name()?></title>
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

    <link rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css'>


  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->

          <div class="sidenav-header-inner text-center">

            <?php if($this->session->userdata('role')=='developer'){ ?>
              <img src="https://image.flaticon.com/icons/svg/1484/1484861.svg" alt="person" class="img-fluid rounded-circle">
            <?php } else { ?>
              <img src="<?= $this->session->userdata('avatar')?>" alt="person" class="img-fluid rounded-circle">
            <?php } ?>

            <h2 class="h5"><?= $this->session->userdata('first_name')?></h2><span><?= $this->session->userdata('role')?></span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="<?= base_url()?>cpanel/menu_project" class="brand-small text-center"><strong class="text-primary" style="font-size: 12px;"><?= project_name()?></strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">

          <h5 class="sidenav-heading">MENU</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="<?= base_url()?>dashboard"> <i class="icon-home"></i>Dashboard</a></li>
          </ul>

          <h5 class="sidenav-heading">MY APP</h5>

          <?php $this->load->view('project/header/navbar')?>
          


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
                  <div class="brand-text d-none d-md-inline-block"><strong class="text-primary"><?= project_name()?></strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Log out-->

                <?php if($this->session->userdata('role')=='developer'){ ?>

                <li class="nav-item"><a href="<?= base_url()?>cpanel/menu_project" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>

                <?php } else { ?>

                <li class="nav-item"><a href="<?= base_url()?>login/logout" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>

                <?php } ?>

              </ul>
            </div>
          </div>
        </nav>
      </header>
      

<?php 
  $a = $this->uri->segment(1);
  if (stripos($a, 'Graph_') !== false) { //Case insensitive
      
  } else { 
    
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
jQuery(function($) {
  $(".datepicker").datepicker({
    dateFormat: 'dd-mm-yy'
  });
});
</script>


<?php } ?>
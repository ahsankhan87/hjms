<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $title; ?></title>

  <!-- Jquery Library -->
  <script src="<?php echo base_url(); ?>asset/vendor/jquery/jquery.min.js"></script>
  
  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>asset/css/modern-business.css" rel="stylesheet">
  
  <!-- Data Tables CSS -->
  <link href="<?php echo base_url(); ?>asset/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  
  <!-- Animate CSS-->
  <link href="<?php echo base_url(); ?>asset/css/animate.min.css" rel="stylesheet">
  
  <!-- select2 CSS-->
  <link href="<?php echo base_url(); ?>asset/css/select2.min.css" rel="stylesheet" />
  
</head>

<body class="animated fadeIn">

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo site_url('Dashboard'); ?>"><?php echo $this->session->userdata('company');?></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('Dashboard'); ?>">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Vouchers
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="<?php echo site_url('Vouchers/create'); ?>">Create Vouchers</a>
              <a class="dropdown-item" href="<?php echo site_url('Vouchers'); ?>">View Vouchers</a>
              <a class="dropdown-item" href="<?php echo site_url('Vouchers/allVouchers'); ?>">View All</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('Users'); ?>">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('Passengers'); ?>">Passengers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('Suppliers'); ?>">Suppliers</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Reports
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="<?php echo site_url('Reports/arrivalReport'); ?>">Arrival Report</a>
              <a class="dropdown-item" href="<?php echo site_url('Reports/departureReport'); ?>">Departure Report</a>
            </div>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Master Forms
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="<?php echo site_url('Hotel'); ?>">Hotels</a>
              <a class="dropdown-item" href="<?php echo site_url('City'); ?>">City</a>
              <a class="dropdown-item" href="<?php echo site_url('TransportationTrip'); ?>">Transportation Trip</a>
              <a class="dropdown-item" href="<?php echo site_url('TransportationType'); ?>">Transportation Type</a>
              <a class="dropdown-item" href="<?php echo site_url('Shirka'); ?>">Shirkas</a>
            </div>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo 'Welcome '.$this->session->userdata('name'); ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                <a class="dropdown-item" href="<?php echo site_url('C_fyear'); ?>">Fiscal Years</a>
                <a class="dropdown-item" href="<?php echo site_url('Users/profile/'.$this->session->userdata('user_id')); ?>">Profile</a>
                <a class="dropdown-item" href="<?php echo site_url('Login/logout'); ?>">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container-fluid">

    <!-- Page Heading/Breadcrumbs 
    <h2 class="mt-4 mb-3"><?php echo $main; ?>
      <small><?php echo $main_small; ?></small>
    </h2>
-->

    <ol class="breadcrumb mt-2">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('Dashboard'); ?>">Dashboard</a>
      </li>
      <li class="breadcrumb-item active"><?php echo $main; ?></li>
     
    </ol>
    <div class="text-right"> Fiscal Year: <?php echo $this->session->userdata('FY_YEAR'); ?></div>

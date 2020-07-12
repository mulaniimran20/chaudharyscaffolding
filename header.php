<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Dashboard</title>

 

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  
<!--  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">-->

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  
 <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
  
  
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="main.php">Start Bootstrap</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" style="display: none;">
      <div class="input-group" style="display: none;">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown" style="display:none;">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="main.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="product_list.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Stocks</span></a>
      </li>
      <li class="nav-item" style="display:none;">
        <a class="nav-link" href="user_list.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Missing or Damage or Pending Stock</span></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="user_history.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Return Challan Entry</span></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="billing.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Create Delivery Challan</span></a>
      </li>
      <?php
      
      session_start();
      
      $adminid = $_SESSION['adminsessionid'];
      
      if($adminid == 2)
      {
      ?>
      <li class="nav-item">
        <a class="nav-link" href="todayuseddata.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Daily Used Product Entry</span></a>
      </li>
      
      <?php
      }
      ?>
      
      <li class="nav-item">
        <a class="nav-link" href="user_history_main.php">
          <i class="fas fa-fw fa-table"></i>
          <span>User History</span></a>
      </li>
      
     <?php 
     if($adminid == 2)
      {
     ?>
     <li class="nav-item">
        <a class="nav-link" href="daily_used_list.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Daily Used List</span></a>
      </li>
      
      <?php
      }
      ?>
      
      <li class="nav-item">
        <a class="nav-link" href="DeliveryS.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Delivery Challen Scanning</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="dailyentry.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Daily Challan List</span></a>
      </li>
      
       <li class="nav-item">
        <a class="nav-link" href="all_challan_list.php">
          <i class="fas fa-fw fa-table"></i>
          <span>DC Challan List</span></a>
      </li>
      
      
    </ul>
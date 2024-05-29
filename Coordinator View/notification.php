<?php
include "Processes/db_conn_high_school.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title></title>
<!-- CSS FILES -->
    <link href="../Coordinator View/assets/css/bootstrap.css" rel="stylesheet">
    <link href="../Coordinator View/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Coordinator View/assets/css/resource_allocation.css" rel="stylesheet">
    <link href="../Coordinator View/assets/css/modal.css" rel="stylesheet">



  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <!--Importing jquery-->
   <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>

<div class="container">
<nav class="sidebar">
    <div class="menu">
  
      <div class="main-menu">
  
        <div class="logo">
        <a href="#" class="SDOlogo"><img src="sdo.png"></a>
        </div>
  
      <div class="menu-content">
      <ul class="menu-items">
        <div class="menu-title">ICT Resource Management System</div>
        <li class="item">
          <a href="dashboard_content.php">
          <i class="bi bi-bar-chart-fill"></i>Dashboard</a>
        </li>
        <li class="item">
        <a href="resource_allocation_content.php">
            <i class="bi bi-pie-chart-fill"></i>Resource Allocation
        </a>
        </li>
        <li class="item">
          <a href="notification.php">
          <i class="bi bi-bell-fill"></i>Notifications</a>
        </li>
        <li class="item">
          <a href="school_content.php">
          <i class="bi bi-building-fill"></i>Schools</a>
        </li>
        <li class="item">
          <a href="manage_users_content.php">
          <i class="bi bi-person-vcard-fill"></i>Manage Users</a>
        </li>
        <li class="item">
          <a href="login.php">
          <i class="bi bi-box-arrow-in-left"></i>Log Out</a>
        </li>
      </ul>
    </div>
          </div>
        </div>
     </nav>

    
    <div class="content">
        <h3 class = "mx-3">Notifications</h3>
        <br>
            <!-- search bar -->
            <div class = "container d-flex">
                <div style = "width:260px; margin-left: 0vw;" class="input-group rounded">
                    <input  type="text" id = "searchschool" name = "searchschool" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
</div>

<div id = "tablecontent">
    <div class = "container mt-5">
        <!-- Table showing resource allocation info in the database -->
        <table style="margin-left: 0.5vw;" class="table table-striped centerTable text-center">
    <thead class="thead-light">
        <tr>
            <th scope="col">Table Date</th>
            <th scope="col">Request</th>
            <th scope="col">Remarks</th>
        </tr>
    </thead>
</table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- JS FILES -->
    <script src="../Coordinator View/assets/js/bootstrap.bundle.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.min.js"></script>
</body>


</html>
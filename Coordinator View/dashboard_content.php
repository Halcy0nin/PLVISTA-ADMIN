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
    <link href="../Coordinator View/assets/css/dashboard.css" rel="stylesheet">



  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
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
          <i class="bi bi-pie-chart-fill"></i>Resource Allocation</a>
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
          <a href="profile_content.php">
          <i class="bi bi-person-circle"></i>Profile</a>
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

    <div class = "content">

    <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div style="margin-left:3vw; margin-top:0vh;" class="dropdown">
                            <button style="width: 10vw; margin-left: 14vw;" class="btn btn-outline-secondary dropdown-toggle d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButtonDate" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Date</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonDate">
                                <!-- Dropdown items here -->
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div style="margin-left:4vw; margin-top:0vh;" class="dropdown">
                            <button style="width: 10vw; margin-left: -23vw;" class="btn btn-outline-secondary dropdown-toggle d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButtonSchool" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>School</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonSchool">
                                <!-- Dropdown items here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="container">
                <div style="margin-left:3vw; margin-top:1vh;" class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total No. of Equipment</h4>
                        <h2 class="card-text">0000</h2>
                    </div>
                </div>
            </div>
                <div style="margin-left:34.4vw; margin-top:-14.3vh;" class="card">
                    <div class="card-body">
                        <h4 class="card-title">Working</h4>
                        <h2 class="card-text">0000</h2>
                    </div>
                </div>
            </div>
                <div style="margin-left:52.4vw; margin-top:-14.4vh;" class="card">
                    <div class="card-body">
                        <h4 class="card-title">Need Repair</h4>
                        <h2 class="card-text">0000</h2>
                    </div>
                </div>
            </div>
                <div style="margin-left:70.6vw; margin-top:-14.4vh;" class="card">
                    <div class="card-body">
                        <h4 class="card-title">Condemned</h4>
                        <h2 class="card-text">0000</h2>
                    </div>
                </div>
                
                <!-- NO BORDER CARD -->
                <div style="margin-left:19.5vw; margin-top:2.5vh; width:45.2vw;height:35vh;" class="cards">
                    <div class="cards-body">
                        <h4 class="cards-title"></h4>
                        <h2 class="cards-text"></h2>
                    </div>
                </div>
                <div style="margin-left:66.7vw; margin-top:-37vh; width:19vw;height:35vh;" class="cards">
                    <div class="cards-body">
                        <h4 class="cards-title"></h4>
                        <h2 class="cards-text"></h2>
                    </div>
                </div>
                <div style="margin-left:19.4vw; margin-top:1vh; width:25vw;height:36vh;" class="cards">
                    <div class="cards-body">
                        <h4 class="cards-title"></h4>
                        <h2 class="cards-text"></h2>
                    </div>
                </div>
                <div style="margin-left:46vw; margin-top:-38.1vh; width:39.8vw;height:36vh;" class="cards">
                    <div class="cards-body">
                        <h4 class="cards-title"></h4>
                        <h2 class="cards-text"></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- JS FILES -->
  <script src="../Coordinator View/assets/js/bootstrap.bundle.js"></script>
  <script src="../Coordinator View/assets/js/bootstrap.bundle.min.js"></script>

</body>
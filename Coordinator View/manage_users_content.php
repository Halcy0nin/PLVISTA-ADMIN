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
  <link href="../Coordinator View/assets/css/manage_users_content.css" rel="stylesheet">

  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <!-- icon sa tab -->
  <link rel="icon" type="images/x-icon" href="sdo.png"/>
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
        <div class = "containers">
        <h3 class = "mx-3">Manage Users</h3>
        <br>

        <div class = "row">
            <div class = "col">
            <!-- search bar -->
            <div class = "container d-flex">
                <div style = "width:260px;" class="input-group rounded">
                    <input  type="search" class="form-control rounded" placeholder="Search User" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
            <div>

            <!-- Dropdown filter for role -->
            <div class="container d-flex justify-content-center">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Role</button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
            </div>
    </div>
        
        <div class = "container mt-5">
        <!-- Table showing user info in the database -->
        <table style="margin-left: auto; margin-right: auto;" class = "table table-striped centerTable text-center">
            <thead class="thead-light"></thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Role</th>
                    <th scope="col">School</th>
                    <th style = "width:13%;" scope="col">Action</th>
                </tr>

                <tr>
                    <td scope="row">123456</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>
                        <!-- Edit User Button -->
                        <button type="button" class="btn btn-primary "><i class="bi bi-pencil-fill"></i></button>
                        <!-- Delete User Button -->
                        <button type="button" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                    </td>
                </tr>
        </table>

        <div class = "container d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
            </div>
        
        </div>


        <!-- Pending Requests Section -->
        <div class = "containers">
        <h3 class = "mx-3">Pending Requests</h3>
        <br>

        <div class = "row">
            <div class = "col">
            <!-- search bar -->
            <div class = "container d-flex">
                <div style = "width:260px;" class="input-group rounded">
                    <input  type="search" class="form-control rounded" placeholder="Search User" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
            

            <!-- Dropdown filter for role -->
                <div class="container">
                        <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Role </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                        </div>
                </div>
            </div>
    </div>
        
        <div class = "container mt-5">
        <!-- Table showing pending user requests in the database -->
        <table style="margin-left: auto; margin-right: auto;" class = "table table-striped centerTable text-center">
            <thead class="thead-light"></thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Role</th>
                    <th scope="col">School</th>
                    <th style = "width:13%;" scope="col">Action</th>
                </tr>

                <tr>
                    <td scope="row">123456</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>
                        <!-- Approve Button -->
                        <button type="button" class="btn btn-success "><i class="bi bi-check-lg"></i></button>
                        <!-- Reject Button -->
                        <button type="button" class="btn btn-danger"><i class="bi bi-x"></i></button>
                    </td>
                </tr>
        </table>

        <div class = "container d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
            </div>
        
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
      <!-- JS FILES -->
    <script src="../Coordinator View/assets/js/bootstrap.bundle.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
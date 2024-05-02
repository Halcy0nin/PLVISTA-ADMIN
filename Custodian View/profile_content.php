<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Account Settings</title>
    <!-- CSS FILES -->
    <link href="../Custodian View/assets/css/bootstrap.css" rel="stylesheet">
    <link href="../Custodian View/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Custodian View/assets/css/profile_content.css" rel="stylesheet">

  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <!-- icon sa tab -->
  <link rel="icon" type="images/x-icon" href="sdo.png"/>

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
          <a href="school_inventory_content.php?school_id=<?php echo $_SESSION['school_id']; ?>">
          <i class="bi bi-archive-fill"></i>School Inventory</a>
        </li>
        <li class="item">
          <a href="resource_allocation_content.php?school_id=<?php echo $_SESSION['school_id']; ?>">
          <i class="bi bi-journal-bookmark-fill"></i>Report</a>
        </li>
        <li class="item">
          <a href="profile_content.php?school_id=<?php echo $_SESSION['school_id']; ?>">
          <i class="bi bi-person-circle"></i>Profile</a>
        </li>
        <li class="item">
          <a href="login.php">
          <i class="bi bi-box-arrow-in-left"></i>Logout</a>
        </li>
      </ul>
    </div>
          </div>
        </div>
     </nav>

     <div class="col-md-9">
            
            <div class="container content clear-fix">
        
            <h2 class="mt-5 mb-5">Profile Settings</h2>
            
            <div class="row" style="height:100%">
            
                <div class="col-md-3"></div>
                
                <div class="col-md-9">
                    
                    <div class="container">
                    
                        <form>
                    
                            <div class="form-group">

                                <label for=fullName>Full Name</label>
                                <input type="text" class="form-control" id="fullName">

                            </div>
                            <div class="form-group">

                                <label for=email>Email</label>
                                <input type="email" class="form-control" id="email">

                            </div>
                            <div class="form-group">

                                <label for=pass>Password</label>
                                <input type="password" class="form-control" id="pass">

                            </div>
                            <div class="form-group ">

                                <label for=birthday>Birthday</label>
                                <input type="date" class="form-control" id="birthday">

                            </div>
                            
                            <div class="row mt-5">
                            
                                <div class="col">
                                
                                    <button type="button" class="btn btn-primary btn-block">Save Changes</button>
                                
                                </div>
                                
                                <div class="col">
                                
                                    <button type="button" class="btn btn-default btn-block"
                                    onclick="window.location.href='dashboard.php'">Cancel</button>
                                
                                </div>
                            
                            </div>

                        </form>
                    
                    </div>
                
                </div>
            
            </div>
        
        </div>
            
        </div>
    
    </div>
    
</div>
</body>

</html>

     

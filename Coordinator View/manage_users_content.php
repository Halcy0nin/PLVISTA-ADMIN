<?php
include "Processes/users_info.php";
include "Processes/show_approved_requests.php";
include "Processes/show_denied_requests.php";
include "Processes/show_pending_requests.php";
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
  <link href="../Coordinator View/assets/css/manage_users_content.css" rel="stylesheet">
  <link href="../Coordinator View/assets/css/modal.css" rel="stylesheet">

  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <!-- icon sa tab -->
  <link rel="icon" type="images/x-icon" href="sdo.png"/>

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
                    <input type="text" id = "searchuser" name = "searchuser" class="form-control rounded" placeholder="Search User" aria-label="Search" aria-describedby="search-addon" />
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
        
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-users-tab" data-bs-toggle="tab" data-bs-target="#nav-users" type="button" role="tab" aria-controls="nav-users" aria-selected="true">Users</button>
            <button class="nav-link" id="nav-pendingrequests-tab" data-bs-toggle="tab" data-bs-target="#nav-pendingrequests" type="button" role="tab" aria-controls="nav-pendingrequests" aria-selected="false">Pending Requests</button>
            <button class="nav-link" id="nav-approvedrequests-tab" data-bs-toggle="tab" data-bs-target="#nav-approvedrequests" type="button" role="tab" aria-controls="nav-approvedrequests" aria-selected="false">Approved Requests</button>
            <button class="nav-link" id="nav-deniedrequests-tab" data-bs-toggle="tab" data-bs-target="#nav-deniedrequests" type="button" role="tab" aria-controls="nav-deniedrequests" aria-selected="false">Denied Requests</button>
        </div>
        </nav>
        
        
        <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab" tabindex="0">
             <!-- Table showing all user info in the database -->
         <table style="width:90%; margin-left: auto; margin-right: auto;" class = "table table-striped centerTable">
        <thead class="thead-light">
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact No.</th>
                <th scope="col">School</th>
                <th style= "width:5vw;" scope="col">Action</th>
            </tr>
        </thead>
    <!-- loops through all of the data in the table and displays it per row -->
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?php echo htmlspecialchars($user["user_id"]); ?></td>
            <td><?php echo htmlspecialchars($user["user_name"]); ?></td>
            <td><?php echo htmlspecialchars($user["user_email"]); ?></td>
            <td><?php echo htmlspecialchars($user["user_contact"]); ?></td>
            <td><?php echo htmlspecialchars($user["school_name"]);?></td>

            <td> 
                <button type="button" id="edituser<?php echo $user["user_id"]; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edituser<?php echo $user["user_id"]; ?>">
                    Edit User
                </button>
            </td>

            <td>
                <button type="button" id="deleteuser<?php echo $user["user_id"]; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteuser<?php echo htmlspecialchars($user["user_id"]); ?>">
                    Delete User
                </button>
            </td>

        </tr>

        <!-- Pop-up form for updating user -->
                <!--get user no as reference to match in order to assign the respective user no to the item to be updated-->
                <div class="modal fade" id="edituser<?php echo $user["user_id"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateitemLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="updateitemLabel">Edit User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action = "Processes/edit_user.php" method ="POST">
                            <div class="modal-body">

                            <div class="form-group mb-3">
                                <input type = "text" name ="username" placeholder= "Username" value = "<?php echo $user["user_name"]; ?>"></input>
                            </div>

                            <div class="form-group mb-3">
                                <input type = "text" name ="useremail" placeholder= "User Email" value = "<?php echo $user["user_email"]; ?>"></input>
                            </div>

                            <div class="form-group mb-3">
                                <input type = "text" name ="usercontact" placeholder= "User Email" value = "<?php echo $user["user_contact"]; ?>"></input>
                            </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- shows the current id of the row of data through an input field -->
                                <input type = "hidden" name = "user_to_update" value = "<?php echo $user["user_id"]; ?>">
                                <button type="submit" name = "edituser" class="btn btn-primary">Confirm</button>
                            </form>
                            </div>
                            </div>
                        </div>
                        </div>


                <!-- Modal for Delete User -->
                <div class="modal fade" id="deleteuser<?php echo htmlspecialchars($user["user_id"]); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteschoolLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteschoolLabel">Delete User</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action = "Processes/delete_user.php" method ="POST">
                                        <div class="modal-body">
                                        <h4>Are you sure you want to delete user, <?php echo $user["user_name"]?>?</h4>
                                        <p>This action cannot be undone</p>
                                        
                                                <!-- shows the current id of the row of data through an input field -->
                                                <input type = "hidden" name = "user_to_delete" value = "<?php echo htmlspecialchars($user["user_id"]); ?>">
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type = "submit" name = "deleteuser" value = "Delete User" class = "btn btn-primary">
                                                
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <?php } ?>
    </table>
        </div>


        <div class="tab-pane fade" id="nav-pendingrequests" role="tabpanel" aria-labelledby="nav-pendingrequests-tab" tabindex="0">
            <!-- Table showing all user info in the database -->
    <table style="width:90%; margin-left: auto; margin-right: auto;" class = "table table-striped centerTable">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Request ID</th>
                    <th scope="col">Requester</th>
                    <th scope="col">Date Requested</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        <!-- loops through all of the data in the table and displays it per row -->
        <?php foreach ($requests as $request) { ?>

            <tr>
                <td><?php echo htmlspecialchars($request["request_id"]); ?></td>
                <td><?php echo htmlspecialchars($request["request_name"]); ?></td>
                <td><?php echo htmlspecialchars($request["request_date"]); ?></td>


                <td>
                    <button type="button" id="viewrequest<?php echo $request["request_id"]; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#viewrequest<?php echo $request["request_id"]; ?>">
                        View Request
                    </button>
                </td>
        </tr>
        <?php foreach ($users as $user) { ?>
            <!-- Modal for viewing request -->
            <div class="modal fade" id="viewrequest<?php echo htmlspecialchars($request["request_id"]); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteschoolLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteschoolLabel">Request Information</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action = "Processes/request_verification.php" method ="POST">
                                                    <div class="modal-body">
                                                    
                                                    
                                                    <h5>Previous Custodian Name</h5>
                                                    <p><?php echo htmlspecialchars($user["user_name"]); ?></p>
                                                    <input type = "hidden" name = "requestname" value = "<?php echo htmlspecialchars($user["user_name"]); ?>">

                                                    <h5>New Custodian Name</h5>
                                                    <p><?php echo htmlspecialchars($request["new_username"]); ?></p>
                                                    <input type = "hidden" name = "newusername" value = "<?php echo htmlspecialchars($request["new_username"]); ?>">

                                                    <h5>Old Email</h5>
                                                    <p><?php echo htmlspecialchars($user["user_email"]); ?></p>

                                                    <h5>New Email</h5>
                                                    <p><?php echo htmlspecialchars($request["new_email"]); ?></p>
                                                    <input type = "hidden" name = "newemail" value = "<?php echo htmlspecialchars($request["new_email"]); ?>">
                                                    
                                                    <h5>Old Contact No.</h5>
                                                    <p><?php echo htmlspecialchars($user["user_contact"]); ?></p>
                                                    
                                                    <h5>New Contact No.</h5>
                                                    <p><?php echo htmlspecialchars($request["new_contact"]); ?></p>
                                                    <input type = "hidden" name = "newcontact" value = "<?php echo htmlspecialchars($request["new_contact"]); ?>">

                                                    <input type = "hidden" name = "user_to_request" value = "<?php echo htmlspecialchars($user["user_id"]); ?>">
                                                        </div>
                                                    <div class="modal-footer">
                                                            
                                                            <input type = "submit" name = "denyrequest" value = "Deny" class = "btn btn-primary">
                                                            <input type = "submit" name = "approverequest" value = "Approve" class = "btn btn-primary">
                                                            
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                            </div>

        <?php } }?>
        </table>
        
        </div>

        <div class="tab-pane fade" id="nav-approvedrequests" role="tabpanel" aria-labelledby="nav-approvedrequests-tab" tabindex="0">
            <!-- Table showing all user info in the database -->
    <table style="width:90%; margin-left: auto; margin-right: auto;" class = "table table-striped centerTable">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Request ID</th>
                    <th scope="col">Requester</th>
                    <th scope="col">Date Requested</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        <!-- loops through all of the data in the table and displays it per row -->
        <?php foreach ($approvedrequests as $approvedrequest) { ?>
            <tr>
                <td><?php echo htmlspecialchars($approvedrequest["request_id"]); ?></td>
                <td><?php echo htmlspecialchars($approvedrequest["request_name"]); ?></td>
                <td><?php echo htmlspecialchars($approvedrequest["request_date"]); ?></td>
        </tr>

        <?php } ?>
        </table>
        </div>


        <div class="tab-pane fade" id="nav-deniedrequests" role="tabpanel" aria-labelledby="nav-deniedrequests-tab" tabindex="0">
            <!-- Table showing all user info in the database -->
    <table style="width:90%; margin-left: auto; margin-right: auto;" class = "table table-striped centerTable">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Request ID</th>
                    <th scope="col">Requester</th>
                    <th scope="col">Date Requested</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        <!-- loops through all of the data in the table and displays it per row -->
        <?php foreach ($deniedrequests as $deniedrequest) { ?>
            <tr>
                <td><?php echo htmlspecialchars($deniedrequest["request_id"]); ?></td>
                <td><?php echo htmlspecialchars($deniedrequest["request_name"]); ?></td>
                <td><?php echo htmlspecialchars($deniedrequest["request_date"]); ?></td>

        </tr>

        <?php } ?>
        </table>
        </div>

        <div class = "container d-flex justify-content-end">
                    <nav style="position: fixed; bottom: 7vh; right: 19.5vw;" aria-label="Page navigation example">
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


<!-- Jquery script for detecting input in searchbar and displaying results on it -->
<script type="text/javascript"> 
$(document).ready(function() {
    var defaultTableContents = {}; // Store the default table contents for each tab
    
    // Function to hide all rows in a table except the header row
    var hideAllRows = function(tableId) {
        $(tableId + " tr").not(":first").hide();
    };

    // Function to update table visibility based on search input
    var updateTableVisibility = function(tableId, searchValue) {
        $(tableId + " tr").each(function(index) {
            if (index === 0) {
                $(this).show(); // Show the header row
            } else {
                var rowText = $(this).text().toLowerCase(); // Convert row text to lowercase
                if (rowText.includes(searchValue)) {
                    $(this).show(); // Show the row if it contains the search string
                } else {
                    $(this).hide(); // Hide the row if it doesn't contain the search string
                }
            }
        });
    };

    // Store the default contents of each table
    $("#nav-tabContent .tab-pane").each(function() {
        defaultTableContents["#" + $(this).attr("id")] = $(this).html();
    });

    // Attach keyup event listener directly to the search input
    $("#searchuser").on("keyup", function() {
        var searchValue = $(this).val().toLowerCase(); // Convert search input to lowercase
        $("#nav-tabContent .tab-pane").each(function() {
            var tableId = "#" + $(this).attr("id");
            $(this).html(defaultTableContents[tableId]); // Reset table content to default
            hideAllRows(tableId); // Hide all rows except the header row
            updateTableVisibility(tableId, searchValue); // Update table visibility based on search input
        });
    });
});


        </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
      <!-- JS FILES -->
    <script src="../Coordinator View/assets/js/bootstrap.bundle.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
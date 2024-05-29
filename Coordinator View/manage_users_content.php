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
            </div>
    </div>

        <!-- Button for add users -->
<button style = "margin-left: 54vw; margin-top: -7vh;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
        Add User
        </button><br>

<!-- Pop-up form for adding users -->
<div class="modal fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addUserLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="addUser" action="../Coordinator View/Processes/add_user.php" method="POST" onsubmit="return validateForm()">
                <div class="modal-body">
                    <?php 
                        $schoolQuery = "SELECT * FROM high_schools";
                        $schoolResult = mysqli_query($conn, $schoolQuery);
                    ?>
                    <div class="form-group mb-3">
                        <input type="text" name="username" placeholder="Username" value="">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="useremail" placeholder="Email" value="">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="userpass" placeholder="Password" value="">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="usercontact" placeholder="User Contact Number" value="">
                    </div>
                    <div class="form-group mb-3">
                        <label> School </label> <br>
                        <select name="school">
                            <option value="" disabled selected>Select a school</option>
                            <?php
                                // Check if there are any schools in the database
                                if (mysqli_num_rows($schoolResult) > 0) {
                                    // Loop through each row of school data
                                    while ($row = mysqli_fetch_assoc($schoolResult)) {
                                        // Output a dropdown item for each school
                                        echo '<option>' . $row['school_name'] . '</option>';
                                    }
                                } else {
                                    // If no schools found, display a default message
                                    echo '<option>No schools found</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div> <!-- End of modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="adduser" class="btn btn-primary">Add User</button>
                </div> <!-- End of modal-footer -->
            </form>
        </div> <!-- End of modal-content -->
    </div> <!-- End of modal-dialog -->
</div> <!-- End of modal -->


    <nav>
        <div style="margin-top:-2vh;" class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-users-tab" data-bs-toggle="tab" data-bs-target="#nav-users" type="button" role="tab" aria-controls="nav-users" aria-selected="true">Users</button>
            <button class="nav-link" id="nav-pendingrequests-tab" data-bs-toggle="tab" data-bs-target="#nav-pendingrequests" type="button" role="tab" aria-controls="nav-pendingrequests" aria-selected="false">Pending Requests</button>
            <button class="nav-link" id="nav-approvedrequests-tab" data-bs-toggle="tab" data-bs-target="#nav-approvedrequests" type="button" role="tab" aria-controls="nav-approvedrequests" aria-selected="false">Approved Requests</button>
            <button class="nav-link" id="nav-deniedrequests-tab" data-bs-toggle="tab" data-bs-target="#nav-deniedrequests" type="button" role="tab" aria-controls="nav-deniedrequests" aria-selected="false">Denied Requests</button>
        </div>
        </nav>
        
        
        <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab" tabindex="0">
             <!-- Table showing all user info in the database -->
         <table style="width:90%; margin-left: auto; margin-right: auto;margin-top:-3vh;" class = "table table-striped centerTable">
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
                <button id="edituser<?php echo $user["user_id"]; ?>" class="edit-button" data-bs-toggle="modal" data-bs-target="#edituser<?php echo $user["user_id"]; ?>">
                <svg class="edit-svgIcon" viewBox="0 0 512 512">
                    <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                </svg>
                </button>
            </td>

            <td>
                <button style="margin-left:-1vw;" id="deleteuser<?php echo $user["user_id"]; ?>" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteuser<?php echo htmlspecialchars($user["user_id"]); ?>">
                <svg class="delete-svgIcon" viewBox="0 0 448 512">
                    <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                </svg>
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
                                <input type = "text" name ="userpass" placeholder= "Password" value = "<?php echo $user["user_pass"]; ?>"></input>
                            </div>

                            <div class="form-group mb-3">
                                <input type = "text" name ="usercontact" placeholder= "Contact No." value = "<?php echo $user["user_contact"]; ?>"></input>
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
                                <div class = "container d-flex justify-content-end">
                                <nav style="position: fixed; bottom: 7vh; right: 19.5vw;"aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="manage_users_content.php?page=<?php echo max($users_current_page - 1, 1); ?>" style="border-right: 1px solid #dee2e6;">Previous</a>
            </li>

            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item">
                    <a class="page-link" href="manage_users_content.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item">
                <a class="page-link" href="manage_users_content.php?page=<?php echo min($users_current_page + 1, $totalPages); ?>" style="border-left: 1px solid #dee2e6;">Next</a>
            </li>
        </ul>
    </nav>
            </div>
    </table>
        </div>


        <div class="tab-pane fade" id="nav-pendingrequests" role="tabpanel" aria-labelledby="nav-pendingrequests-tab" tabindex="0">
            <!-- Table showing all user info in the database -->
    <table style="width:90%; margin-left: auto; margin-right: auto; margin-top:-3vh;" class = "table table-striped centerTable">
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
                    <button style="margin-right:1vw;" id="viewrequest<?php echo $request["request_id"]; ?>" class="view-button" data-bs-toggle="modal" data-bs-target="#viewrequest<?php echo $request["request_id"]; ?>">
                    <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"> <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" fill="white"></path> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" fill="white"></path> </svg>
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
                <form action="Processes/request_verification.php" method="POST">
                    <div class="modal-body">
                        <h5>Previous Custodian Name</h5>
                        <p><?php echo htmlspecialchars($user["user_name"]); ?></p>
                        <input type="hidden" name="requestname" value="<?php echo htmlspecialchars($user["user_name"]); ?>">

                        <h5>New Custodian Name</h5>
                        <p><?php echo htmlspecialchars($request["new_username"]); ?></p>
                        <input type="hidden" name="newusername" value="<?php echo htmlspecialchars($request["new_username"]); ?>">

                        <h5>Old Password</h5>
                        <p><?php echo htmlspecialchars($user["user_pass"]); ?></p>

                        <h5>New Password</h5>
                        <p><?php echo htmlspecialchars($request["new_pass"]); ?></p>
                        <input type="hidden" name="newpass" value="<?php echo htmlspecialchars($request["new_pass"]); ?>">

                        <input type="hidden" name="user_to_request" value="<?php echo htmlspecialchars($user["user_id"]); ?>">
                        <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($request["request_id"]); ?>">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="denyrequest" value="Deny" class="btn btn-primary">
                        <input type="submit" name="approverequest" value="Approve" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } }?>
<div class = "container d-flex justify-content-end">
<nav style="position: fixed; bottom: 7vh; right: 19.5vw;" aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="manage_users_content.php?page=<?php echo max($pending_current_page - 1, 1); ?>" style="border-right: 1px solid #dee2e6;">Previous</a>
            </li>

            <?php for ($i = 1; $i <= $pendingTotalPages; $i++) : ?>
                <li class="page-item">
                    <a class="page-link" href="manage_users_content.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item">
                <a class="page-link" href="manage_users_content.php?page=<?php echo min($pending_current_page + 1, $pendingTotalPages); ?>" style="border-left: 1px solid #dee2e6;">Next</a>
            </li>
        </ul>
    </nav>
            </div>
        </table>
        
        </div>

        <div class="tab-pane fade" id="nav-approvedrequests" role="tabpanel" aria-labelledby="nav-approvedrequests-tab" tabindex="0">
            <!-- Table showing all user info in the database -->
    <table style="width:90%; margin-left: auto; margin-right: auto;margin-top:-3vh;" class = "table table-striped centerTable">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Request ID</th>
                    <th scope="col">Requester</th>
                    <th scope="col">Date Requested</th>
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
        <div class = "container d-flex justify-content-end">
        <nav style="position: fixed; bottom: 7vh; right: 19.5vw;" aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="manage_users_content.php?page=<?php echo max($approved_current_page - 1, 1); ?>" style="border-right: 1px solid #dee2e6;">Previous</a>
            </li>

            <?php for ($i = 1; $i <= $userTotalPages; $i++) : ?>
                <li class="page-item">
                    <a class="page-link" href="manage_users_content.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link" href="manage_users_content.php?page=<?php echo min($approved_current_page + 1, $userTotalPages); ?>" style="border-left: 1px solid #dee2e6;">Next</a>
            </li>
        </ul>
    </nav>
            </div>
        </table>
        </div>


        <div class="tab-pane fade" id="nav-deniedrequests" role="tabpanel" aria-labelledby="nav-deniedrequests-tab" tabindex="0">
            <!-- Table showing all user info in the database -->
    <table style="width:90%; margin-left: auto; margin-right: auto;margin-top:-3vh;" class = "table table-striped centerTable">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Request ID</th>
                    <th scope="col">Requester</th>
                    <th scope="col">Date Requested</th>
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
        <div class = "container d-flex justify-content-end">
        <nav style="position: fixed; bottom: 7vh; right: 19.5vw;" aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="manage_users_content.php?page=<?php echo max($denied_current_page - 1, 1); ?>" style="border-right: 1px solid #dee2e6;">Previous</a>
            </li>

            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item">
                    <a class="page-link" href="manage_users_content.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item">
                <a class="page-link" href="manage_users_content.php?page=<?php echo min($denied_current_page + 1, $totalPages); ?>" style="border-left: 1px solid #dee2e6;">Next</a>
            </li>
        </ul>
    </nav>
            </div>
        </table>
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

<script>
    function validateForm() {
        // Get the value of the email input field
        var email = document.forms["addUser"]["useremail"].value;

        // Regular expression pattern to match email format
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Check if the email matches the pattern
        if (!emailPattern.test(email)) {
            // If it doesn't match, show an alert and return false to prevent form submission
            alert("Please enter a valid email address.");
            return false;
        }
    }
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
      <!-- JS FILES -->
    <script src="../Coordinator View/assets/js/bootstrap.bundle.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
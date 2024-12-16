<?php
include "Processes/users_info.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Users</title>
    <?php include "head.php"; ?>
  <link href="../Coordinator View/assets/css/manage_users_content.css" rel="stylesheet">
  <link href="../Coordinator View/assets/css/modal.css" rel="stylesheet">
</head>

<body>

<div class="container">
<?php include "sidebar.php"; ?>

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
    
        <!-- Table showing all user info in the database -->
         <table style="width:90%; margin-left: auto; margin-right: auto;margin-top:3vh;" class = "table table-striped centerTable">
        <thead class="thead-light">
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Last Updated</th>
                <th style= "width:5vw;" scope="col">Action</th>
            </tr>
        </thead>
    <!-- loops through all of the data in the table and displays it per row -->
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?php echo htmlspecialchars($user["student_id"]); ?></td>
            <td><?php echo htmlspecialchars($user["name"]); ?></td>
            <td><?php echo htmlspecialchars($user["email"]); ?></td>
            <td><?php echo htmlspecialchars($user["role"]); ?></td>
            <td><?php echo htmlspecialchars($user["updated_at"]);?></td>

            <td> 
                <button id="edituser<?php echo $user["student_id"]; ?>" class="edit-button" data-bs-toggle="modal" data-bs-target="#edituser<?php echo $user["student_id"]; ?>">
                <svg class="edit-svgIcon" viewBox="0 0 512 512">
                    <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                </svg>
                </button>
            </td>

            <td>
                <button style="margin-left:-1vw;" id="deleteuser<?php echo $user["student_id"]; ?>" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteuser<?php echo htmlspecialchars($user["student_id"]); ?>">
                <svg class="delete-svgIcon" viewBox="0 0 448 512">
                    <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                </svg>
                </button>
            </td>

        </tr>

        <!-- Pop-up form for updating user -->
                <!--get user no as reference to match in order to assign the respective user no to the item to be updated-->
                <div class="modal fade" id="edituser<?php echo $user["student_id"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateitemLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="updateitemLabel"><i class="bi bi-pencil-square"></i> Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="Processes/edit_user.php" method="POST">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="username<?php echo $user["student_id"]; ?>" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username<?php echo $user["student_id"]; ?>" name="username" placeholder="Enter username" value="<?php echo htmlspecialchars($user["name"]); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userpass<?php echo $user["student_id"]; ?>" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="userpass<?php echo $user["student_id"]; ?>" name="userpass" placeholder="Enter password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="usercontact<?php echo $user["student_id"]; ?>" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="usercontact<?php echo $user["student_id"]; ?>" name="usercontact" placeholder="Enter email address" value="<?php echo htmlspecialchars($user["email"]); ?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="user_to_update" value="<?php echo $user["student_id"]; ?>">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="edituser" class="btn btn-success">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <!-- Modal for Delete User -->
                <div class="modal fade" id="deleteuser<?php echo htmlspecialchars($user['student_id']); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteUserLabel">
                                    <i class="bi bi-trash"></i> Archive User
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="Processes/delete_user.php" method="POST">
                                <div class="modal-body">
                                    <div class="text-center">
                                        <h4 class="text-danger">Are you sure?</h4>
                                        <p class="mb-4">You are about to archive user <strong><?php echo htmlspecialchars($user['name']); ?></strong>. This action cannot be undone.</p>
                                    </div>
                                    <input type="hidden" name="user_to_delete" value="<?php echo htmlspecialchars($user['student_id']); ?>">
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle"></i> Cancel
                                    </button>
                                    <button type="submit" name="deleteuser" class="btn btn-danger">
                                        <i class="bi bi-trash"></i> Archive
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                                <?php } ?>
    </table>
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
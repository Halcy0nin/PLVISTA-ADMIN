<?php
include "../Coordinator View/Processes/db_conn_high_school.php";
include "Processes/show_user_details.php";

// Check if school_id is present in the URL parameters
if (isset($_GET["school_id"])) {
    $schoolidtomatch = $_GET["school_id"];
}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
                            <a href="school_inventory_content.php?school_id=<?php echo $schoolidtomatch; ?>">
                            <i class="bi bi-archive-fill"></i>School Inventory</a>
                        </li>
                        <li class="item">
                            <a href="resource_allocation_content.php?school_id=<?php echo $schoolidtomatch; ?>">
                            <i class="bi bi-journal-bookmark-fill"></i>Report</a>
                        </li>
                        <li class="item">
                            <a href="profile_content.php?school_id=<?php echo $schoolidtomatch; ?>">
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
                        <form action="Processes/edit_profile.php" method="POST" id="profileForm">
                            <?php foreach ($details as $user) { ?>
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" name="newusername" id="fullName" value="<?php echo $user["user_name"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input type="password" class="form-control" name="newpassword" id="pass" value="<?php echo $user["user_pass"]; ?>">
                                </div>
                                <div class="form-group ">
                                    <label for="contact">Contact No.</label>
                                    <input type="text" class="form-control" name="newcontact" id="contact" value="<?php echo $user["user_contact"]; ?>">
                                </div>
                                <!-- Hidden input field to store the original username -->
                                <input type="hidden" name="originalusername" value="<?php echo $user["user_name"]; ?>">
                                <div class="row mt-5">
                                    <div class="col">
                                        <!-- Hidden input fields for request details -->
                                        <input type="hidden" name="requestdate" value="<?php date_default_timezone_set("Asia/Manila"); echo date("Y-m-d H:i:s"); ?>">
                                        <input type="hidden" name="requeststatus" value="Pending">
                                        <input type="hidden" name="user_to_update" value="<?php echo $user["user_id"]; ?>">
                                        <input type="hidden" name="schoolid" value="<?php echo $user["school_id"]; ?>">
                                        <!-- Save Changes button -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editprofile">Save Changes</button>

                                         <!-- modal before publishing changes -->
                                         <div class="modal fade" id="editprofile" tabindex="-1" aria-labelledby="editprofilelabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editprofilelabel">Edit Custodian Information</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to request these changes?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="requestedit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

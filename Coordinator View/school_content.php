<?php
include "Processes/db_conn_high_school.php";
include "Processes/school_info.php";
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
  <link href="../Coordinator View/assets/css/school_content.css" rel="stylesheet">
  <link href="../Coordinator View/assets/css/modal.css" rel="stylesheet">
     <!-- icon sa tab -->
     <link rel="icon" type="images/x-icon" href="sdo.png"/>

  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <!-- icon sa tab -->
  <link rel="icon" type="images/x-icon" href="sdo.png"/>

  <!--Importing jquery-->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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

    <div class = "content-container">
        <h3 class = "mx-3">Registered Schools</h3>
        <br>
            <div class = "col">
            <!-- search bar -->
            <div class = "container d-flex">
                <div style = "width:260px; margin-left: -10vw;" class="input-group rounded">
                    <input  type="text" id = "searchschool" name = "searchschool" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
            

            <!-- dropdown filter -->
            <div>
            <div class="container d-flex">
    <div class="dropdown">
        <button style="margin-left: 10%;" class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Filter
        </button>
        <ul class="dropdown-menu rounded" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#" data-value="all">Show All</a></li>
            <li><a class="dropdown-item" href="#" data-value="publicschools">Public Schools</a></li>
            <li><a class="dropdown-item" href="#" data-value="privateschools">Private Schools</a></li>
            <li><a class="dropdown-item" href="#" data-value="congressionalI">Congressional I</a></li>
            <li><a class="dropdown-item" href="#" data-value="congressionalII">Congressional II</a></li>
        </ul>
    </div>
</div>

            </div>
        
        <!-- add school and export button -->
        <div class = "col">
            <div class = "container d-flex justify-content-end">

<!-- Button for add schools -->
<button style = "margin-right: 1vw; margin-bottom: 0px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSchool">
        Add School
        </button><br>

        <!-- Pop-up form for adding schools -->
        <div class="modal fade" id="addSchool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSchoolLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addSchoolLabel">Add School</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action = "../Coordinator View/Processes/add_school.php" method ="POST">
            <div class="modal-body">
                
                    <div class="form-group mb-3">
                        <input type = "text" name ="schoolname" placeholder= "School name" value = ""></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="schoolid" placeholder= "School ID" value = ""></input>
                    </div>
                    <div class="form-group mb-3">
                    <label> Division </label> <br>
                        <select name="schooldivision">
                        <option>DCS-Valenzuela</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                    <label> School Type </label> <br>
                        <select name="schooltype">
                            <option> Public School </option>
                            <option> Private School</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="schoolcontact" placeholder= "School Contact Person" value = ""></input>
                   </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="schoolcontactno" placeholder= "School Contact Number" value = ""></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="schoolemail" placeholder= "School Email" value = ""></input>
                    </div>
                    <div class="form-group mb-3">
                    <label> School District </label> <br>
                        <select name="schooldistrict" value = "">
                            <option>Congressional I</option>
                            <option>Congressional II</option>
                        </select>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name = "add_school" class="btn btn-primary">Add School</button>
            </form>
            </div>
            </div>
        </div>
        </div>
            <!-- export data button -->
        <button style = "margin-right: -2vw; margin-bottom: 0px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportSchool">
            Export
        </button>

        <!-- modal before exporting data -->
        <div class="modal fade" id="exportSchool" tabindex="-1" aria-labelledby="exportSchoolLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exportSchoolLabel">Export Resource Allocation Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to export this data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <form action = "Processes/export_schools_excel.php" method = "POST">
                        <button type="submit" name = "exportExcel" class="btn btn-primary">Save as spreadsheet</button>
                        </form>
                        <form action = "Processes/export_schools_pdf.php" method = "POST">
                        <button type="submit" name = "exportPDF" class="btn btn-primary">Save as PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

            </div>
        </div>

    </div>
</div>
<div id="schooltable" class="container mt-5">
    <!-- Table showing all school info in the database -->
    <table style="width: 1200px; margin-left: -12vw;" class="table table-striped centerTable">
        <thead class="thead-light">
            <tr class="text-center">
                <th style="width: 10%;" scope="col">School Name</th>
                <th style="width: 12%;" scope="col">School ID</th>
                <th style="width: 10%;" scope="col">Division</th>
                <th style="width: 10%;" scope="col">School Type</th>
                <th style="width: 10%;" scope="col">Contact Person</th>
                <th style="width: 10%;" scope="col">Contact No.</th>
                <th style="width: 10%;" scope="col">Email</th>
                <th style="width: 10%;" scope="col">School District</th>
                <th style="width: 12%;" scope="col">Date Added</th>
                <th style="width: 10%;" scope="col"></th>
                <th style="width: 10%;" scope="col">Action</th>
                <th style="width: 10%;" scope="col"></th> <!-- Adjusted width -->
            </tr>
        </thead>
        <tbody>
            <!-- loops through all of the data in the table and displays it per row -->
            <?php foreach ($highschools as $school) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($school["school_name"]); ?></td>
                    <td><?php echo htmlspecialchars($school["school_id"]); ?></td>
                    <td><?php echo htmlspecialchars($school["school_division"]); ?></td>
                    <td><?php echo htmlspecialchars($school["school_type"]); ?></td>
                    <td><?php echo htmlspecialchars($school["school_contact"]); ?></td>
                    <td><?php echo htmlspecialchars($school["school_contact_no"]); ?></td>
                    <td><?php echo htmlspecialchars($school["school_email"]); ?></td>
                    <td><?php echo htmlspecialchars($school["school_district"]); ?></td>
                    <td><?php echo htmlspecialchars($school["school_added"]); ?></td>
            <!-- button to edit school record -->
            <td><button style="margin-left:auto;"class="edit-button" data-bs-toggle="modal" data-bs-target="#updateschool<?php echo $school["school_id"]; ?>">
                <svg class="edit-svgIcon" viewBox="0 0 512 512">
                    <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                </svg>
            </button></td>

                <!-- Pop-up form for updating schools -->
                <div class="modal fade" id="updateschool<?php echo $school["school_id"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateschoolLabel" aria-hidden="true">

                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="updateschoolLabel">Edit School</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action = "Processes/edit_school.php" method ="POST">
                            <div class="modal-body">
                                <!-- set the following values to the last selected value in the dropdown list -->
                                <?php
                                $lastdivision = $school["school_division"];
                                $lasttype = $school["school_type"];
                                $lastdistrict = $school["school_district"];
                                ?>

                                    <div class="form-group mb-3">
                                        <input type = "text" name ="schoolname" placeholder= "School name" value = "<?php echo $school[
                                            "school_name"
                                        ]; ?>"></input>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type = "text" name ="schoolid" placeholder= "School ID" value = "<?php echo $school[
                                            "school_id"
                                        ]; ?>"></input>
                                    </div>
                                    <div class="form-group mb-3">
                                    <label> Division </label> <br>
                                        <select name="schooldivision">
                                        <option value="DCS-Valenzuela" <?php if (
                                            $lastdivision === "DCS-Valenzuela"
                                        ) {
                                            echo "selected";
                                        } ?>>DCS-Valenzuela</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                    <label> School Type </label> <br>
                                        <select name="schooltype">
                                            <option value="Public School" <?php if (
                                                $lasttype === "Public School"
                                            ) {
                                                echo "selected";
                                            } ?>> Public School </option>
                                            <option value="Private School" <?php if (
                                                $lasttype === "Private School"
                                            ) {
                                                echo "selected";
                                            } ?>> Private School</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type = "text" name ="schoolcontact" placeholder= "School Contact Person" value = "<?php echo $school[
                                            "school_contact"
                                        ]; ?>"></input>
                                `   </div>
                                    <div class="form-group mb-3">
                                        <input type = "text" name ="schoolcontactno" placeholder= "School Contact Number" value = "<?php echo $school[
                                            "school_contact_no"
                                        ]; ?>"></input>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type = "text" name ="schoolemail" placeholder= "School Email" value = "<?php echo $school[
                                            "school_email"
                                        ]; ?>"></input>
                                    </div>
                                    <div class="form-group mb-3">
                                    <label> School District </label> <br>
                                        <select name="schooldistrict">
                                            <option value="Congressional I" <?php if (
                                                $lastdistrict ===
                                                "Congressional I"
                                            ) {
                                                echo "selected";
                                            } ?>>Congressional I</option>
                                            <option value="Congressional II" <?php if (
                                                $lastdistrict ===
                                                "Congressional II"
                                            ) {
                                                echo "selected";
                                            } ?>>Congressional II</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- shows the current id of the row of data through an input field -->
                                <input type = "hidden" name = "id_to_update" value = "<?php echo $school["school_id"]; ?>">
                                <button type="submit" name = "updateschool" class="btn btn-primary">Edit School</button>
                            </form>
                            </div>
                            </div>
                        </div>
                        </div>

             <!-- button to delete school record -->
            <td><button style="margin-left:auto;" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteschool<?php echo $school["school_id"]; ?>">
            <svg class="delete-svgIcon" viewBox="0 0 448 512">
                    <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                  </svg>
            </button></td>

            <div class="modal fade" id="deleteschool<?php echo $school["school_id"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteschoolLabel" aria-hidden="true">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteschoolLabel">Delete School</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action = "Processes/delete_school.php" method ="POST">
                                        <div class="modal-body">
                                        <h4>Are you sure you want to delete <?php echo "<h4>" .
                                            $school["school_name"] .
                                            "? </h4>"; ?></h4>
                                        <p>This action cannot be undone</p>
                                        
                                                <!-- shows the current id of the row of data through an input field -->
                                                <input type = "hidden" name = "id_to_delete" value = "<?php echo $school[
                                                    "school_id"
                                                ]; ?>">
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <!-- submits id of current row to POST array and sends it to delete_school.php -->
                                                <input type = "submit" name = "deleteschool" value = "Delete School" class = "btn btn-primary">
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
            <td><form action='school_inventory.php' method='GET'>
                                <input type='hidden' name='inventoryid' value= "<?php echo $school[
                                    "school_id"
                                ]; ?>">
                                <input type='hidden' name='inventoryname' value= "<?php echo $school[
                                    "school_name"
                                ]; ?>">
                                <button style="margin-right:1vw;" type='submit' class="view-button">
                                <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"> <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" fill="white"></path> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" fill="white"></path> </svg>
                                </button>
                            </form></td>
        </tr>

    <?php } ?>
    </table>
    <div style="position: fixed; bottom: 7vh; right: 10vw;" class="container d-flex justify-content-end">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="school_content.php?page=<?php echo max($current_page - 1, 1); ?>">Previous</a>
                </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item">
                    <a class="page-link" href="school_content.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="school_content.php?page=<?php echo min($current_page + 1, $totalPages); ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>


<!-- Jquery script for detecting input in searchbar and displaying results on it -->
<script type="text/javascript"> 
$(document).ready(function() {
    var defaultTableContent = $("#schooltable").html();

    var debounceFunction = function(func, delay) {
        var timeout;
        return function() {
            var context = this;
            var args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                func.apply(context, args);
            }, delay);
        };
    };

    var updateTableVisibility = debounceFunction(function() {
        var searchschool = $("#searchschool").val().toLowerCase(); // Convert to lowercase for case-insensitive search
        $("#schooltable tr").each(function(index) {
            if (index === 0) {
                $(this).show(); // Show the header row
            } else {
                var rowText = $(this).text().toLowerCase(); // Convert row text to lowercase
                if (rowText.includes(searchschool)) {
                    $(this).show(); // Show the row if it contains the search string
                } else {
                    $(this).hide(); // Hide the row if it doesn't contain the search string
                }
            }
        });
    }, 300); // Reduced delay to 300ms

    // Attach keyup event listener directly to the search input
    $("#searchschool").on("keyup", updateTableVisibility);
});

        </script>

<script>
    $(document).ready(function() {
        // Function to handle dropdown item selection
        $(".dropdown-item").on("click", function() {
            var selectedValue = $(this).data("value"); // Get the value from data-value attribute
            // Hide the table while loading
            $("#schooltable").hide();
            // Send AJAX request
            $.ajax({
                url: "Processes/filter_school.php", // Path to your PHP file
                method: "POST",
                data: { filterValue: selectedValue }, // Data to send
                success: function(response) {
                    // Handle success response
                    $("#schooltable").html(response); // Update table with filtered data
                    $("#schooltable").show(); // Show the table again
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

    <!-- JS FILES -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.min.js"></script>


        
</body>


</html>
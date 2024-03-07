<?php
include "db_conn_high_school.php";
include "school_info.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title></title>
    <!-- bootstrap css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="modal.css">

    <style>

        select{
            width:200px;
        }

    </style>
</head>

<body>
  <!-- Bootstrap JS CDN for mobile responsiveness -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <div class = "content-container">
        <h3 class = "mx-3">Registered Schools</h3>
        <br>

        <div class = "row">
            <div class = "col">
            <!-- search bar -->
            <div class = "container d-flex">
                <div style = "width:260px;" class="input-group rounded">
                    <input  type="text" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
            <div>

            <!-- dropdown filter -->
            <div class = "container d-flex">
                <div class="dropdown">

                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filter
                    </button>

                    <div class="dropdown-menu rounded" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            </div>
        
        <!-- add school and export button -->
        <div class = "col">
            <div class = "container d-flex justify-content-end">

            <!-- add school button -->
            <button type="button" class="btn btn-primary rounded mx-2" data-toggle="modal" data-target="#addSchool">Add School</button>


            <!-- modal before exporting data -->
            <div class="modal fade" id="addSchool" tabindex="-1" role="dialog" aria-labelledby="addSchoolLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSchoolLabel">Add School</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action = "add_school_process.php" method ="POST">
                <div class="modal-body">

                    <div class = "container">
                    <h5 class = "fw-bold mb-3">School Information</h5>
                        <div class = "row">

                            <div class = "col">
                                <div class="form-group mb-3">
                                        <input type = "text" name ="schoolname" placeholder= "School name" value = ""></input>
                                </div>

                                <div class="form-group mb-3">
                                    <input type = "text" name ="schoolid" placeholder= "School ID" value = ""></input>
                                </div>

                                <div class="form-group mb-3">
                                    <input type = "text" name ="schoolcontact" placeholder= "School Contact Person" value = ""></input>
                                </div>

                                <div class="form-group mb-3">
                                    <input type = "text" name ="schoolcontactno" placeholder= "School Contact Number" value = ""></input>
                                </div>

                                <div class="form-group">
                                    <input type = "text" name ="schoolemail" placeholder= "School Email" value = ""></input>
                                </div>
                            </div>

                            <div class = "col">
                                <div class="form-group mb-3">
                                        <select name="schooldistrict" value = "">
                                            <option value="" disabled selected>Select School District</option>
                                            <option>Congressional I</option>
                                            <option>Congressional II</option>
                                        </select>
                                </div>

                                <div class="form-group mb-3">
                                    <select name="schooldivision">
                                    <option value="" disabled selected>Select School Division</option>
                                    <option>DCS-Valenzuela</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select name="schooltype">
                                        <option value="" disabled selected>Select School Type</option>
                                        <option> Public School </option>
                                        <option> Private School</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
            </div>
            </div>


                <!--export data button -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exportSchools">
            Export
            </button>

            <!-- modal before exporting data -->
            <div class="modal fade" id="exportSchools" tabindex="-1" role="dialog" aria-labelledby="exportSchoolsLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportSchoolsLabel">Export Registered Schools Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to export this data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary">Yes</button>
                </div>
                </div>
            </div>
            </div>

            </div>
        </div>

    </div>

    <div class = "container mt-5">
        <!-- Table showing all school info in the database -->
        <table style="margin-left: auto; margin-right: auto;" class = "table table-striped centerTable">
            <thead class="thead-light"></thead>
                <tr class = "text-center">
                    <th scope="col">ID</th>
                    <th scope="col">School Name</th>
                    <th scope="col">School ID</th>
                    <th scope="col">Division</th>
                    <th scope="col">School Type</th>
                    <th scope="col">Contact Person</th>
                    <th scope="col">Contact No.</th>
                    <th scope="col">Email</th>
                    <th scope="col">School District</th>
                    <th scope="col">Date Added</th>
                    <th style = "width:13%;" scope="col">Action</th>
                </tr>

                <!-- loops through all of the data in the table and displays it per row -->
                <?php foreach ($highschools as $school) { ?>
                <tr>
                    <td scope="row"><?php echo htmlspecialchars(
                        $school["id"]
                    ); ?></td>
                    <td><?php echo htmlspecialchars(
                        $school["school_name"]
                    ); ?></td>
                    <td><?php echo htmlspecialchars(
                        $school["school_id"]
                    ); ?></td>
                    <td><?php echo htmlspecialchars(
                        $school["school_division"]
                    ); ?></td>
                    <td><?php echo htmlspecialchars(
                        $school["school_type"]
                    ); ?></td>
                    <td><?php echo htmlspecialchars(
                        $school["school_contact"]
                    ); ?></td>
                    <td><?php echo htmlspecialchars(
                        $school["school_contact_no"]
                    ); ?></td>
                    <td><?php echo htmlspecialchars(
                        $school["school_email"]
                    ); ?></td>
                    <td><?php echo htmlspecialchars(
                        $school["school_district"]
                    ); ?></td>
                    <td><?php echo htmlspecialchars(
                        $school["school_added"]
                    ); ?></td>

             <!-- button to edit school record -->
             <td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#updateschool<?php echo $school[
                 "id"
             ]; ?>">
            Edit School
            </button></td>

                <!-- Pop-up form for updating schools -->
                <div class="modal fade" id="updateschool<?php echo $school[
                    "id"
                ]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateschoolLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="updateschoolLabel">Edit School</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action = "edit_school.php" method ="POST">
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
                                <input type = "hidden" name = "id_to_update" value = "<?php echo $school[
                                    "id"
                                ]; ?>">
                                <button type="submit" name = "updateschool" class="btn btn-primary">Edit School</button>
                            </form>
                            </div>
                            </div>
                        </div>
                        </div>

             <!-- button to delete school record -->
            <td>
            <!-- creates a unique id for each modal as to not create loops -->
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteschool<?php echo $school[
                "id"
            ]; ?>">
            Delete School
            </button>
            </td>   
            <div class="modal fade" id="deleteschool<?php echo $school[
                "id"
            ]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteschoolLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteschoolLabel">Delete School</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action = "delete_school.php" method ="POST">
                                        <div class="modal-body">
                                        <h4>Are you sure you want to delete <?php echo "<h4>" .
                                            $school["school_name"] .
                                            "? </h4>"; ?></h4>
                                        <p>This action cannot be undone</p>
                                        
                                                <!-- shows the current id of the row of data through an input field -->
                                                <input type = "hidden" name = "id_to_delete" value = "<?php echo $school[
                                                    "id"
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
                                <button type='submit' class="btn btn-primary btn-sm">View Inventory</button>
                            </form></td>
        </tr>
        <?php } ?>
        </table>

            <div class = "container d-flex justify-content-end">

                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="dashboard.php?username=admin&password=admin&page=<?php echo max($current_page - 1, 1); ?>">Previous</a>
                        </li>

                        <?php for ($i = 1;$i <= $totalPages;$i++): ?>
                            <li class="page-item">
                                <a class="page-link" href="dashboard.php?username=admin&password=admin&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php
                endfor; ?>

                        <li class="page-item">
                            <a class="page-link" href="dashboard.php?username=admin&password=admin&page=<?php echo min($current_page + 1, $totalPages); ?>">Next</a>
                        </li>
                    </ul>
             </nav>

            </div>
</body>


</html>
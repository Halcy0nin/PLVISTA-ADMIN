<?php
include "db_conn_high_school.php";


if (!isset($_GET["page"]))
{
    $_GET["page"] = 1;
}
    // Set the number of items per page and the current page number
    $itemsPerPage = 5;
    $current_page = $_GET["page"];

    // Calculate the offset based on the current page number
    $offset = max(0, ($current_page - 1) * $itemsPerPage);

// Check if filter value is set
if (isset($_POST["filterValue"])) {
    $filter = $_POST["filterValue"];

    // Construct the query based on the selected filter
    switch ($filter) {
        case "publicschools":
            $filterQuery = "SELECT * FROM high_schools WHERE school_type = 'Public School' LIMIT $offset, $itemsPerPage";
            break;
        case "privateschools":
            $filterQuery = "SELECT * FROM high_schools WHERE school_type = 'Private School' LIMIT $offset, $itemsPerPage";
            break;
        case "congressionalI":
            $filterQuery = "SELECT * FROM high_schools WHERE school_district = 'Congressional I' LIMIT $offset, $itemsPerPage";
            break;
        case "congressionalII":
            $filterQuery = "SELECT * FROM high_schools WHERE school_district = 'Congressional II' LIMIT $offset, $itemsPerPage";
            break;
        case "all":
            $filterQuery = "SELECT * FROM high_schools LIMIT $offset, $itemsPerPage";
            break;
        default:
            // Default case if no specific filter is selected
            $filterQuery = "SELECT * FROM high_schools LIMIT $offset, $itemsPerPage";
            break;
    }

    $totalRowsQuery = "SELECT COUNT(school_name) as total_count
        FROM high_schools";

    $totalRowsResult = mysqli_query($conn, $totalRowsQuery);

    // Fetch the result as an associative array
    $totalRowsArray = mysqli_fetch_assoc($totalRowsResult);

    // Access the value of total_count and store it in a variable
    $totalCount = (int)$totalRowsArray["total_count"];

    // Calculate the total number of pages
    $totalPages = ceil($totalCount / $itemsPerPage);


    // Execute the query
    $result = mysqli_query($conn, $filterQuery);
    $rowCount = mysqli_num_rows($result);
    $filteredData = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!--Importing bootstrap styles and icons-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
    <!--Importing jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

            <!-- Table showing all school info in the database -->
        <table style="width: 1000px; margin-left: auto; margin-right: auto;" class="table table-striped centerTable">
    <thead class="thead-light"></thead>
        <tr class="text-center">
            <th style="margin: right 50px;" scope="col">School Name</th>
            <th style="width: 10%;" scope="col">School ID</th>
            <th style="width: 10%;" scope="col">Division</th>
            <th style="width: 10%;" scope="col">School Type</th>
            <th style="width: 10%;" scope="col">Contact Person</th>
            <th style="width: 10%;" scope="col">Contact No.</th>
            <th style="width: 10%;" scope="col">Email</th>
            <th style="width: 10%;" scope="col">School District</th>
            <th style="width: 10%;" scope="col">Date Added</th>
            <th style="width: 10%;" scope="col"></th>
            <th style="width: 10%;" scope="col">Action</th>
            <th style="width: 10%;" scope="col"></th> <!-- Adjusted width -->
        </tr>

                <!-- loops through all of the data in the table and displays it per row -->

                <td scope="row"></td>
                <?php foreach ($filteredData as $school) { ?>
        <tr>
            <td><?php echo htmlspecialchars($school["school_name"]); ?></td>
            <td><?php echo htmlspecialchars($school["school_id"]); ?></td>
            <td><?php echo htmlspecialchars($school["school_division"]); ?></td>
            <td><?php echo htmlspecialchars($school["school_type"]); ?></td>
            <td><?php echo htmlspecialchars($school["school_contact"]); ?></td>
            <td><?php echo htmlspecialchars(
                $school["school_contact_no"]
            ); ?></td>
            <td><?php echo htmlspecialchars($school["school_email"]); ?></td>
            <td><?php echo htmlspecialchars($school["school_district"]); ?></td>
            <td><?php echo htmlspecialchars($school["school_added"]); ?></td>

            <!-- button to edit school record -->
            <td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#updateschool<?php echo $school["school_id"]; ?>">

            Edit School
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
            <td>
            <!-- creates a unique id for each modal as to not create loops -->
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteschool<?php echo $school["school_id"]; ?>">

            Delete School
            </button>
            </td>   
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
            <td><<form action='school_inventory.php' method='GET'>
                                <input type='hidden' name='inventoryid' value= "<?php echo $school[
                                    "school_id"
                                ]; ?>">
                                <input type='hidden' name='inventoryname' value= "<?php echo $school[
                                    "school_name"
                                ]; ?>">
                                <button type='submit' class="btn btn-primary btn-sm">View Inventory</button>
                            </form></td>
        </tr>



        <?php
            }
        }
        else {
            echo "<h3>No results found</h3>";
        }
?>


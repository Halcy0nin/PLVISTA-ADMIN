<?php
include "db_conn_high_school.php";
//once searchsubmit button is pressed the following code executes
if (isset($_POST["searchschool"]))
        $search = $_POST["searchschool"];

        //query for searching
        $searchquery = "SELECT *
    FROM high_schools 
    WHERE school_name LIKE '%$search%' OR school_id LIKE '%$search%'
    ";

        $result = mysqli_query($conn, $searchquery);
        $searchcount = mysqli_num_rows($result);
        $searchcontent = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if ($searchcount > 0) {
            ?>

            <!--Importing bootstrap styles and icons-->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

            <!--Importing jquery-->
            <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

            <!--Importing bootstrap JS-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
            <!-- Table showing all inventory info per school in the database -->
            <table style="width:90%; margin-left: auto; margin-right: auto;" class="table table-striped centerTable">
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
                <!-- Loop through search results -->
                <?php foreach ($searchcontent as $school) {
                    ?>

                    <!-- Display inventory info in tabular form -->
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

                <?php } ?>
            </table>

            <?php
            // Modal for updating item and deleting item
            foreach ($searchcontent as $school) {
                ?>
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

            <?php
            }
        }
        else {
            echo "<h3>No results found</h3>";
        }
?>
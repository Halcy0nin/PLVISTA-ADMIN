<?php
include "Processes/db_conn_high_school.php";
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

            $selectinventoryinfo = "SELECT *
        FROM high_schools WHERE school_id LIKE '%$search%' OR
    school_name LIKE '%$search%'";

            $totalRowsQuery = "SELECT COUNT(school_id) as total_count
        FROM high_schools WHERE school_id LIKE '%$search%' OR
    school_name LIKE '%$search%'";

    $schoolname = $schoolid = $schoolcontact = $schoolcontactno = $schoolemail = $schooldivision =
    "";
            ?>

  <!--Importing bootstrap styles and icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
    <!--Importing jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
            <!-- Table showing all school info in the database -->
            <div id="schooltable" class="container mt-5">
    <table style="width: 1200px; margin-left:-3.7vw; margin-top:1vw" class="table table-striped centerTable">
        <thead class="thead-light"></thead>
            <tr class="text-center">
                <th style="width: 10%;" scope="col">School Name</th>
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

            <?php foreach ($filteredData as $school) { ?>
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

                    <td>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#updateschool<?php echo $school["school_id"]; ?>">
                            Edit School
                        </button>
                    </td>

                    <div class="modal fade" id="updateschool<?php echo $school["school_id"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateschoolLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="updateschoolLabel">Edit School</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="Processes/edit_school.php" method="POST">
                                    <div class="modal-body">
                                        <?php
                                        $lastdivision = $school["school_division"];
                                        $lasttype = $school["school_type"];
                                        $lastdistrict = $school["school_district"];
                                        ?>
                                        <div class="form-group mb-3">
                                            <input type="text" name="schoolname" placeholder="School name" value="<?php echo $school["school_name"]; ?>">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="text" name="schoolid" placeholder="School ID" value="<?php echo $school["school_id"]; ?>">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label> Division </label> <br>
                                            <select name="schooldivision">
                                                <option value="DCS-Valenzuela" <?php if ($lastdivision === "DCS-Valenzuela") echo "selected"; ?>>DCS-Valenzuela</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label> School Type </label> <br>
                                            <select name="schooltype">
                                                <option value="Public School" <?php if ($lasttype === "Public School") echo "selected"; ?>>Public School</option>
                                                <option value="Private School" <?php if ($lasttype === "Private School") echo "selected"; ?>>Private School</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="text" name="schoolcontact" placeholder="School Contact Person" value="<?php echo $school["school_contact"]; ?>">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="text" name="schoolcontactno" placeholder="School Contact Number" value="<?php echo $school["school_contact_no"]; ?>">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="text" name="schoolemail" placeholder="School Email" value="<?php echo $school["school_email"]; ?>">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label> School District </label> <br>
                                            <select name="schooldistrict">
                                                <option value="Congressional I" <?php if ($lastdistrict === "Congressional I") echo "selected"; ?>>Congressional I</option>
                                                <option value="Congressional II" <?php if ($lastdistrict === "Congressional II") echo "selected"; ?>>Congressional II</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="hidden" name="id_to_update" value="<?php echo $school["school_id"]; ?>">
                                        <button type="submit" name="updateschool" class="btn btn-primary">Edit School</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <td>
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
                                <form action="Processes/delete_school.php" method="POST">
                                    <div class="modal-body">
                                        <h4>Are you sure you want to delete <?php echo "<h4>" . $school["school_name"] . "? </h4>"; ?></h4>
                                        <p>This action cannot be undone</p>
                                        <input type="hidden" name="id_to_delete" value="<?php echo $school["school_id"]; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" name="deleteschool" value="Delete School" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <td>
                        <form action='school_inventory.php' method='GET'>
                            <input type='hidden' name='inventoryid' value="<?php echo $school["school_id"]; ?>">
                            <input type='hidden' name='inventoryname' value="<?php echo $school["school_name"]; ?>">
                            <button type='submit' class="btn btn-primary btn-sm">View Inventory</button>
                        </form>
                    </td>
                </tr>
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
            <?php
                }
            } else {
                echo "<h3>No results found</h3>";
            }
            ?>
    </table>
</div>
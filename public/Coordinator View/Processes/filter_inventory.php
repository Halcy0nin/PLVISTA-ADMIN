<?php
include "db_conn_high_school.php";

// Check if filter value is set
if (isset($_POST["filterValue"])) {
    $filter = $_POST["filterValue"];
    $schoolidtomatch = $_POST["schoolidtomatch"];

    // Construct the query based on the selected filter
    switch ($filter) {
        case "working":
            $filterQuery = "SELECT *
            FROM school_inventory 
            JOIN high_schools ON school_inventory.school_id = high_schools.school_id
            WHERE high_schools.school_id = $schoolidtomatch AND item_status = 'Working'";
            break;
        case "needrepair":
            $filterQuery = "SELECT *
            FROM school_inventory 
            JOIN high_schools ON school_inventory.school_id = high_schools.school_id
            WHERE high_schools.school_id = $schoolidtomatch AND item_status = 'Need Repair'";
            break;
        case "condemned":
            $filterQuery = "SELECT *
            FROM school_inventory 
            JOIN high_schools ON school_inventory.school_id = high_schools.school_id
            WHERE high_schools.school_id = $schoolidtomatch AND item_status = 'Condemned'";
            break;
        case "all":
            $filterQuery = "SELECT *
            FROM school_inventory 
            JOIN high_schools ON school_inventory.school_id = high_schools.school_id
            WHERE high_schools.school_id = $schoolidtomatch";
            break;
        default:
            // Default case if no specific filter is selected
            $filterQuery = "SELECT *
            FROM school_inventory 
            JOIN high_schools ON school_inventory.school_id = high_schools.school_id
            WHERE high_schools.school_id = $schoolidtomatch";
            break;
    }

    // Execute the query
    $result = mysqli_query($conn, $filterQuery);
    $rowCount = mysqli_num_rows($result);
    $filteredData = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Calculate total pages
    $totalRecords = count($filteredData); // Assuming $filteredData contains the filtered records
    $recordsPerPage = 10; // Change this value according to your requirement
    $totalPages = ceil($totalRecords / $recordsPerPage);
}
?>

<!--Importing bootstrap styles and icons-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
    <!--Importing jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <div id = "tablecontent">
             <!-- Table showing all inventory info per school in the database -->
        <table style="width:90%; margin-left: auto; margin-right: auto; margin-top:auto;" class = "table table-striped centerTable">
        <thead class="thead-light">
            <tr>
                <th scope="col">Item Code</th>
                <th scope="col">Item Article</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Source of Funds</th>
                <th scope="col">Date Acquired</th>
                <th scope="col">Unit Value</th>
                <th scope="col">Quantity</th>
                <th scope="col">Active Items</th>
                <th scope="col">Inactive Items</th>
                <th scope="col">Total Value</th>
                <th scope="col">Last Updated</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <!--get array of inventory from inventoryid from schools page-->
        <?php if (is_array($filteredData))
    {
        foreach ($filteredData as $item)
        {

            //multiplies quantity to unit value to get total value
            $qty = $item["item_quantity"] * $item["item_unit_value"];
            //formats the answer above to a decimal
            $itemtotalvalue = number_format($qty, 2);
            
            $timestamp = strtotime($item["item_date_input"]);

            // Format date in mm-dd-yyyy format
            $date_formatted = date("m-d-Y", $timestamp);
            
            // Format time in 12-hour format
            $time_formatted = date("g:i a", $timestamp);
            
            // Combine date and time
            $itemdateadded = $date_formatted . ' ' . $time_formatted;
?>


        <!--display inventory info in tabular form-->
        <tr>
    <td><?php echo "SDOVAL-" , htmlspecialchars($item["item_code"]); ?></td>
    <td><?php echo htmlspecialchars($item["item_article"]); ?></td>
    <td><?php echo htmlspecialchars($item["item_desc"]); ?></td>
    <td><?php echo htmlspecialchars($item["item_status"]); ?></td>
    <td><?php echo htmlspecialchars($item["item_funds_source"]); ?></td>
    <td><?php echo date("m/d/Y", strtotime(htmlspecialchars($item["item_date_acquired"])));?></td>
    <td><?php echo "PHP " . htmlspecialchars($item["item_unit_value"]); ?></td>
    <td><?php echo htmlspecialchars($item["item_quantity"]); ?></td>
    <td><?php echo htmlspecialchars($item["item_active"]); ?></td>
    <td><?php echo htmlspecialchars($item["item_inactive"]); ?></td>
    <td><?php echo "PHP " . htmlspecialchars($itemtotalvalue); ?></td>
    <td><?php echo htmlspecialchars($itemdateadded); ?></td>
    
    <td> 
        <button type="button" id="editbutton<?php echo $item["item_code"]; ?>" class="edit-button" data-bs-toggle="modal" data-bs-target="#updateitem<?php echo $item["item_code"]; ?>">
        <svg class="edit-svgIcon" viewBox="0 0 512 512">
                    <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                </svg>
        </button>
    </td>
    <td>
        <button type="button" id="deletebutton<?php echo $item["item_code"]; ?>" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteitem<?php echo htmlspecialchars($item["item_code"]); ?>">
        <svg class="delete-svgIcon" viewBox="0 0 448 512">
                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
            </svg>
        </button>

    </td>
</tr>


                <!-- Pop-up form for updating item -->
                <!--get item no as reference to match in order to assign the respective item no to the item to be updated-->
                <div class="modal fade" id="updateitem<?php echo $item["item_code"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateitemLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="updateitemLabel">Edit Item</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action = "Processes/edit_item.php" method ="POST">
                            <div class="modal-body">
                    <!-- store last value stored in dropdown list -->
                        <?php $laststatus = $item["item_status"]; ?>

                    <div class="form-group mb-3">
                        <input type = "text" name ="itemarticle" placeholder= "Article" value = "<?php echo $item["item_article"]; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemdesc" placeholder= "Description" value = "<?php echo $item["item_desc"]; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "date" name ="itemdateacquired" placeholder= "Date Acquired (YYYY-MM-DD)" value = "<?php echo $item["item_date_acquired"]; ?>"></input>
                  </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemunitvalue" placeholder= "Unit Value" value = "<?php echo $item["item_unit_value"]; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemquantity" placeholder= "Quantity" value = "<?php echo $item["item_quantity"]; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="itemactive" placeholder="Active Items" value="<?php echo $item["item_active"]; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="iteminactive" placeholder="Inactive Items" value="<?php echo $item["item_inactive"]; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemfundssource" placeholder= "Funds Source" value = "<?php echo $item["item_funds_source"]; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <select name="itemstatus">
                            <option value="Working" <?php if ($laststatus === "Working") echo "selected"; ?>>Working</option>
                            <option value="Need Repair" <?php if ($laststatus === "Need Repair") echo "selected"; ?>>Need Repair</option>
                            <option value="Condemned" <?php if ($laststatus === "Condemned") echo "selected"; ?>>Condemned</option>
                        </select>
                    </div>
                </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- shows the current id of the row of data through an input field -->
                                <input type = "hidden" name = "item_to_update" value = "<?php echo $item["item_code"]; ?>">
                                <input type='hidden' name='schoolid' value= "<?php echo $schoolidtomatch; ?>">
                                <input type='hidden' name='invenname' value= "<?php echo $inventoryname; ?>">
                                <input type='hidden' name='itemdateadded' value= "<?php date_default_timezone_set("Asia/Manila"); echo date("Y-m-d H:i:s");?>">
                                <button type="submit" name = "updateitem" class="btn btn-primary">Edit Item</button>
                            </form>
                            </div>
                            </div>
                        </div>
                        </div>
                <!-- Modal for Delete Item -->
                <div class="modal fade" id="deleteitem<?php echo htmlspecialchars($item["item_code"]); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteschoolLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteschoolLabel">Delete Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action = "Processes/delete_item.php" method ="POST">
                                        <div class="modal-body">
                                        <h4>Are you sure you want to delete this row?</h4>
                                        <p>This action cannot be undone</p>
                                        
                                                <!-- shows the current id of the row of data through an input field -->
                                                <input type = "hidden" name = "item_to_delete" value = "<?php echo htmlspecialchars($item["item_code"]); ?>">
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <!-- submits id of current row to POST array and sends it to delete_item.php -->
                                                <input type='hidden' name='schoolid' value= "<?php echo $schoolidtomatch; ?>">
                                                <input type='hidden' name='invenname' value= "<?php echo $inventoryname; ?>">
                                                <input type = "submit" name = "deleteitem" value = "Delete Item" class = "btn btn-primary">
                                                
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div style="position: fixed; bottom: 20px; right: 4vw;" class="container d-flex justify-content-end">
                <nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="school_inventory.php?inventoryid=<?php echo $schoolidtomatch; ?>&inventoryname=<?php echo urlencode($inventoryname); ?>&page=<?php echo max($current_page - 1, 1); ?>">Previous</a>
        </li>

        <?php for ($i = 1;$i <= $totalPages;$i++): ?>
            <li class="page-item">
                <a class="page-link" href="school_inventory.php?inventoryid=<?php echo $schoolidtomatch; ?>&inventoryname=<?php echo urlencode($inventoryname); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php
endfor; ?>

        <li class="page-item">
            <a class="page-link" href="school_inventory.php?inventoryid=<?php echo $schoolidtomatch; ?>&inventoryname=<?php echo urlencode($inventoryname); ?>&page=<?php echo min($current_page + 1, $totalPages); ?>">Next</a>
        </li>
    </ul>
</nav>
                </div>

            <?php }
    } else {
        echo "<h3>No results found</h3>";
    }

?>
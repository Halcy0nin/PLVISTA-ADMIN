<?php
include "Processes/db_conn_high_school.php";
//once searchsubmit button is pressed the following code executes
if (isset($_POST["searchitem"])) {
    if (isset($_POST["schoolid"])) {
        $schoolid = $_POST["schoolid"];

        $search = $_POST["searchitem"];

        //query for searching
        $searchquery = "SELECT *
    FROM school_inventory 
    JOIN high_schools ON school_inventory.school_id = high_schools.school_id
    WHERE high_schools.school_id = $schoolid AND (item_code LIKE '%$search%' OR item_article LIKE '%$search%' OR item_desc LIKE '%$search%')
    ";

        $result = mysqli_query($conn, $searchquery);
        $searchcount = mysqli_num_rows($result);
        $searchcontent = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if ($searchcount > 0) {

            $selectinventoryinfo = "SELECT *
        FROM school_inventory WHERE item_code LIKE '%$search%' OR
    item_article LIKE '%$search%' OR item_desc LIKE '%$search%'";

            $totalRowsQuery = "SELECT COUNT(item_code) as total_count
        FROM school_inventory WHERE item_code LIKE '%$search%' OR
    item_article LIKE '%$search%' OR item_desc LIKE '%$search%'";

            //placeholders for variable input
            $itemcode = $schoolid = $itemarticle = $itemdesc = $itemdateacquired = $itemdateadded = $itemunitvalue = $itemquantity = $itemtotalvalue = $itemfundssource = $itemstatus = $searchitem =
                "";
            ?>
             <!--Importing bootstrap styles and icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
    <!--Importing jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    


    <!--Importing bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
            <!-- Table showing all inventory info per school in the database -->
        <table style="width:90%; margin-left: auto; margin-right: auto;" class = "table table-striped centerTable">
        <thead class="thead-light">
            <tr>
                <th scope="col">Item Code</th>
                <th scope="col">Item Article</th>
                <th scope="col">Description</th>
                <th scope="col">Date Acquired</th>
                <th scope="col">Date Added</th>
                <th scope="col">Unit Value</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Value</th>
                <th scope="col">Source of Funds</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <!--get array of inventory from inventoryid from schools page-->
        <?php if (is_array($searchcontent)) {
            foreach ($searchcontent as $item) {

                //multiplies quantity to unit value to get total value
                $qty = $item["item_quantity"] * $item["item_unit_value"];
                //formats the answer above to a decimal
                $itemtotalvalue = number_format($qty, 2);
                ?>
        <!--display inventory info in tabular form-->
        <tr>
            <td><?php echo "SDOVAL-",
                htmlspecialchars($item["item_code"]); ?></td>
            <td><?php echo htmlspecialchars($item["item_article"]); ?></td>
            <td><?php echo htmlspecialchars($item["item_desc"]); ?></td>
            <td><?php echo htmlspecialchars(
                $item["item_date_acquired"]
            ); ?></td>
            <td><?php echo htmlspecialchars($item["item_date_input"]); ?></td>
            <td><?php echo "PHP " .
                htmlspecialchars($item["item_unit_value"]); ?></td>
            <td><?php echo htmlspecialchars($item["item_quantity"]); ?></td>
            <td><?php echo "PHP " . htmlspecialchars($itemtotalvalue); ?></td>
            <td><?php echo htmlspecialchars($item["item_funds_source"]); ?></td>
            <td><?php echo htmlspecialchars($item["item_status"]); ?></td>
            </div>
               <td> 
        <button type="button" id="editbutton<?php echo $item[
            "item_code"
        ]; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#updateitem<?php echo $item[
    "item_code"
]; ?>">
            Edit Item
        </button>
    </td>
    <td>
        <button type="button" id="deletebutton<?php echo $item[
            "item_code"
        ]; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteitem<?php echo htmlspecialchars(
    $item["item_code"]
); ?>">
            Delete Item
        </button>
    </td>
</tr>


                <!-- Pop-up form for updating item -->
                <!--get item no as reference to match in order to assign the respective item no to the item to be updated-->
                <div class="modal fade" id="updateitem<?php echo $item[
                    "item_code"
                ]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateitemLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="updateitemLabel">Edit Item</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action = "edit_item.php" method ="POST">
                            <div class="modal-body">
                    <!-- store last value stored in dropdown list -->
                        <?php $laststatus = $item["item_status"]; ?>

                    <div class="form-group mb-3">
                        <input type = "text" name ="itemarticle" placeholder= "Article" value = "<?php echo $item[
                            "item_article"
                        ]; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemdesc" placeholder= "Description" value = "<?php echo $item[
                            "item_desc"
                        ]; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "date" name ="itemdateacquired" placeholder= "Date Acquired (YYYY-MM-DD)" value = "<?php echo $item[
                            "item_date_acquired"
                        ]; ?>"></input>
                  </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemunitvalue" placeholder= "Unit Value" value = "<?php echo $item[
                            "item_unit_value"
                        ]; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemquantity" placeholder= "Quantity" value = "<?php echo $item[
                            "item_quantity"
                        ]; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemfundssource" placeholder= "Funds Source" value = "<?php echo $item[
                            "item_funds_source"
                        ]; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <select name="itemstatus"  value = "<?php echo $lastitemstatus; ?>">
                            <option> Working </option>
                            <option> Need Repair</option>
                            <option> For Repair</option>
                        </select>
                    </div>
                </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- shows the current id of the row of data through an input field -->
                                <input type = "hidden" name = "item_to_update" value = "<?php echo $item[
                                    "item_code"
                                ]; ?>">
                                <input type='hidden' name='schoolid' value= "<?php echo $schoolidtomatch; ?>">
                                <input type='hidden' name='invenname' value= "<?php echo $inventoryname; ?>">
                                <input type='hidden' name='itemdateadded' value= "<?php
                                date_default_timezone_set("Asia/Manila");
                                echo date("Y-m-d H:i:s");
                                ?>">
                                <button type="submit" name = "updateitem" class="btn btn-primary">Edit Item</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>
                <!-- Modal for Delete Item -->
                <div class="modal fade" id="deleteitem<?php echo htmlspecialchars(
                    $item["item_code"]
                ); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteschoolLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteschoolLabel">Delete Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action = "delete_item.php" method ="POST">
                                        <div class="modal-body">
                                        <h4>Are you sure you want to delete this row?</h4>
                                        <p>This action cannot be undone</p>
                                        
                                                <!-- shows the current id of the row of data through an input field -->
                                                <input type = "hidden" name = "item_to_delete" value = "<?php echo htmlspecialchars(
                                                    $item["item_code"]
                                                ); ?>">
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <!-- submits id of current row to POST array and sends it to delete_item.php -->
                                                <input type='hidden' name='schoolid' value= "<?php echo $schoolidtomatch; ?>">
                                                <input type='hidden' name='invenname' value= "<?php echo $inventoryname; ?>">
                                                <input type = "submit" name = "deleteitem" value = "Delete Item" class = "btn btn-primary">
                                                
                                    </div>
                                    </form>
                                    
                                    </div>
                                </div>
                                </div>

            <?php
            }
        }
        } else {
            echo "<h3>No results found</h3>";
        }
    }
}
?>

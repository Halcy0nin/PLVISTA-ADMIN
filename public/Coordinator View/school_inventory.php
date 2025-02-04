<?php
include "Processes/db_conn_high_school.php";

if (isset($_GET["inventoryid"]))
{

    include "Processes/overall_inventory_initialization.php"
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Schools</title>
    
    <link href="../Coordinator View/assets/css/school_inventory.css" rel="stylesheet">

    <!--Importing bootstrap styles and icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
       <!-- icon sa tab -->
  <link rel="icon" type="images/x-icon" href="sdo.png"/>
    
    <!--Importing jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar"> 
    <div class="menu">
        <div class="main-menu">
        </div>
    </div>
</nav>
    <!--Importing bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!--get school name to show on upper portion-->
        <div>
        <a href="school_content.php" style="width: 10px; color:white; margin-left:97vw;"class="bi bi-arrow-left"></a>
        </div>

        <div>
        <?php if (isset($_GET["inventoryname"]))
    {
        $inventoryname = $_GET["inventoryname"];
        echo '<h1 style="margin-left: 5vw; margin-top: -1vh;color:white;">' . $inventoryname . "'s Inventory</h1>";
    } ?>
    </div>
            
 <!-- export data button -->
 <button style = "margin-left: 90vw; margin-top: 9vh; margin-bottom:-1vh;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportSchool">
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
                        <form action = "Processes/export_inventory_excel.php" method = "POST">
                        <input type='hidden' name='schoolid' value= "<?php echo $schoolidtomatch; ?>">
                        <input type='hidden' name='schoolname' value= "<?php echo $inventoryname; ?>">
                        <button type="submit" name = "exportExcel" class="btn btn-primary">Save as spreadsheet</button>
                        </form>
                        <form action = "Processes/export_inventory_pdf.php" method = "POST">
                        <input type='hidden' name='schoolid' value= "<?php echo $schoolidtomatch; ?>">
                        <input type='hidden' name='schoolname' value= "<?php echo $inventoryname; ?>">
                        <button type="submit" name = "exportPDF" class="btn btn-primary">Save as PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

          <!-- Button for add item -->
          <button style = "margin-left: 77vw; margin-top: -7vh; margin-bottom:0%;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItem">
        Add Item
        </button><br>

         <!--search bar -->
        <div class = "search">
                <div style = "width:260px; margin-left: 5vw; margin-top: -7.3vh" class="input-group rounded">
                    <input  type="text" id = "searchitemfield" name = "searchitem" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="bi bi-search"></i>
                    </span>
                </div>


        <!--dropdown filter -->
        <div>
            <div class="container d-flex">
                <div class="dropdown">
                    <button style="margin-left: 15vw; margin-top: -9.4vh" class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter
                </button>
        <ul class="dropdown-menu rounded" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#" data-value="all">Show All</a></li>
            <li><a class="dropdown-item" href="#" data-value="working">Working</a></li>
            <li><a class="dropdown-item" href="#" data-value="needrepair">Need Repair</a></li>
            <li><a class="dropdown-item" href="#" data-value="condemned">Condemned</a></li>
            <form>
            <input type='hidden' id='schoolidtomatch' value= "<?php echo $schoolidtomatch; ?>">
            </form>
        </ul>
    </div>
</div>


        <!-- Pop-up form for adding items -->
        <div class="modal fade" id="addItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addItemLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addItemLabel">Add Item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action = "Processes/add_item.php" method ="POST" >
            <div class="modal-body">
                
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemarticle" placeholder= "Article" value = "<?php echo $itemarticle; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemdesc" placeholder= "Description" value = "<?php echo $itemdesc; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "date" name ="itemdateacquired" placeholder= "Date Acquired (YYYY-MM-DD)" value = "<?php echo $itemdateacquired; ?>"></input>
                  </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemunitvalue" placeholder= "Unit Value" value = "<?php echo $itemunitvalue; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemquantity" placeholder= "Quantity" value = "<?php echo $itemquantity; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
    <input type="text" name="itemactive" placeholder="Active Items" value="<?php echo $itemactive; ?>">
</div>
<div class="form-group mb-3">
    <input type="text" name="iteminactive" placeholder="Inactive Items" value="<?php echo $iteminactive; ?>">
</div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="itemfundssource" placeholder= "Funds Source" value = "<?php echo $itemfundssource; ?>"></input>
                    </div>
                    <div class="form-group mb-3">
                        <select name="itemstatus"  value = "<?php echo $itemstatus; ?>">
                            <option> Working </option>
                            <option> Need Repair</option>
                            <option> Condemned</option>
                        </select>
                    </div>
                </div>

            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!--sends school id, current timestamp and inventory name to add_item.php-->
                <input type='hidden' name='schoolid' value= "<?php echo $schoolidtomatch; ?>">
                <input type='hidden' name='itemdateadded' value= "<?php
    date_default_timezone_set("Asia/Manila");
    echo date("Y-m-d H:i:s");
?>">
                <input type='hidden' name='invenname' value= "<?php echo $inventoryname; ?>">
                <button type="submit" name = "additem" class="btn btn-primary">Add Item</button>
            </form>
            </div>
            </div>
        </div>
        </div>

         <!-- import data button -->
        <button style = "margin-left: 84vw; margin-top: -15.8vh; margin-bottom:0%;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importData">
            Import
        </button>

        <!-- modal before importing data -->
        <div class="modal fade" id="importData" tabindex="-1" aria-labelledby="importDataLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importDataLabel">import Resource Allocation Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    Upload the data to be imported here:
                    <form action = "Processes/import_data.php" enctype = "multipart/form-data" method = "POST">
                        <input type = "file" name = "importData">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name = "submitImport" class="btn btn-primary">Import</button>
                        <input type='hidden' name='inventoryid' value= "<?php echo $schoolidtomatch; ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
      
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
        <?php if (is_array($schoolinventory))
    {
        foreach ($schoolinventory as $item)
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
        <button style="margin-right:1vw;" type="button" id="deletebutton<?php echo $item["item_code"]; ?>" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteitem<?php echo htmlspecialchars($item["item_code"]); ?>">
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

            <?php }
    }

?>
</div>

<!-- Jquery script for detecting input in searchbar and displaying results on it -->
<script type="text/javascript"> 
$(document).ready(function() {
    var defaultTableContent = $("#tablecontent").html();
    var schoolid = "<?php echo $schoolidtomatch; ?>";

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
        var searchitem = $("#searchitemfield").val().toLowerCase(); // Convert to lowercase for case-insensitive search
        $("#tablecontent tr").each(function(index) {
            if (index === 0) {
                $(this).show(); // Show the header row
            } else {
                var rowText = $(this).text().toLowerCase(); // Convert row text to lowercase
                if (rowText.includes(searchitem)) {
                    $(this).show(); // Show the row if it contains the search string
                } else {
                    $(this).hide(); // Hide the row if it doesn't contain the search string
                }
            }
        });
    }, 300); // Reduced delay to 300ms

    // Attach keyup event listener directly to the search input
    $("#searchitemfield").on("keyup", updateTableVisibility);
});



        </script>


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
?>
<!-- Jquery script for detecting input in searchbar and displaying results on it -->
<script type="text/javascript"> 
$(document).ready(function() {
    var defaultTableContent = $("#tablecontent").html();
    var schoolid = "<?php echo $schoolidtomatch; ?>";
    var inventoryname = "<?php echo $inventoryname?>";

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

    var updateTableContent = debounceFunction(function() {
        var searchitem = $("#searchitemfield").val();
        if (searchitem !== "") {
            $.ajax({
                url: "Processes/search_school_inventory.php",
                method: "POST",
                data: {
                    searchitem: searchitem,
                    schoolid: schoolid,
                    inventoryname: inventoryname
                },
                success: function(data) {
                    $("#tablecontent").html(data);
                }
            });
        } else {
            $("#tablecontent").html(defaultTableContent);
        }
    }, 300); // Reduced delay to 300ms

    $(document).on("keyup", "#searchitemfield", updateTableContent);
});
        </script>

<script>
    $(document).ready(function() {
        // Function to handle dropdown item selection
        $(".dropdown-item").on("click", function() {
            var selectedValue = $(this).data("value"); // Get the value from data-value attribute
            var schoolidtomatch = $("#schoolidtomatch").val(); // Get the value of schoolidtomatch
            var inventoryname = "<?php echo $inventoryname?>";

            // Hide the table while loading
            $("#tablecontent").hide();

            // Send AJAX request
            $.ajax({
                url: "Processes/filter_inventory.php", // Path to your PHP file
                method: "POST",
                data: {
                    filterValue: selectedValue, // Filter value
                    schoolidtomatch: schoolidtomatch,
                    inventoryname: inventoryname // schoolidtomatch value
                },
                success: function(response) {
                    // Handle success response
                    $("#tablecontent").html(response); // Update table with filtered data
                    $("#tablecontent").show(); // Show the table again
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

        </body>
</html>

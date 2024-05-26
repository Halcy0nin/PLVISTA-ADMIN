<?php

include "../Coordinator View/Processes/db_conn_high_school.php";
include "../Coordinator View/Processes/show_notif_info.php";
if (isset($_GET["school_id"]))
{

    $schoolidtomatch = $_GET["school_id"];
    include "Processes/indiv_inventory_initialization.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Inventory Management System | DEPED</title>

  <!-- CSS FILES -->
  <link href="../Custodian View/assets/css/bootstrap.css" rel="stylesheet">
  <link href="../Custodian View/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../Custodian View/assets/css/dashboard.css" rel="stylesheet">
  <link href="../Custodian View/assets/css/modal.css" rel="stylesheet">


  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <!-- icon sa tab -->
  <link rel="icon" type="images/x-icon" href="sdo.png"/>

  <!--Importing jquery-->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</head>

<body>

<!--Importing bootstrap JS-->
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
          <a href="notification.php?school_id=<?php echo $schoolidtomatch; ?>">
          <i class="bi bi-bell-fill"></i>Notifications</a>
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
     
     <div class="content">
        <h3 class = "mx-3">School Inventory</h3>

 <!--search bar -->
        <div style="margin-left: -9.3vw;" class="input-group rounded">
            <input style = "margin-left: 25vw; margin-top:13vh;" type = "text" id = "searchitemfield" name ="searchitem" class="form-control rounded" placeholder= "Search"  aria-label="Search" aria-describedby="search-addon"></input>
            <span style = "margin-left: 0vw;margin-right: 60vw; margin-top:13vh;"class="input-group-text border-0" id="search-addon">
                <i class="bi bi-search"></i>
            </span>
        </div>

<!--dropdown filter -->
<div>
            <div class="container d-flex">
    <div class="dropdown">
        <button style="margin-left: 14vw; margin-top: -7vh" class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
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
        <button id="notification-button" style="margin-left: -12vw; margin-top: -4vh;" class="button">
                                <svg viewBox="0 0 448 512" class="bell"><path d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"></path></svg>
                            </button>
                        </div>
            <div id = "popup-container" class="notification-container">
                <div class="notification-header">
                    <h2>Notifications</h2>
                </div>
                <div class="notification-item">
    <?php foreach ($notifications as $index => $notif) { ?>
        <div class="notification-details <?php if($index !== 0) echo 'mt-3'; ?>">
            <p>From: SDO VALENZUELA</p>
            <p class="time"><?php echo htmlspecialchars($notif["notification_date"]); ?></p>
            <p><?php echo htmlspecialchars($notif["notification_message"]);?></p>
        </div>
        <?php if($index !== count($notifications) - 1) { ?>
            <hr class="my-2">
        <?php } ?>
    <?php } ?>
</div>
                <div class="notification-footer">
                    <a href="#"onclick="hidePopup()">Dismiss</a> | <a href="notification.php?school_id=<?php echo $schoolidtomatch ?>">All Notifications</a>
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
  <button style = "margin-left: 85.3vw; margin-top: 0; margin-bottom:4vh;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importData">
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
<!-- export data button -->
<button style = "margin-left: 90vw; margin-top: -15vh;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportSchool">
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
          <button style = "margin-left: 79.7vw; margin-top: -20vh;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItem">
        Add Item
        </button><br>

        <div>
        <a href = "../custodianpage/report.php?school_id=<?php echo $schoolidtomatch ?>">Report</a>
        </div>

        <div>
        <a href = "../custodianpage/profile.php?school_id=<?php echo $schoolidtomatch ?>">Profile</a>
        </div>

        <div id = "tablecontent">
            
            <!-- Table showing all inventory info per school in the database -->
            <table style="width:85%; margin-left: 15vw; margin-right: auto; margin-top:-5vw;" class = "table table-striped centerTable">
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
        <button type="button" id="editbutton<?php echo $item["item_code"]; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#updateitem<?php echo $item["item_code"]; ?>">
            Edit Item
        </button>
    </td>
    <td>
        <button type="button" id="deletebutton<?php echo $item["item_code"]; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteitem<?php echo htmlspecialchars($item["item_code"]); ?>">
            Delete Item
        </button>
    </td>
</tr>

                <!-- Pop-up form for working item -->
                <!--get item no as reference to match in order to assign the respective item no to the item to be updated-->
                <div class="modal fade" id="workingitem<?php echo $item["item_code"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="workingitemLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="workingitemLabel">Edit Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action = "Processes/edit_status.php" method ="POST">
                            <div class="modal-body">
                        <h4>Are you sure you want to change this item's status to 'Working'?</h4>
                    <div class="form-group mb-3"> 
                    </div>
                </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- shows the current id of the row of data through an input field -->
                                <input type = "hidden" name = "item_to_update" value = "<?php echo $item["item_code"]; ?>">
                                <input type='hidden' name='schoolid' value= "<?php echo $schoolidtomatch; ?>">
                                <input type='hidden' name= 'itemstatus'  value = "Working">
                                <button type="submit" name = "updateitem" class="btn btn-primary">Confirm</button>
                            </form>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Pop-up form for repair item -->
                <!--get item no as reference to match in order to assign the respective item no to the item to be updated-->
                <div class="modal fade" id="repairitem<?php echo $item["item_code"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="repairitemLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="repairitemLabel">Edit Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action = "Processes/edit_status.php" method ="POST">
                            <div class="modal-body">
                        <h4>Are you sure you want to change this item's status to 'Need Repair'?</h4>
                    <div class="form-group mb-3"> 
                    </div>
                </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- shows the current id of the row of data through an input field -->
                                <input type = "hidden" name = "item_to_update" value = "<?php echo $item["item_code"]; ?>">
                                <input type='hidden' name='schoolid' value= "<?php echo $schoolidtomatch; ?>">
                                <input type='hidden' name= 'itemstatus'  value = "Need Repair">
                                <button type="submit" name = "updateitem" class="btn btn-primary">Confirm</button>
                            </form>
                            </div>
                            </div>
                        </div>
                        </div>


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

       
        <?php
        }
    }?>
    </table> 
        </div>
        </body>

<!-- Jquery script for detecting input in searchbar and displaying results on it -->
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
        
        <script>
    $(document).ready(function() {
        // Function to handle dropdown item selection
        $(".dropdown-item").on("click", function() {
            var selectedValue = $(this).data("value"); // Get the value from data-value attribute
            var schoolidtomatch = $("#schoolidtomatch").val(); // Get the value of schoolidtomatch

            // Hide the table while loading
            $("#tablecontent").hide();

            // Send AJAX request
            $.ajax({
                url: "Processes/filter_inventory.php", // Path to your PHP file
                method: "POST",
                data: {
                    filterValue: selectedValue, // Filter value
                    schoolidtomatch: schoolidtomatch // schoolidtomatch value
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

<?php
}
?>

<div style="position: fixed; bottom: 7vh; right: 12vw;" class="container d-flex justify-content-end">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="custodianinventory.php?page=<?php echo max($current_page - 1, 1); ?>">Previous</a>
                </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item">
                    <a class="page-link" href="custodianinventory.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="custodianinventory.php?page=<?php echo min($current_page + 1, $totalPages); ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <script>
    document.getElementById('notification-button').addEventListener('click', function() {
        const popup = document.getElementById('popup-container');
        if (popup.style.display === 'none' || popup.style.display === '') {
            popup.style.display = 'block';
        } else {
            popup.style.display = 'none';
        }
    });

    function hidePopup() {
        document.getElementById('popup-container').style.display = 'none';
    }
</script>
  <!-- JS FILES -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.min.js"></script>

</body> 
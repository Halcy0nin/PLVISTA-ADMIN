<?php

session_start();

include "../Coordinator View/Processes/db_conn_high_school.php";

if (isset($_GET["school_id"]))
{

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
          <a href="school_inventory_content.php?school_id=<?php echo $_SESSION['school_id']; ?>">
          <i class="bi bi-archive-fill"></i>School Inventory</a>
        </li>
        <li class="item">
          <a href="resource_allocation_content.php?school_id=<?php echo $_SESSION['school_id']; ?>">
          <i class="bi bi-journal-bookmark-fill"></i>Report</a>
        </li>
        <li class="item">
          <a href="profile_content.php?school_id=<?php echo $_SESSION['school_id']; ?>">
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

 <!--search bar -->
        <div>
            <input type = "text" id = "searchitemfield" name ="searchitem" placeholder= "Search"  style = "margin-left: 25vw; margin-top:13vh;"></input>
        </div>

        <div>
        <a href = "../custodianpage/report.php?school_id=<?php echo $schoolidtomatch ?>">Report</a>
        </div>

        <div>
        <a href = "../custodianpage/profile.php?school_id=<?php echo $schoolidtomatch ?>">Profile</a>
        </div>

        <div id = "tablecontent">
            
            <!-- Table showing all inventory info per school in the database -->
        <table style="width: 1200px; margin-left: 25vw;" class="table table-striped centerTable">
        <thead class="thead-light"></thead>
            <tr>
                <th scope="col">Item Code</th>
                <th scope="col">Item Article</th>
                <th scope="col">Description</th>
                <th scope="col">Date Acquired</th>
                <th scope="col">Unit Value</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Value</th>
                <th scope="col">Source of Funds</th>
                <th scope="col">Last Updated</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>

        <!--get array of inventory from inventoryid from schools page-->
        <?php if (is_array($schoolinventory))
    {
        foreach ($schoolinventory as $item)
        {

            //multiplies quantity to unit value to get total value
            $qty = $item["item_quantity"] * $item["item_unit_value"];
            //formats the answer above to a decimal
            $itemtotalvalue = number_format($qty, 2);
?>
        <!--display inventory info in tabular form-->
        <tr>
            <td><?php echo htmlspecialchars($item["item_code"]); ?></td>
            <td><?php echo htmlspecialchars($item["item_article"]); ?></td>
            <td><?php echo htmlspecialchars($item["item_desc"]); ?></td>
            <td><?php echo htmlspecialchars($item["item_date_acquired"]); ?></td>
            <td><?php echo "PHP " . htmlspecialchars($item["item_unit_value"]); ?></td>
            <td><?php echo htmlspecialchars($item["item_quantity"]); ?></td>
            <td><?php echo "PHP " . htmlspecialchars($itemtotalvalue); ?></td>
            <td><?php echo htmlspecialchars($item["item_funds_source"]); ?></td>
            <td><?php echo htmlspecialchars($item["item_date_input"]); ?></td>
            <td><?php echo htmlspecialchars($item["item_status"]); ?></td>
            
             <td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#workingitem<?php echo $item["item_code"]; ?>">
            Working
            </button></td>

            <td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#repairitem<?php echo $item["item_code"]; ?>">
            Need Repair
            </button></td>

            <td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#condemneditem<?php echo $item["item_code"]; ?>">
            Condemned
            </button></td>

                <!-- Pop-up form for working item -->
                <!--get item no as reference to match in order to assign the respective item no to the item to be updated-->
                <div class="modal fade" id="workingitem<?php echo $item["item_code"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="workingitemLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="workingitemLabel">Edit Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action = "edit_status.php" method ="POST">
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
                            <form action = "edit_status.php" method ="POST">
                            <div class="modal-body">
                        <h4>Are you sure you want to change this item's status to 'For Repair'?</h4>
                    <div class="form-group mb-3"> 
                    </div>
                </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- shows the current id of the row of data through an input field -->
                                <input type = "hidden" name = "item_to_update" value = "<?php echo $item["item_code"]; ?>">
                                <input type='hidden' name='schoolid' value= "<?php echo $schoolidtomatch; ?>">
                                <input type='hidden' name= 'itemstatus'  value = "For Repair">
                                <button type="submit" name = "updateitem" class="btn btn-primary">Confirm</button>
                            </form>
                            </div>
                            </div>
                        </div>
                        </div>


                        <!-- Pop-up form for condemned item -->
                <!--get item no as reference to match in order to assign the respective item no to the item to be updated-->
                <div class="modal fade" id="condemneditem<?php echo $item["item_code"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="condemneditemLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="condemneditemLabel">Edit Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action = "edit_status.php" method ="POST">
                            <div class="modal-body">
                        <h4>Are you sure you want to change this item's status to 'Condemned'?</h4>
                    <div class="form-group mb-3"> 
                    </div>
                </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- shows the current id of the row of data through an input field -->
                                <input type = "hidden" name = "item_to_update" value = "<?php echo $item["item_code"]; ?>">
                                <input type='hidden' name='schoolid' value= "<?php echo $schoolidtomatch; ?>">
                                <input type='hidden' name= 'itemstatus'  value = "Condemned">
                                <button type="submit" name = "updateitem" class="btn btn-primary">Confirm</button>
                            </form>
                            </div>
                            </div>
                        </div>
                        </div>
        </tr>  
       
        <?php
        }
    }?>
    </table> 
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

    var updateTableContent = debounceFunction(function() {
        var searchitem = $("#searchitemfield").val();
        if (searchitem !== "") {
            $.ajax({
                url: "search_item.php",
                method: "POST",
                data: {
                    searchitem: searchitem,
                    schoolid: schoolid
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
  <!-- JS FILES -->
  <script src="../Custodian View/assets/js/bootstrap.bundle.js"></script>
  <script src="../Custodian View/assets/js/bootstrap.bundle.min.js"></script>
  <script src="../Custodian View/assets/js/dashboard.js"></script>

</body> 
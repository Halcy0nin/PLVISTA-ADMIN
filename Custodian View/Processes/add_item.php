<?php

include '../../Coordinator View/Processes/db_conn_high_school.php';

if(isset($_POST['additem'])){
    // Sanitize and escape input data to prevent SQL injection
    $schoolid = mysqli_real_escape_string($conn, $_POST['schoolid']);
    $itemarticle = mysqli_real_escape_string($conn, $_POST['itemarticle']);
    $itemdesc = mysqli_real_escape_string($conn, $_POST['itemdesc']);
    $itemdateacquired = mysqli_real_escape_string($conn, $_POST['itemdateacquired']);
    // No need to escape the current timestamp as it's generated by PHP
    $itemdateadded = mysqli_real_escape_string($conn, $_POST['itemdateadded']);;
    $itemunitvalue = mysqli_real_escape_string($conn, $_POST['itemunitvalue']);
    $itemquantity = mysqli_real_escape_string($conn, $_POST['itemquantity']);
    $itemactive = mysqli_real_escape_string($conn, $_POST['itemactive']);
    $iteminactive = mysqli_real_escape_string($conn, $_POST['iteminactive']);
    $itemfundssource = mysqli_real_escape_string($conn, $_POST['itemfundssource']);
    $itemstatus = mysqli_real_escape_string($conn, $_POST['itemstatus']);
    $inventoryname = mysqli_real_escape_string($conn, $_POST['invenname']);

    // Create SQL query to insert data into the database
    $insertitem = "INSERT INTO school_inventory (school_id,
    item_article,
    item_desc,
    item_date_acquired,
    item_date_input,
    item_unit_value,
    item_quantity,
    item_active,
    item_inactive,
    item_funds_source,
    item_status)
    VALUES('$schoolid',
    '$itemarticle',
    '$itemdesc',
    '$itemdateacquired',
    '$itemdateadded',
    '$itemunitvalue',
    '$itemquantity',
    '$itemactive',
    '$iteminactive',
    '$itemfundssource',
    '$itemstatus'
    )";


    // Execute the query and check for success
    if(mysqli_query($conn, $insertitem)){
        // Redirect the user back to the inventory page with appropriate parameters
        $redirectURL = "../school_inventory_content.php?school_id=" . urlencode($schoolid);
        header("Location: $redirectURL");
        exit();
    } else {
        // Display an error message if the query fails
        echo 'Query error: ' . mysqli_error($conn);
    }
}
?>

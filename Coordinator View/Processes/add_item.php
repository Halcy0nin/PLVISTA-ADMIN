<?php
include "db_conn_high_school.php";


if(isset($_POST['additem'])){

    //insert variables into database
    $schoolid = mysqli_real_escape_string($conn, $_POST['schoolid']);
    $itemarticle = mysqli_real_escape_string($conn, $_POST['itemarticle']);
    $itemdesc = mysqli_real_escape_string($conn, $_POST['itemdesc']);
    $itemdateacquired = mysqli_real_escape_string($conn, $_POST['itemdateacquired']);
    $itemdateadded = mysqli_real_escape_string($conn, $_POST['itemdateadded']);
    $itemunitvalue = mysqli_real_escape_string($conn, $_POST['itemunitvalue']);
    $itemquantity = mysqli_real_escape_string($conn, $_POST['itemquantity']);
    $itemfundssource = mysqli_real_escape_string($conn, $_POST['itemfundssource']);
    $itemstatus = mysqli_real_escape_string($conn, $_POST['itemstatus']);
    $inventoryname = mysqli_real_escape_string($conn, $_POST['invenname']);

    //create query to input data into database
    
    $insertitem = "INSERT INTO school_inventory (school_id,
        item_article,
        item_desc,
        item_date_acquired,
        item_date_input,
        item_unit_value,
        item_quantity,
        item_funds_source,
        item_status)
        VALUES('$schoolid',
        '$itemarticle',
        '$itemdesc',
        '$itemdateacquired',
        '$itemdateadded',
        '$itemunitvalue',
        '$itemquantity',
        '$itemfundssource',
        '$itemstatus')";
    

    //save to database and check

    if(mysqli_query($conn,$insertitem)){
    $redirectURL = "../school_inventory.php?inventoryid=" . urlencode($schoolid) . "&inventoryname=" . urlencode($inventoryname);
    header("Location: $redirectURL");
    exit();
    } else {
    echo 'query error: '. mysqli_error($conn);
    }
}

?>
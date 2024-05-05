<?php

// Connect to database (using the parameters localhost, username, password, and database to be used)
$conn = mysqli_connect('localhost','root','', 'sdo_high_schools_ict_equipment');

// Check connection
if (!$conn) {
    echo 'Connection ERROR: ' . mysqli_connect_error();
}

    if(isset($_POST['updateitem'])){
        $schoolid = mysqli_real_escape_string($conn, $_POST['schoolid']);
        $inventoryname = mysqli_real_escape_string($conn, $_POST['invenname']);

        $item_to_update = mysqli_real_escape_string($conn, $_POST['item_to_update']);
        $itemstatus = mysqli_real_escape_string($conn, $_POST['itemstatus']);

        $updateitem = "UPDATE school_inventory SET item_status = '$itemstatus' WHERE item_code = $item_to_update";

        if(mysqli_query($conn,$updateitem)){
            $redirectURL = "../school_inventory_content.php?school_id=" . urlencode($schoolid);
            header("Location: $redirectURL");
            exit();
            } else {
                echo 'query error: '. mysqli_error($conn);
            }
        }

?>
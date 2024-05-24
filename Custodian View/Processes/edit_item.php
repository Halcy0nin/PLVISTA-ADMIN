<?php
    include '../../Coordinator View/Processes/db_conn_high_school.php';

    if(isset($_POST['updateitem'])){
        $schoolid = mysqli_real_escape_string($conn, $_POST['schoolid']);
        $inventoryname = mysqli_real_escape_string($conn, $_POST['invenname']);

        $item_to_update = mysqli_real_escape_string($conn, $_POST['item_to_update']);
        $itemarticle = mysqli_real_escape_string($conn, $_POST['itemarticle']);
        $itemdesc = mysqli_real_escape_string($conn, $_POST['itemdesc']);
        $itemdateacquired = mysqli_real_escape_string($conn, $_POST['itemdateacquired']);
        $itemunitvalue = mysqli_real_escape_string($conn, $_POST['itemunitvalue']);
        $itemquantity = mysqli_real_escape_string($conn, $_POST['itemquantity']);
        $itemfundssource = mysqli_real_escape_string($conn, $_POST['itemfundssource']);
        $itemstatus = mysqli_real_escape_string($conn, $_POST['itemstatus']);
        $itemdateadded = mysqli_real_escape_string($conn, $_POST['itemdateadded']);
        $itemactive = mysqli_real_escape_string($conn, $_POST['itemactive']);
        $iteminactive = mysqli_real_escape_string($conn, $_POST['iteminactive']);

        $updateitem = "UPDATE school_inventory SET item_article = '$itemarticle'
        ,item_desc = '$itemdesc',item_date_acquired = '$itemdateacquired',item_unit_value = $itemunitvalue,item_quantity = $itemquantity
        ,item_funds_source = '$itemfundssource', item_status = '$itemstatus', item_date_input = '$itemdateadded', item_active = $itemactive, item_inactive = $iteminactive WHERE item_code = $item_to_update";

        if(mysqli_query($conn, $updateitem)){
            $redirectURL = "../school_inventory_content.php?school_id=" . urlencode($schoolid);
            header("Location: $redirectURL");
            exit();
        } else {
            echo 'query error: '. mysqli_error($conn);
        }
    }
?>

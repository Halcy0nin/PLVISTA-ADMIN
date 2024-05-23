<?php
include '../../Coordinator View/Processes/db_conn_high_school.php';

//once deleteitem button is pressed the following code executes
if(isset($_POST['deleteitem'])){
    $schoolid = mysqli_real_escape_string($conn, $_POST['schoolid']);
    $inventoryname = mysqli_real_escape_string($conn, $_POST['invenname']);
    //takes id_to_delete input from schools.php input field named id_to_delete with the value of said input field being school id
    $item_to_delete = mysqli_real_escape_string($conn, $_POST['item_to_delete']);
    //matches id_to_delete with id from database
    $deleteitem = "DELETE from school_inventory WHERE item_code = $item_to_delete";

    if(mysqli_query($conn,$deleteitem)){
    $redirectURL = "../school_inventory_content.php?school_id=" . urlencode($schoolid);
    header("Location: $redirectURL");
    exit();
    } else {
        echo 'query error: '. mysqli_error($conn);
    }
}


?>
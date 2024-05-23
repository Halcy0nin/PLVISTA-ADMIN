<?php
include '../../Coordinator View/Processes/db_conn_high_school.php';

if(isset($_POST['removerequest'])){
    $item_code = $_POST['requesttoremove'];
    $schoolid = $_POST['schoolid'];

    $updateQuery = "UPDATE school_inventory SET is_visible = FALSE WHERE item_code = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "s", $item_code);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Item removed successfully.";
        $redirectURL = "../resource_allocation_content.php?school_id=" . urlencode($schoolid);
        header("Location: $redirectURL");
        exit();
    } else {
        echo "Failed to remove the item.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
?>

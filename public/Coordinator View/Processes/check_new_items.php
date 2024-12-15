<?php
session_start();
include "Processes/db_conn_high_school.php";

$lastCheck = isset($_SESSION['last_check']) ? $_SESSION['last_check'] : '1970-01-01 00:00:00';

// Query to find new items added after the last check
$query = "SELECT item_code, item_article, item_status, item_date_acquired FROM school_inventory WHERE notified_at > '$lastCheck'";
$result = mysqli_query($conn, $query);

$newItems = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Update the last check time
$_SESSION['last_check'] = date('Y-m-d H:i:s');

echo json_encode($newItems);

mysqli_free_result($result);
mysqli_close($conn);
?>

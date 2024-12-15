<?php

include('db_conn_high_school.php');
// Query to fetch approved requests with pagination
$selectapproved = "SELECT * FROM profile_edit_requests WHERE request_status = 'Approved' ORDER BY request_id";
$result = mysqli_query($conn, $selectapproved);
$approvedrequests = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);


?>
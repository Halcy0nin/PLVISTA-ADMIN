<?php

include('db_conn_high_school.php');
// Query to fetch denied requests with pagination
$selectdenied = "SELECT * FROM profile_edit_requests WHERE request_status = 'Denied' ORDER BY request_id";
$result = mysqli_query($conn, $selectapproved);
$deniedrequests = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);


?>
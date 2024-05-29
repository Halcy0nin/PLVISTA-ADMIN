<?php

include('db_conn_high_school.php');

// Number of items per page
$itemsPerPage = 5;

$denied_current_page = isset($_GET["page"]) ? $_GET["page"] : 1;

// Calculate the offset for the SQL query
$offset = ($approved_current_page - 1) * $itemsPerPage;

// Query to get total number of denied requests
$totalRequestsQuery = "SELECT COUNT(*) AS total FROM profile_edit_requests WHERE request_status = 'Denied'";
$totalRequestsResult = mysqli_query($conn, $totalRequestsQuery);
$totalRequests = mysqli_fetch_assoc($totalRequestsResult)['total'];

// Calculate total pages
$deniedTotalPages = ceil($totalRequests / $itemsPerPage);

// Query to fetch denied requests with pagination
$selectapproved = "SELECT * FROM profile_edit_requests WHERE request_status = 'Denied' ORDER BY request_id LIMIT $offset, $itemsPerPage";
$result = mysqli_query($conn, $selectapproved);
$deniedrequests = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);


?>
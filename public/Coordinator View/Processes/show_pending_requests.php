<?php

include('db_conn_high_school.php');

// Number of items per page
$itemsPerPage = 5;

// Current page number, default to 1 if not set
$pending_current_page = isset($_GET["page"]) ? $_GET["page"] : 1;

// Calculate the offset for the SQL query
$offset = ($pending_current_page - 1) * $itemsPerPage;

// Query to get total number of pending requests
$totalRequestsQuery = "SELECT COUNT(*) AS total FROM profile_edit_requests WHERE request_status = 'Pending'";
$totalRequestsResult = mysqli_query($conn, $totalRequestsQuery);
$totalRequests = mysqli_fetch_assoc($totalRequestsResult)['total'];

// Calculate total pages
$pendingTotalPages = ceil($totalRequests / $itemsPerPage);

// Query to fetch pending requests with pagination
$selectrequests = "SELECT * FROM profile_edit_requests WHERE request_status = 'Pending' ORDER BY request_id LIMIT $offset, $itemsPerPage";
$result = mysqli_query($conn, $selectrequests);
$requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);


?>
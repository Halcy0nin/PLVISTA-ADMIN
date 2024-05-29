<?php

include('db_conn_high_school.php');

// Number of items per page
$itemsPerPage = 5;

// Current page number, default to 1 if not set
$users_current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($users_current_page  - 1) * $itemsPerPage;

// Query to get total number of rows
$totalRowsQuery = 'SELECT COUNT(*) AS total FROM formatted_users';
$totalRowsResult = mysqli_query($conn, $totalRowsQuery);
$totalRows = mysqli_fetch_assoc($totalRowsResult)['total'];

// Calculate total pages
$userTotalPages = ceil($totalRows / $itemsPerPage);

// Query to fetch data with pagination
$selectuserinfo = "SELECT * FROM formatted_users ORDER BY user_id LIMIT $offset, $itemsPerPage";
$result = mysqli_query($conn, $selectuserinfo);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
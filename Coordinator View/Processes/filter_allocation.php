<?php
include "db_conn_high_school.php";

// Check if filter value is set
if (isset($_POST["filterValue"])) {
    $filter = $_POST["filterValue"];

    // Construct the query based on the selected filter
    switch ($filter) {
        case "working":
            $filterQuery = "SELECT * FROM school_inventory WHERE item_status = 'Working'";
            break;
        case "needrepair":
            $filterQuery = "SELECT * FROM school_inventory WHERE item_status = 'Need Repair'";
            break;
        case "condemned":
            $filterQuery = "SELECT * FROM school_inventory WHERE item_status = 'Condemned'";
            break;
        case "all":
            $filterQuery = "SELECT * FROM school_inventory";
            break;
        default:
            // Default case if no specific filter is selected
            $filterQuery = "SELECT * FROM school_inventory";
            break;
    }

    // Execute the query
    $result = mysqli_query($conn, $filterQuery);
    $rowCount = mysqli_num_rows($result);
    $filteredData = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
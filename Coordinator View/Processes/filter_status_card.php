<?php
// Include your database connection file
include "db_conn_high_school.php";

// Check if the selectedSchool parameter is set in the POST request
if(isset($_POST['selectedSchool'])) {
    // Sanitize the input to prevent SQL injection
    $selectedSchool = mysqli_real_escape_string($conn, $_POST['selectedSchool']);
    
    // Initialize variables to store status counts
    $totalWorkingItems = 0;
    $totalRepairOrCondemnedItems = 0;

    // Query to get total count of working items for the selected school
    $totalWorkingItemCountQuery = "SELECT COUNT(item_article) as total_count FROM school_inventory WHERE item_status = 'Working' AND school_name = '$selectedSchool'";
    $resultWorking = mysqli_query($conn, $totalWorkingItemCountQuery);
    if ($resultWorking) {
        $rowWorking = mysqli_fetch_assoc($resultWorking);
        $totalWorkingItems = $rowWorking['total_count'];
        mysqli_free_result($resultWorking);
    }

    // Query to get total count of items needing repair or condemned for the selected school
    $totalNeedRepairOrCondemnedItemCountQuery = "SELECT COUNT(item_article) as total_count FROM school_inventory WHERE item_status = 'Need Repair' OR item_status = 'Condemned' AND school_name = '$selectedSchool'";
    $resultRepairOrCondemned = mysqli_query($conn, $totalNeedRepairOrCondemnedItemCountQuery);
    if ($resultRepairOrCondemned) {
        $rowRepairOrCondemned = mysqli_fetch_assoc($resultRepairOrCondemned);
        $totalRepairOrCondemnedItems = $rowRepairOrCondemned['total_count'];
        mysqli_free_result($resultRepairOrCondemned);
    }

    // Create an array to store the status counts
    $statusCounts = array(
        'totalWorkingItems' => $totalWorkingItems,
        'totalRepairOrCondemnedItems' => $totalRepairOrCondemnedItems
    );

    // Convert the array to JSON format and echo it as the response
    echo json_encode($statusCounts);
} else {
    // If the selectedSchool parameter is not set, return an error message
    echo "Error: No school selected";
}
?>

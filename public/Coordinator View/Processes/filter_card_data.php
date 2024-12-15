<?php
// Include your database connection file
include "db_conn_high_school.php";

if (isset($_POST['selectedValue'])) {
    // Sanitize the selected value to prevent SQL injection
    $selectedValue = mysqli_real_escape_string($conn, $_POST['selectedValue']);
    
    if ($selectedValue === 'showAll') {
        // Query to get total count of all items
        $totalCountQuery = "SELECT COUNT(item_code) AS total_count FROM school_inventory";
        
        // Query to get total count of working items
        $workingCountQuery = "SELECT COUNT(item_code) AS total_count FROM school_inventory WHERE item_status = 'Working'";
        
        // Query to get total count of items needing repair
        $repairCountQuery = "SELECT COUNT(item_code) AS total_count FROM school_inventory WHERE item_status = 'Need Repair'";
        
        // Query to get total count of condemned items
        $condemnedCountQuery = "SELECT COUNT(item_code) AS total_count FROM school_inventory WHERE item_status = 'Condemned'";
    } else {
        // Perform database queries based on the selected value
        $totalCountQuery = "SELECT COUNT(item_code) AS total_count FROM school_inventory JOIN high_schools ON school_inventory.school_id = high_schools.school_id WHERE high_schools.school_name = '$selectedValue'";
        
        $workingCountQuery = "SELECT COUNT(item_code) AS total_count FROM school_inventory JOIN high_schools ON school_inventory.school_id = high_schools.school_id WHERE high_schools.school_name = '$selectedValue' AND item_status = 'Working'";
        
        $repairCountQuery = "SELECT COUNT(item_code) AS total_count FROM school_inventory JOIN high_schools ON school_inventory.school_id = high_schools.school_id WHERE high_schools.school_name = '$selectedValue' AND item_status = 'Need Repair'";
        
        $condemnedCountQuery = "SELECT COUNT(item_code) AS total_count FROM school_inventory JOIN high_schools ON school_inventory.school_id = high_schools.school_id WHERE high_schools.school_name = '$selectedValue' AND item_status = 'Condemned'";
    }
    
    // Execute queries
    $totalCountResult = mysqli_query($conn, $totalCountQuery);
    $workingCountResult = mysqli_query($conn, $workingCountQuery);
    $repairCountResult = mysqli_query($conn, $repairCountQuery);
    $condemnedCountResult = mysqli_query($conn, $condemnedCountQuery);
    
    // Fetch results
    $totalCount = mysqli_fetch_assoc($totalCountResult)['total_count'];
    $workingCount = mysqli_fetch_assoc($workingCountResult)['total_count'];
    $repairCount = mysqli_fetch_assoc($repairCountResult)['total_count'];
    $condemnedCount = mysqli_fetch_assoc($condemnedCountResult)['total_count'];
    
    // Return data as JSON
    echo json_encode([
        'totalCount' => $totalCount,
        'workingCount' => $workingCount,
        'repairCount' => $repairCount,
        'condemnedCount' => $condemnedCount,
        'message' => 'Data fetched successfully.'
    ]);
} else {
    // If the selected value is not set or empty, return an error message
    echo json_encode(['error' => 'Selected value is missing']);
}
?>

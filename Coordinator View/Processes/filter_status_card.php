<?php
// Include your database connection file
include "db_conn_high_school.php";

// Check if selectedValue is set and not empty
if(isset($_POST['selectedValue']) && !empty($_POST['selectedValue'])) {
    // Sanitize the input to prevent SQL injection
    $selectedValue = mysqli_real_escape_string($conn, $_POST['selectedValue']);
    
    if ($selectedValue === 'showAll') {
    // Define the combined MySQL query
    $query = "SELECT 
                SUM(CASE WHEN item_status = 'Working' THEN 1 ELSE 0 END) AS working_count,
                SUM(CASE WHEN item_status = 'Need Repair' THEN 1 ELSE 0 END) AS repair_count,
                SUM(CASE WHEN item_status = 'Condemned' THEN 1 ELSE 0 END) AS condemned_count
            FROM 
                school_inventory";
    } else {
        $query = "SELECT 
                SUM(CASE WHEN item_status = 'Working' THEN 1 ELSE 0 END) AS working_count,
                SUM(CASE WHEN item_status = 'Need Repair' THEN 1 ELSE 0 END) AS repair_count,
                SUM(CASE WHEN item_status = 'Condemned' THEN 1 ELSE 0 END) AS condemned_count
                FROM school_inventory 
            JOIN high_schools ON school_inventory.school_id = high_schools.school_id 
            WHERE high_schools.school_name = '$selectedValue'";
    }
    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if query executed successfully
    if ($result) {
        // Fetch the result as an associative array
        $row = mysqli_fetch_assoc($result);
        
        // Prepare response data
        $responseData = [
            'workingCount' => $row['working_count'],
            'repairCount' => $row['repair_count'],
            'condemnedCount' => $row['condemned_count']
        ];
        
        // Log the response data
        error_log("Response data: " . json_encode($responseData));

        // Send the response back to the frontend
        echo json_encode($responseData);
    } else {
        // Handle query execution error
        $response = ['error' => 'Query failed'];
        echo json_encode($response);
    }
} else {
    // Handle missing or empty selectedValue
    $response = ['error' => 'Selected value is missing'];
    echo json_encode($response);
}
?>

<?php
// Include your database connection file
include "db_conn_high_school.php";

if (isset($_POST['selectedValue'])) {
    // Sanitize the selected value to prevent SQL injection
    $selectedValue = mysqli_real_escape_string($conn, $_POST['selectedValue']);
    
    if ($selectedValue === 'showAll') {
        $query = "SELECT item_article, COUNT(item_article) AS count FROM school_inventory GROUP BY item_article HAVING COUNT(item_article) > 0";
    } else {
        // Perform a database query based on the selected value
        $query = "SELECT item_article, COUNT(item_article) AS count
            FROM school_inventory 
            JOIN high_schools ON school_inventory.school_id = high_schools.school_id 
            WHERE high_schools.school_name = '$selectedValue' 
            GROUP BY item_article";
    }
    

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Fetch the data and store it in an array
        $labels = [];
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $labels[] = $row['item_article'];
            $data[] = $row['count'];
        }

        // Return the data and labels as JSON
        echo json_encode(['data' => $data, 'labels' => $labels, 'message' => 'Data fetched successfully.']);
    } else {
        // If the query fails, return an error message
        echo json_encode(['error' => 'Query failed']);
    }
} else {
    // If the selected value is not set or empty, return an error message
    echo json_encode(['error' => 'Selected value is missing']);
}
?>

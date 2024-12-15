<?php
// Include your database connection file
include "db_conn_high_school.php";

if (isset($_POST['selectedValue'])) {
    // Sanitize the selected value to prevent SQL injection
    $selectedValue = mysqli_real_escape_string($conn, $_POST['selectedValue']);
    $current_year = date('Y');
    if ($selectedValue === 'showAll') {
        $query = "SELECT MONTH(item_date_acquired) AS month, COUNT(item_article) AS count 
        FROM school_inventory 
        WHERE item_date_acquired IS NOT NULL 
        AND YEAR(item_date_acquired) = $current_year
        GROUP BY MONTH(item_date_acquired)";
    } else {
        // Perform a database query based on the selected value
        $query = "SELECT MONTH(item_date_acquired) AS month, COUNT(item_article) AS count
        FROM school_inventory 
        JOIN high_schools ON school_inventory.school_id = high_schools.school_id WHERE high_schools.school_name = '$selectedValue' AND YEAR(item_date_acquired) = '$current_year' GROUP BY MONTH(item_date_acquired)";

    }
    

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Fetch the data and store it in an array
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row['count'];
        }

        // Return the data and a success message as JSON
        echo json_encode(['data' => $data, 'message' => 'Data fetched successfully.']);
    } else {
        // If the query fails, return an error message
        echo json_encode(['error' => 'Query failed']);
    }
} else {
    // If the selected value is not set or empty, return an error message
    echo json_encode(['error' => 'Selected value is missing']);
}
?>

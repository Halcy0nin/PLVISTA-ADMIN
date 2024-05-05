<?php

// Connect to database (using the parameters localhost, username, password, and database to be used)
$conn = mysqli_connect('localhost','root','', 'sdo_high_schools_ict_equipment');

// Check connection
if (!$conn) {
    echo 'Connection ERROR: ' . mysqli_connect_error();
}

if (isset($_GET["school_id"])) {
    // Sanitize the input to prevent SQL injection
    $school_id_to_match = mysqli_real_escape_string($conn, $_GET["school_id"]);

    $showuserdetails = "SELECT * FROM users WHERE school_id = '$school_id_to_match'";
    $result = mysqli_query($conn, $showuserdetails);

    if ($result) {
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "School ID not provided.";
}
?>

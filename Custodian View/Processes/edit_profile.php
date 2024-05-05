<?php 
if (isset($_POST['requestedit'])) {
    // Connect to the database
    $conn = mysqli_connect('localhost','root','', 'sdo_high_schools_ict_equipment');

    // Check connection
    if (!$conn) {
        echo 'Connection ERROR: ' . mysqli_connect_error();
    } else {
        // Retrieve form data
        $user_to_update = mysqli_real_escape_string($conn, $_POST['user_to_update']);
        $newusername = mysqli_real_escape_string($conn, $_POST['newusername']);
        $newemail = mysqli_real_escape_string($conn, $_POST['newemail']);
        $newcontact = mysqli_real_escape_string($conn, $_POST['newcontact']);
        $newpassword = mysqli_real_escape_string($conn, $_POST['newpassword']);
        $requestdate = mysqli_real_escape_string($conn, $_POST['requestdate']);
        $schoolid = mysqli_real_escape_string($conn, $_POST['schoolid']);
        $requeststatus = mysqli_real_escape_string($conn, $_POST['requeststatus']);
        $requestname = mysqli_real_escape_string($conn, $_POST['originalusername']); // Use the original username as the request name

        // SQL query to insert into profile_edit_requests table
        $addrequest = "INSERT INTO profile_edit_requests 
        (request_name, request_date, request_status, new_username, new_email, new_contact) 
        VALUES ('$requestname','$requestdate','$requeststatus','$newusername','$newemail','$newcontact')";

        // Execute the query
        if(mysqli_query($conn, $addrequest)){
            // Redirect to the profile page with the updated school_id
            $redirectURL = "../profile_content.php?school_id=" . urlencode($schoolid);
            header("Location: $redirectURL");
            exit();
        } else {
            echo 'query error: '. mysqli_error($conn);
        }
    }
}
?>
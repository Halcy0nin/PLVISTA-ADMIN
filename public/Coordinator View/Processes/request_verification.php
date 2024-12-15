<?php

include('db_conn_high_school.php');

if (isset($_POST['approverequest'])) {
    $user_to_request = mysqli_real_escape_string($conn, $_POST['user_to_request']);
    $newusername_request = mysqli_real_escape_string($conn, $_POST['newusername']);
    $newpassword_request = mysqli_real_escape_string($conn, $_POST['newpass']);
    $request_id = mysqli_real_escape_string($conn, $_POST['request_id']);

    $dorequest = "UPDATE users SET user_name = '$newusername_request', user_pass = '$newpassword_request'
                  WHERE user_id = '$user_to_request'";

    $approverequest = "UPDATE profile_edit_requests SET request_status = 'Approved'
                       WHERE request_id = '$request_id'";

    if (mysqli_query($conn, $dorequest)) {
        // Execute the second query
        if (mysqli_query($conn, $approverequest)) {
            $redirectURL = "../manage_users_content.php";
            header("Location: $redirectURL");
            exit();
        } else {
            echo 'Second query error: ' . mysqli_error($conn);
        }
    } else {
        echo 'First query error: ' . mysqli_error($conn);
    }
}

if (isset($_POST['denyrequest'])) {
    $request_id = mysqli_real_escape_string($conn, $_POST['request_id']);

    $denyrequest = "UPDATE profile_edit_requests SET request_status = 'Denied'
                    WHERE request_id = '$request_id'";

    if (mysqli_query($conn, $denyrequest)) {
        $redirectURL = "../manage_users_content.php";
        header("Location: $redirectURL");
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
?>

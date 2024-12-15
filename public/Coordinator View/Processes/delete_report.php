<?php

include('db_conn_high_school.php');

if(isset($_POST['deletereport'])){

    $reporttodelete = mysqli_real_escape_string($conn, $_POST['reporttodelete']);
    $message = mysqli_real_escape_string($conn, $_POST['deletereason']);
    $currentdate = new DateTime();
    $notifdate = $currentdate->format('Y-m-d H:i:s');
    

    $deletereport = "UPDATE school_inventory SET is_visible = FALSE WHERE item_code = $reporttodelete";

    // Using prepared statement to insert values into the notifications table
    $addnotification = $conn->prepare("INSERT INTO notifications(notification_message, notification_date) VALUES (?, ?)");
    $addnotification->bind_param("ss", $message, $notifdate);

    // Execute the prepared statement
    $addnotification->execute();
    $addnotification->close();
}

// Execute the update query to mark the item as not visible
if(mysqli_query($conn, $deletereport)){
    header('Location: ../resource_allocation_content.php');
    exit();
} else {
    echo 'query error: '. mysqli_error($conn);
}

?>

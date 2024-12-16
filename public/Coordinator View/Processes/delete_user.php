<?php
include('../db_conn_high_school.php');
//once deleteuser button is pressed the following code executes
if(isset($_POST['deleteuser'])){
    //takes id_to_delete input from schools.php input field named id_to_delete with the value of said input field being school id
    $user_to_delete = mysqli_real_escape_string($conn, $_POST['user_to_delete']);
    //matches id_to_delete with id from database
    $deleteuser = "UPDATE users SET is_archived = 1 
                    WHERE student_id = '$user_to_delete'";

    if(mysqli_query($conn,$deleteuser)){
        header('Location: ../manage_users_content.php');
        exit();
    } else {
        echo 'query error: '. mysqli_error($conn);
    }
}


?>
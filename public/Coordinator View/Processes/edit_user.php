<?php
    include('../db_conn_high_school.php');

    if(isset($_POST['edituser'])){

        // Assume you have collected the input values from the form
        $username = $_POST['username'];
        $userpass = $_POST['userpass'];
        $usercontact = $_POST['usercontact'];
        $user_to_update = $_POST['user_to_update'];
        
        // Hash the password
        $hashed_password = password_hash($userpass, PASSWORD_DEFAULT);
        
        // Update query with the hashed password
        $updateuser = "UPDATE users SET name = '$username', password = '$hashed_password', email = '$usercontact' 
                       WHERE student_id = '$user_to_update'";

        if(mysqli_query($conn,$updateuser)){
            header('Location: ../manage_users_content.php');
            exit();
        } else {
            echo 'query error: '. mysqli_error($conn);
        }
        }

?>
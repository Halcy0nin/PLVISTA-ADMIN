<?php
    include('db_conn_high_school.php');

    if(isset($_POST['edituser'])){

        $user_to_update = mysqli_real_escape_string($conn, $_POST['user_to_update']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $useremail = mysqli_real_escape_string($conn, $_POST['useremail']);
        $usercontact = mysqli_real_escape_string($conn, $_POST['usercontact']);

        $updateuser = "UPDATE users SET user_name = '$username', user_email = '$useremail', user_contact = '$usercontact'
        WHERE user_id = '$user_to_update'";
        

        if(mysqli_query($conn,$updateuser)){
            header('Location: ../manage_users_content.php');
            exit();
        } else {
            echo 'query error: '. mysqli_error($conn);
        }
        }

?>
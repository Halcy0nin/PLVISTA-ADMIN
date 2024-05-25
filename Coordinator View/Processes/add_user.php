<?php

include('db_conn_high_school.php');

    if(isset($_POST['adduser'])){
        //insert variables into database
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $useremail = mysqli_real_escape_string($conn, $_POST['useremail']);
        $userpass = mysqli_real_escape_string($conn, $_POST['userpass']);
        $usercontact = mysqli_real_escape_string($conn, $_POST['usercontact']);
        $userschool = mysqli_real_escape_string($conn, $_POST['school']);


        $schoolQuery = "SELECT school_id FROM high_schools WHERE school_name = '$userschool'";
$schoolResult = mysqli_query($conn, $schoolQuery);

if (mysqli_num_rows($schoolResult) > 0) {
    // Fetch the school_id
    $row = mysqli_fetch_assoc($schoolResult);
    $school_id = $row['school_id'];

    // Step 2: Insert the new user data into the users table
    $insertuser = "INSERT INTO users (user_name, user_email, user_pass, user_contact, school_id, school_name)
                     VALUES ('$username', '$useremail', '$userpass', '$usercontact', '$school_id', '$userschool')";
    }
    }

    //save to database and check
    if(mysqli_query($conn,$insertuser)){
        header('Location: ../manage_users_content.php');
        exit();
    } else {
        echo 'query error: '. mysqli_error($conn);
    }
?>
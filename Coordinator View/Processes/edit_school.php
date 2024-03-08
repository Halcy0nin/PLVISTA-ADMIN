<?php
    include('db_conn_high_school.php');

    if(isset($_POST['updateschool'])){

        $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
        $schoolname = mysqli_real_escape_string($conn, $_POST['schoolname']);
        $schoolid = mysqli_real_escape_string($conn, $_POST['schoolid']);
        $schooldivision = mysqli_real_escape_string($conn, $_POST['schooldivision']);
        $schooltype = mysqli_real_escape_string($conn, $_POST['schooltype']);
        $schoolcontact = mysqli_real_escape_string($conn, $_POST['schoolcontact']);
        $schoolcontactno = mysqli_real_escape_string($conn, $_POST['schoolcontactno']);
        $schoolemail = mysqli_real_escape_string($conn, $_POST['schoolemail']);
        $schooldistrict = mysqli_real_escape_string($conn, $_POST['schooldistrict']);

        $updateschool = "UPDATE high_schools SET school_name = '$schoolname',school_id = $schoolid
        ,school_division = '$schooldivision',school_type = '$schooltype',school_contact = '$schoolcontact',school_contact_no = '$schoolcontactno'
        ,school_email = '$schoolemail', school_district = '$schooldistrict' WHERE id = $id_to_update";

        if(mysqli_query($conn,$updateschool)){
            header('Location: ../school_content.php');
            exit();
        } else {
            echo 'query error: '. mysqli_error($conn);
        }
        }

?>
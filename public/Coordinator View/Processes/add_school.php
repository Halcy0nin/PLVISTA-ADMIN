<?php

include('db_conn_high_school.php');

    if(isset($_POST['add_school'])){
        //insert variables into database
        $schoolname = mysqli_real_escape_string($conn, $_POST['schoolname']);
        $schoolid = mysqli_real_escape_string($conn, $_POST['schoolid']);
        $schooldivision = mysqli_real_escape_string($conn, $_POST['schooldivision']);
        $schooltype = mysqli_real_escape_string($conn, $_POST['schooltype']);
        $schoolcontact = mysqli_real_escape_string($conn, $_POST['schoolcontact']);
        $schoolcontactno = mysqli_real_escape_string($conn, $_POST['schoolcontactno']);
        $schoolemail = mysqli_real_escape_string($conn, $_POST['schoolemail']);
        $schooldistrict = mysqli_real_escape_string($conn, $_POST['schooldistrict']);


        //create query to input data into database
        $insertschool = "INSERT INTO high_schools (school_name,
                                        school_id,
                                        school_division,
                                        school_type,
                                        school_contact,
                                        school_contact_no,
                                        school_email,
                                        school_district)
                VALUES('$schoolname',
                        '$schoolid',
                        '$schooldivision',
                        '$schooltype',
                        '$schoolcontact',
                        '$schoolcontactno',
                        '$schoolemail',
                        '$schooldistrict')";
    }

    //save to database and check
    if(mysqli_query($conn,$insertschool)){
        header('Location: ../school_content.php');
        exit();
    } else {
        echo 'query error: '. mysqli_error($conn);
    }
?>
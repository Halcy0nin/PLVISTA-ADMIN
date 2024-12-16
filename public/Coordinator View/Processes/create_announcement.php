<?php

include('../db_conn_high_school.php');
        //insert variables into database
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
        $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);

        //create query to input data into database
        $addAnnouncement = "INSERT INTO announcements (title,
                                        content,
                                        start_date,
                                        end_date,
                                        category)
                VALUES('$title',
                        '$content',
                        '$start_date',
                        '$end_date',
                        '$category')";

    //save to database and check
    if(mysqli_query($conn,$addAnnouncement)){
        header('Location: ../dashboard_content.php');
        exit();
    } else {
        echo 'query error: '. mysqli_error($conn);
    }
?>
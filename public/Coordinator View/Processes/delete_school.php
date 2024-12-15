<?php
include('db_conn_high_school.php');
//once deleteschool button is pressed the following code executes
if(isset($_POST['deleteschool'])){
    //takes id_to_delete input from schools.php input field named id_to_delete with the value of said input field being school id
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    //matches id_to_delete with id from database
    $deleteschool = "DELETE from high_schools WHERE school_id = $id_to_delete";

    if(mysqli_query($conn,$deleteschool)){
        header('Location: ../school_content.php');
        exit();
    } else {
        echo 'query error: '. mysqli_error($conn);
    }
}


?>
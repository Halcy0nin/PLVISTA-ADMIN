<?php

include('db_conn_high_school.php');

    $selectuserinfo = 'SELECT * FROM formatted_users ORDER BY user_id LIMIT 10';

    //make query and get results using the parameters (connection to be used, query to be used)
    $result = mysqli_query($conn, $selectuserinfo);

    //fetch resulting rows as an array using the parameters (array to be used, MYSQLI_ASSOC)
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //releases results to avoid stacking up memory
    mysqli_free_result($result);


?>
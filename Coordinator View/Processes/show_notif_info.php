<?php 

   $selectnotifinfo = "SELECT *
        FROM notifications ORDER BY notification_id";

    //make query and get results using the parameters (connection to be used, query to be used)
    $result = mysqli_query($conn, $selectnotifinfo);

    //fetch resulting rows as an array using the parameters (array to be used, MYSQLI_ASSOC)
    $notifications = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //releases results to avoid stacking up memory
    mysqli_free_result($result);

    ?>
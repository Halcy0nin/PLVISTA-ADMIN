<?php 

   $announcementInfo = "SELECT *
        FROM announcements ORDER BY created_at";

    //make query and get results using the parameters (connection to be used, query to be used)
    $result = mysqli_query($conn, $announcementInfo);

    //fetch resulting rows as an array using the parameters (array to be used, MYSQLI_ASSOC)
    $announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //releases results to avoid stacking up memory
    mysqli_free_result($result);

    ?>
<?php //write query for all public high school info

    $selectschoolinfo = 'SELECT * FROM high_schools ORDER BY id LIMIT 10';

    //make query and get results using the parameters (connection to be used, query to be used)
    $result = mysqli_query($conn, $selectschoolinfo);

    //fetch resulting rows as an array using the parameters (array to be used, MYSQLI_ASSOC)
    $highschools = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //releases results to avoid stacking up memory
    mysqli_free_result($result);


    ?>
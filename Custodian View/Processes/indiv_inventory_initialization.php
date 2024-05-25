<?php
    //gets id from submit
    $schoolidtomatch = $_GET["school_id"];

    include "pagination.php";

    // Fetch the school name
    $schoolNameQuery = "SELECT school_name FROM high_schools WHERE school_id = $schoolidtomatch";
    $schoolNameResult = mysqli_query($conn, $schoolNameQuery);
    $schoolNameRow = mysqli_fetch_assoc($schoolNameResult);
    $schoolname = $schoolNameRow['school_name'];
    //make query and get results using the parameters (connection to be used, query to be used)
    $result = mysqli_query($conn, $selectinventoryinfo);

    //fetch resulting rows as an array using the parameters (array to be used, MYSQLI_ASSOC)
    $schoolinventory = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //releases results to avoid stacking up memory
    mysqli_free_result($result);

    //placeholders for variable input
    $itemcode = $schoolid = $itemarticle = $itemdesc = $itemdateacquired = $itemdateadded = $itemunitvalue = $itemquantity = $itemactive = $iteminactive = $itemtotalvalue = $itemfundssource = $itemstatus = "";
    ?>
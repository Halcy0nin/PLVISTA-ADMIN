<?php

    //write query for inventory per school
    // Set the default page number if it's not already set in the session
    if (!isset($_GET["page"]))
    {
        $_GET["page"] = 1;
    }

    // Set the number of items per page and the current page number
    $itemsPerPage = 5;
    $current_page = $_GET["page"];

    // Calculate the offset based on the current page number
    $offset = max(0, ($current_page - 1) * $itemsPerPage);

    $selectreportinfo = "SELECT item_code, item_article, item_status, item_date_acquired
    FROM school_inventory 
    JOIN users ON school_inventory.school_id = users.school_id
    WHERE users.school_id = $schoolidtomatch AND (item_status = 'Need Repair' OR item_status = 'Condemned') AND school_inventory.is_visible = TRUE
    LIMIT $offset, $itemsPerPage";


$totalRowsQuery = "SELECT COUNT(item_code) as total_count
   FROM school_inventory 
   JOIN users ON school_inventory.school_id = users.school_id
   WHERE users.school_id = $schoolidtomatch AND (item_status = 'Need Repair' OR item_status = 'Condemned') AND school_inventory.is_visible = TRUE";

    $totalRowsResult = mysqli_query($conn, $totalRowsQuery);

    // Fetch the result as an associative array
    $totalRowsArray = mysqli_fetch_assoc($totalRowsResult);

    // Access the value of total_count and store it in a variable
    $totalCount = (int)$totalRowsArray["total_count"];

    // Calculate the total number of pages
    $totalPages = ceil($totalCount / $itemsPerPage);

     //make query and get results using the parameters (connection to be used, query to be used)
     $result = mysqli_query($conn, $selectreportinfo);

     //fetch resulting rows as an array using the parameters (array to be used, MYSQLI_ASSOC)
     $reports = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
     //releases results to avoid stacking up memory
     mysqli_free_result($result);

     // Fetch the school name
    $schoolNameQuery = "SELECT school_name FROM high_schools WHERE school_id = $schoolidtomatch";
    $schoolNameResult = mysqli_query($conn, $schoolNameQuery);
    $schoolNameRow = mysqli_fetch_assoc($schoolNameResult);
    $schoolname = $schoolNameRow['school_name'];
    
?>
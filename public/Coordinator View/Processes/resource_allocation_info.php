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

    $selectreportinfo = "SELECT high_schools.school_name, school_inventory.item_code, school_inventory.item_article, school_inventory.item_status, school_inventory.item_date_acquired
    FROM school_inventory 
    JOIN high_schools ON school_inventory.school_id = high_schools.school_id
    WHERE (item_status = 'Need Repair' OR item_status = 'Condemned') AND school_inventory.is_visible = TRUE
    LIMIT $offset, $itemsPerPage";
    
    $totalRowsQuery = "SELECT COUNT(item_code) as total_count
        FROM school_inventory 
        WHERE  (item_status = 'Need Repair' OR item_status = 'Condemned') AND school_inventory.is_visible = TRUE";

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
?>
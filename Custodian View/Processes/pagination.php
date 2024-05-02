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

    $selectinventoryinfo = "SELECT *
        FROM school_inventory 
        JOIN users ON school_inventory.school_id = users.school_id
        WHERE users.school_id = $schoolidtomatch LIMIT $offset, $itemsPerPage";

    $totalRowsQuery = "SELECT COUNT(item_code) as total_count
        FROM school_inventory 
        JOIN users ON school_inventory.school_id = users.school_id
        WHERE users.school_id = $schoolidtomatch";

    $totalRowsResult = mysqli_query($conn, $totalRowsQuery);

    // Fetch the result as an associative array
    $totalRowsArray = mysqli_fetch_assoc($totalRowsResult);

    // Access the value of total_count and store it in a variable
    $totalCount = (int)$totalRowsArray["total_count"];

    // Calculate the total number of pages
    $totalPages = ceil($totalCount / $itemsPerPage);
?>
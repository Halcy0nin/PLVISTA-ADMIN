<?php 
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

   $selectschoolinfo = "SELECT *
        FROM high_schools ORDER BY school_id LIMIT $offset, $itemsPerPage";


    $totalRowsQuery = "SELECT COUNT(school_name) as total_count
        FROM high_schools";

    $totalRowsResult = mysqli_query($conn, $totalRowsQuery);

    // Fetch the result as an associative array
    $totalRowsArray = mysqli_fetch_assoc($totalRowsResult);

    // Access the value of total_count and store it in a variable
    $totalCount = (int)$totalRowsArray["total_count"];

    // Calculate the total number of pages
    $totalPages = ceil($totalCount / $itemsPerPage);


    //make query and get results using the parameters (connection to be used, query to be used)
    $result = mysqli_query($conn, $selectschoolinfo);

    //fetch resulting rows as an array using the parameters (array to be used, MYSQLI_ASSOC)
    $highschools = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //releases results to avoid stacking up memory
    mysqli_free_result($result);

    //empty strings as placeholders before form input
$schoolname = $schoolid = $schoolcontact = $schoolcontactno = $schoolemail = $schooldivision =
"";



    ?>
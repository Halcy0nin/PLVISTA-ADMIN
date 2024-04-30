<?php
include "db_conn_high_school.php";

if(isset($_POST['submitImport'])) {
    $fileName = $_FILES["importData"]["name"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Generate base filename with date
    $baseFileName = date('Y-m-d');
    
    // Initialize counter
    $counter = 1;
    
    // Check if file already exists
    while(file_exists("uploads/$baseFileName($counter).$fileExtension")) {
        $counter++;
    }

    // Append counter to filename if necessary
    if($counter > 1) {
        $newFileName = "$baseFileName($counter).$fileExtension";
    } else {
        $newFileName = "$baseFileName.$fileExtension";
    }

    $targetDirectory = "uploads/" . $newFileName;
    move_uploaded_file($_FILES["importData"]["tmp_name"], $targetDirectory);

    require "excelReader/excel_reader2.php";
    require "excelReader/SpreadsheetReader.php";

    $reader = new SpreadsheetReader($targetDirectory);
    $schoolid = $_POST['inventoryid'];

    // Array to store encountered items
    $encounteredItems = array();

    foreach($reader as $key => $row) {
        $itemarticle = $row[0];
        $itemdesc = $row[1];
        $itemstatus = $row[2];
        $itemfundssource = $row[3];
        $itemdateacquired = $row[4];
        $itemunitvalue = $row[5];
        $itemquantity = $row[6];
        $itemdateadded = $row[7];

        // Combine article and description to create a unique identifier for the item
        $itemIdentifier = $itemarticle . $itemdesc;

        // Check if the item has already been encountered
        if (in_array($itemIdentifier, $encounteredItems)) {
            // Duplicate found, handle accordingly (e.g., skip insertion, log, etc.)
            continue;
        }

        // Add the item to the encountered list
        $encounteredItems[] = $itemIdentifier;

        // Insert the item into the database
        mysqli_query($conn, "INSERT INTO school_inventory (school_id,
            item_article,
            item_desc,
            item_date_acquired,
            item_unit_value,
            item_quantity,
            item_funds_source,
            item_date_input,
            item_status)
            VALUES('$schoolid',
            '$itemarticle',
            '$itemdesc',
            '$itemdateacquired',
            '$itemunitvalue',
            '$itemquantity',
            '$itemfundssource',
            '$itemdateadded',
            '$itemstatus')");
    }

    $redirectURL = "../school_inventory.php?inventoryid=" . urlencode($schoolid) . "&inventoryname=" . urlencode($inventoryname);
    header("Location: $redirectURL");
    exit();
}
?>

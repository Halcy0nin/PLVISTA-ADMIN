<?php
include "db_conn_high_school.php";

// Check if filter value is set
if (isset($_POST["filterValue"])) {
    $filter = $_POST["filterValue"];

    // Construct the query based on the selected filter
    switch ($filter) {
        case "needrepair":
            $filterQuery = "SELECT high_schools.school_name, school_inventory.item_code, school_inventory.item_article, school_inventory.item_status, school_inventory.item_date_acquired
            FROM school_inventory 
            JOIN high_schools ON school_inventory.school_id = high_schools.school_id WHERE school_inventory.item_status = 'Need Repair'";
            break;
        case "condemned":
            $filterQuery = "SELECT high_schools.school_name, school_inventory.item_code, school_inventory.item_article, school_inventory.item_status, school_inventory.item_date_acquired
            FROM school_inventory 
            JOIN high_schools ON school_inventory.school_id = high_schools.school_id WHERE school_inventory.item_status = 'Condemned'";
            break;
        case "all":
            $filterQuery = "SELECT high_schools.school_name, school_inventory.item_code, school_inventory.item_article, school_inventory.item_status, school_inventory.item_date_acquired
            FROM school_inventory 
            JOIN high_schools ON school_inventory.school_id = high_schools.school_id
            WHERE (school_inventory.item_status = 'Need Repair' OR school_inventory.item_status = 'Condemned')";
            break;
        default:
            // Default case if no specific filter is selected
            $filterQuery = "SELECT * FROM school_inventory";
            break;
    }

    
    // Execute the query
    $result = mysqli_query($conn, $filterQuery);
    $rowCount = mysqli_num_rows($result);
    $filteredData = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!--Importing bootstrap styles and icons-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!--Importing jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- Table showing resource allocation info in the database -->
    <table style="margin-left: auto; margin-right: auto;" class="table table-striped centerTable text-center">
    <thead class="thead-light">
        <tr>
            <th scope="col">School</th>
            <th scope="col">Item Code</th>
            <th scope="col">Item Article</th>
            <th scope="col">Status</th>
            <th scope="col">Date Acquired</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php if (is_array($filteredData)) {
        foreach ($filteredData as $report) { ?>
            <tr>
                <td scope="col"><?php echo htmlspecialchars($report["school_name"]); ?></td>
                <td scope="col">SDOVAL-<?php echo htmlspecialchars($report["item_code"]); ?></td>
                <td scope="col"><?php echo htmlspecialchars($report["item_article"]); ?></td>
                <td scope="col"><?php echo htmlspecialchars($report["item_status"]); ?></td>
                <td scope="col"><?php echo htmlspecialchars($report["item_date_acquired"]); ?></td>
                <td>
                    <button type="button" id="deletereport" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteitem<?php echo htmlspecialchars($item["item_code"]); ?>">
                        Reject
                    </button>
                </td>
            </tr>
    <?php } ?>
    </tbody>
</table>

    </div>
</div>
        </div>
    <?php
            }
        }
        else {
            echo "<h3>No results found</h3>";
        }
?>
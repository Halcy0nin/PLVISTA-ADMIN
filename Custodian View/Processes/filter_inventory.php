<?php
    // Connect to database (using the parameters localhost, username, password, and database to be used)
    $conn = mysqli_connect('localhost','root','', 'sdo_high_schools_ict_equipment');

    // Check connection
    if (!$conn) {
        echo 'Connection ERROR: ' . mysqli_connect_error();
    }

    // Check if filter value is set
    if (isset($_POST["filterValue"])) {
        $filter = $_POST["filterValue"];
        $schoolidtomatch = $_POST["schoolidtomatch"];

        // Construct the query based on the selected filter
        switch ($filter) {
            case "working":
                $filterQuery = "SELECT *
                FROM school_inventory 
                JOIN high_schools ON school_inventory.school_id = high_schools.school_id
                WHERE high_schools.school_id = $schoolidtomatch AND item_status = 'Working'";
                break;
            case "needrepair":
                $filterQuery = "SELECT *
                FROM school_inventory 
                JOIN high_schools ON school_inventory.school_id = high_schools.school_id
                WHERE high_schools.school_id = $schoolidtomatch AND item_status = 'Need Repair'";
                break;
            case "condemned":
                $filterQuery = "SELECT *
                FROM school_inventory 
                JOIN high_schools ON school_inventory.school_id = high_schools.school_id
                WHERE high_schools.school_id = $schoolidtomatch AND item_status = 'Condemned'";
                break;
            case "all":
            default:
                // Default case if no specific filter is selected
                $filterQuery = "SELECT *
                FROM school_inventory 
                JOIN high_schools ON school_inventory.school_id = high_schools.school_id
                WHERE high_schools.school_id = $schoolidtomatch";
                break;
        }

        // Execute the query
        $result = mysqli_query($conn, $filterQuery);
        $filteredData = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Check if data is found
        if (!$filteredData) {
            echo "<h3>No results found</h3>";
        }
    }
?>

<!-- Importing bootstrap styles and icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

<!-- Importing jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<div id="tablecontent">
    <table style="width: 1200px; margin-left: 25vw;" class="table table-striped centerTable">
        <thead class="thead-light">
            <tr>
                <th scope="col">Item Code</th>
                <th scope="col">Item Article</th>
                <th scope="col">Description</th>
                <th scope="col">Date Acquired</th>
                <th scope="col">Unit Value</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Value</th>
                <th scope="col">Source of Funds</th>
                <th scope="col">Last Updated</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (isset($filteredData)) {
                foreach ($filteredData as $item) {
                    $qty = $item["item_quantity"] * $item["item_unit_value"];
                    $itemtotalvalue = number_format($qty, 2);
            ?>
            <tr>
                <td><?php echo "SDOVAL-" . htmlspecialchars($item["item_code"]); ?></td>
                <td><?php echo htmlspecialchars($item["item_article"]); ?></td>
                <td><?php echo htmlspecialchars($item["item_desc"]); ?></td>
                <td><?php echo htmlspecialchars($item["item_date_acquired"]); ?></td>
                <td><?php echo "PHP " . htmlspecialchars($item["item_unit_value"]); ?></td>
                <td><?php echo htmlspecialchars($item["item_quantity"]); ?></td>
                <td><?php echo "PHP " . htmlspecialchars($itemtotalvalue); ?></td>
                <td><?php echo htmlspecialchars($item["item_funds_source"]); ?></td>
                <td><?php echo htmlspecialchars($item["item_date_input"]); ?></td>
                <td><?php echo htmlspecialchars($item["item_status"]); ?></td>
                <td>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#workingitem<?php echo $item["item_code"]; ?>">
                        Working
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#repairitem<?php echo $item["item_code"]; ?>">
                        Need Repair
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#condemneditem<?php echo $item["item_code"]; ?>">
                        Condemned
                    </button>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modals for status update -->
<?php
if (isset($filteredData)) {
    foreach ($filteredData as $item) {
?>
    <!-- Pop-up form for working item -->
    <div class="modal fade" id="workingitem<?php echo $item["item_code"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="workingitemLabel" aria-hidden="true">
        <!-- Modal content will be here -->
    </div>

    <!-- Pop-up form for repair item -->
    <div class="modal fade" id="repairitem<?php echo $item["item_code"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="repairitemLabel" aria-hidden="true">
        <!-- Modal content will be here -->
    </div>

    <!-- Pop-up form for condemned item -->
    <div class="modal fade" id="condemneditem<?php echo $item["item_code"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="condemneditemLabel" aria-hidden="true">
        <!-- Modal content will be here -->
    </div>
<?php
    }
}
?>

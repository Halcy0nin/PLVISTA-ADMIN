<?php
include "Processes/db_conn_high_school.php";
include "Processes/resource_allocation_info.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title></title>
<!-- CSS FILES -->
    <link href="../Coordinator View/assets/css/bootstrap.css" rel="stylesheet">
    <link href="../Coordinator View/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Coordinator View/assets/css/resource_allocation.css" rel="stylesheet">
    <link href="../Coordinator View/assets/css/modal.css" rel="stylesheet">



  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <!--Importing jquery-->
   <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>

<div class="container">
<nav class="sidebar">
    <div class="menu">
  
      <div class="main-menu">
  
        <div class="logo">
        <a href="#" class="SDOlogo"><img src="sdo.png"></a>
        </div>
  
      <div class="menu-content">
      <ul class="menu-items">
        <div class="menu-title">ICT Resource Management System</div>
        <li class="item">
          <a href="dashboard_content.php">
          <i class="bi bi-bar-chart-fill"></i>Dashboard</a>
        </li>
        <li class="item">
          <a href="resource_allocation_content.php">
          <i class="bi bi-pie-chart-fill"></i>Resource Allocation</a>
        </li>
        <li class="item">
          <a href="school_content.php">
          <i class="bi bi-building-fill"></i>Schools</a>
        </li>
        <li class="item">
          <a href="manage_users_content.php">
          <i class="bi bi-person-vcard-fill"></i>Manage Users</a>
        </li>
        <li class="item">
          <a href="profile_content.php">
          <i class="bi bi-person-circle"></i>Profile</a>
        </li>
        <li class="item">
          <a href="login.php">
          <i class="bi bi-box-arrow-in-left"></i>Log Out</a>
        </li>
      </ul>
    </div>
          </div>
        </div>
     </nav>

    
    <div class="content">
        <h3 class = "mx-3">Resource Allocation</h3>
        <br>

        <!--dropdown filter -->
        <div>
            <div class="container d-flex">
    <div class="dropdown">
        <button style="margin-left: 10%;" class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Filter
        </button>
        <ul class="dropdown-menu rounded" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#" data-value="all">Show All</a></li>
            <li><a class="dropdown-item" href="#" data-value="needrepair">Need Repair</a></li>
            <li><a class="dropdown-item" href="#" data-value="condemned">Condemned</a></li>
        </ul>
    </div>
</div>
        
        <!-- export button -->
<div class="col">
    <div class="container d-flex justify-content-end">
        <!-- export data button -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportReport">
            Export
        </button>

        <!-- modal before exporting data -->
        <div class="modal fade" id="exportReport" tabindex="-1" aria-labelledby="exportReportLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exportReportLabel">Export Resource Allocation Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to export this data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <form action = "Processes/export_allocation_excel.php" method = "POST">
                        <button type="submit" name = "exportExcel" class="btn btn-primary">Save as spreadsheet</button>
                        </form>
                        <form action = "Processes/export_allocation_pdf.php" method = "POST">
                        <button type="submit" name = "exportPDF" class="btn btn-primary">Save as PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div id = "tablecontent">
    <div class = "container mt-5">
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
    <?php if (is_array($reports)) {
        foreach ($reports as $report) { ?>
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


            <div class = "container d-flex justify-content-end">
            <nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="resource_allocation_content.php?page=<?php echo max($current_page - 1, 1); ?>">Previous</a>
        </li>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item">
                <a class="page-link" href="resource_allocation_content.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <li class="page-item">
            <a class="page-link" href="resource_allocation_content.php?page=<?php echo min($current_page + 1, $totalPages); ?>">Next</a>
        </li>
    </ul>
</nav>
            </div>
    </div>
</div>
        </div>

        <script>
    $(document).ready(function() {
        // Function to handle dropdown item selection
        $(".dropdown-item").on("click", function() {
            var selectedValue = $(this).data("value"); // Get the value from data-value attribute
            // Hide the table while loading
            $("#tablecontent").hide();
            // Send AJAX request
            $.ajax({
                url: "Processes/filter_allocation.php", // Path to your PHP file
                method: "POST",
                data: { filterValue: selectedValue }, // Data to send
                success: function(response) {
                    // Handle success response
                    $("#tablecontent").html(response); // Update table with filtered data
                    $("#tablecontent").show(); // Show the table again
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- JS FILES -->
    <script src="../Coordinator View/assets/js/bootstrap.bundle.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.min.js"></script>
  
    <?php } ?>
</body>


</html>
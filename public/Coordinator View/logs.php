<?php
include "db_conn_high_school.php";
include "Processes/show_activity_logs.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Activity Logs</title>
    <link href="../Coordinator View/assets/css/resource_allocation.css" rel="stylesheet">
    <link href="../Coordinator View/assets/css/modal.css" rel="stylesheet">
    <?php include "head.php";?>
</head>

<body>

<div class="container">
<?php include "sidebar.php";?>

    
    <div class="content">
        <h3 class = "mx-3">Activity Logs</h3>
        <br>
            <!-- search bar -->
            <div class = "container d-flex">
                <div style = "width:260px; margin-left: 0vw;" class="input-group rounded">
                    <input  type="text" id = "searchschool" name = "searchschool" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
</div>

<div id = "tablecontent">
    <div class = "container mt-5">
        <!-- Table showing resource allocation info in the database -->
        <table style="margin-left: 0.5vw;" class="table table-striped centerTable text-center">
    <thead class="thead-light">
        <tr>
            <th scope="col">User Id</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col">Details</th>
            <th scope="col">Location Visited</th>
            <th scope="col">Session Start</th>
            <th scope="col">Session End</th>
            <th scope="col">Total Session Time</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($logs as $log) { ?>
        <tr>
            <td><?php echo htmlspecialchars($log["user_id"]); ?></td>
            <td><?php echo htmlspecialchars($log["name"]); ?></td>
            <td><?php echo htmlspecialchars($log["role"]); ?></td>
            <td><?php echo htmlspecialchars($log["activity_details"]); ?></td>
            <td><?php echo htmlspecialchars($log["location"]); ?></td>
            <td><?php echo htmlspecialchars(date("M j, Y g:i A", strtotime($log["session_start"]))); ?></td>
            <td><?php echo htmlspecialchars(date("M j, Y g:i A", strtotime($log["session_end"]))); ?></td>
            <td>
                <?php
                // Convert session start and end times to timestamps
                $sessionStart = strtotime($log["session_start"]);
                $sessionEnd = strtotime($log["session_end"]);
                
                // Calculate the difference in seconds
                $sessionTimeInSeconds = $sessionEnd - $sessionStart;

                // Format the difference into hours, minutes, and seconds
                $hours = floor($sessionTimeInSeconds / 3600);
                $minutes = floor(($sessionTimeInSeconds % 3600) / 60);
                $seconds = $sessionTimeInSeconds % 60;

                // Display the formatted session time
                echo sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- JS FILES -->
    <script src="../Coordinator View/assets/js/bootstrap.bundle.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.min.js"></script>
</body>


</html>
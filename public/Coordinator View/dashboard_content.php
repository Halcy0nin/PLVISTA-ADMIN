<?php

include "db_conn_high_school.php";
include "Processes/show_announcements.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php";?>
    <title>Dashboard</title>

    <link href="../Coordinator View/assets/css/dashboard.css" rel="stylesheet">

  <!--Charts.JS-->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<?php include "sidebar.php";?>

    <div class = "content">

    <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        
                    </div>

                    <div class="col">
                       
                    </div>
                </div>
            </div>
        
            <div class="container">
                <div style="margin-left:3vw; margin-bottom:7vh; height: 11vh;" class="card">
                    <div id="totalNumCard" class="card-body">
                        <h1 class="card-title">Active Users</h1>
                        <?php
                        $totalitemcount = 'SELECT 
                                            COUNT(DISTINCT al.user_id) AS total_count
                                        FROM 
                                            activity_logs al
                                        WHERE 
                                            al.session_start IS NOT NULL
                                            AND (al.session_end IS NULL OR al.session_end > NOW());
                                        ';
                        
                        // Make query and get results using the parameters (connection to be used, query to be used)
                        $result = mysqli_query($conn, $totalitemcount);
                        
                        // Fetch the result as an associative array
                        $row = mysqli_fetch_assoc($result);
                        
                        // Store the total count in a variable
                        $totalItemCount = $row['total_count'];
                        
                        // Release the result to avoid stacking up memory
                        mysqli_free_result($result);
                        
                        ?>

                        <h2 class="card-text"><?php echo $totalItemCount; ?></h2>
                        <script>
                            $('.filter-option').on('click', function(){
                            var selectedValue = $(this).data('value');
                            console.log("Selected value:", selectedValue);
                            updateCardText(selectedValue);
                        });
                        </script>
                    </div>
                </div>
            </div>

                <div style="margin-left:34.4vw; margin-top:-20.7vh; height: 11vh;" class="card">
                    <div id="totalWorkingCard" class="card-body">
                        <h4 class="card-title">Total Visits This Month</h4>
                        <?php
                        $totalVisitsMonth = 'SELECT COUNT(created_at) as total_count
                                          FROM activity_logs WHERE created_at <= NOW()';
                        
                        // Make query and get results using the parameters (connection to be used, query to be used)
                        $result = mysqli_query($conn, $totalVisitsMonth);
                        
                        // Fetch the result as an associative array
                        $row = mysqli_fetch_assoc($result);
                        
                        // Store the total count in a variable
                        $totalVisitsMonth = $row['total_count'];
                        
                        // Release the result to avoid stacking up memory
                        mysqli_free_result($result);
                        
                        ?>
                        <h2 class="card-text"><?php echo $totalVisitsMonth; ?></h2>
                        <script>
                            $('.filter-option').on('click', function(){
                            var selectedValue = $(this).data('value');
                            console.log("Selected value:", selectedValue);
                            updateCardText(selectedValue);
                        });
                        </script>
                    </div>
                </div>
            </div>

                <div style="margin-left:52.4vw; margin-top:-16.5vh; height: 11vh;" class="card">
                    <div id="totalRepairCard"class="card-body">
                        <h4 class="card-title">Average Session Time</h4>
                        <?php
                        $averageSessionTime = 'SELECT 
                        SEC_TO_TIME(AVG(TIMESTAMPDIFF(SECOND, session_start, session_end))) AS average_session_time
                    FROM 
                        activity_logs
                    WHERE 
                        session_end IS NOT NULL;
                        ';
                        
                        // Make query and get results using the parameters (connection to be used, query to be used)
                        $result = mysqli_query($conn, $averageSessionTime);
                        
                        // Fetch the result as an associative array
                        $row = mysqli_fetch_assoc($result);
                        
                        // Store the total count in a variable
                        $averageSessionTime = $row['average_session_time'];
                        
                        list($hours, $minutes, $seconds) = explode(':', $averageSessionTime);
                        $humanReadableTime = "{$hours}:{$minutes}";

                        // Release the result to avoid stacking up memory
                        mysqli_free_result($result);
                        
                        ?>
                        <h2 class="card-text"><?php echo $humanReadableTime; ?></h2>
                        <script>
                            $('.filter-option').on('click', function(){
                            var selectedValue = $(this).data('value');
                            console.log("Selected value:", selectedValue);
                            updateCardText(selectedValue);
                        });
                        </script>
                    </div>
                </div>
            </div>
                <div style="margin-left:70.6vw; margin-top:-16.5vh;height: 11vh;" class="card">
                    <div id="totalCondemnedCard" class="card-body">
                        <h4 class="card-title">Total Users</h4>
                        <?php
                        $totalUserCount = 'SELECT COUNT(student_id) as total_count
                                          FROM users WHERE student_id IS NOT NULL';
                        
                        // Make query and get results using the parameters (connection to be used, query to be used)
                        $result = mysqli_query($conn, $totalUserCount);
                        
                        // Fetch the result as an associative array
                        $row = mysqli_fetch_assoc($result);
                        
                        // Store the total count in a variable
                        $totalUsers = $row['total_count'];
                        
                        // Release the result to avoid stacking up memory
                        mysqli_free_result($result);
                        
                        ?>
                         <h2 class="card-text"><?php echo $totalUsers; ?></h2>
                         <script>
                            $('.filter-option').on('click', function(){
                            var selectedValue = $(this).data('value');
                            console.log("Selected value:", selectedValue);
                            updateCardText(selectedValue);
                        });
                        </script>
                    </div>
                </div>
                
                <!-- BAR CHART CARD -->
                <div style="margin-left: 19.5vw; margin-top: 4vh; width: 65vw; height: 20vw; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 20px;" class="cards">
                    <div id="barCard" class="cards-body">
                    <h6 style="text-align:right; font-weight: bold; font-size: 1.5em; color: #343a40; margin-bottom:20px"><b>Most Visited Locations</b></h6>
                        <canvas id="barChart" style="width: 100%; height: 20vw;"></canvas>

                        <?php
                        $query = 'SELECT location, COUNT(location) AS count FROM activity_logs GROUP BY location HAVING COUNT(location) > 0';
                        $result = mysqli_query($conn, $query);

                        $labels = [];
                        $data = [];

                        while ($row = mysqli_fetch_assoc($result)) {
                            $labels[] = $row['location'];
                            $data[] = $row['count'];
                        }
                        ?>
                        <script>
                            var labels = <?php echo json_encode($labels); ?>;
                            var data = <?php echo json_encode($data); ?>;

                            var config = {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'No. of Visits',
                                        data: data,
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Optional: Set the bar color
                                        borderColor: 'rgba(75, 192, 192, 1)', // Optional: Set the border color
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    indexAxis: 'y', // Set to 'y' for horizontal bar chart
                                    responsive: true,
                                    maintainAspectRatio: false, // Allow the chart to use the full height of the canvas
                                    scales: {
                                        x: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            };

                            var barChart = new Chart(document.getElementById('barChart'), config);

                            $('.filter-option').on('click', function() {
                                var selectedValue = $(this).data('value');
                                console.log("Selected value:", selectedValue);
                                updateBar(selectedValue);
                            });
                        </script>
                    </div>
                        </div>

                        <div style="margin-left: 19.4vw; margin-top: 1vh; width: 65vw; height: auto; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 20px;" class="cards">
                            <div style="text-align:right; margin-bottom: 15px;">
                                <h6 style="font-weight: bold; font-size: 1.5em; color: #343a40;">Announcements and Events</h6>
                            </div>
                            <div id="announcements" class="cards-body" style="overflow-y: auto; max-height: 30vh; border: 1px solid #dee2e6; border-radius: 5px; background-color: #ffffff; padding: 10px;">
                                <?php foreach ($announcements as $announcement) { ?>
                                    <div style="position: relative; margin-bottom: 10px; padding: 10px; border: 1px solid #e0e0e0; border-radius: 5px; background-color: #f1f1f1;">
                                        <h6 style="margin: 0; font-size: 1.2em; color: #495057;"><?php echo $announcement['title']; ?></h6>
                                        <p style="margin: 5px 0; color: #6c757d;"><?php echo $announcement['content']; ?></p>
                                        <span style="position: absolute; top: 10px; right: 10px; font-size: 0.9em; color: #6c757d;"><?php echo date('F j, Y', strtotime($announcement['start_date'])); ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
            </div>
        </div>
    </div>

<script>
//ALL FUNCTIONS TO UPDATE CHARTS AND INFO

function updateCardText(selectedValue) {
    // Send AJAX request to the server
    $.ajax({
        url: 'Processes/filter_card_data.php', // URL to your PHP script
        method: 'POST',
        data: { selectedValue: selectedValue },
        success: function(response) {
            console.log("Response from server:", response); // Log the response
            
            // Parse the response JSON
            var responseData = JSON.parse(response);
            
            // Check if the response contains data
            if (responseData.totalCount !== undefined && responseData.workingCount !== undefined && responseData.repairCount !== undefined && responseData.condemnedCount !== undefined) {
                // Update card text
                $('#totalNumCard h2').text(responseData.totalCount);
                $('#totalWorkingCard h2').text(responseData.workingCount);
                $('#totalRepairCard h2').text(responseData.repairCount);
                $('#totalCondemnedCard h2').text(responseData.condemnedCount);
                console.log("Card text updated successfully.");
            } else {
                console.error("Incomplete data received from server.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
}


function updateBar(selectedValue) {
    // Send AJAX request to the server
    $.ajax({
        url: 'Processes/filter_barchart.php', // URL to your PHP script
        method: 'POST',
        data: { selectedValue: selectedValue },
        success: function(response) {
            console.log("Response from server:", response); // Log the response
            
            // Parse the response JSON
            var responseData = JSON.parse(response);
            
            // Check if the response contains data
            if (responseData.data) {
                // Update chart data
                barChart.data.labels = responseData.labels;
                barChart.data.datasets[0].data = responseData.data;
                barChart.update();
                console.log("Chart data updated successfully.");
            } else {
                console.error("No data received from server.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
}

function updatePie(selectedValue) {
    // Send AJAX request to the server
    $.ajax({
        url: 'Processes/filter_piechart.php', // URL to your PHP script
        method: 'POST',
        data: { selectedValue: selectedValue },
        success: function(response) {
            console.log("Response from server:", response); // Log the response
            
            // Parse the response JSON
            var responseData = JSON.parse(response);
            
            // Check if the response contains data
            if (responseData.data) {
                // Update chart data
                pieChart.data.labels = responseData.labels;
                pieChart.data.datasets[0].data = responseData.data;
                pieChart.update();
                console.log("Chart data updated successfully.");
            } else {
                console.error("No data received from server.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
}

function updateLine(selectedValue) {
    // Send AJAX request to the server
    $.ajax({
        url: 'Processes/filter_linechart.php', // URL to your PHP script
        method: 'POST',
        data: { selectedValue: selectedValue },
        success: function(response) {
            console.log("Response from server:", response); // Log the response
            
            // Parse the response JSON
            var responseData = JSON.parse(response);
            
            // Check if the response contains data
            if (responseData.data) {
                // Update chart data
                lineChart.data.datasets[0].data = responseData.data;
                lineChart.update();
                console.log("Chart data updated successfully.");
            } else {
                console.error("No data received from server.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
}

</script>


    <!-- JS FILES -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.min.js"></script>


</body>
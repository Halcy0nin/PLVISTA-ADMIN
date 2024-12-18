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
                        <h1 class="card-title">Total Number Of Users </h1>
                        <?php
                        $totalitemcount = "SELECT COUNT(*) AS total_count FROM users WHERE is_archived = 0;
                        ";
                        
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
                    <h4 class="card-title">Peak Usage Time</h4>
                        <?php
                        // SQL Query to get peak usage hour
                        $peakUsageTimeQuery = "
                            SELECT 
                                HOUR(session_start) AS peak_hour,
                                COUNT(*) AS session_count
                            FROM 
                                activity_logs
                            WHERE 
                                session_start IS NOT NULL
                            GROUP BY 
                                peak_hour
                            ORDER BY 
                                session_count DESC
                            LIMIT 1;
                        ";
                        
                        // Execute the query
                        $result = mysqli_query($conn, $peakUsageTimeQuery);
                        
                        // Check if query execution was successful and returned a result
                        if ($result && mysqli_num_rows($result) > 0) {
                            // Fetch the row as an associative array
                            $row = mysqli_fetch_assoc($result);

                            // Retrieve the peak hour
                            $peakHour = $row['peak_hour'];

                            // Convert the hour to a human-readable format (e.g., 14 -> 2 PM)
                            $humanReadableTime = date("g A", strtotime("$peakHour:00:00"));
                        } else {
                            // Default message if no data is found or an error occurs
                            $humanReadableTime = "No Data";
                        }

                        // Free result memory
                        mysqli_free_result($result);
                        ?>
                        <!-- Display the peak usage time -->
                        <h2 class="card-text"><?php echo $humanReadableTime; ?></h2>

                        <script>
                            // Example: JavaScript for handling additional logic
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
                
                <!-- CHARTS CONTAINER -->
                <div style="display: flex; justify-content: space-between; margin-top: 4vh; padding: 0 19.5vw; gap: 2vw;">

                    <!-- MOST VISITED LOCATIONS CHART -->
                    <div style="flex: 1; height:20vw; width:45vw; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 20px;" class="cards">
                        <div id="barCard" class="cards-body">
                            <h6 style="text-align:right; font-weight: bold; font-size: 1.5em; color: #343a40; margin-bottom:20px"><b>Most Searched Locations</b></h6>
                            <canvas id="barChartLocations" style="width: 100%; height: 20vw;"></canvas>

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
                                var labelsLocations = <?php echo json_encode($labels); ?>;
                                var dataLocations = <?php echo json_encode($data); ?>;

                                var configLocations = {
                                    type: 'bar',
                                    data: {
                                        labels: labelsLocations,
                                        datasets: [{
                                            label: 'No. of Visits',
                                            data: dataLocations,
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        indexAxis: 'x',
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                };

                                var barChartLocations = new Chart(document.getElementById('barChartLocations'), configLocations);
                            </script>
                        </div>
                    </div>

                    <!-- AVERAGE MONTHLY USERS CHART -->
                    <div style="flex: 1; height:20vw; width:45vw; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 20px;" class="cards">
                        <div id="barCard" class="cards-body">
                            <h6 style="text-align:right; font-weight: bold; font-size: 1.5em; color: #343a40; margin-bottom:20px"><b>Average Monthly Users</b></h6>
                            <canvas id="barChartUsers" style="width: 100%; height: 20vw;"></canvas>

                            <?php
                            $query = 'SELECT 
                                        DATE_FORMAT(created_at, "%Y-%m") AS month, 
                                        COUNT(DISTINCT user_id) AS user_count 
                                    FROM 
                                        activity_logs 
                                    WHERE 
                                        created_at IS NOT NULL 
                                    GROUP BY 
                                        DATE_FORMAT(created_at, "%Y-%m")
                                    ORDER BY 
                                        month ASC';

                            $result = mysqli_query($conn, $query);

                            $labels = [];
                            $data = [];

                            while ($row = mysqli_fetch_assoc($result)) {
                                $month = DateTime::createFromFormat('Y-m', $row['month']);
                                $labels[] = $month->format('F');
                                $data[] = $row['user_count'];
                            }
                            ?>
                            <script>
                                var labelsUsers = <?php echo json_encode($labels); ?>;
                                var dataUsers = <?php echo json_encode($data); ?>;

                                var configUsers = {
                                    type: 'bar',
                                    data: {
                                        labels: labelsUsers,
                                        datasets: [{
                                            label: 'Average Monthly Users',
                                            data: dataUsers,
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Number of Users'
                                                }
                                            },
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Month'
                                                }
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: true,
                                                position: 'top'
                                            }
                                        }
                                    }
                                };

                                var barChartUsers = new Chart(document.getElementById('barChartUsers'), configUsers);
                            </script>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; margin-top: 4vh; padding: 0 19.5vw; gap: 2vw;">

                <!-- MOST VISITED LOCATIONS CHART -->
                <div style="flex: 1; height:20vw; width:45vw; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 20px;" class="cards">
                    <div id="barCard" class="cards-body">
                    <div class="chart-container">
                        <canvas id="myBarChart"></canvas>
                    </div>

                    <script>
                        // Sample data for the bar chart
                        const labels = ['1', '2', '3', '4', '5'];
                        const data = {
                            labels: labels,
                            datasets: [{
                                label: 'Number of Votes',
                                data: [12, 19, 3, 5, 2], // Sample data points
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        };

                        const config = {
                            type: 'bar',
                            data: data,
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Number of Votes'
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Scores'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    },
                                    title: {
                                        display: true,
                                        text: 'Rating Results'
                                    }
                                }
                            }
                        };

                        // Render the chart
                        const myBarChart = new Chart(
                            document.getElementById('myBarChart'),
                            config
                        );
                    </script>
                    </div>
                </div>


                        <div style="margin-left: 19.4vw; margin-top: 1vh; width: 65vw; height: auto; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 20px;" class="cards">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 style="font-weight: bold; font-size: 1.5em; color: #343a40;">Announcements and Events</h6>
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="announcementActions" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="announcementActions">
                                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">Create Announcement</button></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="announcements" class="cards-body" style="overflow-y: auto; max-height: 30vh; border: 1px solid #dee2e6; border-radius: 5px; background-color: #ffffff; padding: 10px;">
                                <?php foreach ($announcements as $announcement) { ?>
                                    <div style="position: relative; margin-bottom: 10px; padding: 10px; border: 1px solid #e0e0e0; border-radius: 5px; background-color: #f1f1f1;">
                                        <h6 style="margin: 0; font-size: 1.2em; color: #495057;"><?php echo htmlspecialchars($announcement['title']); ?></h6>
                                        <p style="margin: 5px 0; color: #6c757d;"><?php echo htmlspecialchars($announcement['content']); ?></p>
                                        <span style="position: absolute; top: 10px; right: 10px; font-size: 0.9em; color: #6c757d;"><?php echo date('F j, Y', strtotime($announcement['start_date'])); ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Modal for Creating Announcement -->
                        <div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="Processes/create_announcement.php" method="POST">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="announcementTitle" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="announcementTitle" name="title" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="announcementContent" class="form-label">Content</label>
                                                <textarea class="form-control" id="announcementContent" name="content" rows="3" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="startDate" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" id="startDate" name="start_date" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="enddate" class="form-label">End Date</label>
                                                <input type="date" class="form-control" id="enddate" name="end_date" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="category" class="form-label">Category</label><br>
                                                <select id="category" name="category">
                                                    <option value="General"> General </option>
                                                    <option value="Event"> Event</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>
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
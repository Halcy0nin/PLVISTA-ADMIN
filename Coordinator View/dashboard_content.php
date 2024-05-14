<?php

include "Processes/db_conn_high_school.php";

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
    <link href="../Coordinator View/assets/css/dashboard.css" rel="stylesheet">



  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!--Charts.JS-->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!--Importing jquery-->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
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

    <div class = "content">

    <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div style="margin-left:3vw; margin-top:0vh;" class="dropdown">
                            <button style="width: 10vw; margin-left: 14vw;" class="btn btn-outline-secondary dropdown-toggle d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButtonDate" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Date</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonDate">
                                <!-- Dropdown items here -->
                            </ul>
                        </div>
                    </div>

                    <div class="col">
                        <div style="margin-left:4vw; margin-top:0vh;" class="dropdown">
                            <button style="width: 10vw; margin-left: -23vw;" class="btn btn-outline-secondary dropdown-toggle d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButtonSchool" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>School</span>
                            </button>
                            <?php 
                            $schoolQuery = "SELECT * FROM high_schools";
                            $schoolResult = mysqli_query($conn, $schoolQuery);
                            ?>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonSchool">
                                <li><a class="dropdown-item filter-option" href="#" data-value="showAll">Show All</a></li>
                                <?php
                                // Check if there are any schools in the database
                                if (mysqli_num_rows($schoolResult) > 0) {
                                    // Loop through each row of school data
                                    while ($row = mysqli_fetch_assoc($schoolResult)) {
                                        // Output a dropdown item for each school
                                        echo '<li><a class="dropdown-item filter-option" href="#" data-value="' . $row['school_name'] . '">' . $row['school_name'] . '</a></li>';
                                    }
                                } else {
                                    // If no schools found, display a default message
                                    echo '<li><a class="dropdown-item" href="#">No schools found</a></li>';
                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        
            <div class="container">
                <div style="margin-left:3vw; margin-top:1vh;" class="card">
                    <div id="totalNumCard" class="card-body">
                        <h4 class="card-title">Total No. of Equipment</h4>
                        <?php
                        $totalitemcount = 'SELECT COUNT(item_code) as total_count
                                          FROM school_inventory';
                        
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

                <div style="margin-left:34.4vw; margin-top:-14.3vh;" class="card">
                    <div id="totalWorkingCard" class="card-body">
                        <h4 class="card-title">Working</h4>
                        <?php
                        $totalworkingitemcount = 'SELECT COUNT(item_code) as total_count
                                          FROM school_inventory WHERE item_status = "Working"';
                        
                        // Make query and get results using the parameters (connection to be used, query to be used)
                        $result = mysqli_query($conn, $totalworkingitemcount);
                        
                        // Fetch the result as an associative array
                        $row = mysqli_fetch_assoc($result);
                        
                        // Store the total count in a variable
                        $totalWorkingItems = $row['total_count'];
                        
                        // Release the result to avoid stacking up memory
                        mysqli_free_result($result);
                        
                        ?>
                        <h2 class="card-text"><?php echo $totalWorkingItems; ?></h2>
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

                <div style="margin-left:52.4vw; margin-top:-14.4vh;" class="card">
                    <div id="totalRepairCard"class="card-body">
                        <h4 class="card-title">Need Repair</h4>
                        <?php
                        $totalneedrepairitemcount = 'SELECT COUNT(item_code) as total_count
                                          FROM school_inventory WHERE item_status = "Need Repair"';
                        
                        // Make query and get results using the parameters (connection to be used, query to be used)
                        $result = mysqli_query($conn, $totalneedrepairitemcount);
                        
                        // Fetch the result as an associative array
                        $row = mysqli_fetch_assoc($result);
                        
                        // Store the total count in a variable
                        $totalNeedRepairItems = $row['total_count'];
                        
                        // Release the result to avoid stacking up memory
                        mysqli_free_result($result);
                        
                        ?>
                        <h2 class="card-text"><?php echo $totalNeedRepairItems; ?></h2>
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
                <div style="margin-left:70.6vw; margin-top:-14.4vh;" class="card">
                    <div id="totalCondemnedCard" class="card-body">
                        <h4 class="card-title">Condemned</h4>
                        <?php
                        $totalcondemneditemcount = 'SELECT COUNT(item_code) as total_count
                                          FROM school_inventory WHERE item_status = "Condemned"';
                        
                        // Make query and get results using the parameters (connection to be used, query to be used)
                        $result = mysqli_query($conn, $totalcondemneditemcount);
                        
                        // Fetch the result as an associative array
                        $row = mysqli_fetch_assoc($result);
                        
                        // Store the total count in a variable
                        $totalCondemnedItems = $row['total_count'];
                        
                        // Release the result to avoid stacking up memory
                        mysqli_free_result($result);
                        
                        ?>
                         <h2 class="card-text"><?php echo $totalCondemnedItems; ?></h2>
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
                <div style="margin-left:19.5vw; margin-top:2.5vh; width:45.2vw;height:35vh;" class="cards">
                    <div id="barCard" class="cards-body">
                        <canvas id="barChart"></canvas>

                        <?php

                        $query = 'SELECT item_article, COUNT(item_article) AS count FROM school_inventory GROUP BY item_article HAVING COUNT(item_article) > 0';
                        $result = mysqli_query($conn, $query);

                        $labels = [];
                        $data = [];

                        while ($row = mysqli_fetch_assoc($result)) {
                            $labels[] = $row['item_article'];
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
                                            label: 'No. of Items',
                                            axis: 'y',
                                            data: data,
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        indexAxis: 'y'
                                    }
                                };
                    
                                var barChart = new Chart(document.getElementById('barChart'), config);

                                $('.filter-option').on('click', function(){
                                var selectedValue = $(this).data('value');
                                console.log("Selected value:", selectedValue);
                                updateBar(selectedValue);

                                });
                            </script>
                    </div>
                </div>

                <!-- STATUS  CARD -->
                <div id="statusCard" style="margin-left:66.7vw; margin-top:-37vh; width:19vw;height:35vh;" class="cards">
                    <div class="circle">
                    <?php
                    // Query to get total count of working items
                    $totalWorkingItemCountQuery = 'SELECT COUNT(item_article) as total_count FROM school_inventory WHERE item_status = "Working"';
                    $resultWorking = mysqli_query($conn, $totalWorkingItemCountQuery);
                    $rowWorking = mysqli_fetch_assoc($resultWorking);
                    $totalWorkingItems = $rowWorking['total_count'];
                    mysqli_free_result($resultWorking);

                    // Query to get total count of items needing repair or condemned
                    $totalNeedRepairOrCondemnedItemCountQuery = 'SELECT COUNT(item_article) as total_count FROM school_inventory WHERE item_status = "Need Repair" OR item_status = "Condemned"';
                    $resultRepairOrCondemned = mysqli_query($conn, $totalNeedRepairOrCondemnedItemCountQuery);
                    $rowRepairOrCondemned = mysqli_fetch_assoc($resultRepairOrCondemned);
                    $totalRepairOrCondemnedItems = $rowRepairOrCondemned['total_count'];
                    mysqli_free_result($resultRepairOrCondemned);
                    ?>

                        <span class="check-icon">&#10003;</span>
                        <span class="red-icon">&#33;</span>
                        <span class="exclamation-icon">&#33;</span>
                        
                        <script>
                        // Function to update the transition based on the percentage
                            function TransitionTrigger() {
                                if (<?php echo $totalWorkingItems; ?> < <?php echo $totalRepairOrCondemnedItems; ?>) {
                                    document.querySelector('.check-icon').style.opacity = '0';
                                    document.querySelector('.red-icon').style.opacity = '1';
                                    document.querySelector('.exclamation-icon').style.opacity = '0'; 
                                    document.querySelector('.circle').classList.add('red-mark');
                                    document.querySelector('.circle').classList.remove('yellow-mark');
                                } else if (<?php echo $totalWorkingItems; ?> === <?php echo $totalRepairOrCondemnedItems; ?>) {
                                    document.querySelector('.check-icon').style.opacity = '0';
                                    document.querySelector('.red-icon').style.opacity = '0';
                                    document.querySelector('.exclamation-icon').style.opacity = '1'; 
                                    document.querySelector('.circle').classList.remove('red-mark');
                                    document.querySelector('.circle').classList.add('yellow-mark');
                                } else if (<?php echo $totalWorkingItems; ?> > <?php echo $totalRepairOrCondemnedItems; ?>) {
                                    document.querySelector('.check-icon').style.opacity = '1';
                                    document.querySelector('.check-icon').classList.remove('yellow-mark');
                                    document.querySelector('.red-icon').style.opacity = '0';
                                    document.querySelector('.exclamation-icon').style.opacity = '0';
                                    document.querySelector('.circle').classList.remove('red-mark');
                                    document.querySelector('.circle').classList.remove('yellow-mark');
                                }
                            }
                            TransitionTrigger();

                        </script>
                        
                    </div>
                </div>

                <!-- PIE CHART CARD -->
                <div style="margin-left:19.4vw; margin-top:1vh; width:25vw;height:36vh;" class="cards">
                    <div id="pieCard" class="cards-body">
                    <canvas id="pieChart"></canvas>

                    <?php

                    $query = 'SELECT item_article, COUNT(item_article) AS count FROM school_inventory GROUP BY item_article HAVING COUNT(item_article) > 0';
                    $result = mysqli_query($conn, $query);

                    $labels = [];
                    $data = [];

                    while ($row = mysqli_fetch_assoc($result)) {
                        $labels[] = $row['item_article'];
                        $data[] = $row['count'];
                    }
                    ?>
                        <script>
                            var labels = <?php echo json_encode($labels); ?>;
                            var data = <?php echo json_encode($data); ?>;

                            var config = {
                                type: 'doughnut',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'No. of Items',
                                        axis: 'y',
                                        data: data,
                                        hoverOffset: 4
                                    }]
                                },
                                options: {
                                }
                            };

                            var pieChart = new Chart(document.getElementById('pieChart'), config);

                            $('.filter-option').on('click', function(){
                                var selectedValue = $(this).data('value');
                                console.log("Selected value:", selectedValue);
                                updatePie(selectedValue);

                                });
                        </script>
                    </div>
                </div>

                <!-- LINE GRAPH CARD -->
                <div style="margin-left:46vw; margin-top:-38.1vh; width:39.8vw;height:36vh;" class="cards">
                    <div id="lineCard" class="cards-body">
                    <canvas id="lineChart"></canvas>

                    <?php
                    $current_year = date('Y'); // Get the current year
                    $query = "SELECT MONTH(item_date_acquired) AS month, COUNT(item_article) AS count 
                            FROM school_inventory 
                            WHERE item_date_acquired IS NOT NULL 
                            AND YEAR(item_date_acquired) = $current_year
                            GROUP BY MONTH(item_date_acquired)";

                    $result = mysqli_query($conn, $query);

                    $data = [];
                    $labels = [];

                    while ($row = mysqli_fetch_assoc($result)) {
                        $labels[] = date('F', mktime(0, 0, 0, $row['month'], 1)); // Convert month number to month name
                        $data[] = $row['count'];
                    }
                    ?>


                        <script>
                            var labels = <?php echo json_encode($labels); ?>;
                            var data = <?php echo json_encode($data); ?>;

                            var config = {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Items obtained per month',
                                        data: data,
                                        fill: false,
                                        borderColor: 'rgb(75, 192, 192)',
                                        tension: 0.1
                                    }]
                                },
                                options: {}
                            };

                            var lineChart = new Chart(document.getElementById('lineChart'), config);

                            $('.filter-option').on('click', function(){
                                var selectedValue = $(this).data('value');
                                console.log("Selected value:", selectedValue);
                                updateLine(selectedValue);
                            });

                        </script>
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
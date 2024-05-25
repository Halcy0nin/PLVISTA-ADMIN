<?php

// Include the database connection file
include "../Coordinator View/Processes/db_conn_high_school.php";

// Check if form is submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Get username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Authenticate username and select row where username is associated with the input
    $usernameverifyQuery = "SELECT * FROM users WHERE user_name = '$username'";
    $usernameverifyResult = mysqli_query($conn, $usernameverifyQuery);

    // Store query result in $user variable as an associative array
    $user = mysqli_fetch_assoc($usernameverifyResult);

    // Verify the password
    if ($user && $password == $user['user_pass']) {
        // Credentials are correct, retrieve the school ID associated with the user
        $school_id = $user['school_id'];

        // Redirect the user using the school_id as a parameter
        $_SESSION['school_id'] = $school_id;
        header("Location: school_inventory_content.php?school_id=$school_id");
        exit();
    } else {
        // Authentication failed, redirect back to login page with an error message
        header("Location: login.php?error=1");
        exit();
    }

    // Free result set
    mysqli_free_result($usernameverifyResult);

    // Close database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In | Custodian</title>

    <!-- CSS FILES -->
    <link href="../Custodian View/assets/css/bootstrap.css" rel="stylesheet">
    <link href="../Custodian View/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Custodian View/assets/css/login.css" rel="stylesheet">

    <!-- bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- icon sa tab -->
    <link rel="icon" type="images/x-icon" href="sdo.png" />
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="" method="post" onsubmit="return authenticate()">
                <h1>Sign in</h1>
                <div class="infieldone">
                    <input id="username" type="username" placeholder="Username" name="username" required />
                    <label></label>
                </div>
                <div class="infieldtwo">
                    <input id="password" type="password" placeholder="Password" name="password" required />
                    <label></label>
                </div>
                <a href="forgot_password.php" class="forgot">Forgot your password?</a> 
                <button type="submit">Sign In</button>
            </form>
        </div>

        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h3>ICT Resource Inventory System</h3>
                    <p>Schools Divisions Office of Valenzuela</p>
                </div>
            </div>
        </div>
    </div>

    <!-- this makes sure the error message shows up -->
    <script>
        // Following function gets values of the username and password fields and checks to see if they match a hard-coded username and password 
        function authenticate() {
            // Get input values
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            // Client-side validation: Check if fields are empty
            if (username.trim() === "" || password.trim() === "") {
                alert("Please enter both username and password.");
                return false;
            }

            // No need for password verification here, as it will be done server-side
            return true;
        }
    </script>

    <!-- JS FILES -->
    <script src="../try/assets/js/bootstrap.bundle.js"></script>
    <script src="../try/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../try/assets/js/bootstrap.js"></script>
</body>

</html>

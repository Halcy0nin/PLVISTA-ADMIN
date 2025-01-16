<!DOCTYPE html>
<html lang="en">

<head>
<?php include "Coordinator View/head.php"; ?>

  <title>Sign In</title>
  <link href="../Coordinator View/assets/css/login.css" rel="stylesheet">
  <link rel="icon" type="images/x-icon" href="Coordinator View/PLVista Logo.png"/>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="Coordinator View/dashboard_content.php" onsubmit="return authenticate()">
                <h1>Sign in</h1>
                <div class="infieldone">
                    <input id="username" type="username" placeholder="Username" name="username" required />
                    <label></label>
                </div>
                <div class="infieldtwo">
                    <input id="password" type="password" placeholder="Password" name="password" required />
                    <label></label>
                </div>
                <button type="submit" >Sign In</button> 
            </form>
            <script>
                //Following function gets values of the username and password fields and checks to see if they match a hard coded username and password 
                function authenticate() {
                    var authorized;

                    //get input values
                    var username = document.getElementById("username").value;
                    var password = document.getElementById("password").value;

                    //check to see if the password and username match
                    if (username == "admin" && password == "admin") {
                        authorized = true;
                    } else { // username or password do not match
                        authorized = false;
                        //alert user
                        alert("Sorry, username or password is incorrect.");
                    }
                    //return result
                    return authorized;
                }
            </script>
        </div>

        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <img src="Coordinator View/PLVista Logo.png">
                </div>
            </div>
        </div>
    </div>

    <!-- this makes sure the error message shows up -->
    <script>
        //Following function gets values of the username and password fields and checks to see if they match a hard coded username and password 
        function authenticate() {
            var authorized;

            //get input values
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            //check to see if the password and username match
            if (username == "admin" && password == "admin") {
                authorized = true;
            } else { // username or password do not match
                authorized = false;

                // Show the error message in a Bootstrap modal
                $('#errorModal').modal('show');
            }
            //return result
            return authorized;
        }
    </script>

    <!-- the error message itself -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Sorry, username or password is incorrect.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

    <!-- JS FILES -->
    <script src="../Coordinator View/assets/js/bootstrap.bundle.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.js"></script>
</body>

</html>
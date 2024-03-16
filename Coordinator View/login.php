<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign in || Admin</title>
    <link rel="icon" type="images/x-icon" href="sdo.png" /> <!-- icon on tab -->
    <!-- bootstrap css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css"> <!-- css -->
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="dashboard.php" onsubmit="return authenticate()">
                <h1>Sign in</h1>
                <div class="infieldone">
                    <input id="username" type="username" placeholder="Username" name="username" required />
                    <label></label>
                </div>
                <div class="infieldtwo">
                    <input id="password" type="password" placeholder="Password" name="password" required />
                    <label></label>
                </div>
                <a href="#" class="forgot">Forgot your password?</a> 
                <button type="submit">Sign In</button> 
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
                    <h3>ICT Resource Inventory System</h3>
                    <p>Schools Divisions Office of Valenzuela</p>
                </div>
            </div>
        </div>
    </div>

<!-- Bootstrap JS CDN for mobile responsiveness -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Sorry, username or password is incorrect.</h5>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
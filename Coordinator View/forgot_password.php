<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Forgot Password</title>

  <!-- CSS FILES -->
  <link href="../Coordinator View/assets/css/bootstrap.css" rel="stylesheet">
  <link href="../Coordinator View/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../Coordinator View/assets/css/login.css" rel="stylesheet">
  <link href="../Coordinator View/assets/css/forgot_password.css" rel="stylesheet">

  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <!-- icon sa tab -->
  <link rel="icon" type="images/x-icon" href="sdo.png"/>
</head>

<body>

<div class="container" id="container">
        <div class="form-container reset-password-container">
            <form action="Processes/pass_reset.php" method="POST">
                <h1 style="margin-left: -2.5vw; margin-top:-6vh;">Reset Password</h1>
                <div style="margin-top:-6vh;" class="infieldone">
                    <input type="email" placeholder="Email" name="adminemail" required />
                    <label></label>
                </div>
                <button style="margin-left: 1vw; margin-top: -14vh;" type="submit" name="forgotpass">Reset Password</button>
                <a href="login.php"  class="button" style="text-decoration: none; margin-left: -6.5vw; margin-top:-41vh;">
                <button style="background-color: red; color: white; border: none;" type="button">Cancel</button></a>
            </form>
        </div>
    </div>


</body>
</html>
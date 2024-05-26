<?php

include '../../Coordinator View/Processes/db_conn_high_school.php';

$email = $_POST['adminemail'];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$sql = "UPDATE users
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE user_email = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($stmt->affected_rows) {
    require "mailer.php";
    $mail->SetFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END
Click <a href = "http://localhost/sdovalenzuelainventory/SDO-Val-Inventory-Management/Custodian%20View/Processes/reset_password.php?token=$token">here</a>
to reset your password
END;
    try {
        $mail->send();
    } catch (Exception $e) {
        echo "{$mail->ErrorInfo}";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

* {
    padding: 0vh;
    margin: 0vh;
    box-sizing: border-box;
}

:root {
    --linear-grad: linear-gradient(#363f44, #1f4699);
    --grad-clr1: black;
    --grad-clr2: #1f4699;
}

body {
    height: 100vh;
    background-image: linear-gradient(#fffcf9, #1f4699);
    display: grid;
    place-content: center;
    font-family: 'Poppins', sans-serif;
}

.container {
    position:relative;
    width: 60vh;
    height: 35vh;
    background-color: rgb(230, 230, 230);
    box-shadow: 2.57vh 3.09vh 5.67vh #5557;
    border-radius: 13px;
    overflow: hidden;
}
.form-container{
    position: relative;
    width: 60vh;
    height: 60vh;
    padding: 0vh 4vh;
}
button {
    margin-left: 6.5vw;
    margin-bottom: -5vh;
    border-radius: 2.09vh;
    border: 0.10vh solid var(--grad-clr2);
    background: var(--grad-clr2);
    color: #fff;
    font-size: 1.25vh;
    font-weight: bold;
    padding: 1.25vh 4.72vh;
    letter-spacing: 0.10vh;
    text-transform: uppercase;
    text-decoration:none;
}

button a {
    text-decoration: none; /* Remove underline */
    color: white;
}
.form-container button {
    margin-top: 1.78vh;
    transition: 80ms ease-in;
}
.form-container button:hover {

    color: var(--grad-clr1);
}
h1 {
            text-align: center;
            margin-top: 4vh;
            margin-left: 0vw;
        }
    </style>

  <title>Forgot Password</title>

  <!-- CSS FILES -->
  <link href="../Custodian View/assets/css/bootstrap.css" rel="stylesheet">
  <link href="../Custodian View/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../Custodian View/assets/css/login.css" rel="stylesheet">
  <link href="../Custodian View/assets/css/pass_reset.css" rel="stylesheet">
  <link href="../Custodian View/assets/css/forgot_password.css" rel="stylesheet">


  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <!-- icon sa tab -->
  <link rel="icon" type="images/x-icon" href="sdo.png"/>
</head>

<body>

<div class="container" id="container">
        <div class="form-container reset-password-container">
        <h1>An email has been sent to reset your password. Please check your inbox</h1>
<button type="button" class="button" data-bs-dismiss="modal"><a href="../login.php">Back to Log-In</button>
        </div>
    </div>

</body>
</html>

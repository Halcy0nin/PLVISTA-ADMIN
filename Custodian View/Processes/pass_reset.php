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

  <title>Forgot Password</title>

  <!-- CSS FILES -->
  <link href="../Coordinator View/assets/css/bootstrap.css" rel="stylesheet">
  <link href="../Coordinator View/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../Coordinator View/assets/css/login.css" rel="stylesheet">

  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <!-- icon sa tab -->
  <link rel="icon" type="images/x-icon" href="sdo.png"/>
</head>

<body>

<h1>An email has been sent to reset your password. Please check your inbox</h1>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="../login.php">Back to Log-In</button>


</body>
</html>

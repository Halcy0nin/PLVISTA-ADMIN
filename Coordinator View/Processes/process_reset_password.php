<?php
$token = $_POST["token"];
$token_hash = hash("sha256", $token);

include "db_conn_high_school.php";

$sql = "SELECT * FROM users WHERE reset_token_hash = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("Token not found");
}

$password = $_POST["newpass"];
$confirm_password = $_POST["confirmpass"];

$sql = "UPDATE users
        SET user_pass = ?,
        reset_token_hash = NULL,
        reset_token_expires_at = NULL
        WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $password, $user["user_id"]);
$stmt->execute();


$stmt->close();
$conn->close();
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

<h1>Password updated successfully.</h1>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="../login.php">Back to Log-In</button>


</body>
</html>


<?php
$errors = array();

// Function to check if a password meets the criteria
function validatePassword($password) {
    $errors = array();

    // Check if password is at least 8 characters long
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Add more validation rules if needed
    
    return $errors;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve passwords from form
    $newpass = $_POST["newpass"];
    $confirmpass = $_POST["confirmpass"];

    // Validate passwords
    $errors = array_merge($errors, validatePassword($newpass));

    // Check if passwords match
    if ($newpass !== $confirmpass) {
        $errors[] = "Passwords do not match.";
    }

    // If there are no errors, proceed with password reset
    if (empty($errors)) {
        // Your password reset logic here
        // Redirect or display success message
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <!-- CSS FILES -->
    <link href="../Coordinator View/assets/css/bootstrap.css" rel="stylesheet">
    <link href="../Coordinator View/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Coordinator View/assets/css/login.css" rel="stylesheet">
    <!-- bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icon sa tab -->
    <link rel="icon" type="images/x-icon" href="sdo.png"/>
     <!--Importing jquery-->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <style>
        .error {
            color: red;
        }
    </style>

</head>

<body>

<?php
$token = $_GET["token"];
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

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token expired");
}

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST["newpass"];
    $confirm_password = $_POST["confirmpass"];

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must include at least one uppercase letter.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must include at least one lowercase letter.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must include at least one number.";
    }
    if (!preg_match('/[\W_]/', $password)) {
        $errors[] = "Password must include at least one special character.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $success = "Password successfully changed.";
        // Process password change and update database here
    }
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach ($errors as $error): ?>
                        <p class="mb-0"><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form id="resetForm" action="process_reset_password.php" method="POST">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                <input type="password" placeholder="New Password" name="newpass" id="newpass" required>
                <br>

                <input type="password" placeholder="Confirm Password" name="confirmpass" id="confirmpass" required>
                <br>

                <input type="submit" name="resetpass" value="Reset Password">
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#resetForm").submit(function (event) {
            var errors = [];

            if ($("#newpass").val().length < 8) {
                errors.push("Password must be at least 8 characters long.");
            }
            if (!/[A-Z]/.test($("#newpass").val())) {
                errors.push("Password must include at least one uppercase letter.");
            }
            if (!/[a-z]/.test($("#newpass").val())) {
                errors.push("Password must include at least one lowercase letter.");
            }
            if (!/[0-9]/.test($("#newpass").val())) {
                errors.push("Password must include at least one number.");
            }
            if (!/[\W_]/.test($("#newpass").val())) {
                errors.push("Password must include at least one special character.");
            }
            if ($("#newpass").val() !== $("#confirmpass").val()) {
                errors.push("Passwords do not match.");
            }

            if (errors.length > 0) {
                event.preventDefault();

                var errorMessage = "Errors:\n\n" + errors.join("\n");
                alert(errorMessage);
            }
        });
    });
</script>



</body>
</html>
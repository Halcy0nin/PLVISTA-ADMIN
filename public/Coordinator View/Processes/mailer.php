<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../../vendor/autoload.php";

$mail = new PHPMailer(true);
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//$mail->SMTPDebug = 2;  // Set to 2 to enable verbose debug output
//$mail->Debugoutput = 'html';  // Output format for debugging info

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->Username = 'exonatural321@gmail.com'; // Your Gmail address
$mail->Password = 'rayu ehvy aaos clhv'; // Your Gmail password or app-specific password
$mail->isHTML(true);

return $mail;
?>
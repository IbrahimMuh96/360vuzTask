<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->SMTPSecure = 'ssl';
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username = "360vuz.task@gmail.com";
$mail->Password = "ibrahim-1234!";
//$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = 465;

$mail->setFrom('ibrahim.abedalhaleem@gmail.com', 'Mailer');

$mail->isHTML(true);

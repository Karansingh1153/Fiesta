<?php

include "./include/db_conn.php";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


require './phpmailer/vendor/autoload.php';

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes(($data));
        $data = htmlspecialchars($data);
        return $data;
    }
}

$email = validate($_POST['email']);
$name = validate($_POST['name']);
$message = validate($_POST['message']);


$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = "venirfiesta2023@gmail.com";
$mail->Password = "ocqjvrmbnlysralq";
$mail->setFrom($email, $email);
$mail->addAddress('venirfiesta2023@gmail.com');
$mail->Subject = 'Contact Form Submission';
$mail->Body = $message;

if ($mail->send()) {
    $sql = "INSERT INTO `contact` (`name`, `email`, `message`) VALUES ('" . $name . "', '" . $email . "', '" . $message . "')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location: index.php');
    } else {
        header('Location: contact.php?error=Message not sent');
    }
} else {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

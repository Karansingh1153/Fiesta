<?php

session_start();

include "./common/include/db_conn.php";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'common/PHPMailer-master/src/Exception.php';
require 'common/PHPMailer-master/src/PHPMailer.php';
require 'common/PHPMailer-master/src/SMTP.php';


require 'common/PHPMailer-master/vendor/autoload.php';

function validate($data)
{
    $data = trim($data);
    $data = stripslashes(($data));
    $data = htmlspecialchars($data);
    return $data;
}

$uname = validate($_POST['username']);
$email = validate($_POST['email']);
$pass = validate($_POST['password']);
$cpass = validate($_POST['cpassword']);
$role = validate($_POST['role']);
$verification = validate($_POST['verification']);

$verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
$encrypted_password = password_hash($pass, PASSWORD_DEFAULT);

// Send OTP in an email
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = "venirfiesta2023@gmail.com";
$mail->Password = "fokuzzvlpbdlqwed";
$mail->setFrom('venirfiesta2023@gmail.com', 'Fiesta');
$mail->addReplyTo('venirfiesta2023@gmail.com', 'Fiesta');
$mail->addAddress($email, 'User');
$mail->Subject = 'Verify your email address';
$mail->Body = 'Dear ' . $uname . ',

We hope this email finds you well. We recently received a request to create an account using this email address. To ensure the security of your account and protect your information, we require email verification.

Please use the following One-Time Password (OTP) to verify your email address: ' . $verification_code . '

Please note that this OTP is valid for 5 minutes and can only be used once. If you did not make this request, please disregard this email.

Best regards,
Fiesta';

$sql = "SELECT * FROM `users` WHERE `email` = '$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) >= 1) {
    header('Location: signup.php?error=Email already exists');
} else {
    if ($cpass != $pass) {
        header('Location: signup.php?error=Password not match');
    } else {
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $_SESSION['username'] = $uname;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $pass;
            $_SESSION['epassword'] = $encrypted_password;
            $_SESSION['verification_code'] = $verification_code;
            $_SESSION['role'] = $role;
            header('Location: signup.php?verifiy');
        }
    }
}

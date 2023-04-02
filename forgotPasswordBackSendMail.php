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

// Check if the form has been submitted
if (isset($_POST['email'])) {
    // Get the email from the form
    $email = $_POST['email'];

    // Check if the email exists in the database
    $query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        $uname = $row['username'];

        // Generate a unique token
        $token = bin2hex(random_bytes(50));

        // Store the token in the database
        $query = "INSERT INTO `password_reset` (`user_id`, `token`) VALUES ('$user_id', '$token')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Send the email
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html';
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = "venirfiesta2023@gmail.com";
            $mail->Password = "ocqjvrmbnlysralq";
            $mail->setFrom('venirfiesta2023@gmail.com', 'Fiesta');
            $mail->addReplyTo('venirfiesta2023@gmail.com', 'Fiesta');
            $mail->addAddress($email, 'User');
            $mail->Subject = 'Verify your email address';
            $mail->Body = '
Dear ' . $uname . ',

I hope this email finds you well. I am writing to request a password reset for my account. I seem to have forgotten my password and am unable to log in to my account.

If it is possible, I would greatly appreciate it if you could reset my password for me. To make the process easier, I have included a link below that you can use to reset my password.

Please click on the link to reset your password: http://localhost:80/WB/resetPassword.php?token=' . $token . '

If there are any additional steps I need to take, please let me know and I will be more than happy to follow them.

Thank you for your time and assistance in this matter. I look forward to being able to access my account again soon.

Best regards,
Fiesta';


            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                header('Location: login.php');
                $_SESSION['token'] = $token;
            }
        } else {
            header('Location: forgotPassword.php?error=Email not Found');
        }
    }
}

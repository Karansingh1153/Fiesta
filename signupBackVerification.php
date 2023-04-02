<?php
session_start();

include('./include/db_conn.php');

$uname = $_SESSION['username'];
$email = $_SESSION['email'];
$pass = $_SESSION['epassword'];
$uname = $_SESSION['username'];
$role = $_SESSION['role'];


if (isset($_POST['verification'])) {
    if ($_SESSION['verifiction_code'] = $_POST['verification']) {
        $sql = "INSERT INTO `users` (`username`, `email`, `password`, `role`) VALUES ('" . $uname . "', '" . $email . "', '" . $pass . "','" . $role . "')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('Location: localhost/wb/login.php');
        }
    } else {
        header('Location: signup.php?error="Invalid Verification Code"');
    }
}

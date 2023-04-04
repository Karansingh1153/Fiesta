<?php
session_start();
include "./include/db_conn.php";

if (isset($_POST['newpassword']) && isset($_POST['cnewpassword'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes(($data));
        $data = htmlspecialchars($data);
        return $data;
    }
}

$npass = validate($_POST['newpassword']);
$cnpass = validate($_POST['cnewpassword']);

$token = $_GET['token'];

$query = "SELECT * FROM `password_reset` WHERE `token` = '$token'";
$result = mysqli_query($conn, $query);
if ($result) {
    $row = $result->fetch_assoc();
    if ($npass == $cnpass) {
        // Hash the new password
        $new_password_hash = password_hash($npass, PASSWORD_DEFAULT);

        // Update the password in the database
        $id = $row['user_id'];
        $query = "UPDATE `users` SET `password` = '$new_password_hash' WHERE `id` = $id";
        $result = mysqli_query($conn, $query);

        // Check if the update was successful
        if ($result) {
            header('Location: login.php');
        } else {
            header('Location: resetPassword.php?error=Unable to change password');
        }
    } else {
        header('Location: resetPassword.php?error=New passwords do not match');
    }
} else {
    header('Location: resetPassword.php?error=Not changed');
}

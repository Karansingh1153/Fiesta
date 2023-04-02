<?php
session_start();
include "./common/include/db_conn.php";

if (isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['cnewpassword'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes(($data));
        $data = htmlspecialchars($data);
        return $data;
    }
}

$opass = validate($_POST['oldpassword']);
$npass = validate($_POST['newpassword']);
$cnpass = validate($_POST['cnewpassword']);

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT password FROM `users` WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $password_hash = $row['password'];
} else {
    header('Location: changePassword.php?error=Not changed');
}

// Check if the current password is correct
if (password_verify($opass, $password_hash)) {
    // Check if the new passwords match
    if ($npass == $cnpass) {
        // Hash the new password
        $new_password_hash = password_hash($npass, PASSWORD_DEFAULT);

        // Update the password in the database
        $query = "UPDATE `users` SET `password` = '$new_password_hash' WHERE `id` = $id";
        $result = mysqli_query($conn, $query);

        // Check if the update was successful
        if ($result) {
            header('Location: index.php?user');
        } else {
            header('Location: changePassword.php?error=Unable to change password');
        }
    } else {
        header('Location: changePassword.php?error=New passwords do not match');
    }
} else {
    header('Location: changePassword.php?error=Current password is incorrect');
}

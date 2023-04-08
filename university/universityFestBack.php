<?php
session_start();

include('../include/db_conn.php');

if (isset($_POST['festname'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes(($data));
        $data = htmlspecialchars($data);
        return $data;
    }
}

$festname = validate($_POST['festname']);
$user_id = $_SESSION['id'];
$user_name = $_SESSION['username'];
$user_email = $_SESSION['email'];

$sql1 = "INSERT INTO `fests` (`user_id`, `fest_name`, `user_name`, `user_email`) VALUES ('" . $user_id . "', '" . $festname . "', '" . $user_name . "','" . $user_email . "')";

$sql = "CREATE TABLE `$festname` (`id` INT(255) NOT NULL AUTO_INCREMENT , `eventname` VARCHAR(100) NOT NULL , `eventdesc` VARCHAR(100) NOT NULL , `eventmem` INT(255) NOT NULL , PRIMARY KEY (`id`))";

$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);
if ($result && $result1) {
    $_SESSION['festname'] = $festname;
    header('Location: ../organizer/organizer.php?fest=' . $festname . '');
}

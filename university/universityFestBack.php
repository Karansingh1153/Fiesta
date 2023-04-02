<?php
session_start();

include('./include/db_conn.php');

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

$sql = "CREATE TABLE `$festname` (`id` INT(255) NOT NULL AUTO_INCREMENT , `eventname` VARCHAR(100) NOT NULL , `eventdesc` VARCHAR(100) NOT NULL , `eventmem` INT(255) NOT NULL , PRIMARY KEY (`id`))";
$result = mysqli_query($conn, $sql);
if ($result) {
    $_SESSION['festname'] = $festname;
    header('Location: ../organizer/organizer.php?fest=' . $festname . '');
}

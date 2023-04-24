<?php
session_start();

include('../include/db_conn.php');

if (isset($_POST['festName'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes(($data));
        $data = htmlspecialchars($data);
        return $data;
    }
}

$festName = validate($_POST['festName']);
$userId = $_SESSION['id'];
$userName = $_SESSION['username'];
$userEmail = $_SESSION['email'];

$festId = mt_rand(100000, 99999999);

$sql1 = "INSERT INTO `fests` (`userId`, `festName`, `festId`, `userName`, `userEmail`) VALUES ('" . $userId . "', '" . $festName . "', '" . $festId . "', '" . $userName . "','" . $userEmail . "')";

$sql = "CREATE TABLE `$festName` (`id` INT(255) NOT NULL AUTO_INCREMENT, `eventId` INT(255) NOT NULL, `eventName` VARCHAR(100) NOT NULL , `eventDescription` VARCHAR(100) NOT NULL, `eventFaculty` VARCHAR(100) NOT NULL, `eventMembers` INT(255) NOT NULL , PRIMARY KEY (`id`))";

$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);
if ($result && $result1) {
    $_SESSION['festName'] = $festName;
    header('Location: ../organizer/festEvent.php?festName='.$festName.'');
    exit();
}

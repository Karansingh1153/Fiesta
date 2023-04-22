<?php
session_start();

include('../include/db_conn.php');

$tableName = $_SESSION['festName'];
if (isset($_POST['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `$tableName` WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: organizer.php');
        exit;
    } else {
        header('Location: organizer.php?error=Error while trying to delete.');
        exit;
    }
}

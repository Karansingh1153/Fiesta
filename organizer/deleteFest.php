<?php
session_start();
include('../include/db_conn.php');

if (isset($_GET['festName'])) {
  $festName = $_GET['festName'];
  $id = $_SESSION['id'];
  $query = "DELETE FROM `fests` WHERE `festName` = '$festName' AND `userId` = '$id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    header('Location: organizer.php');
  } else {
    header('Location: organizer.php?error=Something went wrong while deleting fest.');
  }
} else {
  header('Location: organizer.php');
}

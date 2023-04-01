<?php
$shost = "localhost";
$sname = "root";
$spass = "";
$dbname = "fiesta";

$conn = mysqli_connect($shost, $sname, $spass, $dbname);

if (!$conn) {
    die("Error : " . mysqli_connect_error());
}

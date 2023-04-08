<?php
$host = "localhost";
$name = "root";
$pass = "";
$dbname = "fiesta";

$conn = mysqli_connect($host, $name, $pass, $dbname);

if (!$conn) {
    die("Error : " . mysqli_connect_error());
}

<?php
include('./include/config-google.php');

//Reset OAuth access token
// $google_client->revokeToken();

session_destroy();
header("Location: index.php");

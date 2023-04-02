<?php
session_start();
// include('../common/include/config-google.php');

//Reset OAuth access token
// $google_client->revokeToken();

if (session_destroy()) {
    header("Location: ../index.php");
}

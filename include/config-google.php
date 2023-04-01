<?php
session_start();

//Include Google Client Library for PHP autoload file
require_once './google/vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google\Client();

$google_client->setApplicationName('Fiesta');

//Set the OAuth 2.0 Client ID
$google_client->setClientId('631043835774-ihujuissghdbb66nfj7tdrtgbvv0t2a4.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/wb/login.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

$google_service = new Google\Service\Oauth2($google_client);
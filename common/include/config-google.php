<?php
session_start();

//Include Google Client Library for PHP autoload file
require_once '../google/vendor/autoload.php';

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

$google_client->createAuthUrl();

if (isset($_GET["code"])) {
    $code = $_GET['code'];
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $data = $google_service->userinfo->get();

        $userinfo = [
            'email' => $data['email'],
            'first_name' => $data['givenName'],
            'last_name' => $data['familyName'],
            'gender' => $data['gender'],
            'full_name' => $data['name'],
            'picture' => $data['picture'],
            'verified_email' => $data['verifiedEmail'],
            'token' => $data['id']
        ];

        $sql = "SELECT * FROM `google_users` WHERE `email` = '{$userinfo['email']}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_assoc($result);
            $token = $userdata['token'];
            $_SESSION['username'] = $userdata['full_name'];
            $_SESSION['id'] = $userdata['id'];
            header("Location: index.php");
        } else {
            $sql = "INSERT INTO `google_users` (`email`, `first_name`, `last_name`, `gender`, `full_name`, `picture` ,`verified_email`, `token`) VALUES ('{$userinfo['email']}','{$userinfo['first_name']}','{$userinfo['last_name']}','{$userinfo['gender']}','{$userinfo['full_name']}','{$userinfo['picture']}','{$userinfo['verified_email']}','{$userinfo['token']}')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['username'] = $userinfo['full_name'];
                $_SESSION['id'] = $userinfo['id'];
                $token = $userinfo['token'];
                header("Location: index.php");
            } else {
                header('Location: login.php?error=Try again later');
            }
        }
        $_SESSION['google_access_token'] = $token;
        $_SESSION['login_extra'] = true;
        $_SESSION['logged_in'] = true;
    } else {
        header('Location: login.php?error=Something went wrong');
    }
}

<?php
session_start();
require_once '../facebook/vendor/autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;

// Edit Following 2 Lines
FacebookSession::setDefaultApplication( '1012356393067455','bc91eeb0eb5ed33ccd94446b688bb2cf' );
$helper = new FacebookRedirectLoginHelper('http://localhost/wb/login.php');

try {$session = $helper->getSessionFromRedirect();} catch( FacebookRequestException $ex ) {} catch( Exception $ex ) {}
if ( isset( $session ) ) 
{
    $request = new FacebookRequest( $session, 'GET', '/me?fields=id,first_name,last_name,name,email' );
    $response = $request->execute();
    $graphObject = $response->getGraphObject();
    $fbid = $graphObject->getProperty('id');
    $fbfirstname = $graphObject->getProperty('first_name');
    $fblastname = $graphObject->getProperty('last_name');
    $fbfullname = $graphObject->getProperty('name');
    $femail = $graphObject->getProperty('email');
    if($femail==null || $femail=='' || $femail==' ')
    {
        $femail=$fbfirstname.$fblastname.$fbid.'@gmail.com';
    }
    $_SESSION['oauth_provider'] = 'Facebook'; 
    $_SESSION['oauth_uid'] = $fbid; 
    $_SESSION['username'] = $fbfirstname; 
    $_SESSION['last_name'] = $fblastname; 
    $_SESSION['email'] = $femail;
    $_SESSION['logincust']='yes';
    header("Location: ./index.php");
} 
else 
{
    $loginUrl = $helper->getLoginUrl();
    header("Location: ".$loginUrl);
}


    // session_start();
    
    // include_once './facebook/vendor/autoload.php';
    
    // // Call Facebook API
    // $fb = new Facebook\Facebook(array(
    //     'app_id' => '900895437763901', // Replace with your app id
    //     'app_secret' => '478f934bffbd3abf81340e9400d674ec',  // Replace with your app secret
    //     'default_graph_version' => 'v3.2',
    // ));
    
    // $helper = $fb->getRedirectLoginHelper('http://localhost:8080/WB/login.php');
    
    // // $helper->getLoginUrl();
    
    // try {
    //     if (isset($_SESSION['fb_access_token'])) {
    //         $accessToken = $_SESSION['fb_access_token'];
    //     } else {
    //         $accessToken = $helper->getAccessToken();
    //     }
    // } catch (Facebook\Exceptions\FacebookResponseException $e) {
    //     // When Graph returns an error
    //     echo 'Graph returned an error: ' . $e->getMessage();
    //     exit;
    // } catch (Facebook\Exceptions\FacebookSDKException $e) {
    //     // When validation fails or other local issues
    //     echo 'Facebook SDK returned an error: ' . $e->getMessage();
    //     exit;
    // }
    
    // if (isset($accessToken)) {
    //     if (!isset($_SESSION['fb_access_token'])) {
    //         $_SESSION['fb_access_token'] = (string) $accessToken;
    //         $oAuth2Client = $fb->getOAuth2Client();
    //         $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['fb_access_token']);
    //         $_SESSION['fb_access_token'] = $longLivedAccessToken;
    //         $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
    //     } else {
    //         $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
    //     }
    
    //     try {
    //         $fb_response = $fb->get('/me?fields=id,name,email');
    //         $fb_response_picture = $fb->get('/me?picture?redirect=flase&height=200');
    
    //         $fb_user = $fb_response->getGraphUser();
    //         $picture = $fb_response_picture->getGraphUser();
    
    //         $_SESSION['username'] = $fb_user['name'];
    //         $_SESSION['login_extra'] = true;
    //         $_SESSION['logged_in'] = true;
    //         header('Location: index.php');
    //     } catch (Facebook\Exceptions\FacebookResponseException $e) {
    //         // When Graph returns an error
    //         echo 'Graph returned an error: ' . $e->getMessage();
    //         exit;
    //     } catch (Facebook\Exceptions\FacebookSDKException $e) {
    //         // When validation fails or other local issues
    //         echo 'Facebook SDK returned an error: ' . $e->getMessage();
    //         exit;
    //     }
    // }
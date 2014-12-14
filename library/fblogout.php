<?php

/* 	FACEBOOK LOGIN + LOGOUT - PHP SDK V4.0
 * 	file 			- index.php
 * 	Developer 		- Krishna Teja G S
 * 	Website			- http://packetcode.com/apps/fblogin-basic/
 * 	Date 			- 27th Sept 2014
 * 	license			- GNU General Public License version 2 or later
 */

/* INCLUSION OF LIBRARY FILEs */
require_once( 'Facebook/FacebookSession.php');
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php');
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/GraphUser.php' );
require_once( 'Facebook/GraphSessionInfo.php' );
require_once( 'Facebook/Entities/AccessToken.php');
require_once( 'Facebook/HttpClients/FacebookCurl.php' );
require_once( 'Facebook/HttpClients/FacebookHttpable.php');
require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php');

/* USE NAMESPACES */

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\FacebookHttpable;
use Facebook\FacebookCurlHttpClient;
use Facebook\FacebookCurl;

/* PROCESS */

//1.Stat Session
session_start();

//check if users wants to logout
if (isset($_REQUEST['logout'])) {
    unset($_SESSION['fb_token']);
}

//2.Use app id,secret and redirect url 
$app_id = '597155087077856';
$app_secret = 'bbe141e4c7c603365a279c09ae9cddcd';
$redirect_url = 'http://mrgoalz.com/library/fblogout.php';

//3.Initialize application, create helper object and get fb sess
FacebookSession::setDefaultApplication($app_id, $app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_url);
$sess = $helper->getSessionFromRedirect();

//check if facebook session exists
if (isset($_SESSION['fb_token'])) {
    $sess = new FacebookSession($_SESSION['fb_token']);
}

//logout
$logout = 'http://mrgoalz.com/library/fblogout.php?logout=true';

//4. if fb sess exists echo name 
if (isset($sess)) {
    //store the token in the php session
    $_SESSION['fb_token'] = $sess->getToken();
    //create request object,execute and capture response
    $request = new FacebookRequest($sess, 'GET', '/me');
    echo "Request:<br>";
    echo "<pre>";
    var_dump($request);
    echo "</pre>";
    // from response get graph object
    $response = $request->execute();
    echo "Response:<br>";
    echo "<pre>";
    var_dump($response);
    echo "</pre>";
    $graph = $response->getGraphObject(GraphUser::classname());
    echo "Ggraph:<br>";
    echo "<pre>";
    var_dump($graph);
    echo "</pre>";
    // use graph object methods to get user details
    $name = $graph->getName();
    $id = $graph->getId();
    $image = 'https://graph.facebook.com/' . $id . '/picture?width=300';
    $email = $graph->getProperty('email');
    echo "<br>Birthday:".$graph->getBirthDay();
    echo '<br>ID:'.$graph->getId();
    echo "hi $name <br>";
    echo "your email is $email <br><Br>";
    echo "<img src='$image' /><br><br>";
    echo "<a href='" . $logout . "'><button>Logout</button></a>";
} else {
    //else echo login
    echo '<a href="' . $helper->getLoginUrl(array('email')) . '" >Login with facebook</a>';
}











	

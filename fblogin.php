<?php
//include "Generic.php";

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

$app_id = '597155087077856';
$app_secret = 'bbe141e4c7c603365a279c09ae9cddcd';
$redirect_url = 'http://mrgoalz.com/fblogin.php';
FacebookSession::setDefaultApplication($app_id, $app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_url);
$sess = $helper->getSessionFromRedirect();
if (isset($_SESSION['fb_token'])) {
    $sess = new FacebookSession($_SESSION['fb_token']);
}
if (isset($sess)) {
    $_SESSION['fb_token'] = $sess->getToken();
    $request = new FacebookRequest($sess, 'GET', '/me');
    $response = $request->execute();
    $graph = $response->getGraphObject(GraphUser::classname());
    $name = $graph->getName();
    $id = $graph->getId();
    $userdata = $graph->asArray();
    $_SESSION['socialmedia']['avatar'] = 'https://graph.facebook.com/' . $id . '/picture?width=100';
    $_SESSION['socialmedia']['username'] = $name;
    $_SESSION['socialmedia']['birthday'] = $userdata['birthday'];
    $_SESSION['socialmedia']['gender'] = $userdata['gender'];
    $email = $graph->getProperty('email');
    $_SESSION['vaiuugroup']['login_type'] = md5("facebook");
    $_SESSION['vaiuugroup']['user_id_name'] = $id;
    $_SESSION['vaiuugroup']['user_email'] = $email;
    $FB_LOGIN_URL = "javascript:void(0)";


    $user['user_email'] = $email;
    $user['user_name'] = $name;
    $user['profile_picture'] = 'https://graph.facebook.com/' . $id . '/picture?width=100';
    $user['gender'] = $userdata['gender'];
    $user['login_type'] = "Facebook Login";
    $user['user_password'] = md5($email);
    $user['recovery_number'] = $id;
    $user['update_date'] = date("Y-m-d H:i:s");
    $check_existence = v_dataSelect("mrpredict_user", "user_email='" . $user['user_email'] . "'");
    if ($check_existence['counter'] == 0) {
        $string = "Mg".time();
        $user['create_date'] = date("Y-m-d H:i:s");
        $user['status'] = "active";
        $user['user_id_name'] = $string;
        $pass = str_shuffle($string);
        $user['user_password'] = md5($pass);
        v_dataInsert("mrpredict_user", $user);
        $_SESSION['login_type'] = "Facebook Login";
        $_SESSION['vaiuugroup']['user_id_name'] = $string;
        $_SESSION['vaiuugroup']['user_email'] = $email;
        $_SESSION['vaiuugroup']['username'] = $name;
        $_SESSION['vaiuugroup']['profile'] = $user['profile_picture'];
        $_SESSION['vaiuugroup']['user_state'] = "active";
        if (isset($_SESSION['login_type']) && $_SESSION['login_type'] == "Facebook Login" && isset($_SESSION['vaiuugroup']['user_id_name']) && isset($_SESSION['vaiuugroup']['user_email'])) {
            $messagearray[0] = "Dear, <strong>" . $_SESSION['vaiuugroup']['username'] . "</strong><br>";
            $messagearray[1] = "Thank you for your signup in " . APP_NAME . " using Facebook account. You can also login with Username: <strong>" . $string . "</strong> and Password <strong>" . $pass . "<strong>";
            $messagearray[2] = "If you think it is not you then contact with admin (" . ADMIN_EMAIL . ")<br>";
            $messagearray[3] = "<br><br><i>Thanks for your patience.</i><br>";
            $mailmessage = v_registrationMail($messagearray, BASE_URL);
            simpleMail(ADMIN_EMAIL,$email, $mailmessage, "Registration in " . APP_NAME . " with Facebook", "no-replay@mrgoalz.com");
            header("Location:settings.php");
        }
    } else {
        $user2['profile_picture'] = $user['profile_picture'];
        $user2['login_type'] = "Facebook Login";
        $user2['update_date'] = date("Y-m-d H:i:s");
        v_dataUpdate("mrpredict_user", $user2, "user_email='" . $email . "'");
        $_SESSION['login_type'] = "Facebook Login";
        $_SESSION['vaiuugroup']['user_id_name'] = $check_existence['data'][0]['user_id_name'];
        $_SESSION['vaiuugroup']['user_email'] = $check_existence['data'][0]['user_email'];
        $_SESSION['vaiuugroup']['username'] = $name;
        $_SESSION['vaiuugroup']['profile'] = $user['profile_picture'];
        $_SESSION['vaiuugroup']['user_state'] = "active";
        if (isset($_SESSION['login_type']) && $_SESSION['login_type'] == "Facebook Login" && isset($_SESSION['vaiuugroup']['user_id_name']) && isset($_SESSION['vaiuugroup']['user_email'])) {
            header("Location:gamelist.php");
        }
    }
} else {
    $permissions = array(
        'email',
        'user_location',
        'user_birthday'
    );
    $FB_LOGIN_URL = $helper->getLoginUrl($permissions);
}











	

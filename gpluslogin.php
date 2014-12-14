<?php

include 'Generic.php';
include GOOGLE_API . 'Google/Client.php';
$client = new Google_Client();
$client->setApplicationName(APP_NAME);
$client->setDeveloperKey(API_KEY);
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URL);
$client->setScopes($scope);
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $client->setAccessToken($_SESSION['access_token']);
} else {
    header("Location:logout.php");
}
$service = new Google_Service_Oauth2($client);


$user['user_email'] = $service->userinfo->get()['email'];
$user['user_name'] = $service->userinfo->get()['name'];
$user['profile_picture'] = $service->userinfo->get()['picture'];
$user['gender'] = $service->userinfo->get()['gender'];
$user['login_type'] = "Google Login";
$user['recovery_number'] = $user['user_id_name'];
$user['update_date'] = $user['user_id_name'];
$check_existence = v_dataSelect("mrpredict_user", "user_email='" . $user['user_email'] . "'");
if ($check_existence['counter'] == 0) {
    $string = "Mg" .time();
    $user['user_id_name'] = $string;
    $user['create_date'] = $user['user_id_name'];
    $user['status'] = "active";
    $pass = str_shuffle($string);
    $user['user_password'] = md5($pass);
    v_dataInsert("mrpredict_user", $user);
    $_SESSION['login_type'] = "Google Login";

    $_SESSION['vaiuugroup']['user_id_name'] = $string;
    $_SESSION['vaiuugroup']['user_email'] = $service->userinfo->get()['email'];
    $_SESSION['vaiuugroup']['username'] = $service->userinfo->get()['name'];
    $_SESSION['vaiuugroup']['profile'] = $service->userinfo->get()['picture'];
    $_SESSION['vaiuugroup']['user_state'] = "active";
    if (isset($_SESSION['login_type']) && $_SESSION['login_type'] == "Google Login" && isset($_SESSION['vaiuugroup']['user_id_name']) && isset($_SESSION['vaiuugroup']['user_email'])) {
        $messagearray[0] = "Dear, <strong>" . $_SESSION['vaiuugroup']['username'] . "</strong><br>";
        $messagearray[1] = "Thank you for your signup in " . APP_NAME . " using g+ account. You can also login with Username: <strong>" . $string . "</strong> and Password <strong>" . $pass . "<strong>";
        $messagearray[2] = "If you think it is not you then contact with admin (" . ADMIN_EMAIL . ")<br>";
        $messagearray[3] = "<br><br><i>Thanks for your patience.</i><br>";
        $mailmessage = v_registrationMail($messagearray, BASE_URL);
        simpleMail(ADMIN_EMAIL, $service->userinfo->get()['email'], $mailmessage, "Registration in " . APP_NAME . " with G+", "no-replay@mrgoalz.com");
        header("Location:settings.php");
    }
} else {
    $user2['profile_picture'] = $user['profile_picture'];
    $user2['login_type'] = "Google Login";
    $user2['update_date'] = $user['update_date'];
    v_dataUpdate("mrpredict_user", $user2, "user_email='" . $user['user_email'] . "'");
    $_SESSION['login_type'] = "Google Login";
    $_SESSION['vaiuugroup']['user_id_name'] =$check_existence['data'][0]['user_id_name'];
    $_SESSION['vaiuugroup']['user_email'] = $check_existence['data'][0]['user_email'];
    $_SESSION['vaiuugroup']['username'] = $service->userinfo->get()['name'];
    $_SESSION['vaiuugroup']['profile'] = $service->userinfo->get()['picture'];
    $_SESSION['vaiuugroup']['user_state'] = "active";
    if (isset($_SESSION['login_type']) && $_SESSION['login_type'] == "Google Login" && isset($_SESSION['vaiuugroup']['user_id_name']) && isset($_SESSION['vaiuugroup']['user_email'])) {
        header("Location:gamelist.php");
    }
}









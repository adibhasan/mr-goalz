<?php
v_preventDirectAccess("Settings");
if (!v_get_getpass()) {
    v_reDirect(BASE_URL . "logout.php");
}
if (empty($_SESSION['client_info']) || $_SESSION['client_info'] == "") {
    $client_info = timeZone(v_get_client_ip());
    $_SESSION['client_info'] = $client_info;
}

$userinfo = v_dataSelect("mrpredict_user", "user_email='" . $_SESSION['vaiuugroup']['user_email'] . "' AND user_id_name='" . $_SESSION['vaiuugroup']['user_id_name'] . "'");
if($userinfo['data'][0]['status']=="pending"){
	v_reDirect(BASE_URL . "primarylogin.php");
}
$user = v_cash_data();
?>

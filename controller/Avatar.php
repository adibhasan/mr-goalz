<?php

preventDirectAccess("Avatar");

function preventDirectAccess($filename) {
    $requesturl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if (false !== strpos($requesturl, $filename)) {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }
}

$access = false;
if (isset($_SESSION['vaiuugroup']['user_id_name']) && isset($_SESSION['vaiuugroup']['user_email'])) {
    $access = true;
    $userid = $_SESSION['vaiuugroup']['user_id_name'];
    $useremail = $_SESSION['vaiuugroup']['user_email'];
} else if (v_cookieEnable() == true) {
    $access = true;
    $userid = $_COOKIE['user_id_name'];
    $useremail = $_COOKIE['user_email'];
    $_SESSION['vaiuugroup']['user_id_name']=$userid;
    $_SESSION['vaiuugroup']['user_email']=$useremail;
} else {
    $access = false;
}

if ($access == true) {
    $userinfo = v_dataSelect("mrpredict_user", "user_id_name='$userid' AND user_email='$useremail'");
    $userid = empty($userinfo['data'][0]['user_id_name']) ? "" : $userinfo['data'][0]['user_id_name'];
    $useremail = empty($userinfo['data'][0]['user_email']) ? "" : $userinfo['data'][0]['user_email'];
    $avatar = empty($userinfo['data'][0]['profile_picture']) ? BASE_URL . "assets/userimages/avatar.jpg" : $userinfo['data'][0]['profile_picture'];
    $imagelist = v_dataSelect("avatar", "status='active'");
} else {
    echo '<script> window.location.href="' . BASE_URL . 'logout.php"; </script>';
    die();
}
?>

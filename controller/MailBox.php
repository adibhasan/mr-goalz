<?php

preventDirectAccess("Gamelist");

function preventDirectAccess($filename) {
    $requesturl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if (false !== strpos($requesturl, $filename)) {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }
}

if (!v_get_getpass()) {
    v_reDirect(BASE_URL . "logout.php");
}
$userid = $_SESSION['vaiuugroup']['user_id_name'];
$useremail = $_SESSION['vaiuugroup']['user_email'];
$userinfo = v_dataSelect("mrpredict_user", "user_id_name='$userid' AND user_email='$useremail'");
$boxsms= boxMessage();
$boxsmsall=$boxsms['all'];
if(isset($_GET['mailid'])){
    $id=$userinfo['data'][0]['userid'];
    $m['status']="readed";
    $m['update_date']=date("Y-m-d H:i:s");
    v_dataUpdate("message_box", $m, "message_id='".$_GET['mailid']."' AND receiver_id='$id'");
    $particularmessage=  v_dataSelect("message_box","message_id='".$_GET['mailid']."' AND receiver_id='$id'");
}
?>

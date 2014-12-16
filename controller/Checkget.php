<?php
ob_start();
include '../Generic.php';
if (isset($_GET['completionkey']) && isset($_GET['secretkey'])) {
    unset($_SESSION['token']);
    $token = $_GET['completionkey'];
    $secretkey = $_GET['secretkey'];
    $tokencheck = v_dataSelect("tokens", "token='$token'");
    $secretkeycheck = v_dataSelect("mrpredict_user", "recovery_number='$secretkey' AND status='pending'");
    if ($tokencheck['counter'] == 0) {
         v_show_404();
    } else if ($secretkeycheck['counter'] == 0) {
        v_show_404();
    } else {
        $dataarray['status'] = "active";
        $dataarray['update_date'] = date("Y-m-d H:i:s");
        $dataarray['user_ip']=v_get_client_ip();
        $activeaccount = v_dataUpdate("mrpredict_user", $dataarray, "recovery_number='$secretkey'");
        if ($activeaccount) {
            $deletetoken = v_dataDelete("tokens", "token='$token' ");
            if ($deletetoken) {
                $_SESSION['vaiuugroup']['user_id_name']=$secretkeycheck['data'][0]['user_id_name'];
                $_SESSION['vaiuugroup']['user_email']=$secretkeycheck['data'][0]['user_email'];
                $url = BASE_URL . "settings.php";
                v_reDirect($url);
            } else {
                $url = BASE_URL . "logout.php";
                v_reDirect($url);
            }
        }
    }
}else if(isset($_GET['completionkey']) && isset($_GET['newemail'])){
    echo "Hello there ";
} else {
    $url = BASE_URL . "logout.php";  // Un authorize
    v_reDirect($url);
}
ob_flush();
?>


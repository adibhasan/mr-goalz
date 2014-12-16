<?php
if (isset($_SESSION['vaiuugroup']['adminname']) && isset($_SESSION['vaiuugroup']['adminemail']) && $_SESSION['vaiuugroup']['admintype']) {
    $userinfo = v_dataSelect("mrpredict_user", "status !='deleted'");
    if(isset($_GET['userid']) && isset($_GET['action']) && $_GET['action']=="edit-general-user"){
        $id=$_GET['userid'];
        $uniqueuser=v_dataSelect("mrpredict_user", "status !='deleted'  AND userid='$id'");
    }
    include 'view/user.php';
} else {
    v_show_404();
}
?>


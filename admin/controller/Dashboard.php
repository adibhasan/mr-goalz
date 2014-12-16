<?php
if(isset($_SESSION['vaiuugroup']['adminname']) && isset($_SESSION['vaiuugroup']['adminemail']) && $_SESSION['vaiuugroup']['admintype']){
    $admininfo = v_dataSelect("admin", "status !='deleted' AND admintype!='super admin'");
    if(isset($_GET['adminid']) && isset($_GET['action']) && $_GET['action']=="edit-admin-user"){
        $id=$_GET['adminid'];
        $uniqueuser=v_dataSelect("admin", "status !='deleted' AND admintype!='super admin' AND id='$id'");
    }
    include 'view/dashboard.php';
}else{
    v_show_404();
}

?>


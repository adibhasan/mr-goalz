<?php
if(isset($_SESSION['vaiuugroup']['adminname']) && isset($_SESSION['vaiuugroup']['adminemail']) && $_SESSION['vaiuugroup']['admintype']){
    v_reDirect(BASE_URL."admin/admin.php?adminroute=home");
}else{
    include 'view/userlogin.php';
}
?>
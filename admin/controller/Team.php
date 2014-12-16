<?php
if(isset($_SESSION['vaiuugroup']['adminname']) && isset($_SESSION['vaiuugroup']['adminemail']) && $_SESSION['vaiuugroup']['admintype']){
    $teaminfo=  v_dataSelect("team", "status!='deleted'");
     if(isset($_GET['teamid']) && isset($_GET['action']) && $_GET['action']=="edit-team"){
        $id=$_GET['teamid'];
        $uniqueinfo=v_dataSelect("team", "status !='deleted' AND teamid='$id'");
    }
    include 'view/team.php';
}else{
    v_show_404();
}

?>



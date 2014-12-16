<?php
if (isset($_SESSION['vaiuugroup']['adminname']) && isset($_SESSION['vaiuugroup']['adminemail']) && $_SESSION['vaiuugroup']['admintype']) {
    $userinfo = v_dataSelect("league", "status !='deleted'");
    $teaminfo = v_dataSelect("team", "status !='deleted'");
    $gameinfo = v_dataSelect("upcominggames", "status !='deleted'");
    $currentdate=date("Y-m-d H:i:s");
    $gameinfo_old = v_dataSelect("upcominggames", "status !='deleted' AND  schedule < '$currentdate'");
    $gameinfo_new = v_dataSelect("upcominggames", "status !='deleted' AND  schedule > '$currentdate'");
    if (isset($_GET['leagueid']) && isset($_GET['action']) && $_GET['action'] === "update-league") {
        $id = $_GET['leagueid'];
        $league_info = v_dataSelect("league", "status !='deleted'  AND leagueid='$id'");
    }
    if (isset($_GET['gameid']) && isset($_GET['action']) && $_GET['action'] === "update-game") {
        $id = $_GET['gameid'];
        $game_info = v_dataSelect("upcominggames", "status !='deleted'  AND id='$id'");
    }
    include 'view/game.php';
} else {
    v_show_404();
}
?>

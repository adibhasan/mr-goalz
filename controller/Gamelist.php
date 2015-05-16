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
$userid = empty($userinfo['data'][0]['user_id_name']) ? "" : $userinfo['data'][0]['user_id_name'];
$useremail = empty($userinfo['data'][0]['user_email']) ? "" : $userinfo['data'][0]['user_email'];
$avatar = empty($userinfo['data'][0]['profile_picture']) ? BASE_URL . "assets/userimages/avatar.jpg" : $userinfo['data'][0]['profile_picture'];
$imagelist = v_dataSelect("avatar", "status='active'");
$current_time = time();
$gamelist = v_dataSelect("upcominggames", "status='active' AND schedule_timestamp >'$current_time' ORDER BY schedule_timestamp DESC");
$total_data = count($gamelist['data']);
for ($i = 0; $i < count($gamelist['data']); $i++) {
    $team1 = v_dataSelect("team", "teamid ='" . $gamelist['data'][$i]['team1'] . "'");
    $team2 = v_dataSelect("team", "teamid ='" . $gamelist['data'][$i]['team2'] . "'");
    $upcoming_game[$i]['id'] = $gamelist['data'][$i]['id'];
    $upcoming_game[$i]['team1'] = $team1['data'][0]['teamname'];
    $upcoming_game[$i]['team2'] = $team2['data'][0]['teamname'];
    $upcoming_game[$i]['timestamp'] = $gamelist['data'][$i]['schedule_timestamp'];
    $upcoming_game[$i]['guessing_state'] = $gamelist['data'][$i]['schedule_timestamp'] - time() > 300 ? "has-link" : "no-link";
    $upcoming_game[$i]['game_date'] = date("M d @ h:i a", $gamelist['data'][$i]['schedule_timestamp'] + $_SESSION['client_info']['rawOffset']);
}
$total_upcoming = count($upcoming_game);




$all_team = v_dataSelect("team", "status='active'");

for ($i = 0; $i < count($all_team['data']); $i++) {
    $leaguedata = v_comlex_query_league($all_team['data'][$i]['teamid']);
    if ($leaguedata['data'][0]['final_total'] != 0) {
        $league[$i]['team_name'] = $all_team['data'][$i]['teamname'];
        $league[$i]['played'] = $leaguedata['data'][0]['final_total'];
        $league[$i]['score'] = $leaguedata['data'][0]['final_score'];
    }
}
usort($league, function($a, $b) {
    if ($a['score'] == $b['score'])
        return 0;
    return $a['score'] < $b['score'] ? 1 : -1;
});
$total_league = count($league);
$getBlocks = v_dataSelect("block", "status='active'");
$getBlocks = $getBlocks['data'];
$blockArray=array();
foreach ($getBlocks as $key => $value) {
    $blockArrayKey=  str_replace(" ","_",strtolower($getBlocks[$key]['block_title']));
    $blockArray[$blockArrayKey]=$getBlocks[$key];
}

?>

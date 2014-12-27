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
$uid = $userinfo['data'][0]['userid'];
$userid = empty($userinfo['data'][0]['user_id_name']) ? "" : $userinfo['data'][0]['user_id_name'];
$useremail = empty($userinfo['data'][0]['user_email']) ? "" : $userinfo['data'][0]['user_email'];
$avatar = empty($userinfo['data'][0]['profile_picture']) ? BASE_URL . "assets/userimages/avatar.jpg" : $userinfo['data'][0]['profile_picture'];
$imagelist = v_dataSelect("avatar", "status='active'");
$current_time = time() - 300;
$gamelist = v_dataSelect("upcominggames", "status='active' ORDER BY schedule_timestamp DESC");
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
for ($i = 0; $i < count($upcoming_game); $i++) {
    $guess = v_dataSelect("myguess", "userid='$uid' AND gameid='" . $upcoming_game[$i]['id'] . "'");
    if ($guess['data'] == "") {
        $upcoming_game[$i]['teamonegoal'] = "&nbsp";
        $upcoming_game[$i]['teamtwogoal'] = "&nbsp";
    } else {
        $upcoming_game[$i]['teamonegoal'] = $guess['data'][0]['team1score'];
        $upcoming_game[$i]['teamtwogoal'] = $guess['data'][0]['team2score'];
    }
}
// User history

$history = v_dataSelect("myguess", "status='calculated' AND userid='$uid'");
for ($i = 0; $i < count($history['data']); $i++) {
    $hgame = v_dataSelect("upcominggames", "id='" . $history['data'][$i]['gameid'] . "'");
    $hteam1 = v_dataSelect("team", "teamid='" . $hgame['data'][0]['team1'] . "'");
    $hteam2 = v_dataSelect("team", "teamid='" . $hgame['data'][0]['team2'] . "'");
    $history['data'][$i]['gameTime'] = date("Y-m-d", ($hgame['data'][0]['schedule_timestamp'] + ($_SESSION['client_info']['rawOffset'])));
    $history['data'][$i]['gamedate'] = $hgame['data'][0]['schedule'];
    $history['data'][$i]['gameYear'] = date("Y", $hgame['data'][0]['schedule_timestamp']);
    $history['data'][$i]['gameMonth'] = date("m", $hgame['data'][0]['schedule_timestamp']);
    $history['data'][$i]['gameDate'] = date("d", $hgame['data'][0]['schedule_timestamp']);
    if ($history['data'][$i]['gameDate'] <= 7) {
        $history['data'][$i]['gameWeek'] = 1;
    } else if ($history['data'][$i]['gameDate'] <= 14) {
        $history['data'][$i]['gameWeek'] = 2;
    } else if ($history['data'][$i]['gameDate'] <= 21) {
        $history['data'][$i]['gameWeek'] = 3;
    } else {
        $history['data'][$i]['gameWeek'] = 4;
    }
    $history['data'][$i]['team1name'] = $hteam1['data'][0]['teamname'];
    $history['data'][$i]['team2name'] = $hteam2['data'][0]['teamname'];
    $history['data'][$i]['team1realscore'] = $hgame['data'][0]['team1score'];
    $history['data'][$i]['team2realscore'] = $hgame['data'][0]['team2score'];
    $history['data'][$i]['totalpoints'] = $history['data'][$i]['points1'] + $history['data'][$i]['points2'] + $history['data'][$i]['points3'];
}
$currenYear = date("Y", (time() + ($_SESSION['client_info']['rawOffset'])));
$currenMonth = date("m", (time() + ($_SESSION['client_info']['rawOffset'])));
$currentDay = date("d", (time() + ($_SESSION['client_info']['rawOffset'])));
$currentDate = date("D", (time() + ($_SESSION['client_info']['rawOffset'])));
if ($currentDate == "Fri") {
    $initime = time() + ($_SESSION['client_info']['rawOffset']) - 604800;
    $iniday = date("Y-m-d", $initime);
    $dateTimeArray = array(
        date("Y-m-d", $initime),
        date("Y-m-d", ($initime + (1 * 86400))),
        date("Y-m-d", ($initime + (2 * 86400))),
        date("Y-m-d", ($initime + (3 * 86400))),
        date("Y-m-d", ($initime + (4 * 86400))),
        date("Y-m-d", ($initime + (5 * 86400))),
        date("Y-m-d", ($initime + (6 * 86400)))
    );
}
$j = 0;
for ($i = 0; $i < count($history['data']); $i++) {
    if (in_array($history['data'][$i]['gameTime'], $dateTimeArray)) {
       $history2['data'][$j]['team1name']=$history['data'][$i]['team1name'];
       $history2['data'][$j]['team1score']=$history['data'][$i]['team1score'];
       $history2['data'][$j]['team2name']=$history['data'][$i]['team2name'];
       $history2['data'][$j]['team2score']=$history['data'][$i]['team2score'];
       $history2['data'][$j]['team1realscore']=$history['data'][$i]['team1realscore'];
       $history2['data'][$j]['team2realscore']=$history['data'][$i]['team2realscore'];
       $history2['data'][$j]['totalpoints']=$history['data'][$i]['totalpoints'];
       $j++;
    }
}
$totalhistory = count($history2['data']);
?>

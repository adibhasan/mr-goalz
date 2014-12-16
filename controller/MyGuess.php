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

$access = false;
if (isset($_SESSION['vaiuugroup']['user_id_name']) && isset($_SESSION['vaiuugroup']['user_email'])) {
    $access = true;
    $userid = $_SESSION['vaiuugroup']['user_id_name'];
    $useremail = $_SESSION['vaiuugroup']['user_email'];
} else if (v_cookieEnable() == true) {
    $access = true;
    $userid = $_COOKIE['user_id_name'];
    $useremail = $_COOKIE['user_email'];
    $_SESSION['vaiuugroup']['user_id_name'] = $userid;
    $_SESSION['vaiuugroup']['user_email'] = $useremail;
} else {
    $access = false;
}

if ($access == true) {
    if (isset($_GET['limit']) || $_GET['limit'] != "") {
        $lowerlimit = $_GET['limit'];
    } else {
        $lowerlimit = 0;
    }
    $upperlimit = $lowerlimit + 6;
    $userinfo = v_dataSelect("mrpredict_user", "user_id_name='$userid' AND user_email='$useremail'");
    $userid = empty($userinfo['data'][0]['user_id_name']) ? "" : $userinfo['data'][0]['user_id_name'];
    $useremail = empty($userinfo['data'][0]['user_email']) ? "" : $userinfo['data'][0]['user_email'];
    $avatar = empty($userinfo['data'][0]['profile_picture']) ? BASE_URL . "assets/userimages/avatar.jpg" : $userinfo['data'][0]['profile_picture'];
    $imagelist = v_dataSelect("avatar", "status='active'");
    $current_time = time() - 300;
    $gamelist = v_dataSelect("upcominggames", "status='active' AND schedule_timestamp >'$current_time' ORDER BY schedule_timestamp DESC  LIMIT $lowerlimit,$upperlimit");
    $total_data = count($gamelist['data']);
    for ($i = 0; $i < count($gamelist['data']); $i++) {
        $team1 = v_dataSelect("team", "teamid ='" . $gamelist['data'][$i]['team1'] . "'");
        $team2 = v_dataSelect("team", "teamid ='" . $gamelist['data'][$i]['team2'] . "'");
        $myguess = v_dataSelect("myguess", "userid ='".$userinfo['data'][0]['userid']."' AND gameid='" . $gamelist['data'][$i]['id'] . "'");
        if ($myguess['data'][$i]['guessid'] == "" || $myguess['data'][$i]['guessid'] == null) {
            $upcoming_game[$i]['guessid'] = "nay";
            $upcoming_game[$i]['team1score'] =0;
            $upcoming_game[$i]['team2score'] =0;
        } else {
            $upcoming_game[$i]['guessid'] = $myguess['data'][$i]['guessid'];
            $upcoming_game[$i]['team1score'] = $myguess['data'][$i]['team1score'];
            $upcoming_game[$i]['team2score'] = $myguess['data'][$i]['team2score'];
        }

        $upcoming_game[$i]['id'] = $gamelist['data'][$i]['id'];
        $upcoming_game[$i]['team1'] = $team1['data'][0]['teamname'];
        $upcoming_game[$i]['team2'] = $team2['data'][0]['teamname'];
        $upcoming_game[$i]['timestamp'] = $gamelist['data'][$i]['schedule_timestamp'];
        $upcoming_game[$i]['guessing_state'] = $gamelist['data'][$i]['schedule_timestamp'] - time() > 300 ? "has-link" : "no-link";
        $upcoming_game[$i]['game_date'] = date("M d,Y @ h:i a", $gamelist['data'][$i]['schedule_timestamp'] + $_SESSION['client_info']['rawOffset']);
    }
    
} else {
    echo '<script> window.location.href="' . BASE_URL . 'logout.php"; </script>';
    die();
}
?>

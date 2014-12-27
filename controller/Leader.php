<?php

preventDirectAccess("Leader");

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
$leaderlist = allUserScore();
for ($i = 0; $i < count($leaderlist); $i++) {
    if ($i == 0) {
        $leaderlist[$i]['rank'] = ($i + 1) . "st";
    } elseif ($i == 1) {
        $leaderlist[$i]['rank'] = ($i + 1) . "nd";
    } elseif ($i == 2) {
        $leaderlist[$i]['rank'] = ($i + 1) . "rd";
    } else {
        $leaderlist[$i]['rank'] = ($i + 1) . "th";
    }
}
$totalleader = count($leaderlist);
/* * ***************************************** */
$userid = $_SESSION['vaiuugroup']['user_id_name'];
$useremail = $_SESSION['vaiuugroup']['user_email'];
$userinfo = v_dataSelect("mrpredict_user", "user_id_name='$userid' AND user_email='$useremail'");
$allprivateleague = v_all_league($userinfo['data'][0]['userid']);
if (isset($_GET['groupid'])) {
    $groupid = $_GET['groupid'];
    $groupinfo = v_dataSelect("enrolegroup", "groupid='$groupid'");
    for ($i = 0; $i < count($groupinfo['data']); $i++) {
        $fscore[$i] = userTotalScore($groupinfo['data'][$i]['userid']);
    }
}
usort($fscore, function($a, $b) {
    if ($a['withoutbonus'] == $b['withoutbonus'])
        return 0;
    return $a['withoutbonus'] < $b['withoutbonus'] ? 1 : -1;
});
for ($i = 0; $i < count($fscore); $i++) {
    if ($i == 0) {
        $fscore[$i]['rank'] = ($i + 1) . "st";
    } elseif ($i == 1) {
        $fscore[$i]['rank'] = ($i + 1) . "nd";
    } elseif ($i == 2) {
        $fscore[$i]['rank'] = ($i + 1) . "rd";
    } else {
        $fscore[$i]['rank'] = ($i + 1) . "th";
    }
}

// Get my league
$allmyleague=  v_dataSelect("usergroup","userid='".$userinfo['data'][0]['userid']."'");
$inviteleaderlist=$leaderlist;
//for($i=0;$i<count($inviteleaderlist);$i++){
//    if($inviteleaderlist[$i]['useremail']==$_SESSION['vaiuugroup']['user_email']){
//        unset($inviteleaderlist[$i]);
//    }
//}
/********* End of new code *****************/
$userid = empty($userinfo['data'][0]['user_id_name']) ? "" : $userinfo['data'][0]['user_id_name'];
$useremail = empty($userinfo['data'][0]['user_email']) ? "" : $userinfo['data'][0]['user_email'];
$avatar = empty($userinfo['data'][0]['profile_picture']) ? BASE_URL . "assets/userimages/avatar.jpg" : $userinfo['data'][0]['profile_picture'];
$completed_games = v_dataSelect("upcominggames", "status='completed'");
$counter = 0;
for ($i = 0; $i < count($completed_games['data'][$i]); $i++) {
    $guess[$i] = v_dataSelect("myguess", "gameid='" . $completed_games['data'][$i]['id'] . "' AND status='active'");
    if ($guess[$i]['counter'] != 0) {
        $myguess[$counter]['data'] = $guess[$i]['data'];
        $myguess[$counter]['data'][0]['team1Goal'] = $completed_games['data'][$i]['team1score'];
        $myguess[$counter]['data'][0]['team2Goal'] = $completed_games['data'][$i]['team2score'];
        $counter++;
    }
}
for ($j = 0; $j < count($myguess); $j++) {
    $result1 = "";
    $result2 = "";
    if ($myguess[$j]['data'][0]['team1Goal'] > $myguess[$j]['data'][0]['team2Goal']) {
        $result1 = 1;
    } else if ($myguess[$j]['data'][0]['team1Goal'] < $myguess[$j]['data'][0]['team2Goal']) {
        $result1 = 2;
    } else {
        $result1 = 0;
    }

    if ($myguess[$j]['data'][0]['team1score'] > $myguess[$j]['data'][0]['team2score']) {
        $result2 = 1;
    } else if ($myguess[$j]['data'][0]['team1score'] < $myguess[$j]['data'][0]['team2score']) {
        $result2 = 2;
    } else {
        $result2 = 0;
    }

    if ($result1 == $result2) {
        $data['points1'] = 4;
    } else {
        $data['points1'] = 0;
    }
    if ($myguess[$j]['data'][0]['team1score'] == $myguess[$j]['data'][0]['team1Goal'] && $myguess[$j]['data'][0]['team2score'] == $myguess[$j]['data'][0]['team2Goal']) {
        $data['points2'] = 6;
    } else {
        $data['points2'] = 0;
    }

    if ($myguess[$j]['data'][0]['team1score'] >= $myguess[$j]['data'][0]['team1Goal']) {
        $result1 = $myguess[$j]['data'][0]['team1Goal'];
    } else {
        $result1 = $myguess[$j]['data'][0]['team1score'];
    }
    if ($myguess[$j]['data'][0]['team2score'] >= $myguess[$j]['data'][0]['team2Goal']) {
        $result2 = $myguess[$j]['data'][0]['team2Goal'];
    } else {
        $result2 = $myguess[$j]['data'][0]['team2score'];
    }
    $data['points3'] = $result1 + $result2;
    $data['calculated'] = date("Y-m-d H:i:s");
    $data['calculatedtime_stamp'] = time();
    $data['status'] = "calculated";
    v_dataUpdate("myguess", $data, "guessid='" . $myguess[$j]['data'][0]['guessid'] . "'");
}

$leader_data = v_dataSelect("myguess", "status='calculated'");
for ($i = 0; $i < count($leader_data['data']); $i++) {
    $leader_data['data'][$i]['total_point'] = $leader_data['data'][$i]['points1'] + $leader_data['data'][$i]['points2'] + $leader_data['data'][$i]['points3'];
    $leader_data['data'][$i]['year'] = date("Y", $leader_data['data'][$i]['calculatedtime_stamp']);
    $leader_data['data'][$i]['month'] = date("m", $leader_data['data'][$i]['calculatedtime_stamp']);
    $leader_data['data'][$i]['day'] = date("d", $leader_data['data'][$i]['calculatedtime_stamp']);
    if ($leader_data['data'][$i]['day'] <= 7) {
        $leader_data['data'][$i]['weak'] = 1;
    } else if ($leader_data['data'][$i]['day'] <= 14) {
        $leader_data['data'][$i]['weak'] = 2;
    } else if ($leader_data['data'][$i]['day'] <= 21) {
        $leader_data['data'][$i]['weak'] = 3;
    } else {
        $leader_data['data'][$i]['weak'] = 4;
    }
    $find_bonus = v_dataSelect("monthly_bonus", "user_id='" . $leader_data['data'][$i]['userid'] . "' AND month_number='" . $leader_data['data'][$i]['month'] . "' AND year='" . $leader_data['data'][$i]['year'] . "' AND week_number='" . $leader_data['data'][$i]['weak'] . "' AND status='used'");
    $leader_data['data'][$i]['bonus'] = empty($find_bonus['data']) ? 1 : 2;
    $leader_data['data'][$i]['point_with_bonus'] = $leader_data['data'][$i]['total_point'] * $leader_data['data'][$i]['bonus'];
}
$leader_array = $leader_data['data'];
for ($i = 0; $i < count($leader_array); $i++) {
    $x = "user_" . $leader_array[$i]['userid'];
    $data_table[$x][$i];
    if (empty($data_table[$x])) {
        $data_table[$x] = array(
            $leader_array[$i]
        );
    } else {
        array_push($data_table[$x], $leader_array[$i]);
    }
}
$final_leader = array();
$usercount = 0;
$userpoint = 0;
$point1 = 0;
$point2 = 0;
$point3 = 0;
foreach ($data_table as $key => $value) {
    for ($i = 0; $i < count($data_table[$key]); $i++) {
        $userid = $data_table[$key][$i]['userid'];
        $userpoint = $userpoint + $data_table[$key][$i]['point_with_bonus'];
        $point1 = $point1 + $data_table[$key][$i]['points1'];
        $point2 = $point2 + $data_table[$key][$i]['points2'];
        $point3 = $point3 + $data_table[$key][$i]['points3'];
    }
    $final_leader[$usercount]['userid'] = $userid;
    $final_leader[$usercount]['userpoint'] = $userpoint;
    $final_leader[$usercount]['point1'] = $point1;
    $final_leader[$usercount]['point2'] = $point2;
    $final_leader[$usercount]['point3'] = $point3;
    $usercount++;
    $userpoint = 0;
    $point1 = 0;
    $point2 = 0;
    $point3 = 0;
}
usort($final_leader, function($a, $b) {
    return $b['userpoint'] - $a['userpoint'];
});
for ($i = 0; $i < count($final_leader); $i++) {
    $userinfo2 = v_dataSelect("mrpredict_user", "userid='" . $final_leader[$i]['userid'] . "'");
    $final_leader[$i]['username'] = $userinfo2['data'][0]['user_name'] != "" ? $userinfo2['data'][0]['user_name'] : "User" . ($i + 1);
    $friend_list = v_dataSelect("friend_list", "invitor_id='" . $userinfo['data'][0]['userid'] . "' AND invited_id='" . $final_leader[$i]['userid'] . "'  AND status !='deleted'");
    if ($userinfo['data'][0]['userid'] == $final_leader[$i]['userid']) {
        $final_leader[$i]['fnfstatus'] = "own-circle";
    } else if ($friend_list['counter'] != 0) {
        $final_leader[$i]['fnfstatus'] = "circle-" . $friend_list['data'][0]['status'];
    } else {
        $final_leader[$i]['fnfstatus'] = "add-circle";
    }
    if ($i == 0) {
        $final_leader[$i]['rank'] = ($i + 1) . "st";
    } elseif ($i == 1) {
        $final_leader[$i]['rank'] = ($i + 1) . "nd";
    } elseif ($i == 2) {
        $final_leader[$i]['rank'] = ($i + 1) . "rd";
    } else {
        $final_leader[$i]['rank'] = ($i + 1) . "th";
    }
}

//$my_history = v_complex_query_history($userinfo['data'][0]['userid']);
//for ($i = 0; $i < count($my_history['data']); $i++) {
//    $team1 = v_dataSelect("team", "teamid='" . $my_history['data'][$i]['team1'] . "'");
//    $team2 = v_dataSelect("team", "teamid='" . $my_history['data'][$i]['team2'] . "'");
//    $my_history['data'][$i]['team1Name'] = $team1['data'][0]['teamname'];
//    $my_history['data'][$i]['team2Name'] = $team2['data'][0]['teamname'];
//    $my_history['data'][$i]['year'] = date("Y", $my_history['data'][$i]['calculatedtime_stamp']);
//    $my_history['data'][$i]['month'] = date("m", $my_history['data'][$i]['calculatedtime_stamp']);
//    $my_history['data'][$i]['day'] = date("d", $my_history['data'][$i]['calculatedtime_stamp']);
//    $my_history['data'][$i]['totalpoint'] = $my_history['data'][$i]['points1'] + $my_history['data'][$i]['points2'] + $my_history['data'][$i]['points3'];
//    if ($my_history['data'][$i]['day'] <= 7) {
//        $my_history['data'][$i]['weak'] = 1;
//    } else if ($my_history['data'][$i]['day'] <= 14) {
//        $my_history['data'][$i]['weak'] = 2;
//    } else if ($my_history['data'][$i]['day'] <= 21) {
//        $my_history['data'][$i]['weak'] = 3;
//    } else {
//        $my_history['data'][$i]['weak'] = 4;
//    }
//}
?>

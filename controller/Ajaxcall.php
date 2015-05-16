<?php

ob_start();
error_reporting(0);
include '../Generic.php';
if (empty($_POST['method']) || $_POST['method'] == "") {
    v_returnMessage("Direct access is not allowed.", false, "warning", "", "");
}
if ($_POST['method'] == "emailcheck") {
    unset($_POST['method']);
    $token = empty($_POST['token']) ? "" : $_POST['token'];
    $email = empty($_POST['user_email']) ? "" : $_POST['user_email'];
    v_tokenCheck($token);
    $result = checkUserExistance("mrpredict_user", "user_email='$email'");
    if ($result) {
        v_returnMessage("Email exists, enter another email.", false, "warning", "", "");
    } else {
        v_returnMessage("Email can be taken.", true, "success", "", "");
    }
}
if ($_POST['method'] == "leaguecheck") {
    unset($_POST['method']);
    $token = empty($_POST['token']) ? "" : $_POST['token'];
    $leaguename = empty($_POST['league_name']) ? "" : $_POST['league_name'];
    v_tokenCheck($token);
    $result = checkUserExistance("usergroup", "groupname='$leaguename'");
    if ($result) {
        v_returnMessage("Group name exists, enter another name.", false, "warning", "", "");
    } else {
        v_returnMessage("Group name can be taken.", true, "success", "", "");
    }
}
if ($_POST['method'] == "deletesms") {
    $smsid = $_POST['smsis'];
    if ($smsid == "") {
        v_returnMessage("Message id is required", false, "warning", "", "");
    }
    $userid = $_SESSION['vaiuugroup']['user_id_name'];
    $useremail = $_SESSION['vaiuugroup']['user_email'];
    $userinfo = v_dataSelect("mrpredict_user", "user_id_name='$userid' AND user_email='$useremail'");
    $uid = $userinfo['data'][0]['userid'];
    $del = v_dataDelete("message_box", "message_id='$smsid' AND receiver_id='$uid'");
    if ($del) {
        v_returnMessage("Message deleted successfully.", true, "success", "", "");
    } else {
        v_returnMessage("Message failed to delete", false, "warning", "", "");
    }
}
if ($_POST['method'] == "teamcheck") {
    unset($_POST['method']);
    $token = empty($_POST['token']) ? "" : $_POST['token'];
    $teamnName = empty($_POST['teamname']) ? "" : $_POST['teamname'];
    v_tokenCheck($token);
    $result = checkUserExistance("team", "teamname='$teamnName'");
    if ($result) {
        v_returnMessage("League name exists, enter another name.", false, "warning", "", "");
    } else {
        v_returnMessage("League name can be taken.", true, "success", "", "");
    }
}
if ($_POST['method'] == "leaveleague") {
    unset($_POST['method']);
    if ($_POST['leagueid'] == "") {
        v_returnMessage("League id is required.", false, "danger", "", "");
    }
    $userid = $_SESSION['vaiuugroup']['user_id_name'];
    $useremail = $_SESSION['vaiuugroup']['user_email'];
    $userinfo = v_dataSelect("mrpredict_user", "user_id_name='$userid' AND user_email='$useremail'");
    $del=v_dataDelete("enrolegroup", "groupid='".$_POST['leagueid']."' AND userid='".$userinfo['data'][0]['userid']."'");
    if($del){
       v_returnMessage("You have left the league successfully.",true, "success", "", ""); 
    }else{
       v_returnMessage("Leaving the league has been failed, please try again later.", false, "danger", "", "");
    }
}
if ($_POST['method'] == "addToCircle") {
    $smsid = $_POST['smsis'];
    if ($smsid == "") {
        v_returnMessage("Message id is required", false, "warning", "", "");
    }
    $userid = $_SESSION['vaiuugroup']['user_id_name'];
    $useremail = $_SESSION['vaiuugroup']['user_email'];
    $userinfo = v_dataSelect("mrpredict_user", "user_id_name='$userid' AND user_email='$useremail'");
    $uid = $userinfo['data'][0]['userid'];
    $check = v_dataSelect("enrolegroup", "id='$smsid' AND userid='$uid' AND status='pending'");
    if ($check['counter'] == 1) {
        $dataarray['status'] = "active";
        $up = v_dataUpdate("enrolegroup", $dataarray, "id='$smsid' AND userid='$uid'");
        if ($up) {
            v_returnMessage("You have been added to the group successfully.", true, "success", "", "");
        } else {
            v_returnMessage("Group addition failed, please try again later.", false, "danger", "", "");
        }
    } else {
        v_returnMessage("Group addition failed. Already added to the group.", false, "danger", "", "");
    }
}
if ($_POST['method'] == "addfriend") {
    unset($_POST['method']);
    if ($_POST['invited_id'] == "") {
        v_returnMessage("Friend id empty.", false, "danger", "0", "refresh");
    }
    $friendid = $_POST['invited_id'];
    $user_id_name = $_SESSION['vaiuugroup']['user_email'];
    $darray1 = v_dataSelect("mrpredict_user", "user_email='$user_id_name'");
    $darray2 = v_dataSelect("mrpredict_user", "userid='$friendid'");
    if ($darray1['counter'] == 0 || $darray2['counter'] == 0) {
        v_returnMessage("Friend id empty.", false, "danger", "0", "refresh");
    }
    $data['friend_token'] = md5(time());
    $data['invitor_id'] = $darray1['data'][0]['userid'];
    $data['invited_id'] = $darray2['data'][0]['userid'];
    $data['create_date'] = date("Y-m-d H:i:s");
    $data['update_date'] = date("Y-m-d H:i:s");
    $data['status'] = "pending";
    $darray3 = v_dataSelect("friend_list", "invitor_id='" . $data['invitor_id'] . "' AND invited_id='" . $data['invited_id'] . "'");
    if ($darray3['counter'] == 0) {
        $inser_to_list = v_dataInsert_LastId("friend_list", $data);
        $emailmessage['receiver_id'] = $friendid;
        $emailmessage['sender_id'] = $data['invitor_id'];
        $emailmessage['sender_type'] = "user";
        $emailmessage['message_type'] = "invitation";
        $emailmessage['message_title'] = "Join With Me";
        $messagebody = "<strong>" . $darray1['data'][0]['user_name'] . "(" . $darray1['data'][0]['user_email'] . ")</strong> has invited you to join his/her group.<br> To join his group simply click the below link:<a href='Execute.php?method='" . md5("joingroup") . "&key=" . $data['friend_token'] . "'><strong>Accept invitation of " . $darray1['data'][0]['user_name'] . "</strong></a>";
        $emailmessage['message_body'] = addslashes($messagebody);

        $emailmessage['create_date'] = date("Y-m-d H:i:s");
        $emailmessage['update_date'] = date("Y-m-d H:i:s");
        $emailmessage['status'] = "pending";
        v_dataInsert("message_box", $emailmessage);
        simpleMail($darray1['data'][0]['user_email'], $darray2['data'][0]['user_email'], $emailmessage['message_body'], $emailmessage['message_title'], $darray1['data'][0]['user_email']);
        v_returnMessage("Joining request has been sent successfully.", true, "success", $friendid, "");
    } else {
        v_returnMessage("Invitation exists.", false, "danger", "0", "refresh");
    }
}
if ($_POST['method'] == "deletefriend") {
    unset($_POST['method']);
    if ($_POST['invited_id'] == "") {
        v_returnMessage("Friend id empty.", false, "danger", "0", "refresh");
    }
    $friendid = $_POST['invited_id'];
    $user_id_name = $_SESSION['vaiuugroup']['user_email'];
    $darray1 = v_dataSelect("mrpredict_user", "user_email='$user_id_name'");
    $darray2 = v_dataSelect("mrpredict_user", "userid='$friendid'");
    if ($darray1['counter'] == 0 || $darray2['counter'] == 0) {
        v_returnMessage("Friend id empty.", false, "danger", "0", "refresh");
    }
    v_dataDelete("friend_list", "invitor_id='" . $darray1['data'][0]['userid'] . "' AND invited_id='" . $darray2['data'][0]['userid'] . "'");
    v_dataDelete("friend_list", "invitor_id='" . $darray2['data'][0]['userid'] . "' AND invited_id='" . $darray1['data'][0]['userid'] . "'");
    simpleMail($darray1['data'][0]['user_email'], $darray2['data'][0]['user_email'], "You and " . $darray1['data'][0]['user_name'] . " Joining has been removed by " . $darray1['data'][0]['user_name'], "Removed from group", $darray1['data'][0]['user_email']);
    v_returnMessage("Joining removed successfully.", true, "success", $friendid, "");
}
if ($_POST['method'] == "addmyscore") {
    unset($_POST['method']);
    $email = $_SESSION['vaiuugroup']['user_email'];
    $user_data = v_dataSelect("mrpredict_user", "user_email='$email'");
    $userid = $user_data['data'][0]['userid'];
    if ($_POST['gameid'] == "") {
        v_returnMessage("Game id empty.", false, "danger", "0", "refresh");
    }
    if ($_POST['team1score'] == "") {
        v_returnMessage("Team one score is empty.", false, "danger", $_POST['gameid'], "refresh");
    }
    if ($_POST['team2score'] == "") {
        v_returnMessage("Team two score is empty.", false, "danger", $_POST['gameid'], "refresh");
    }
    $current_time = time() - 300;
    $gameid = $_POST['gameid'];
    $checktime = v_dataSelect("upcominggames", "status='active' AND schedule_timestamp >'$current_time' AND id=$gameid");
    if ($checktime['data'][0]['id'] == "") {
        v_returnMessage("Un authorize access.", false, "danger", $_POST['gameid'], "refresh");
    }
    $checkexistance = v_dataSelect("myguess", "userid='$userid' AND gameid='$gameid'");
    if ($checkexistance['data'][0]['guessid'] == "") {
        $dataarray['userid'] = $userid;
        $dataarray['gameid'] = $gameid;
        $dataarray['team1score'] = $_POST['team1score'];
        $dataarray['team2score'] = $_POST['team2score'];
        $dataarray['createdate'] = date("Y-m-d H:i:s");
        $dataarray['updatedate'] = date("Y-m-d H:i:s");
        $dataarray['status'] = "active";
        $dbstatus = v_dataInsert("myguess", $dataarray);
    } else {
        $dataarray['team1score'] = $_POST['team1score'];
        $dataarray['team2score'] = $_POST['team2score'];
        $dataarray['updatedate'] = date("Y-m-d H:i:s");
        $dbstatus = v_dataUpdate("myguess", $dataarray, "userid='$userid' AND gameid='$gameid'");
    }
    if ($dbstatus) {
        v_returnMessage("Score updated successfully.", true, "success", $_POST['gameid'], "refresh");
    } else {
        v_returnMessage("Score update failed.", false, "danger", $_POST['gameid'], "refresh");
    }
}
if ($_POST['method'] == "useridnamecheck") {
    unset($_POST['method']);
    $token = empty($_POST['token']) ? "" : $_POST['token'];
    $user_id_name = empty($_POST['user_id_name']) ? "" : $_POST['user_id_name'];
    v_tokenCheck($token);
    $result = checkUserExistance("mrpredict_user", "user_id_name='$user_id_name'");
    if ($result) {
        v_returnMessage("User name has been already taken, please try with another user name.", false, "warning", "", "");
    } else {
        v_returnMessage("User name can be taken.", true, "success", "", "");
    }
    echo json_encode($return);
    die();
}
if ($_POST['method'] == "addbonus") {
    unset($_POST['method']);
    $year = date("Y");
    $month = date("m");
    $email = $_SESSION['vaiuugroup']['user_email'];
    $userinfo = v_dataSelect("mrpredict_user", "user_email='$email'");
    $userid = $userinfo['data'][0]['userid'];
    $t = v_get_week_number();
    $y = $t['applied_year'];
    $m = $t['applied_month'];
    $wnumber = $t['fridaynumber'];
    $check = v_dataSelect("monthly_bonus", "user_id='$userid' AND applied_year='$y' AND applied_month='$m' AND fridaynumber='$wnumber' AND status='used'");
    if ($check['counter'] != 0) {
        v_returnMessage("You can not use more than 1 bonus for a particular week.", false, "danger", "", "");
    } else {
        $availablebonus = v_dataSelect("monthly_bonus", "user_id='$userid' AND month_number='" . date("m") . "' AND year='" . date("Y") . "' AND status='active'");
        $totalbonus = count($availablebonus['data']);
        if ($totalbonus == 1) {
            $t['update_date'] = date("Y-m-d H:i:s");
            $t['status'] = "used";
            $up = v_dataUpdate("monthly_bonus", $t, "bonus_id='" . $availablebonus['data'][0]['bonus_id'] . "'");
            if ($up) {
                v_returnMessage("Bonus added successfully for this week.", true, "success", 0, "");
            } else {
                v_returnMessage("Bonus added failed, please try again later.", false, "danger", $totalbonus, "");
            }
        } else if ($totalbonus > 1) {
            $t['update_date'] = date("Y-m-d H:i:s");
            $t['status'] = "used";
            $up = v_dataUpdate("monthly_bonus", $t, "bonus_id='" . $availablebonus['data'][0]['bonus_id'] . "'");
            if ($up) {
                v_returnMessage("Bonus added successfully for this week.", true, "success", $totalbonus - 1, "");
            } else {
                v_returnMessage("Bonus added failed, please try again later.", false, "danger", $totalbonus, "");
            }
        } else {
            v_returnMessage("You do not have any bonus for this week or month.", false, "danger", 0, "");
        }
    }
}

function checkUserExistance($tablename, $condition) {
    $userdata = v_dataSelect($tablename, $condition);
    if ($userdata['counter'] == 0) {
        return false;
    } else {
        return true;
    }
}

echo json_encode($return);
die();
ob_flush();
?>


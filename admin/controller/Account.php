<?php

include '../../Generic.php';
if (empty($_POST['method']) || $_POST['method'] == "") {
    v_returnMessage("Direct access is not allowed.", false, "danger", "", "");
}
if ($_POST['method'] == "adminlogin") {
    v_tokenCheck($_POST['token']);
    v_authenTicate("User email", true, 6, 100, "email", "adminemail", $_POST['adminemail']);
    v_authenTicate("User password", true, 8, 20, "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,20}$/", "adminpassword", $_POST['adminpassword']);
    userLogin($_POST);
}
if ($_POST['method'] == "changeusername") {
    v_tokenCheck($_POST['token']);
    v_authenTicate("User Name", true, 2, 50, "", "adminname", $_POST['adminname']);
    if ($_SESSION['vaiuugroup']['adminname'] == "" || empty($_SESSION['vaiuugroup']['adminname'])) {
        v_returnMessage("Empty session found , please tryagain later.", false, "danger", "", BASE_URL . "admin/");
    }
    updateuser_name($_POST);
}
if ($_POST['method'] == "addmonthbonus") {
    $monthbonus = v_dataSelect("user_bonus", "bonus_type='monthly bonus' AND bonus_year='" . date("Y") . "' AND bonus_month='" . date("m") . "' AND status='active'");
    if ($monthbonus['counter'] != 0) {
        v_returnMessage("Monthly bonus has been already added.", false, "danger", "", "");
    } else {
        addMonthLyBonus();
    }
}
if ($_POST['method'] == "add-perform-bonus") {
    $monthbonus = v_dataSelect("user_bonus", "bonus_type='performance bonus' AND bonus_year='" . date("Y") . "' AND bonus_month='" . date("m") . "' AND status='active'");
    if ($monthbonus['counter'] != 0) {
        v_returnMessage("Performance  bonus for this month has been already added.", false, "danger", "", "");
    } else {
        addPerformanceBonus();
    }
}
if ($_POST['method'] == "changepassword") {
    v_tokenCheck($_POST['token']);
    v_authenTicate("Old password", true, 8, 20, "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,20}$/", "oldpassword", $_POST['oldpassword']);
    v_authenTicate("New password", true, 8, 20, "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,20}$/", "adminpassword", $_POST['adminpassword']);
    if ($_POST['adminpassword'] == $_POST['oldpassword']) {
        v_returnMessage("New password and old password can not be same.", false, "danger", "", "");
    }
    if ($_POST['adminpassword'] != $_POST['retypedpassword']) {
        v_returnMessage("Retyped password and new password must be same.", false, "danger", "", "");
    }
    if ($_SESSION['vaiuugroup']['adminname'] == "" || empty($_SESSION['vaiuugroup']['adminname'])) {
        v_returnMessage("Empty session found , please tryagain later.", false, "danger", "", BASE_URL . "admin/");
    }
    updateuser_password($_POST);
}
if ($_POST['method'] == "createadmin") {
    v_tokenCheck($_POST['token']);
    v_authenTicate("Status", true, 5, 20, "", "status", $_POST['status']);
    v_authenTicate("Admin name", true, 5, 50, "", "adminname", $_POST['adminname']);
    v_authenTicate("Admin email", true, 5, 150, "email", "adminemail", $_POST['adminemail']);
    v_authenTicate("Password", true, 8, 20, "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,20}$/", "adminpassword", $_POST['adminpassword']);
    if ($_POST['adminpassword'] != $_POST['retypedpassword']) {
        v_returnMessage("Retyped password and new password must be same.", false, "danger", "", "");
    }
    if ($_SESSION['vaiuugroup']['adminname'] == "" || empty($_SESSION['vaiuugroup']['adminname'])) {
        v_returnMessage("Empty session found , please tryagain later.", false, "danger", "", BASE_URL . "admin/");
    }
    create_admin($_POST);
}
if ($_POST['method'] == "updateadmin") {
    v_tokenCheck($_POST['token']);
    if ($_SESSION['vaiuugroup']['adminname'] == "" || empty($_SESSION['vaiuugroup']['adminname'])) {
        v_returnMessage("Empty session found , please tryagain later.", false, "danger", "", BASE_URL . "admin/");
    }
    v_authenTicate("User status", true, 2, 10, "", "status", $_POST['status']);
    v_authenTicate("User name", true, 2, 50, "", "adminname", $_POST['adminname']);
    v_authenTicate("User email", true, 5, 100, "email", "adminemail", $_POST['adminemail']);
    updateuser_info($_POST);
}
if ($_POST['method'] == "deleteuser") {
    $deleteuser = false;
    $url = "";
    if ($_SESSION['vaiuugroup']['adminname'] == "" || empty($_SESSION['vaiuugroup']['adminname'])) {
        v_returnMessage("Empty session found , please tryagain later.", false, "danger", "", BASE_URL . "admin/");
    }
    if ($_POST['usertype'] == "admin" && $_SESSION['vaiuugroup']['admintype'] == "super admin") {
        $id = $_POST['userid'];
        $deleteuser = v_dataDelete("admin", "id='$id' ");
        $url = "admin/admin.php?adminroute=home&action=show-admin-user";
    }
    if ($_POST['usertype'] == "team") {
        $id = $_POST['userid'];
        $data['status'] = "deleted";
        $data['updatedate'] = date("Y-m-d H:i:s");
        $deleteuser = v_dataUpdate("team", $data, "teamid='$id' ");
        $url = "admin/admin.php?adminroute=team&action=show-team-list";
    }
    if ($_POST['usertype'] == "league") {
        $id = $_POST['leagueid'];
        $data['status'] = "deleted";
        $data['update_date'] = date("Y-m-d H:i:s");
        $deleteuser = v_dataUpdate("league", $data, "leagueid='$id' ");
        $url = "admin/admin.php?adminroute=game&action=list-of-league";
    }
    if ($deleteuser) {
        v_returnMessage("League has been deleted successfully.", true, "success", "", BASE_URL . $url);
    } else {
        v_returnMessage("League has been failed to delete.", false, "danger", "", "");
    }
}

if ($_POST['method'] == "addteam") {
    v_tokenCheck($_POST['token']);
    v_authenTicate("Team name", true, 2, 100, "", "teamname", $_POST['teamname']);
    v_authenTicate("Team description", true, 2, 1000, "", "description", $_POST['description']);
    v_authenTicate("Team status", true, 2, 100, "", "status", $_POST['status']);
    addTeam($_POST);
}
if ($_POST['method'] == "updateteam") {
    v_tokenCheck($_POST['token']);
    v_authenTicate("Team name", true, 2, 100, "", "teamname", $_POST['teamname']);
    v_authenTicate("Team description", true, 2, 1000, "", "description", $_POST['description']);
    v_authenTicate("Team play type", true, 2, 100, "", "playtype", $_POST['playtype']);
    v_authenTicate("Team status", true, 2, 100, "", "status", $_POST['status']);
    updateTeam($_POST);
}
if ($_POST['method'] == "updateleague") {
    v_tokenCheck($_POST['token']);
    v_authenTicate("League name", true, 2, 100, "", "league_name", $_POST['league_name']);
    v_authenTicate("League description", true, 2, 1000, "", "description", $_POST['description']);
    v_authenTicate("League status", true, 2, 100, "", "status", $_POST['status']);
    updateLeague($_POST);
}
if ($_POST['method'] == "updategame") {
    v_tokenCheck($_POST['token']);
    v_authenTicate("League name", true, 1, 9, "", "leagueid", $_POST['leagueid']);
    v_authenTicate("Team 1 ", true, 1, 9, "", "team1", $_POST['team1']);
    v_authenTicate("Team 2 ", true, 1, 9, "", "team2", $_POST['team2']);
    v_authenTicate("Game start time ", true, 16, 20, "", "schedule", $_POST['schedule']);
    v_authenTicate("Game description", true, 2, 1000, "", "description", $_POST['description']);
    v_authenTicate("League status", true, 2, 10, "", "status", $_POST['status']);
    updateGame($_POST);
}
if ($_POST['method'] == "updateuserstatus") {
    $id = $_POST['userid'];
    $darray['status'] = $_POST['status'];
    $darray['update_date'] = date("Y-m-d H:i:s");
    $update = v_dataUpdate("mrpredict_user", $darray, "userid='$id'");
    if ($update) {
        v_returnMessage("User status has been updated successfully.", true, "success", "", "");
    } else {
        v_returnMessage("User status has been failed to update.", false, "danger", "", "");
    }
}
if ($_POST['method'] == "addleague") {
    v_tokenCheck($_POST['token']);
    v_authenTicate("League name", true, 2, 100, "", "league_name", $_POST['league_name']);
    v_authenTicate("League description", true, 2, 1000, "", "description", $_POST['description']);
    v_authenTicate("League status", true, 2, 100, "", "status", $_POST['status']);
    addLeague($_POST);
}
if ($_POST['method'] == "addgame") {
    v_tokenCheck($_POST['token']);
    v_authenTicate("League name", true, 1, 9, "", "leagueid", $_POST['leagueid']);
    v_authenTicate("Team 1 ", true, 1, 9, "", "team1", $_POST['team1']);
    v_authenTicate("Team 2 ", true, 1, 9, "", "team2", $_POST['team2']);
    v_authenTicate("Game start time ", true, 16, 20, "", "schedule", $_POST['schedule']);
    v_authenTicate("Game description", true, 2, 1000, "", "description", $_POST['description']);
    v_authenTicate("League status", true, 2, 10, "", "status", $_POST['status']);
    addGame($_POST);
}

function userLogin($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['token']);
    $email = $data['adminemail'];
    $password = md5($data['adminpassword']);
    $userdata = v_dataSelect("admin", " BINARY adminemail='$email' AND adminpassword='$password' AND status='active'");
    if ($userdata['counter'] == 0) {
        v_returnMessage("Invalid email or passwprd.", false, "danger", "", "");
    } else {
        $_SESSION['vaiuugroup']['adminid'] = $userdata['data'][0]['id'];
        $_SESSION['vaiuugroup']['adminname'] = $userdata['data'][0]['adminname'];
        $_SESSION['vaiuugroup']['adminemail'] = $userdata['data'][0]['adminemail'];
        $_SESSION['vaiuugroup']['admintype'] = $userdata['data'][0]['admintype'];
        v_returnMessage("Logged in successfully. Redirectiong to logged in page , please be patient...", true, "success", "", BASE_URL . "admin/admin.php?adminroute=home");
    }
}

function updateuser_name($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    $email = $_SESSION['vaiuugroup']['adminemail'];
    $data['updatedate'] = date("Y-m-d H:i:s");
    $data['ip'] = v_get_client_ip();
    $updatename = v_dataUpdate("admin", $data, "adminemail='$email'");
    if ($updatename) {
        $messagearray[0] = "Hello admin user. This email has been auto generated by<a href='" . BASE_URL . "'>" . APP_NAME . "</a><br>";
        $messagearray[1] = "Your previous user name has been changed to <strong>" . $data['adminname'] . "</strong> .<br>";
        $messagearray[2] = "From IP " . $data['ip'] . "<br>";
        $messagearray[3] = "At time:" . $data['updatedate'] . ".<br>";
        $messagearray[5] = "<br><i>If it is not you please contact with super admin[superadmin@mrgoalz.com].</i><br>Thanks for your patients.";
        $mailmessage = registrationMail($messagearray, BASE_URL);
        $mailresponse = simpleMail("no-reply@mrgoalz.com", $email, $mailmessage, "Security Notification", "no-reply@mrgoalz.com");
        $_SESSION['vaiuugroup']['adminname'] = $data['adminname'];
        v_returnMessage("User name has been successfully updated.", true, "success", "", "");
    } else {
        v_returnMessage("User name has been failed to update.", false, "danger", "", "");
    }
}

function updateuser_info($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    $id = $data['userid'];
    unset($data['userid']);
    $email = $data['adminemail'];
    $emailcheck = v_dataSelect("admin", "adminemail='$email' AND id !='$id'");
    if ($emailcheck['counter'] != 0) {
        v_returnMessage("Email has already taken by other user please choose another email", false, "danger", "", "");
    }
    $ip = v_get_client_ip();
    $data['updatedate'] = date("Y-m-d H:i:s");
    $update = v_dataUpdate("admin", $data, "id='$id'");
    if ($update) {
        $messagearray[0] = "Hello admin user. This email has been auto generated by<a href='" . BASE_URL . "'>" . APP_NAME . "</a><br>";
        $messagearray[1] = "Your previous information has been changed.<br>";
        $messagearray[2] = "From IP " . $ip . "<br>";
        $messagearray[3] = "At time:" . $data['updatedate'] . ".<br>";
        $messagearray[4] = "By: Super admin<br>";
        $messagearray[5] = "<br><i>Please contact with super admin[superadmin@mrgoalz.com].</i><br>Thanks for your patients.";
        $mailmessage = registrationMail($messagearray, BASE_URL);
        $mailresponse = simpleMail("no-reply@mrgoalz.com", $email, $mailmessage, "Security Notification", "no-reply@mrgoalz.com");
        v_returnMessage("Admin information has been successfully updated.", true, "success", "", "");
    } else {
        v_returnMessage("Admin information has been failed to update.", false, "danger", "", "");
    }
}

function updateuser_password($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['retypedpassword']);
    $email = $_SESSION['vaiuugroup']['adminemail'];
    $passwordcheck = v_dataSelect("admin", "adminemail='$email' AND status='active'");
    if ($passwordcheck['counter'] == 0) {
        v_returnMessage("Empty session found , please tryagain later.", false, "danger", "", BASE_URL . "admin/");
    }
    if ($passwordcheck['data'][0]['adminpassword'] != md5($data['oldpassword'])) {
        v_returnMessage("Your old password is not valid.", false, "danger", "", "");
    }
    unset($data['oldpassword']);
    $newpassword = $data['adminpassword'];
    $data['adminpassword'] = md5($data['adminpassword']);
    $data['updatedate'] = date("Y-m-d H:i:s");
    $data['ip'] = v_get_client_ip();
    $updatename = v_dataUpdate("admin", $data, "adminemail='$email'");
    if ($updatename) {
        $messagearray[0] = "Hello admin user. This email has been auto generated by<a href='" . BASE_URL . "'>" . APP_NAME . "</a><br>";
        $messagearray[1] = "Your previous password has been changed to <strong>" . $newpassword . "</strong> .<br>";
        $messagearray[2] = "From IP " . $data['ip'] . "<br>";
        $messagearray[3] = "At time:" . $data['updatedate'] . ".<br>";
        $messagearray[4] = "<br><i>If it is not you please contact with super admin[superadmin@mrgoalz.com].</i><br>Thanks for your patients.";
        $mailmessage = registrationMail($messagearray, BASE_URL);
        $mailresponse = simpleMail("no-reply@mrgoalz.com", $email, $mailmessage, "Security Notification", "no-reply@mrgoalz.com");
        v_returnMessage("Password has been successfully updated.", true, "success", "", "");
    } else {
        v_returnMessage("Password has been failed to update.", false, "danger", "", "");
    }
}

function create_admin($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['retypedpassword']);
    $email = $data['adminemail'];
    $admincheck = v_dataSelect("admin", "adminemail='$email'");
    if ($admincheck['counter'] == 1) {
        v_returnMessage("Email already taken , please choose another email.", false, "danger", "", "");
    }
    $newpassword = $data['adminpassword'];
    $data['adminpassword'] = md5($data['adminpassword']);
    $data['createdate'] = date("Y-m-d H:i:s");
    $data['updatedate'] = date("Y-m-d H:i:s");
    $data['ip'] = v_get_client_ip();
    $insertadmin = v_dataInsert("admin", $data);
    if ($insertadmin) {
        $messagearray[0] = "Hello " . $data['adminname'] . " ,<br> You have been selected as admin of <a href='" . BASE_URL . "admin/'>" . APP_NAME . "</a><br>";
        $messagearray[1] = "Please use this <strong>" . $newpassword . "</strong>password for log in to admin panel .<br>";
        $messagearray[2] = "From IP " . $data['ip'] . "<br>";
        $messagearray[3] = "At time:" . $data['updatedate'] . ".<br>";
        $messagearray[5] = "<br>Thanks for your patients.";
        $mailmessage = registrationMail($messagearray, BASE_URL);
        $mailresponse = simpleMail("no-reply@mrgoalz.com", $email, $mailmessage, "Admin Creation", "no-reply@mrgoalz.com");
        v_returnMessage("Admin has been successfully created.", true, "success", "", "");
    } else {
        v_returnMessage("Admin has been failed to create.", false, "danger", "", "");
    }
}

function addMonthLyBonus() {
    $data['user_type'] = $_SESSION['vaiuugroup']['admintype'];
    $data['user_id'] = $_SESSION['vaiuugroup']['adminid'];
    $data['bonus_type'] = "monthly bonus";
    $data['description'] = "General bonus for all users. This bonus is given after end of every gaming month.";
    $data['recipient'] = "all";
    $data['bonus_month'] = date("m");
    $data['bonus_year'] = date("Y");
    $data['create_date'] = date("Y-m-d H:i:s");
    $data['update_date'] = date("Y-m-d H:i:s");
    $data['status'] = "active";
    $ins = v_dataInsert_LastId("user_bonus", $data);
    $ub['bonusid'] = $ins['lastinsertid'];
    $ub['month_number'] = date("m");
    $ub['month_name'] = date("F");
    $ub['year'] = date("Y");
    $ub['create_date'] = date("Y-m-d H:i:s");
    $ub['update_date'] = date("Y-m-d H:i:s");
    $ub['status'] = 'active';
    $user = v_dataSelect("mrpredict_user", "status='active'");
    $ms['sender_id'] = $_SESSION['vaiuugroup']['adminid'];
    $ms['sender_type'] = "system";
    $ms['message_type'] = "notification";
    $ms['message_title'] = "Monthly General Bonus Has Been Declared";
    $mb = "<div class='bonus'>Monthly general bonus has been declared. You can use this bonus for the month in any week. You are allowed to use on bonus per week. Please click the below link to use this bonus. <br><a class='add-month-bonus'>Use the bonus for this week</a></div>";
    $ms['message_body'] = addslashes($mb);
    $ms['create_date'] = date("Y-m-d H:i:s");
    $ms['update_date'] = date("Y-m-d H:i:s");
    $ms['status'] = "active";

    $messagearray[0] = "Dear " . APP_NAME . " user you have received a monthly bonus. <br>";
    $messagearray[1] = "Please check your " . APP_NAME . " inbox for details.<br>";
    $messagearray[5] = "<br>Thanks for your patients.";
    $mailmessage = registrationMail($messagearray, BASE_URL);

    for ($i = 0; $i < count($user['data']); $i++) {
        $ub['user_id'] = $user['data'][$i]['userid'];
        $ms['receiver_id'] = $user['data'][$i]['userid'];
        v_dataInsert("monthly_bonus", $ub);
        v_dataInsert("message_box", $ms);
        $email = $user['data'][$i]['user_email'];
        simpleMail("no-reply@mrgoalz.com", $email, $mailmessage, "Admin Creation", "no-reply@mrgoalz.com");
    }
    if ($ins) {
        v_returnMessage("Bonus has been declared successfully.", true, "success", "", "");
    } else {
        v_returnMessage("Bonus has been failed to declare, please refresh the page and  try again", false, "danger", "", "");
    }
}

function addPerformanceBonus() {
    $data['user_type'] = $_SESSION['vaiuugroup']['admintype'];
    $data['user_id'] = $_SESSION['vaiuugroup']['adminid'];
    $data['bonus_type'] = "performance bonus";
    $data['description'] = "Performance bonus for leader user.";
    $data['recipient'] = "all";
    $data['bonus_month'] = date("m");
    $data['bonus_year'] = date("Y");
    $data['create_date'] = date("Y-m-d H:i:s");
    $data['update_date'] = date("Y-m-d H:i:s");
    $data['status'] = "active";
    $ins = v_dataInsert_LastId("user_bonus", $data);
    $ub['bonusid'] = $ins['lastinsertid'];
    $ub['month_number'] = date("m");
    $ub['month_name'] = date("F");
    $ub['year'] = date("Y");
    $ub['create_date'] = date("Y-m-d H:i:s");
    $ub['update_date'] = date("Y-m-d H:i:s");
    $ub['status'] = 'active';
    $user = v_dataSelect("mrpredict_user", "status='active'");
    $ms['sender_id'] = $_SESSION['vaiuugroup']['adminid'];
    $ms['sender_type'] = "system";
    $ms['message_type'] = "notification";
    $ms['message_title'] = "Monthly General Bonus Has Been Declared";
    $mb = "<div class='bonus'>Monthly general bonus has been declared. You can use this bonus for the month in any week. You are allowed to use on bonus per week. Please click the below link to use this bonus. <br><a class='add-month-bonus'>Use the bonus for this week</a></div>";
    $ms['message_body'] = addslashes($mb);
    $ms['create_date'] = date("Y-m-d H:i:s");
    $ms['update_date'] = date("Y-m-d H:i:s");
    $ms['status'] = "active";

    $messagearray[0] = "Dear " . APP_NAME . " user you have received a monthly bonus. <br>";
    $messagearray[1] = "Please check your " . APP_NAME . " inbox for details.<br>";
    $messagearray[5] = "<br>Thanks for your patients.";
    $mailmessage = registrationMail($messagearray, BASE_URL);

    for ($i = 0; $i < count($user['data']); $i++) {
        $ub['user_id'] = $user['data'][$i]['userid'];
        $ms['receiver_id'] = $user['data'][$i]['userid'];
        v_dataInsert("monthly_bonus", $ub);
        v_dataInsert("message_box", $ms);
        $email = $user['data'][$i]['user_email'];
        simpleMail("no-reply@mrgoalz.com", $email, $mailmessage, "Admin Creation", "no-reply@mrgoalz.com");
    }
    if ($ins) {
        v_returnMessage("Bonus has been declared successfully.", true, "success", "", "");
    } else {
        v_returnMessage("Bonus has been failed to declare, please refresh the page and  try again", false, "danger", "", "");
    }
}

function addTeam($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['token']);
    $team = $data['teamname'];
    $checkexist = v_dataSelect("team", "teamname='$team'");
    if ($checkexist['counter'] > 0) {
        v_returnMessage("Team already exists.", false, "danger", "", "");
    } else {
        $data['user_type'] = $_SESSION['vaiuugroup']['admintype'];
        $data['user_id'] = $_SESSION['vaiuugroup']['adminid'];
        $data['createdate'] = date("Y-m-d H:i:s");
        $data['updatedate'] = date("Y-m-d H:i:s");
        $teaminsert = v_dataInsert("team", $data);
        if ($teaminsert) {
            v_returnMessage("Team has been successfully inserted.", true, "success", "", "");
        } else {
            v_returnMessage("Team insertion has been failed.", false, "danger", "", "");
        }
    }
}

function addLeague($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['token']);
    $league_name = $data['league_name'];
    $checkexist = v_dataSelect("league", "league_name='$league_name'");
    if ($checkexist['counter'] > 0) {
        v_returnMessage("League already exists.", false, "danger", "", "");
    } else {
        $data['create_date'] = date("Y-m-d H:i:s");
        $data['update_date'] = date("Y-m-d H:i:s");
        $data['user_type'] = $_SESSION['vaiuugroup']['admintype'];
        $data['user_id'] = $_SESSION['vaiuugroup']['adminid'];
        $insert = v_dataInsert("league", $data);
        if ($insert) {
            v_returnMessage("League has been successfully inserted.", true, "success", "", "");
        } else {
            v_returnMessage("League insertion has been failed.", false, "danger", "", "");
        }
    }
}

function addGame($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['token']);
    if ($data['team1'] === $data['team2']) {
        v_returnMessage("Team1 and Team 2 can not be same.", false, "danger", "", "");
    }
    $data['schedule_timestamp'] = strtotime($data['schedule']);
    $timediff = strtotime($data['schedule']) - 300;
    $data['guessing_last_moment'] = date("Y-m-d H:i:s", $timediff);
    $data['createdate'] = date("Y-m-d H:i:s");
    $data['updatedate'] = date("Y-m-d H:i:s");
    $data['user_type'] = $_SESSION['vaiuugroup']['admintype'];
    $data['user_id'] = $_SESSION['vaiuugroup']['adminid'];
    $insert = v_dataInsert("upcominggames", $data);
    if ($insert) {
        v_returnMessage("League has been successfully inserted.", true, "success", "", "");
    } else {
        v_returnMessage("League insertion has been failed.", false, "danger", "", "");
    }
}

function updateGame($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['token']);
    if ($data['team1'] === $data['team2']) {
        v_returnMessage("Team1 and Team 2 can not be same.", false, "danger", "", "");
    }
    $id = $data['gameid'];
    unset($data['gameid']);
    $data['schedule_timestamp'] = strtotime($data['schedule']);
    $timediff = strtotime($data['schedule']) - 300;
    $data['guessing_last_moment'] = date("Y-m-d H:i:s", $timediff);
    $data['updatedate'] = date("Y-m-d H:i:s");
    $insert = v_dataUpdate("upcominggames", $data, "id='$id'");
    if ($insert) {
        v_returnMessage("League has been successfully updated.", true, "success", "", "");
    } else {
        v_returnMessage("League update has been failed.", false, "danger", "", "");
    }
}

function updateTeam($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['token']);
    $team = $data['teamname'];
    $teamid = $data['teamid'];
    $checkexist = v_dataSelect("team", "teamname='$team' AND teamid !='$teamid'");
    if ($checkexist['counter'] > 0) {
        v_returnMessage("Team already exists.", false, "danger", "", "");
    } else {
        $data['updatedate'] = date("Y-m-d H:i:s");
        $teaminsert = v_dataUpdate("team", $data, "teamid='$teamid'");
        if ($teaminsert) {
            v_returnMessage("Team has been successfully updated.", true, "success", "", "");
        } else {
            v_returnMessage("Team updation has been failed.", false, "danger", "", "");
        }
    }
}

function updateLeague($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['token']);
    $league_name = $data['league_name'];
    $leagueid = $data['leagueid'];
    $checkexist = v_dataSelect("league", "league_name='$league_name' AND leagueid !='$leagueid'");
    if ($checkexist['counter'] > 0) {
        v_returnMessage("League already exists.", false, "danger", "", "");
    } else {
        $data['update_date'] = date("Y-m-d H:i:s");
        $teaminsert = v_dataUpdate("league", $data, "leagueid='$leagueid'");
        if ($teaminsert) {
            v_returnMessage("League has been successfully updated.", true, "success", "", "");
        } else {
            v_returnMessage("League update has been failed.", false, "danger", "", "");
        }
    }
}

function registrationMail($messagearray, $baseurl) {
    $message = "<html><body><img src='" . BASE_URL . "assets/images/icon/logo.png'><br><br><table style='width:100%;min-height:300px;background:#eeeeee'>";
    foreach ($messagearray as $key => $value) {
        $message.="<tr><td style='text-align:center'>" . $value . "</td></tr>";
    }
    $message.="</table></body></html>";
    return $message;
}
?>


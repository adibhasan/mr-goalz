<?php

ob_start();
error_reporting(0);
include '../generic.php';
if (empty($_POST['method']) || $_POST['method'] == "") {
    reDirect(BASE_URL . "error?errorid=vaiuuR401");
    die();
}

if ($_POST['method'] == "userlogin") {
    v_tokenCheck($_POST['token']);
    v_authenTicate("User name", true, 8, 50, "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,50}$/", "user_id_name", $_POST['user_id_name']);
    v_authenTicate("User password", true, 8, 50, "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,50}$/", "user_password", $_POST['user_password']);
    userLogin($_POST);
}
if ($_POST['method'] == "registration") {
    v_tokenCheck($_POST['token']);
    userRegistration($_POST);
}
if ($_POST['method'] == "resendal") {
    v_tokenCheck($_POST['token']);
    ResendActivationLink($_POST);
}
if ($_POST['method'] == "updatesettings") {
    v_tokenCheck($_POST['token']);
    updatesettings($_POST);
}
if ($_POST['method'] == "passwordretrieve") {
    v_tokenCheck($_POST['token']);
    retrievePassword($_POST);
}
if ($_POST['method'] == "updateimage") {
    v_tokenCheck($_POST['token']);
    updateimage($_POST);
}
if ($_POST['method'] == "leagueinsert") {
    v_tokenCheck($_POST['token']);
    insertLeague($_POST);
}
if ($_POST['method'] == "teaminput") {
    v_tokenCheck($_POST['token']);
    insertTeam($_POST);
}
if ($_POST['method'] == "gamecreate") {
    v_tokenCheck($_POST['token']);
    createGame($_POST);
}

function createGame($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['token']);
    if ($data['leagueid'] == "other" || $data['leagueid'] == "") {
        $return = array(
            'message' => "League name can not be other or null.",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
        echo json_encode($return);
        die();
    }
    if (strlen($data['description']) >= 200 || $data['description'] == "") {
        $return = array(
            'message' => "Maximum allowed character is 200 for description and description can not be null.",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
        echo json_encode($return);
        die();
    }
    if ($data['team1'] == "other" || $data['team1'] == "") {
        $return = array(
            'message' => "Team 1  can not be other or null.",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
        echo json_encode($return);
        die();
    }
    if ($data['team2'] == "other" || $data['team2'] == "") {
        $return = array(
            'message' => "Team 2  can not be other or null.",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
        echo json_encode($return);
        die();
    }
    if ($data['team1'] == $data['team2']) {
        $return = array(
            'message' => "Team 1 and team 2 can not be same.",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
        echo json_encode($return);
        die();
    }

    if ($data['schedule'] == "") {
        $return = array(
            'message' => "Valid date is required",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
        echo json_encode($return);
        die();
    }
    $currentDate = time();
    if (strtotime($data['schedule']) <= $currentDate) {
        $return = array(
            'message' => "Schedule time must be greater than currtent time.",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
        echo json_encode($return);
        die();
    }
    $user = v_dataSelect("mrpredict_user", "user_email='" . $_SESSION['vaiuugroup']['user_email'] . "'");
    $da['user_type'] = $user['data'][0]['user_type'];
    $da['user_id'] = $user['data'][0]['userid'];
    $da['leagueid'] = $data['leagueid'];
    $da['team1'] = $data['team1'];
    $da['team2'] = $data['team2'];
    $da['description'] = $data['description'];
    $da['schedule'] = $data['schedule'];
    $da['schedule_timestamp'] = strtotime($data['schedule']);
    $da['guessing_last_moment'] = (strtotime($data['schedule']) - 300);
    $da['createdate'] = date("Y-m-d H:i:s");
    $da['updatedate'] = date("Y-m-d H:i:s");
    $da['status'] = "active";
    $ins = v_dataInsert("upcominggames", $da);
    if ($ins) {
        $return = array(
            'message' => "Game has been successfully added.",
            'success' => true,
            'styleclass' => "success",
            "field" => ""
        );
        echo json_encode($return);
        die();
    } else {
        $return = array(
            'message' => "Game creation failed, please try again.",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
        echo json_encode($return);
        die();
    }
}

function insertLeague($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['token']);
    $chek = v_dataSelect("league", "league_name='" . $data['league_name'] . "'");
    if ($chek['counter'] != 0) {
        $return = array(
            'message' => "League name exists.",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
    } else {
        $user = v_dataSelect("mrpredict_user", "user_email='" . $_SESSION['vaiuugroup']['user_email'] . "'");
        $data['user_type'] = $user['data'][0]['user_type'];
        $data['user_id'] = $user['data'][0]['userid'];
        $data['league_name'] = addslashes($data['league_name']);
        $data['description'] = addslashes($data['description']);
        $data['create_date'] = date("Y-m-d H:i:s");
        $data['update_date'] = date("Y-m-d H:i:s");
        $data['status'] = "active";
        $ins = v_dataInsert_LastId("league", $data);
        if ($ins['result']) {
            $return = array(
                'message' => "League successfully added.",
                'success' => true,
                'styleclass' => "success",
                "field" => $ins['lastinsertid'],
                "league_namme" => $data['league_name']
            );
        } else {
            $return = array(
                'message' => "League insertion failed.",
                'success' => false,
                'styleclass' => "danger",
                "field" => "",
                "league_name" => ""
            );
        }
    }
    echo json_encode($return);
    die();
}

function insertTeam($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['token']);
    $chek = v_dataSelect("team", "teamname='" . $data['teamname'] . "'");
    if ($chek['counter'] != 0) {
        $return = array(
            'message' => "Team name exists.",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
    } else {
        $user = v_dataSelect("mrpredict_user", "user_email='" . $_SESSION['vaiuugroup']['user_email'] . "'");
        $data['user_type'] = $user['data'][0]['user_type'];
        $data['user_id'] = $user['data'][0]['userid'];
        $data['teamname'] = addslashes($data['teamname']);
        $data['description'] = addslashes($data['description']);
        $data['createdate'] = date("Y-m-d H:i:s");
        $data['updatedate'] = date("Y-m-d H:i:s");
        $data['status'] = "active";
        $ins = v_dataInsert_LastId("team", $data);
        if ($ins['result']) {
            $return = array(
                'message' => "Team successfully added.",
                'success' => true,
                'styleclass' => "success",
                "field" => $ins['lastinsertid'],
                "team_name" => $data['teamname']
            );
        } else {
            $return = array(
                'message' => "Team insertion failed.",
                'success' => false,
                'styleclass' => "danger",
                "field" => "",
                "team_name" => ""
            );
        }
    }
    echo json_encode($return);
    die();
}

function retrievePassword($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['token']);
    $email = $data['user_email'];
    $userdata = v_dataSelect("mrpredict_user", " BINARY user_email='$email'");
    if ($userdata['counter'] == 0) {
        $return = array(
            'message' => "User does not exist.",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
        echo json_encode($return);
        die();
    } else if ($userdata['data'][0]['status'] == "blocked") {
        $return = array(
            'message' => "Account is blocked. Please contact with admin( " . ADMIN_EMAIL . " )",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
        echo json_encode($return);
        die();
    } else {
        $string = str_shuffle("A1aB2bC3cD4dE5eF6fG7gH8hI9iJ@jK#mLMpNn=O=P");
        $string1 = substr($string, 28);
        $string2 = str_shuffle("MrGoalz1" . $string1);
        $updateArray['user_password'] = md5($string2);
        $updateArray['update_date'] = date("Y-m-d H:i:s");
        v_dataUpdate("mrpredict_user", $updateArray, " BINARY user_email='$email'");

        $username = ucfirst($userdata['data'][0]['user_name'] != "" ? $userdata['data'][0]['user_name'] : "User");
        $messagearray[0] = "Dear, <strong>" . $username . "</strong><br>";
        $messagearray[1] = "Your password has been changed.<br>Your new password is <strong style='color:blue'>" . $string2 . "</strong><br>";
        $messagearray[2] = "If you think it is not you then contact with admin (" . ADMIN_EMAIL . ")<br>";
        $messagearray[3] = "<br><br><i>Thanks for your patience.</i><br>";
        $mailmessage = registrationMail($messagearray, BASE_URL);
        simpleMail(ADMIN_EMAIL, $email, $mailmessage, "Retrieve " . APP_NAME . " password", "no-replay@mrgoalz.com");
        $return = array(
            'message' => "Please check your email for new password. In case you miss the mail then try again.",
            'success' => true,
            'styleclass' => "success",
            "field" => ""
        );
        echo json_encode($return);
        die();
    }
}

function userLogin($dataArry) {
    $data = $dataArry;
    unset($data['method']);
    unset($data['token']);
    $user_id_name = $data['user_id_name'];
    $password = md5($data['user_password']);
    $userdata = v_dataSelect("mrpredict_user", " BINARY user_id_name='$user_id_name' AND user_password='$password' AND ( status ='active' || status ='pending' )");
    if ($userdata['counter'] == 0) {
        $return = array(
            'message' => "User does not exist.",
            'success' => false,
            'styleclass' => "danger",
            "field" => ""
        );
        echo json_encode($return);
        die();
    } else {
        $_SESSION['login_type'] = "Regular";
        $_SESSION['vaiuugroup']['user_id_name'] = $userdata['data'][0]['user_id_name'];
        $_SESSION['vaiuugroup']['user_email'] = $userdata['data'][0]['user_email'];
        $_SESSION['vaiuugroup']['username'] = $userdata['data'][0]['user_name'] != "" ? $userdata['data'][0]['user_name'] : "User";
        $_SESSION['vaiuugroup']['profile'] = $userdata['data'][0]['profile_picture'] == "" ? BASE_URL . "/assets/userimages/avatar.jpg" : $userdata['data'][0]['profile_picture'];
        $_SESSION['vaiuugroup']['user_state'] = $userdata['data'][0]['status'] == "active" ? "active" : "pending";
        if ($data['rememberme'] == "on") {
            $_SESSION['cookieenable'] = true;
            setcookie('login_type', $_SESSION['login_type'], time() + 30 * 24 * 60 * 60, "/");
            setcookie('user_id_name', $_SESSION['vaiuugroup']['user_id_name'], time() + 30 * 24 * 60 * 60, "/");
            setcookie('user_email', $_SESSION['vaiuugroup']['user_email'], time() + 30 * 24 * 60 * 60, "/");
            setcookie('username', $_SESSION['vaiuugroup']['username'], time() + 30 * 24 * 60 * 60, "/");
            setcookie('profile', $_SESSION['vaiuugroup']['profile'], time() + 30 * 24 * 60 * 60, "/");
        } else {
            $_SESSION['cookieenable'] = false;
        }
        $return = array(
            'message' => "Logged in successfully. Redirectiong to logged in page , please be patient...",
            'success' => true,
            'styleclass' => "success",
            "field" => $userdata['data'][0]['status'] == "pending" ? "primarylogin.php" : "gamelist.php",
            "user_status" => $_SESSION['vaiuugroup']['user_state']
        );
        echo json_encode($return);
        die();
    }
}

function ResendActivationLink($dataArray) {
    $data = $dataArray;
    $token = $data['token'];
    unset($data['token']);
    unset($data['method']);
    v_authenTicate("User name", true, 8, 20, "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,20}$/", "user_id_name", $data['user_id_name']);
    if (strlen($data['user_email']) < 4 || strlen($data['user_email']) > 100 || (!filter_var($data['user_email'], FILTER_VALIDATE_EMAIL))) {
        $return = array(
            'message' => "Invalid email format.",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
    $usernameid = $data['user_id_name'];
    $email = $data['user_email'];
    $idexist = checkUserExistance("mrpredict_user", "user_id_name='$usernameid' AND user_email='$email' AND status='pending'");
    if ($idexist == false) {
        $return = array(
            'message' => "No pending user found for this account, account may active or block or does not exists.",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
    v_dataDelete("tokens", "username='$usernameid'");
    $data['recovery_number'] = generateRecoveryNumber("aA7bB1cC2dD3eE4fF5gG6hH7iI8jJ9kK10lL1mM2nN3oO4pP5qQ6rR7sS8tT9uU1vV2wW3xX4yY5zZ6", 8, true);
    $data['update_date'] = date("Y-m-d H:i:s");
    $data['status'] = "pending";
    $dataToken['token'] =$token;
    $dataToken['tokentype'] = "registration";
    $dataToken['username'] = $usernameid;
    $dataToken['createdate'] = date("Y:m:d H:i:s");
    $tokeninsert = v_dataInsert("tokens", $dataToken);
    if ($tokeninsert) {
        $datainsert = v_dataUpdate("mrpredict_user",$data,"user_email='$email'");
    } else {
        $datainsert = false;
    }
    if ($datainsert) {
        $messagearray[0] = "Dear, <strong>" . strip_tags($data['user_id_name']) . "</strong><br>";
        $messagearray[1] = "You have just finished your step 1 registration process.<br>";
        $messagearray[2] = "To complete your registration process,<br>";
        $messagearray[3] = "please click the link below.<br>";
        $messagearray[4] = "<br><a href='" . BASE_URL . "controller/Checkget.php?secretkey=" . $data['recovery_number'] . "&completionkey=" . $token . "' style='text-align:center;padding:5px 50px;border-radius:5px;background:black;color:white;text-decoration:none'>Activate</a>";
        $messagearray[5] = "<br><br><i>Thanks for your patience.</i><br>";
        $mailmessage = registrationMail($messagearray, BASE_URL);
        $mailresponse = simpleMail(ADMIN_EMAIL, $email, $mailmessage, "Complete User Registration", ADMIN_EMAIL);
        if ($mailresponse) {
            $return = array(
                'message' => "Please check your email to complete signup process.",
                'success' => true,
                'styleclass' => "success",
                'url' => ""
            );
            echo json_encode($return);
            die();
        } else {
            $return = array(
                'message' => "Mail sending failed please retry.",
                'success' => true,
                'styleclass' => "warning"
            );
            echo json_encode($return);
            die();
        }
    } else {
        $return = array(
            'message' => "Sorry !!! Registration process failed. Please try again.",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
}

function userRegistration($dataArray) {
    $data = $dataArray;
    $token = $data['token'];
    unset($data['token']);
    v_authenTicate("User name", true, 8, 20, "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,20}$/", "user_id_name", $data['user_id_name']);
    if (strlen($data['user_email']) < 4 || strlen($data['user_email']) > 100 || (!filter_var($data['user_email'], FILTER_VALIDATE_EMAIL))) {
        $return = array(
            'message' => "Invalid email format.",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
    v_authenTicate("User password", true, 8, 20, "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,20}$/", "user_password", $data['user_password']);

    if (strlen($data['retyped_user_password']) < 8 || strlen($data['retyped_user_password']) > 20 || ($data['retyped_user_password'] != $data['user_password'])) {
        $return = array(
            'message' => "Retyped password mismatch with original password.",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
    $usernameid = $data['user_id_name'];
    $idexist = checkUserExistance("mrpredict_user", "user_id_name='$usernameid'");
    if ($idexist) {
        $return = array(
            'message' => "This user name has already occupied by other user, please enter a unique user name.",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
    $email = $data['user_email'];
    $emailexist = checkUserExistance("mrpredict_user", "user_email='$email' AND status !='deleted'");
    if ($emailexist) {
        $return = array(
            'message' => "This email id owner has already registered, please try with another email.",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
    unset($data['method']);
    unset($data['retyped_user_password']);
    $data['user_password'] = hashPassword($data['user_password']);
    $data['recovery_number'] = generateRecoveryNumber("aA7bB1cC2dD3eE4fF5gG6hH7iI8jJ9kK10lL1mM2nN3oO4pP5qQ6rR7sS8tT9uU1vV2wW3xX4yY5zZ6", 8, true);
    $data['create_date'] = date("Y-m-d H:i:s");
    $data['update_date'] = date("Y-m-d H:i:s");
    $data['status'] = "pending";
    $dataToken['token'] = $token;
    $dataToken['tokentype'] = "registration";
    $dataToken['username'] = $usernameid;
    $dataToken['createdate'] = date("Y:m:d H:i:s");
    $tokeninsert = v_dataInsert("tokens", $dataToken);
    if ($tokeninsert) {
        $datainsert = v_dataInsert("mrpredict_user", $data);
    } else {
        $datainsert = false;
    }
    if ($datainsert) {
        $messagearray[0] = "Dear, <strong>" . strip_tags($data['user_id_name']) . "</strong><br>";
        $messagearray[1] = "You have just finished your step 1 registration process.<br>";
        $messagearray[2] = "To complete your registration process,<br>";
        $messagearray[3] = "please click the link below.<br>";
        $messagearray[4] = "<br><a href='" . BASE_URL . "controller/Checkget.php?secretkey=" . $data['recovery_number'] . "&completionkey=" . $token . "' style='text-align:center;padding:5px 50px;border-radius:5px;background:black;color:white;text-decoration:none'>Activate</a>";
        $messagearray[5] = "<br><br><i>Thanks for your patience.</i><br>";
        $mailmessage = registrationMail($messagearray, BASE_URL);
        $mailresponse = simpleMail(ADMIN_EMAIL, $email, $mailmessage, "Complete User Registration", ADMIN_EMAIL);
        if ($mailresponse) {
            $return = array(
                'message' => "Please check your email to complete signup process.",
                'success' => true,
                'styleclass' => "success",
                'styleclass' => "success"
            );
            echo json_encode($return);
            die();
        } else {
            $return = array(
                'message' => "Congratualations !!! You have registered successfully. To complete registration please use this url :" . BASE_URL . "signup?completionkey=" . $data['recovery_number'],
                'success' => true,
                'styleclass' => "warning"
            );
            echo json_encode($return);
            die();
        }
    } else {
        $return = array(
            'message' => "Sorry !!! Registration process failed. Please try again.",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
}

function updatesettings($dataArray) {
    $data = $dataArray;
    if ($data['recovery_number'] == "") {
        $return = array(
            'message' => "Number can't be empty.",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
    if ($data['user_email'] == "") {
        $return = array(
            'message' => "Email can't be empty.",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
    unset($data['method']);
    $token = $data['token'];
    if (empty($_SESSION['vaiuugroup']['user_id_name']) || empty($_SESSION['vaiuugroup']['user_email'])) {
        $return = array(
            'message' => "Empty session, please logout and then try again",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
    unset($data['token']);
    $id = $_SESSION['vaiuugroup']['user_id_name'];
    $email = $_SESSION['vaiuugroup']['user_email'];
    $data['update_date'] = date("Y-m-d H:i:s");
    $data['filledupsecondform'] = 1;
    if ($data['user_email'] != $email) {
        $newemail = $data['user_email'];
        $checkemailexistance = checkUserExistance("mrpredict_user", "user_email='$newemail' AND user_id_name !='$id'");
        if ($checkemailexistance) {
            $return = array(
                'message' => "This email has been already in use. Please choose another one.",
                'success' => false,
                'styleclass' => "danger"
            );
            echo json_encode($return);
            die();
        }
        $dataToken['token'] = $token;
        $dataToken['tokentype'] = "emailchange_" . $data['user_email'];
        $dataToken['username'] = $id;
        $dataToken['createdate'] = date("Y:m:d H:i:s");
        $tokeninsert = v_dataInsert("tokens", $dataToken);
        if ($tokeninsert) {
            $messagearray[0] = "Dear, <strong>" . strip_tags($id) . "</strong><br>";
            $messagearray[1] = "You have tried to change your email from " . $email . " to " . $newemail;
            $messagearray[2] = "Please click the link below to complete your email change.<br>";
            $messagearray[3] = "<br><a href='" . BASE_URL . "controller/Checkget?newemail=" . md5($newemail) . "&completionkey=" . $token . "' style='text-align:center;padding:5px 50px;border-radius:5px;background:black;color:white;text-decoration:none'>Activate</a>";
            $messagearray[4] = "<br><br><i>Thanks for your patience.</i><br>";
            $mailmessage = registrationMail($messagearray, BASE_URL);
            simpleMail(ADMIN_EMAIL, $email, $mailmessage, "Complete User Registration", "no-replay@mrgoalz.com");
            unset($data['user_email']);
        }
    }
    $data['status'] = "active";
    if($data['game_notification']=="on"){
        $data['game_notification']=true;
    }else{
        $data['game_notification']=false;
    }
    $updatesettings = v_dataUpdate("mrpredict_user", $data, "user_id_name='$id' AND user_email='$email'");
    if ($updatesettings) {
        $_SESSION['vaiuugroup']['user_email'] = $data['user_email'];
        $_SESSION['vaiuugroup']['user_state'] = "active";
        $return = array(
            'message' => "Profile information updated successfully.",
            'success' => true,
            'styleclass' => "success"
        );
        echo json_encode($return);
        die();
    } else {
        $return = array(
            'message' => "Profile information update failed.",
            'success' => true,
            'styleclass' => "success"
        );
        echo json_encode($return);
        die();
    }
}

function updateimage($dataArray) {
    $data = $dataArray;
    unset($data['method']);
    unset($data['token']);
    if (empty($_SESSION['vaiuugroup']['user_id_name']) || empty($_SESSION['vaiuugroup']['user_email'])) {
        $return = array(
            'message' => "Empty session, please logout and then try again",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
    if (empty($data['profile_picture']) || $data['profile_picture'] == "") {
        $return = array(
            'message' => "No change in image",
            'success' => false,
            'styleclass' => "danger"
        );
        echo json_encode($return);
        die();
    }
    $data['update_date'] = date("Y-m-d H:i:s");
    $data['filledupsecondform'] = 1;
    $id = $_SESSION['vaiuugroup']['user_id_name'];
    $email = $_SESSION['vaiuugroup']['user_email'];
    $updatesettings = v_dataUpdate("mrpredict_user", $data, "user_id_name='$id' AND user_email='$email'");
    if ($updatesettings) {
        $return = array(
            'message' => "Profile information updated successfully.",
            'success' => true,
            'styleclass' => "success"
        );
        echo json_encode($return);
        die();
    } else {
        $return = array(
            'message' => "Profile information update failed.",
            'success' => true,
            'styleclass' => "success"
        );
        echo json_encode($return);
        die();
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

function generateRecoveryNumber($str, $length, $unique) {
    //$characters = "aA7bB1cC2dD3eE4fF5gG6hH7iI8jJ9kK10lL1mM2nN3oO4pP5qQ6rR7sS8tT9uU1vV2wW3xX4yY5zZ6";
    $characters = $str;
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    if ($unique) {
        return time() . "_" . $randomString;
    } else {
        return $randomString;
    }
}

function hashPassword($password) {
//    $options = [
//        'cost' => 11,
//        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
//    ];
//    $hashedpassword = password_hash($password, PASSWORD_BCRYPT, $options);
    $hashedpassword = md5($password);
    return $hashedpassword;
}

function registrationMail($messagearray, $baseurl) {
    $message = "<html><body><img src='" . BASE_URL . "assets/images/icon/logo.png'><br><br><table style='width:100%;min-height:300px;background:#eeeeee'>";
    foreach ($messagearray as $key => $value) {
        $message.="<tr><td style='text-align:center'>" . $value . "</td></tr>";
    }
    $message.="</table></body></html>";
    return $message;
}

ob_flush();
?>



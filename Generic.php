<?php
error_reporting(0);
date_default_timezone_set('UTC');
v_preventDirectAccess("Generic");
session_start();
define("BASE_URL", "http://localhost/practice/");
define("APP_NAME", "Mr. Goalz");
define("APP_LOGO", BASE_URL . "assets/css/images/logo.png");
define("PROVIDER", "http://vaiuugroupbd.org");
define("PROVIDER_LOGO", "http://vaiuugroupbd.org");

define("GOOGLE_API", "google-api-php-client-master/src/");
define("API_KEY", "AIzaSyDgxIKmBYxmKvOboN8ZOV3PRN1PU0VHlro");

//Google Api
define("CLIENT_ID", '236692989695-bj842d637mr8c98goe7orvs4u9be78k4.apps.googleusercontent.com');
define("CLIENT_SECRET", 'vuIltapyq5lSghJp8or3sJod');
define("REDIRECT_URL", 'http://mrgoalz.com/gpluslogin.php');
define("ADMIN_EMAIL", "superadmin@mrgoalz.com");
include 'library/mail/phpmailer.php';
include 'model/databaseconfig.php';
$messages = array(
    'pattern_username_sms' => "Must have at least 8 character including 1 uppercase, 1 lowercase and 1 number.",
    'pattern_email_sms' => "Invalid email pattern."
);
if (empty($_SESSION['client_info'])) {
    $_SESSION['client_info'] = timeZone();
}

function v_get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
        $ipaddress = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } else if (getenv('HTTP_X_FORWARDED')) {
        $ipaddress = getenv('HTTP_X_FORWARDED');
    } else if (getenv('HTTP_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } else if (getenv('HTTP_FORWARDED')) {
        $ipaddress = getenv('HTTP_FORWARDED');
    } else if (getenv('REMOTE_ADDR')) {
        $ipaddress = getenv('REMOTE_ADDR');
    } else {
        $ipaddress = '';
    }
    return $ipaddress;
}

function v_returnMessage($message, $success, $styleclasses, $field, $url) {
    $return = array(
        'message' => $message,
        'success' => $success,
        'styleclass' => $styleclasses,
        'field' => $field,
        'redirecturl' => $url
    );
    echo json_encode($return);
    die();
}

function v_ip_time_zone() {
    $ip = v_get_client_ip();
    $json = file_get_contents('http://smart-ip.net/geoip-json/' . $ip);
    $ipData = json_decode($json, true);
    if ($ipData['timezone']) {
        $tz = new DateTimeZone($ipData['timezone']);
        $now = new DateTime('now', $tz); // DateTime object corellated to user's timezone
    } else {
        // we can't determine a timezone - do something else...
    }
}

function v_authenTicate($fieldname = "", $require = "", $min = "", $max = "", $pattern = "", $postkey = "", $postvalue = "") {
    if ($required == true) {
        if ($postvalue == "") {
            $response = array(
                "message" => $fieldname . " is required.",
                "success" => false,
                "styleclass" => "danger",
                "field" => $postkey,
            );
            echo json_encode($response);
            die();
        }
    }
    if ($min != "") {
        if (strlen($postvalue) < $min) {
            $response = array(
                "message" => "Must have at least " . $min . " characters.",
                "success" => false,
                "styleclass" => "danger",
                "field" => $postkey
            );
            echo json_encode($response);
            die();
        }
    }
    if ($max != "") {
        if (strlen($postvalue) > $max) {
            $response = array(
                "message" => "Maximum allowed characters are " . $max . ".",
                "success" => false,
                "styleclass" => "danger",
                "field" => $postkey
            );
            echo json_encode($response);
            die();
        }
    }
    if ($pattern != "" && $pattern != "email") {
        if (v_cREX($pattern, $postvalue) == false) {
            $response = array(
                "message" => "Please match the requested format.",
                "success" => false,
                "styleclass" => "danger",
                "field" => $postkey
            );
            echo json_encode($response);
            die();
        }
    }
    if ($pattern == "email") {
        if (!filter_var($postvalue, FILTER_VALIDATE_EMAIL)) {
            $response = array(
                "message" => "Please input a valid email address.",
                "success" => false,
                "styleclass" => "danger",
                "field" => $postkey
            );
            echo json_encode($response);
            die();
        }
    }
}

function v_cookieEnable() {
    if (isset($_COOKIE['user_id_name']) && isset($_COOKIE['user_email'])) {
        return true;
    } else {
        return false;
    }
}

function v_cREX($pattern, $string) {
    $result = preg_match($pattern, $string);
    return $result;
}

function v_generateToken() {
    $token = "mrpredict_vaiuugroupbd_" . time();
    $token = md5($token);
    $_SESSION['token'] = $token;
    return $token;
}

function v_preventDirectAccess($filename = "") {
    $requesturl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if (false !== strpos($requesturl, $filename)) {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }
}

function v_show_404() {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    exit();
}

function v_reDirect($url) {
    header("Location:" . $url);
}

function v_get_getpass() {
    if (isset($_SESSION['vaiuugroup']['user_id_name']) && isset($_SESSION['vaiuugroup']['user_email'])) {
        $access = true;
        $userid = $_SESSION['vaiuugroup']['user_id_name'];
        $useremail = $_SESSION['vaiuugroup']['user_email'];
    } else if (v_cookieEnable() == true) {
        $access = true;
        $userid = $_COOKIE['user_id_name'];
        $useremail = $_COOKIE['user_email'];
    } else {
        $access = false;
    }
    return $access;
}

function v_cash_data() {
    $user = array();
    $userinfo = v_dataSelect("mrpredict_user", "user_email='" . $_SESSION['vaiuugroup']['user_email'] . "'");
    $getTeam = v_dataSelect("team", "status='active'");
    $user['userid'] = empty($userinfo['data'][0]['userid']) ? "" : $userinfo['data'][0]['userid'];
    $user['id_name'] = empty($userinfo['data'][0]['user_id_name']) ? "" : $userinfo['data'][0]['user_id_name'];
    $user['user_email'] = empty($userinfo['data'][0]['user_email']) ? "" : $userinfo['data'][0]['user_email'];
    $user['profile_picture'] = empty($userinfo['data'][0]['profile_picture']) ? BASE_URL . "assets/userimages/avatar.jpg" : $userinfo['data'][0]['profile_picture'];
    $user['user_name'] = empty($userinfo['data'][0]['user_name']) ? "" : $userinfo['data'][0]['user_name'];
    $user['birth_year'] = empty($userinfo['data'][0]['birth_year']) ? "" : $userinfo['data'][0]['birth_year'];
    $user['gender'] = $userinfo['data'][0]['gender'] == "Female" ? "Female" : "Male";
    $user['nationality'] = empty($userinfo['data'][0]['nationality']) ? "" : $userinfo['data'][0]['nationality'];
    $user['favourite_team'] = empty($userinfo['data'][0]['favourite_team']) ? "" : $userinfo['data'][0]['favourite_team'];
    $user['recovery_number'] = empty($userinfo['data'][0]['recovery_number']) ? "" : $userinfo['data'][0]['recovery_number'];
    $user['team'] = $getTeam['data'];
    $user['game_notification'] = $userinfo['data'][0]['game_notification'];
    $bonus_status = v_dataSelect("monthly_bonus", "user_id='" . $userinfo['data'][0]['userid'] . "' AND month_number='" . date("m") . "' AND year='" . date("Y") . "' AND status='used'");
    $user['bonus'] = $bonus_status['data'];
    // Which image to use
    $user['using_avatar'] = $_SESSION['vaiuugroup']['profile'];
    $my_league = v_dataSelect("league", "user_id='" . $user['userid'] . "' AND user_type='user'");
    $user['my_league'] = $my_league['data'];
    return $user;
}

function googleLogin() {
    include GOOGLE_API . 'Google/Client.php';
    $client = new Google_Client();
    $client->setApplicationName(APP_NAME);
    $client->setDeveloperKey(API_KEY);
    $client->setClientId(CLIENT_ID);
    $client->setClientSecret(CLIENT_SECRET);
    $client->setRedirectUri(REDIRECT_URL);
    $client->setScopes(googleLoginScope());
    return $client->createAuthUrl();
}

function setCredential() {
    include GOOGLE_API . 'Google/Client.php';
    $client = new Google_Client();
    $client->setApplicationName(APP_NAME);
    $client->setDeveloperKey(API_KEY);
    $client->setClientId(CLIENT_ID);
    $client->setClientSecret(CLIENT_SECRET);
    $client->setRedirectUri(REDIRECT_URL);
    $client->setScopes(googleLoginScope());
    $service = new Google_Service_Oauth2($client);
    return $service;
}

function googleLoginScope() {
    $scope = array(
        "https://www.googleapis.com/auth/plus.login",
        "https://www.googleapis.com/auth/userinfo.email",
        "https://www.googleapis.com/auth/userinfo.profile",
        "https://www.googleapis.com/auth/plus.me"
    );
    return $scope;
}

function v_tokenCheck($token) {
    if (empty($_SESSION['token']) || $_SESSION['token'] != $token) {
        $return = array(
            'message' => "Session timed out , please refresh the page and then try again",
            'success' => false,
            'styleclass' => "danger",
            'field' => ""
        );
        echo json_encode($return);
        die();
    }
}

function v_sessionCheck() {
    if (isset($_COOKIE['user_id_name']) && isset($_COOKIE['user_id_name'])) {
        header("Location:" . BASE_URL . "settings.php");
    } else if (isset($_SESSION['vaiuugroup']['user_id_name']) && isset($_SESSION['vaiuugroup']['user_email'])) {
        header("Location:" . BASE_URL . "settings.php");
    }
}

function weeklyUserScore() {
    
}

function userScorePerGame($id) {
    $user = v_dataSelect("myguess", "status='calculated' AND userid='$id'");
    for ($i = 0; $i < count($user['data']); $i++) {
        $totalpoint = $user['data'][$i]['points1'] + $user['data'][$i]['points2'] + $user['data'][$i]['points3'];
        $guessdate = $user['data'][$i]['createdate'];
        $guessyear = $user['data'][$i]['year'];
        $guessmonth = $user['data'][$i]['month'];
        $guessdate = $user['data'][$i]['day'];
        $gameweek = $user['data'][$i]['fridaynumber'];
        $bonus = v_dataSelect("monthly_bonus", "month_number='$guessmonth' AND year='$guessyear' AND fridaynumber='$gameweek' AND status='used' AND user_id='$id'");
        $user['data'][$i]['pointwithoutbonus'] = $totalpoint;
        if ($bonus['counter'] != 0) {
            $totalpoint = $totalpoint * 2;
        }
        $user['data'][$i]['pointwithbonus'] = $totalpoint;
    }
    return $user;
}

function userTotalScore($id) {
    $us = v_dataSelect("mrpredict_user", "userid='$id'");
    $user = v_dataSelect("myguess", "status='calculated' AND userid='$id'");
    $numberofgame = count($user['data']);
    for ($i = 0; $i < count($user['data']); $i++) {
        $totalpoint = $user['data'][$i]['points1'] + $user['data'][$i]['points2'] + $user['data'][$i]['points3'];
        $guessdate = $user['data'][$i]['createdate'];
        $guessyear = $user['data'][$i]['year'];
        $guessmonth = $user['data'][$i]['month'];
        $guessdate = $user['data'][$i]['day'];
        $gameweek = $user['data'][$i]['fridaynumber'];
        $bonus = v_dataSelect("monthly_bonus", "month_number='$guessmonth' AND year='$guessyear' AND fridaynumber='$gameweek' AND status='used' AND user_id='$id'");
        $user['data'][$i]['pointwithoutbonus'] = $totalpoint;
        if ($bonus['counter'] != 0) {
            $totalpoint = $totalpoint * 2;
        }
        $user['data'][$i]['pointwithbonus'] = $totalpoint;
    }
    $withoutbonus = 0;
    $withbonus = 0;
    for ($i = 0; $i < count($user['data']); $i++) {
        $withoutbonus = $withoutbonus + $user['data'][$i]['pointwithoutbonus'];
        $withbonus = $withbonus + $user['data'][$i]['pointwithbonus'];
    }
    $u['userid'] = $us['data'][0]['userid'];
    $u['useridname'] = $us['data'][0]['user_id_name'];
    $u['username'] = $us['data'][0]['user_name'];
    $u['useremail'] = $us['data'][0]['user_email'];
    $u['withbonus'] = $withbonus;
    $u['withoutbonus'] = $withoutbonus;
    $u['numberofgame'] = $numberofgame;
    return $u;
}

function allUserScore() {
    $mr = array();
    $user = v_dataSelect("mrpredict_user", "status='active'");
    for ($i = 0; $i < count($user['data']); $i++) {
        $mr[$i] = userTotalScore($user['data'][$i]['userid']);
    }
    usort($mr, function($a, $b) {
        if ($a['withoutbonus'] == $b['withoutbonus'])
            return 0;
        return $a['withoutbonus'] < $b['withoutbonus'] ? 1 : -1;
    });
    return $mr;
}

/* * ******************************************************************************* */
/* * *****************************   Dirty Function ******************************** */
/* * ******************************************************************************* */

function v_includeFooter() {
    ?>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery-2.1.1.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.smoothwheel.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.maskinput.js"></script>
    <script type="text/javascript">
        var BASE_URL = "<?php echo BASE_URL; ?>";
        var DEVICE_WIDTH = window.screen.availWidth;
        var DEVICE_HEIGHT = window.screen.availHeight;
        $(document).ready(function () {
            $("body").smoothWheel();
        });
    </script>
    <script src="<?php echo BASE_URL; ?>assets/js/vaiuu.js"></script>
    <?php
}

function copy_right_menu() {
    ?>
    <div>
        <br>
        <ul class="copy-rigth-menu condenced">
            <li><a href="condition.php">&copy; MrGoalz.com <?php echo date("Y"); ?>, All rights reserved.</a></li>
            <li class="bar1">|</li>
            <li><a href="condition.php?condition=<?php echo md5("terms-condition"); ?>">Terms & Conditions</a></li>
            <li class="bar2">|</li>
            <li><a href="condition.php?condition=<?php echo md5("privacy-policy"); ?>">Privacy Policy</a></li>
        </ul>
        <ul class="copy-rigth-menu condenced">
            <li><a href="http://vaiuugroupbd.org/" style="color:black;font-size:12px;">Developed by  Vaiuu Group BD</a></li>
        </ul>
    </div>
    <?php
}

function v_includeHeader() {
    $device = getDeviceType();
    ?>
    <link rel="icon" type="image/png" href="favicon.png?u=2">
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <?php if ($device == "mobile"): ?>
        <link href="<?php echo BASE_URL; ?>assets/css/ios.css" rel="stylesheet" type="text/css">
    <?php else: ?>
        <link href="<?php echo BASE_URL; ?>assets/css/styles.css" rel="stylesheet" type="text/css">
    <?php endif; ?>
    <!--[if lt IE 9]>
      <script src="<?php echo BASE_URL; ?>assets/js/html5shiv.min.js"></script>
      <script src="<?php echo BASE_URL; ?>assets/js/respond.min.js"></script>
    <![endif]-->
    <?php
}

function getDeviceType() {
    $agent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match("/iPhone/", $agent) || preg_match("/Android/", $agent) || preg_match("/webOS/", $agent) || preg_match("/iPad/", $agent) || preg_match("/iPod/", $agent) || preg_match("/BlackBerry/", $agent) || preg_match("/IEMobile/", $agent) || preg_match("/Opera Mini/", $agent)) {
        return "mobile";
    } else {
        return "large";
    }
}

function v_registrationMail($messagearray, $baseurl) {
    $message = "<html><body><img src='" . BASE_URL . "assets/images/icon/logo.png'><br><br><table style='width:100%;min-height:300px;background:#eeeeee'>";
    foreach ($messagearray as $key => $value) {
        $message.="<tr><td style='text-align:center'>" . $value . "</td></tr>";
    }
    $message.="</table></body></html>";
    return $message;
}

function timeZone($user_ip = "") {
    if ($user_ip != "") {
        $ip_tracking_url = json_decode(file_get_contents('http://www.telize.com/geoip/'));
        $iptrack['ip'] = $ip_tracking_url->{'ip'};
    } else {
        $ip_tracking_url = json_decode(file_get_contents('http://www.telize.com/geoip/' . $user_ip));
        $iptrack['ip'] = $user_ip;
    }
    $iptrack['country'] = $ip_tracking_url->{'country'};
    $iptrack['region'] = $ip_tracking_url->{'timezone'};
    $iptrack['city'] = $ip_tracking_url->{'city'};
    $iptrack['latitude'] = $ip_tracking_url->{'latitude'};
    $iptrack['longitude'] = $ip_tracking_url->{'longitude'};

    $timezone_info = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/timezone/json?location=' . $iptrack["latitude"] . ',' . $iptrack["longitude"] . '&timestamp=' . time() . '&key=' . API_KEY));
    $iptrack['rawOffset'] = $timezone_info->{'rawOffset'};
    $iptrack['timeZoneId'] = $timezone_info->{'timeZoneId'};
    $iptrack['timeZoneName'] = $timezone_info->{'timeZoneName'};
    return $iptrack;
}

function v_sideMenu($FB_LOGIN_URL = "javascript:void(0)", $gurl = "javascript:void(0)") {
    ?>
    <div class="sidemenucontainer mobsm">
        <div class="sidemenucontent mobsmcontent">
            <ul>
                <li><a href="./">HOME</a></li>
                <li><a href="<?php echo BASE_URL; ?>signup.php" >SIGN UP</a></li>
                <li><a href="<?php echo BASE_URL; ?>signin.php" >LOG IN</a></li>
            </ul>
            <div class="sidebarsocialicon mobsmicon">
                <a class="fb"  href="<?php echo $FB_LOGIN_URL; ?>" id="fb"></a>
                <a class="gplus" href="<?php echo $gurl; ?>"></a>
            </div>
        </div>
        <div class="sidemenubackdrop"></div>
        <div class="clearfix"></div>
    </div>
    <?php
}

function v_sessionedTopMenu() {
    ?>
    <div class="sessionedtopmenu">
        <div class="menuicon">
            <div id="menuicon"></div>
        </div>
        <div class="tooglablemenu">
            <div id="tooglablemenu-wrapper">
                <div class="topmenu"><img src="<?php echo BASE_URL; ?>assets/css/images/logo.png"></div>
                <div class="topmenu"><a href="settings.php">HOME</a></div>
                <div class="topmenu"><a href="gamelist.php">UPCOMING</a></div>
                <div class="topmenu"><a href="my-guess-info.php">MY GUESS</a></div>
                <div class="topmenu"><a href="leader-board.php">LEADER</a></div>
                <div class="topmenu"><a href="myhistory.php">MY HISTORY</a></div>
                <div class="topmenu"><a href="more-stuff.php">MORE</a></div>
                <div class="topmenu"><a href="<?php echo BASE_URL ?>logout.php">LOGOUT</a></div>
            </div>
        </div>
    </div>
    <?php
}

function profileInfoGeneral($avatar = "", $userid = "") {
    $user = v_dataSelect("mrpredict_user", "user_email='" . $_SESSION['vaiuugroup']['user_email'] . "'");
    $id = $user['data'][0]['userid'];
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
    for ($i = 0; $i < count($leaderlist); $i++) {
        if ($leaderlist[$i]['userid'] == $id) {
            $myrank = $leaderlist[$i]['rank'];
            $myscore = $leaderlist[$i]['withbonus'];
        }
    }
    ?>
    <div class="profile-image">
        <div class="avatar">
            <a href="avatar.php"><img src="<?php echo $_SESSION['vaiuugroup']['profile']; ?>" class="img-circle" id="profileimage"></a>
        </div>
        <div class="username black">
            <?php echo $_SESSION['vaiuugroup']['user_id_name']; ?>
        </div>
    </div>
    <div class="profile-rank black">
        <div>Rank: <?php echo $myrank; ?></div>
        <div>Score: <?php echo $myscore; ?></div>
    </div>

    <div class="clearfix"></div>
    <?php
}

function profilePictureChange($avatar = "", $userid = "") {
    $user = v_dataSelect("mrpredict_user", "user_email='" . $_SESSION['vaiuugroup']['user_email'] . "'");
    $id = $user['data'][0]['userid'];
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
    for ($i = 0; $i < count($leaderlist); $i++) {
        if ($leaderlist[$i]['userid'] == $id) {
            $myrank = $leaderlist[$i]['rank'];
            $myscore = $leaderlist[$i]['withbonus'];
        }
    }
    ?>
    <div class="profile-image">
        <div class="pim avatar">
            <img src="<?php echo $avatar; ?>" class="img-circle" id="changeprofileimage">
            <div class="imageactionbutton">
                <button class="btn btn-success proceedupload">Save</button>
                <button class="btn btn-danger cancelupload">Cancel</button>
            </div>
            <div class="fileactionbutton hidden">
                <form id="upload-image" autocomplete="off" role="form">
                    <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                    <input type="hidden" value="<?php echo $avatar; ?>" id="previousimage">
                    <input type="hidden" name="profile_picture" id="profile_picture">
                    <input type="submit"  class="hidden" id="uploadimage">
                </form>
            </div>
        </div>
        <div class="username black">
            <?php echo $userid; ?>
        </div>
    </div>
    <div class="profile-rank black">
        <div>Rank: <?php echo $myrank; ?></div>
        <div>Score: <?php echo $myscore; ?></div>
    </div>

    <div class="clearfix"></div>
    <?php
}

function sponsorRedirect($url) {
    ?>
    <div class="sponser-number"><span class="shape-circle" style="color: blue">i</span></div>
    <div class="sponser-message thin" style="color: black">Sponsored Ad</div>
    <div class="sponser-symbol"><span class="correct add-sponsor-button" data-redirect="<?php echo $url; ?>"></span></div>
    <div class="clearfix"></div>
    <?php
}

function sponsorClose() {
    ?>
    <div class="sponser-message  col-md-10 col-sm-10" style="color: black;padding-left: 80px">Sponsored Ad</div>
    <div class="sponser-symbol  col-md-2 col-sm-2" style="padding-left: 50px;"><span class="cross add-cross"></span></div>
    <div class="clearfix"></div>
    <?php
}

function bottomSessionedMenu($p1 = "", $p2 = "", $p3 = "", $p4 = "", $p5 = "", $number = "") {
    ?>
    <div class="usermenu">
        <ul class="bottom-fixed-menu thin">
            <li><a href="gamelist.php"><span class="menu-icon-holder"><span class="shape-circle-menu <?php echo $p1; ?>"></span></span><span class="menu-text">Main</span></a></li>
            <li><a href="my-guess-info.php"><span class="menu-icon-holder"><span class="shape-circle-menu <?php echo $p2; ?>"></span></span><span class="menu-text">Guess it</span></a></li>
            <li><a href="leader-board.php"><span class="menu-icon-holder"><span class="shape-circle-menu <?php echo $p3; ?>"></span></span><span class="menu-text">Ranking</span></a></li>
            <li><a href="leader-board.php?key=leaderboard&action=chooseleague"><span class="menu-icon-holder"><span class="shape-circle-menu <?php echo $p4; ?>"></span></span><span class="menu-text">My League</span></a></li>
            <li><a href="more-stuff.php"><span class="menu-icon-holder"><span class="shape-circle-menu <?php echo $p5; ?>" style="position: relative"><span class="circle-message">1</span></span></span><span class="menu-text">More</span></a></li>
            <div class="clearfix"></div>
        </ul>
    </div>
    <?php
}

function v_topMenu($FB_LOGIN_URL = "javascript:void(0)", $gurl = "javascript:void(0)") {
    ?>
    <div class="topmenucontainer">
        <div class="small-device">
            <div class="listicon"><button class="btn btn-default" id="listicon"><i class="glyphicon glyphicon-tasks"></i></button></div>
            <div class="logoicon">
                <img src="<?php echo BASE_URL ?>assets/css/images/logo.png">
            </div>
            <div class="big-device">
                <div><a href="./">HOME</a></div>
                <div><a href="<?php echo BASE_URL; ?>signup.php">SIGN UP</a></div>
                <div><a href="<?php echo BASE_URL; ?>signin.php">LOG IN</a></div>
                <div style="margin-left:70px;"><a href="<?php echo $FB_LOGIN_URL; ?>" style="padding-top: 12px;"  id="facebook-login"><img src="<?php echo BASE_URL; ?>assets/css/images/fb.png"></a></div>
                <div><a style="padding-top: 12px;" href="<?php echo $gurl; ?>" id="gpls"><img src="<?php echo BASE_URL; ?>assets/css/images/gplus.png"></a></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php }
?>
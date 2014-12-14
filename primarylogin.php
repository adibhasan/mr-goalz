<?php 
include 'Generic.php'; 
include 'controller/Signup.php'; 
include 'fblogin.php';
unset($_SESSION['vaiuugroup']['user_email']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <title><?php echo APP_NAME; ?> || SIGN IN</title>
        <?php v_includeHeader(); ?>
    </head>
    <body>
        <div id="datacontent">
            <?php
            v_sideMenu();
            v_topMenu($FB_LOGIN_URL);
            ?>
            <div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
            <div class="page-container container">
                <div>
                    <div class="doubleline"></div>
                    <div class="doubleline"></div>
                    <div class="doubleline"></div>
                    <div class="main-content">
                    <div  id="logincontainer" class="formcontainer">
                        <div class="formwrapper">
                            <div style="padding:20px">
                                <h4 class="condenced">Your account is now pending. Please check your mail . An activation link had send while registration.</h4>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div style="margin-top:50px;" class="submit-signup">
                        <div class="sign-border"></div>
                        <div class="btn-signup-submit thin">Sign Up!</div>
                        <div class="sign-border"></div>
                    </div>
                    <?php copy_right_menu(); ?>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <?php v_includeFooter(); ?>
    </body>
</html>


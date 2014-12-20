<?php 
include 'Generic.php';
include 'controller/Signin.php'; 
include 'fblogin.php';
$gurl=googleLogin();
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
        <div id="datacontent" class="thin">
            <?php
            v_sideMenu($FB_LOGIN_URL,$gurl);
            v_topMenu($FB_LOGIN_URL,$gurl);
            ?>
            <div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
            <div class="page-container container">
                <div >
                    <div class="doubleline"></div>
                    <div class="doubleline"></div>
                    <div class="doubleline"></div>
                    <div class="main-content">
                    <div  id="logincontainer" class="formcontainer mlogincontainer">
                        <div class="formwrapper">
                            <div class="alert-custom"></div>
                            <form  name="login" id="login" class="dataform" autocomplete="off">
                                <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                <div class="input-box minputbox">
                                    <div class="signal"></div>
                                    <input type="text"   class="textinput center-text black minput1" name="user_id_name" placeholder="Username" maxlength="20" required="required" pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,20}$" title="<?php echo $messages['pattern_username_sms']; ?>">
                                    <div class="error-message"></div>
                                </div>
                                <input type="text" class="hidden">
                                <input type="password" class="hidden">
                                <div class="input-box minputbox">
                                    <div class="signal"></div>
                                    <input type="password" class="passwordinput center-text black minput1" name="user_password" placeholder="Password" maxlength="20" required="required" pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,50}$" title="<?php echo $messages['pattern_username_sms']; ?>">
                                    <div class="error-message"></div>
                                </div>
                                <div class="input-box remember">
                                    <div class="checkbox mcheckbox">
                                        <div class="checkboxinput cb1"></div>
                                        <input type="checkbox" class="hidden" name="rememberme">
                                        <div class="checkboxtext thin">Keep Me Logged In</div>
                                    </div>
                                    <div class="retrievepassword mretrieve"><a href="password-retrieve.php" class="thin">Forgot Password?</a></div>
                                    <div class="clearfix"></div>
                                </div>

                                <input type="submit" class="hidden" value="Login" id="submitlogin">
                            </form>
                        </div>
                    </div>
                    </div>
                    <div class="userlogin" style="margin-top: 50px;">
                        <a class="actionbutton btnfb" href="<?php echo $FB_LOGIN_URL; ?>"><img src="<?php echo BASE_URL;?>assets/css/images/fb.jpg"></a>
                        <a class="actionbutton btngplus" href="javascript:void(0);"><img src="assets/css/images/gplus.jpg"></a>
                        <a class="actionbutton btnreg"  href="signup.php"><img src="assets/css/images/register.jpg"></a>
                        <a class="actionbutton btnlogin" href="javascript:void(0);"><img src="assets/css/images/btnlogin.jpg"></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
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


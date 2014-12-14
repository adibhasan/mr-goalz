<?php 
include 'Generic.php'; 
include 'controller/Signup.php'; 
include 'fblogin.php';
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
                            <div class="alert-custom"></div>
                            <form autocomplete="off" name="signup" id="signup" class="dataform" >
                                <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                <div class="input-box">
                                    <div class="signal"></div>
                                    <input type="email" class="textinput black" name="user_email" placeholder="Email" maxlength="100" required="required">
                                    <div class="error-message"></div>
                                </div>
                                <div class="input-box">
                                    <div class="signal"></div>
                                    <input type="text" class="textinput black" name="user_id_name" placeholder="Username" maxlength="20" required="required" pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,20}$" title="<?php echo $messages['pattern_username_sms']; ?>">
                                    <div class="error-message"></div>
                                </div>
                                <input type="text" class="hidden">
                                <input type="password" class="hidden">
                                <div class="input-box">
                                    <div class="signal"></div>
                                    <input type="password" class="passwordinput black" name="user_password" placeholder="Password" maxlength="20" required="required" pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,50}$" title="<?php echo $messages['pattern_username_sms']; ?>">
                                    <div class="error-message"></div>
                                </div>
                                <div class="input-box">
                                    <div class="signal"></div>
                                    <input type="password" class="passwordinput black" style="border-bottom: 2px solid #999999" name="retyped_user_password" placeholder="Confirm Password" maxlength="20" required="required" pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,50}$" title="<?php echo $messages['pattern_username_sms']; ?>" data-match="user_password">
                                    <div class="error-message"></div>
                                </div>
                                <input type="submit" value="submit" class="hidden" id="submitsignup">
                            </form>
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


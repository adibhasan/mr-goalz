<?php
include 'Generic.php';
include 'controller/Signin.php';
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
        <div id="datacontent">
            <?php
            v_sideMenu();
            v_topMenu($FB_LOGIN_URL);
            ?>
            <div class="doubleline"></div>
            <div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
            <div class="page-container container">
                <div> 
                    <p style="color: blue">Please enter your email to get an auto generated password.</p>
                    <div  id="logincontainer" class="formcontainer">
                       
                        <div class="doubleline"></div>
                        <div class="formwrapper">
                            <div class="alert-custom"></div>
                            <form  name="retrievepassword" id="retrievepassword" class="dataform" autocomplete="off">
                                <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>" id="token">
                                <div class="input-box" style="border-bottom: 2px solid #999999">
                                    <div class="signal"></div>
                                    <input type="email" class="textinput center-text" name="user_email" placeholder="Email" maxlength="100" required="required">
                                    <div class="error-message"></div>
                                </div>
                                <input type="text" class="hidden">
                                <input type="password" class="hidden">
                                <div class="doubleline"></div>
                                <div style="padding:0px 10px;">
                                    <input type="submit" class="btn btn-primary btn-block" value="Retrieve Password" id="password-retrieve">
                                </div>
                                <div class="doubleline"></div>
                            </form>
                        </div>
                    </div>
                    <div class="doubleline"></div>
                    <div class="doubleline"></div>
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


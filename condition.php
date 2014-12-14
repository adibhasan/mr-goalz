<?php
include 'Generic.php';
include 'controller/Conditions.php';
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
            <div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
            <div class="page-container container">
                <div class="col-md-8 col-md-offset-2">
                    <?php if (isset($_GET['condition']) && $_GET['condition'] == md5("terms-condition")): ?>
                        <div class="credential justify-text" id="terma-and-condition">
                            <h4 class="center-text">Terms and Conditions</h4>
                            <hr>
                            <p>This website and its content is copyright of MrGoalz.com - © MrGoalz.com 2014. All rights reserved.</p>
                            <div>Any redistribution or reproduction of part or all of the contents in any form is prohibited other than the following:</div>
                            <ul>
                                <li>you may print or download to a local hard disk extracts for your personal and non-commercial use only</li>
                                <li>you may copy the content to individual third parties for their personal use, but only if you acknowledge the website as the source of the material</li>
                            </ul>
                            <p>You may not, except with our express written permission, distribute or commercially exploit the content. Nor may you transmit it or store it in any other website or other form of electronic retrieval system.</p>
                        </div>
                    <?php elseif (isset($_GET['condition']) && $_GET['condition'] == md5("privacy-policy")): ?>
                        <div class="credential justify-text" id="terma-and-condition">
                            <h4 class="center-text">Privacy Policy</h4>
                            <hr>
                            <p>This website and its content is copyright of MrGoalz.com - © MrGoalz.com 2014. All rights reserved.</p>
                            <div>Any redistribution or reproduction of part or all of the contents in any form is prohibited other than the following:</div>
                            <ul>
                                <li>you may print or download to a local hard disk extracts for your personal and non-commercial use only</li>
                                <li>you may copy the content to individual third parties for their personal use, but only if you acknowledge the website as the source of the material</li>
                            </ul>
                            <p>You may not, except with our express written permission, distribute or commercially exploit the content. Nor may you transmit it or store it in any other website or other form of electronic retrieval system.</p>
                        </div>
                    <?php else: ?>
                        <div class="credential justify-text">
                            <h4 class="center-text">&copy; MrGoalz.com <?php echo date("Y"); ?>, All Rights Reserved.</h4>
                            <hr>
                            <p>This website and its content is copyright of MrGoalz.com - © MrGoalz.com 2014. All rights reserved.</p>
                            <div>Any redistribution or reproduction of part or all of the contents in any form is prohibited other than the following:</div>
                            <ul>
                                <li>you may print or download to a local hard disk extracts for your personal and non-commercial use only</li>
                                <li>you may copy the content to individual third parties for their personal use, but only if you acknowledge the website as the source of the material</li>
                            </ul>
                            <p>You may not, except with our express written permission, distribute or commercially exploit the content. Nor may you transmit it or store it in any other website or other form of electronic retrieval system.</p>
                        </div>
                    <?php endif; ?>
                    <div style="margin-top:50px;" class="submit-signup">
                        <div class="sign-border"></div>
                        <div class="btn-signup-submit">Sign Up!</div>
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


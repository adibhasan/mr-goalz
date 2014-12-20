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
            v_sideMenu($FB_LOGIN_URL);
            v_topMenu($FB_LOGIN_URL);
            ?>
            <div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
            <div class="page-container container">
                <div>
                    <div class="doubleline"></div>
                    <div class="doubleline"></div>
                    <div class="doubleline"></div>
                    <div class="main-content">
                        <div  id="logincontainer" class="formcontainer mlogincontainer center-text resend">
                            <div class="formwrapper">
                                <div style="padding:20px">
                                    <h4 class="condenced">Your account is now pending. Please check your mail . An activation link had send while registration.</h4>
                                </div>
                                <div style="padding:20px">
                                    <h4 class="condenced">In case you missed the mail , please click the button given below.</h4>
                                </div>
                                <div style="text-align: center"><button id="re-send-activation-link" class="btn btn-info">Resend Activation Link</button></div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <?php copy_right_menu(); ?>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <div class="modal fade" id="resend-r-link">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Resend Activation Link</h4>
                    </div>
                    <div class="modal-body">
                        <div  id="logincontainer" class="formcontainer mlogincontainer">
                            <div class="formwrapper">
                                <div class="alert-custom"></div>
                                <form  name="resend-activation-link" id="resend-activation-link" class="dataform" autocomplete="off">
                                    <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                    <div class="input-box minputbox">
                                        <input type="text"   class="textinput center-text black minput1" name="user_id_name" placeholder="Username" maxlength="20" required="required" pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,20}$">
                                    </div>
                                    <input type="text" class="hidden">
                                    <div class="input-box minputbox">
                                        <input type="email" class="textinput black minput1 center-text" name="user_email" placeholder="Email" maxlength="100" required="required">
                                    </div>
                                    <br>
                                    <button type="button" class="btn btn-default condenced" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary condenced">Resend</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <?php v_includeFooter(); ?>
    </body>
</html>


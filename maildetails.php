<?php include 'Generic.php'; ?>
<?php include 'controller/MailBox.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <title><?php echo APP_NAME; ?> || PROFILE PICTURE</title>
        <?php v_includeHeader(); ?>
    </head>
    <body>
        <div id="datacontent">
            <?php
            v_sessionedTopMenu();
            ?>
            <div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
            <div class="page-container container">
                <div >
                    <div class="profile">
                        <?php profileInfoGeneral($avatar, $userid); ?>
                    </div>
                    <div class="line"></div>
                    <div class="sponsor-link" style="padding: 5px;">
                        <?php sponsorRedirect("http://google.com"); ?>
                    </div>
                    <div class="wrapp-container" id="league-table">
                        <div class="main-content">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="table-row-heading">
                                        <div class="col-text-title-black"><a href="mail_invitations.php"><i class="glyphicon glyphicon-chevron-left"></i>Back</a> Mail & Invitations</div>
                                    </div>
                                </div>
                                <div class="table-content" style="padding: 5px;">
                                    <h4 style="color:blue"><?php echo $particularmessage['data'][0]['message_title'];?> <a href="javascript:void(0)" data-msis="<?php echo $_GET['mailid'];?>" style="color: red" id="delete-sms"><i class="glyphicon glyphicon-trash"></i></a></h4>
                                    <p><?php echo stripcslashes($particularmessage['data'][0]['message_body']);?></p>
                                    <p><small><?php echo "Date: ".stripcslashes($particularmessage['data'][0]['create_date']);?></small></p>
                                </div>
                                <div class="table-footer">
                                    <div class="closable-add">
                                        <?php sponsorClose(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="usermenu-wrapper">
            <?php bottomSessionedMenu(); ?>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <?php v_includeFooter(); ?>
        <script>
            $("#league-table").show();
            
        </script>
    </body>
</html>


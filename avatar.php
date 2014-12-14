<?php include 'Generic.php'; ?>
<?php include 'controller/Avatar.php'; ?>
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
                <div>
                    <div class="profile">
                        <?php profilePictureChange($avatar, $userid); ?>
                    </div>
                    <div class="line"></div>
                    <div class="sponsor-link" style="padding: 5px;">
                        <?php sponsorRedirect("http://google.com"); ?>
                    </div>
                    <div class="wrapp-container">
                        <div class="main-content">
                            <div  id="editprofilecontainer" class="formcontainer">
                                <div class="profiletitle" style="position: relative;height: 70px;"><div class="logo-profile-picture thin">Choose Profile Pic:</div></div>
                                <div class="profilebody">
                                    <div class="demo-image">
                                        <?php for ($i = 0; $i < count($imagelist['data']); $i++): ?>
                                            <div class="demo-avatar">
                                                <img src="<?php echo BASE_URL . $imagelist['data'][$i]['filepath']; ?>" title="Click to choose this picture.">
                                            </div>
                                        <?php endfor; ?>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="usermenu-wrapper">
            <?php bottomSessionedMenu("","shape-active", "", "", "", ""); ?>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <?php v_includeFooter(); ?>
    </body>
</html>


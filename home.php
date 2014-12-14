<?php
include 'Generic.php';
include 'controller/Home.php';
include 'fblogin.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <title><?php echo APP_NAME; ?> || Home</title>
        <?php v_includeHeader(); ?>
    </head>
    <body>
        <div id="datacontent" class="thin">
            <?php
            v_sideMenu();
            v_topMenu($FB_LOGIN_URL);
            ?>
            <div class="line"></div>
            <div class="page-container container">
                <div>
                    <div class="add">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="<?php echo BASE_URL; ?>assets/images/slide1.jpg" class="img-responsive">
                                </div>
                                <div class="item">
                                    <img src="<?php echo BASE_URL; ?>assets/images/slide2.jpg" class="img-responsive">
                                </div>
                                <div class="item">
                                    <img src="<?php echo BASE_URL; ?>assets/images/slide3.jpg" class="img-responsive">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="doubleline"></div>
                    <div class="gotologinpage">
                        <a href="signin.php">Start Guessing !!</a>
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


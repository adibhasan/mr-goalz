<?php include 'Generic.php'; ?>
<?php include 'controller/Leader.php'; ?>
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
                        <?php profileInfoGeneral($avatar, $_SESSION['vaiuugroup']['user_id_name']); ?>
                    </div>
                    <div class="line"></div>
                    <div class="sponsor-link" style="padding: 5px;">
                        <?php sponsorRedirect("http://google.com"); ?>
                    </div>
                    <?php if ($_GET['key']): ?>
                        <div class="wrapp-container" id="league-table">
                            <div class="main-content">
                                <div class="my-guess" id="my-guess2">
                                    <div class="table-wrapper">
                                        <div class="table-title">
                                            <div class="table-row-heading">
                                                <div class="col-15 col-text-title-black condenced">My League</div>
                                                <div class="col-14 col-text-title-black withlist">
                                                    <div class="list" id="go-to-leader" style="background-position: 0px;">&nbsp;</div>
                                                </div>
                                                <div class="col-14 col-text-title-black rank condenced">Rank</div>
                                                <div class="col-14 col-text-title-black score condenced">Score</div>
                                                <div class="col-14 col-text-title-black plus-minus condenced"> &nbsp;+/-</div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="table-content">
                                            <?php for ($i = 0; $i < 50; $i++): ?>
                                                <div class="table-row paged2" id="<?php echo 'page2_' . $i; ?>" data-pageid2="<?php echo $i; ?>">
                                                    <div class="col-7">
                                                        <div class="shape-circle2"><?php echo $i + 1; ?></div>
                                                    </div>
                                                    <?php if (isset($_GET['exit'])): ?>
                                                        <div class="col-99 col-text-black" style="position: relative">West Born Vs Sunder Land <?php echo $i; ?> <button class="btn btn-danger btn-sm exit-league" data-exit="<?php echo $i; ?>">Exit</button></div>
                                                    <?php else: ?>
                                                        <div class="col-99 col-text-black">West Born Vs Sunder Land <?php echo $i; ?> <button class="btn btn-danger btn-sm"</div>
                                                    <?php endif; ?>

                                                    <div class="col-44 col-text-title-black">
                                                        <div class="box">11</div>
                                                    </div>
                                                    <div class="col-44 col-text-title-black">
                                                        <div class="box box1">11</div>
                                                    </div>
                                                    <div class="col-44 col-text-title-black">
                                                        <div class="box box">11</div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="table-footer">
                                            <div class="table-pagination2">
                                                <a href="javascript:void(0)" class="up-arrow2 pagination-icon"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                                <a href="javascript:void(0)" class="down-arrow2 pagination-icon"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                            </div>
                                            <div class="closable-add">
                                                <?php sponsorClose(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php else: ?>
                        <div class="wrapp-container" id="leader-list">
                            <div class="main-content">
                                <div class="my-guess" id="my-guess">
                                    <div class="table-wrapper">
                                        <div class="table-title">
                                            <div class="table-row-heading">
                                                <div class="col-15 col-text-title-black condenced">Invite User</div>
                                                <div class="col-14 col-text-title-black withlist">
                                                    <div class="list" id="go-to-leader" style="background-position: 0px;">&nbsp;</div>
                                                </div>
                                                <div class="col-14 col-text-title-black rank condenced">Rank</div>
                                                <div class="col-14 col-text-title-black score condenced">Score</div>
                                                <div class="col-14 col-text-title-black plus-minus condenced"> &nbsp;+/-</div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="table-content">
                                            <?php for ($i = 0; $i < 50; $i++): ?>
                                                <div class="table-row paged history" id="<?php echo 'page_' . $i; ?>" data-pageid="<?php echo $i; ?>">
                                                    <div class="col-7">
                                                        <div class="shape-circle2"><?php echo $i + 1; ?></div>
                                                    </div>
                                                    <div class="col-99 col-text-black">West Born Vs Sunder Land <?php echo $i; ?></div>
                                                    <div class="col-44 col-text-title-black">
                                                        <div class="box">11</div>
                                                    </div>
                                                    <div class="col-44 col-text-title-black">
                                                        <div class="box">11</div>
                                                    </div>
                                                    <div class="col-44 col-text-title-black">
                                                        <div class="box">11</div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="table-footer">
                                            <div class="table-pagination">
                                                <a href="javascript:void(0)" class="up-arrow pagination-icon"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                                <a href="javascript:void(0)" class="down-arrow pagination-icon"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                            </div>
                                            <div class="closable-add">
                                                <?php sponsorClose(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="usermenu-wrapper">
    <?php bottomSessionedMenu("", "", "shape-active", "", "", ""); ?>
</div>
<div class="content-wrapper">
    <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
</div>
<?php v_includeFooter(); ?>
</body>
</html>


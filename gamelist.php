<?php include 'Generic.php'; ?>
<?php include 'controller/Gamelist.php'; ?>
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
                    <div class="wrapp-container" id="wrapp-container1">
                        <div class="main-content">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="table-row-heading">
                                        <div class="col-1 col-text-title-black sm-block1 condenced">Upcoming Games</div>
                                        <div class="col-2 col-text-title-black">
                                            <div class="sub-col-1 sub-column sm-block2 condenced">Date & Time</div>
                                            <div class="sub-col-2 sub-column list sm-block3" id="league-table-list">&nbsp;</div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="table-content">
                                    <?php for ($i = 0; $i < count($upcoming_game); $i++): ?>
                                        <div class="table-row paged1 redirecttogess" id="<?php echo 'page1_' . $i; ?>" data-pageid="<?php echo $i; ?>">
                                            <div class="col-1 col-text-black"><?php echo $upcoming_game[$i]['team1'] . " VS " . $upcoming_game[$i]['team2']; ?></div>
                                            <div class="col-2 col-text-blue"><?php echo $upcoming_game[$i]['game_date']; ?></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="table-footer">
                                    <?php if ($total_upcoming > 6): ?>
                                        <div class="table-pagination">
                                            <a href="javascript:void(0)" class="up-arrow pagination-icon" id="uparrow1"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                            <a href="javascript:void(0)" class="down-arrow pagination-icon" id="downarrow1"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="closable-add">
                                        <?php sponsorClose(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="wrapp-container" id="league-table">
                        <div class="main-content">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="table-row-heading">
                                        <div class="col-6" id="back1"><i class="glyphicon glyphicon-chevron-left"></i> Back</div>
                                        <div class="col-5 col-text-title-black label-block1 condenced">League Table</div>
                                        <div class="col-4 col-text-title-black label-block2 condenced">Played</div>
                                        <div class="col-4 col-text-title-black label-block3 condenced">Points</div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="table-content">

                                    <?php for ($i = 0; $i < count($league); $i++): ?>
                                        <div class="table-row paged2" id="<?php echo 'page2_' . $i; ?>" data-pageid2="<?php echo $i; ?>">
                                            <div class="col-7">
                                                <div class="shape-circle2"><?php echo $i + 1; ?></div>
                                            </div>
                                            <div class="col-8 col-text-title-black"><?php echo $league[$i]['team_name']; ?></div>
                                            <div class="col-4 col-text-title-black box6">
                                                <div class="box box4"><?php echo $league[$i]['played']; ?></div>
                                            </div>
                                            <div class="col-4 col-text-title-black">
                                                <div class="box box5"><?php echo $league[$i]['score']; ?></div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="table-footer">
                                    <?php if ($total_league > 6): ?>
                                        <div class="table-pagination2">
                                            <a href="javascript:void(0)" class="up-arrow2 pagination-icon" id="uparrow2"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                            <a href="javascript:void(0)" class="down-arrow2 pagination-icon" id="downarrow2"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="closable-add">
                                        <?php sponsorClose(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="usermenu-wrapper">
            <?php bottomSessionedMenu("shape-active", "", "", "", "", ""); ?>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <script>
            window.maxleague = "<?php echo $total_league; ?>";
        </script>
        <?php v_includeFooter(); ?>
        <script>
            //Pagination common function
            var showPage = function (page, container, pageSize) {
                $(container).hide();
                $(container).each(function (n) {
                    if (n >= pageSize * (page - 1) && n < pageSize * page)
                        $(this).show();
                });
            }
            //Start pagination, page 1
            var currentPage1 = 1;
            var pageSize1 = 6;
            var minPage1 = 1;
            var maxLength1 = "<?php echo $total_upcoming; ?>";
            var maxPage = Math.ceil(maxLength1 / pageSize1);

            showPage(1, ".paged1", pageSize1);
            $("#downarrow1").on("click", function () {
                if (currentPage1 < maxPage) {
                    currentPage1++;
                    showPage(currentPage1, ".paged1", pageSize1);
                }
            });
            $("#uparrow1").on("click", function () {
                if (currentPage1 > 1) {
                    currentPage1--;
                    showPage(currentPage1, ".paged1", pageSize1);
                }
            });
            // End of pagination, page 1
            //Start pagination, page 1
            var currentPage2 = 1;
            var pageSize2 = 6;
            var minPage2 = 1;
            var maxLength2 = "<?php echo $total_league; ?>";
            var maxPage2 = Math.ceil(maxLength2 / pageSize2);

            showPage(1, ".paged2", pageSize2);
            $("#downarrow2").on("click", function () {
                if (currentPage2 < maxPage2) {
                    currentPage2++;
                    showPage(currentPage2, ".paged2", pageSize2);
                }
            });
            $("#uparrow2").on("click", function () {
                if (currentPage2 > 1) {
                    currentPage2--;
                    showPage(currentPage2, ".paged2", pageSize2);
                }
            });
            // End of pagination, page 1

            $("#league-table-list").on("click", function () {
                $("#wrapp-container1").hide("slide", function () {
                    $("#league-table").show("slide");
                });

            });
            $("#back1").on("click", function () {
                $("#league-table").hide("slide", 500, function () {
                    $("#wrapp-container1").show("slide");
                });
            });
            $(".redirecttogess").on("click", function () {
                window.location.href = "my-guess-info.php";
            });
        </script>
    </body>
</html>


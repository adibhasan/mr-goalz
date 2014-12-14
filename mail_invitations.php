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
                    <div class="wrapp-container" id="league-table">
                        <div class="main-content">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="table-row-heading">
                                        <div class="col-text-title-black">Mail & Invitations</div>
                                    </div>
                                </div>
                                <div class="table-content">

                                    <?php for ($i = 0; $i < 50; $i++): ?>
                                        <div class="table-row paged2" id="<?php echo 'page2_' . $i; ?>" data-pageid2="<?php echo $i; ?>">
                                            <div class="col-4 col-text-title-black">
                                                <div class="box"><?php echo $i; ?></div>
                                            </div>
                                            <div class="col-9 mail-title">You are invited!...</div>
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




                    <div  id="upcominggames" class="formcontainer hidden" style="margin-top: 0px;">
                        <div class="table-responsive">
                            <div id="game-list-wrapper">
                                <table class="table my-guess-info" id="game-list">
                                    <tr>
                                        <th class="heading4">
                                            Upcoming Games
                                        </th>
                                        <th> 

                                    <div class="pull-left heading4">Date & Time </div>
                                    <div class="pull-right list-number">
                                        <a class="list-with-number" href="javascript:return false;" id="league-table-action">
                                            <span>1</span>
                                            <span>2</span>
                                            <span>3</span>
                                        </a>
                                    </div>

                                    </th>
                                    </tr>
                                    <?php for ($i = 0; $i < count($upcoming_game); $i++): ?>
                                        <tr class="<?php echo $upcoming_game[$i]['guessing_state']; ?>">
                                            <td><?php echo $upcoming_game[$i]['team1'] . " Vs " . $upcoming_game[$i]['team2']; ?></td>
                                            <td><?php echo $upcoming_game[$i]['game_date']; ?></td> 
                                        </tr>


                                    <?php endfor; ?>

                                </table>
                                <div class="pagination center-text" id="pagination-">
                                    <a href="gamelist.php?limit=<?php echo $lowerlimit - 6; ?>" class="nav-link <?php echo ($_GET['limit'] < 5 || empty($_GET['limit'])) ? "no-link" : ""; ?>"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                    <a href="gamelist.php?limit=<?php echo $lowerlimit + 6; ?>" class="nav-link <?php echo ($total_data <= 5 || $_GET['limit'] > $total_data) ? "no-link" : ""; ?>"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                </div>
                                <div class="closable-add">
                                    <?php sponsorClose(); ?>
                                </div>
                            </div>
                            <div id="league-table-wrapper">
                                <table class="table" id="league-table-backup">
                                    <tr>
                                        <th><h3 class="table-heading"><a href="javascript:return false;" id="upcoming-table-action"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>   League Table</h3></th>
                                    <th><h3 class="table-heading right-text">Played</h3></th>
                                    <th><h3 class="table-heading right-text">Points</h3></th>
                                    </tr>
                                    <?php for ($i = 0; $i < count($league); $i++): ?>
                                        <tr class="sibling <?php echo $i >= 6 ? "hidden" : "non-hidden"; ?>" id="<?php echo "sibling_" . $i; ?>">
                                            <td><span class="shape-circle"><?php echo $i + 1; ?></span> <h4><?php echo $league[$i]['team_name'] ?></h4></td>
                                            <td class="right-text">
                                                <div class="shape-box"><?php echo $league[$i]['played'] ?></div>
                                            </td> 
                                            <td class="right-text">
                                                <div class="shape-box"><?php echo $league[$i]['score'] ?></div>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>

                                </table>
                                <div class="pagination center-text" id="pagination-">
                                    <a href="gamelist.php?limit=<?php echo $lowerlimit - 6; ?>" class="nav-link <?php echo ($_GET['limit'] < 5 || empty($_GET['limit'])) ? "no-link" : ""; ?>"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                    <a href="gamelist.php?limit=<?php echo $lowerlimit + 6; ?>" class="nav-link <?php echo ($total_data <= 5 || $_GET['limit'] > $total_data) ? "no-link" : ""; ?>"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                </div>
                                <div class="closable-add">
                                    <?php sponsorClose(); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>
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
            window.maxleague2 = "<?php echo $total_league; ?>";
            window.incrementor2 = 1;
            window.totalRow2 = 50;
            window.totalPage2 = Math.ceil(50 / 6);
            if (window.totalRow2 <= 6) {
                $(".table-pagination2").hide();
            }
            if (window.totalRow2 > 6) {
                $(".paged2").each(function () {
                    var pageid2 = $(this).data("pageid2");
                    if (pageid2 >= 6) {
                        $(this).hide();
                        if (pageid2 == 6) {
                            $(this).addClass("legend2");
                        }
                    }
                });
            }
            $(".down-arrow2").on("click", function () {
                if (window.totalRow2 > 6 && window.incrementor2 < window.totalPage2) {
                    var j = 0;
                    window.incrementor2++;
                    var currentpage2 = $(this).parent().parent().parent().find(".legend2").data("pageid2");
                    $(this).parent().parent().parent().find(".paged2").hide();
                    for (j = currentpage2; j < currentpage2 + 6; j++) {
                        $("#page2_" + j).show();
                        if ((j != currentpage2) && (j % 6 == 5) && ($("#page2_" + currentpage2).nextAll().length > 5)) {
                            $(this).parent().parent().parent().find(".legend2").removeClass("legend2");
                            $(this).parent().parent().parent().find("#page2_" + (j + 1)).addClass("legend2");
                        }
                    }
                }
            });
            $(".up-arrow2").on("click", function () {
                console.log("V::"+window.incrementor2);
                if (window.totalRow2 > 6 && window.incrementor2 > 1) {
                    var j = 0;
                    window.incrementor2--;
                    var currentpage2 = $(this).parent().parent().parent().find(".legend2").data("pageid2");
                    $(this).parent().parent().parent().find(".paged2").hide();
                    for (j = currentpage2 - 1; j >= currentpage2 - 6; j--) {
                        $("#page2_" + (j - 6)).show();
                        if ((j != currentpage2) && (j % 6 == 0) && ($("#page2_" + currentpage2).prevAll().length > 6)) {
                            $(this).parent().parent().parent().find(".legend2").removeClass("legend2");
                            $(this).parent().parent().parent().find("#page2_" + (j)).addClass("legend2");
                        }
                    }
                }
            });
        </script>
    </body>
</html>


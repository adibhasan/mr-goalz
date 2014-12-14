<?php include 'Generic.php'; ?>
<?php include 'controller/MyGuess.php'; ?>
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
                        <?php profileInfoGeneral($avatar, $userid); ?>
                    </div>
                    <div class="line"></div>
                    <div class="sponsor-link" style="padding: 5px;">
                        <?php sponsorRedirect("http://google.com"); ?>
                    </div>
                    <div class="wrapp-container">
                        <div class="main-content">
                            <div class="my-guess" id="my-guess">
                                <div class="table-wrapper">
                                    <div class="table-title">
                                        <div class="table-row-heading">
                                            <div class="col-text-title-black condenced" style="text-align: center;">My Guess</div>
                                        </div>
                                    </div>
                                    <div class="table-content">
                                        <?php for ($i = 0; $i < 50; $i++): ?>
                                            <div class="table-row paged" id="<?php echo 'page_' . $i; ?>" data-pageid="<?php echo $i; ?>">
                                                <div class="col-4 col-text-title-black">
                                                    <div class="box">11</div>
                                                </div>
                                                <div class="col-9 col-text-black col-55">West Born Vs Sunder Land <?php echo $i; ?></div>
                                                <div class="col-4 col-text-title-black">
                                                    <div class="box">11</div>
                                                </div>
                                                <div class="col-444">
                                                    <button  class="btn btn-primary btn-sm btn-guess-save">Save</button>
                                                    <button class="btn btn-danger btn-sm btn-guess-cancel">Cancel</button>
                                                    <button href="#" class="btn btn-danger btn-sm btn-guess-edit">Edit</button>
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





                            <div  id="upcominggames" class="formcontainer hidden" style="margin-top: 0px;">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th colspan="4"><h3 class="table-heading center-text">My Guess</h3></th>
                                        </tr>
                                        <?php for ($i = 0; $i < count($upcoming_game); $i++): ?>
                                            <tr data-play="<?php echo $upcoming_game[$i]['id']; ?>">
                                                <td class="goal-team1"><div class="shape-box" style="float: left;padding: 0px;line-height: 35px"><?php echo $upcoming_game[$i]['team1score']; ?></div></td>
                                                <td class="team-vs" id="<?php echo "data_" . $upcoming_game[$i]['id']; ?>"><h4 class="center-text"><?php echo $upcoming_game[$i]['team1'] . " Vs " . $upcoming_game[$i]['team2']; ?></h4></td>
                                                <td class="goal-team2"><div class="shape-box" style="padding: 0px;line-height: 35px"><?php echo $upcoming_game[$i]['team2score']; ?></div></td>
                                                <td class="right-text action-option">
                                                    <button  class="btn btn-primary btn-sm btn-guess-save">Save</button>
                                                    <button class="btn btn-danger btn-sm btn-guess-cancel">Cancel</button>
                                                    <button href="#" class="btn btn-danger btn-sm btn-guess-edit">Edit</button>
                                                </td>
                                            </tr>
                                        <?php endfor; ?>
                                    </table>
                                    <div class="pagination center-text" id="pagination">
                                        <a href="gamelist.php?limit=<?php echo $lowerlimit - 6; ?>" class="nav-link <?php echo ($_GET['limit'] < 5 || empty($_GET['limit'])) ? "no-link" : ""; ?>"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                        <a href="gamelist.php?limit=<?php echo $lowerlimit + 6; ?>" class="nav-link <?php echo ($total_data <= 5 || $_GET['limit'] > $total_data) ? "no-link" : ""; ?>"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                    </div>
                                    <div class="closable-add" style="width: 480px;margin:0px auto 10px;">
                                        <?php sponsorClose(); ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="form-content" class="hidden">
            <input type="number" value="10" class="inline-goal" required="required" max="100" min="0">
        </div>
        <div class="usermenu-wrapper">
            <?php bottomSessionedMenu("","shape-active", "", "", "", ""); ?>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <?php v_includeFooter(); ?>
        <script>
            window.maxleague = "<?php echo $total_league; ?>";
            window.incrementor = 1;
            window.totalRow = 50;
            window.totalPage = Math.ceil(50 / 6);
            if (window.totalRow <= 6) {
                $(".table-pagination").hide();
            }
            if (window.totalRow > 6) {
                $(".paged").each(function () {
                    var pageid = $(this).data("pageid");
                    if (pageid >= 6) {
                        $(this).hide();
                        if (pageid == 6) {
                            $(this).addClass("legend");
                        }
                    }
                });
            }
            $(".down-arrow").on("click", function () {
                if (window.totalRow > 6 && window.incrementor < window.totalPage) {
                    var i = 0;
                    window.incrementor++;
                    var currentpage = $(this).parent().parent().parent().find(".legend").data("pageid");
                    $(this).parent().parent().parent().find(".paged").hide();
                    for (i = currentpage; i < currentpage + 6; i++) {
                        $("#page_" + i).show();
                        if ((i != currentpage) && (i % 6 == 5) && ($("#page_" + currentpage).nextAll().length > 5)) {
                            $(this).parent().parent().parent().find(".legend").removeClass("legend");
                            $(this).parent().parent().parent().find("#page_" + (i + 1)).addClass("legend");
                        }
                    }
                }
            });
            $(".up-arrow").on("click", function () {
                if (window.totalRow > 6 && window.incrementor > 1) {
                    var i = 0;
                    window.incrementor--;
                    var currentpage = $(this).parent().parent().parent().find(".legend").data("pageid");
                    $(this).parent().parent().parent().find(".paged").hide();
                    console.log("B::" + currentpage);
                    for (i = currentpage - 1; i >= currentpage - 6; i--) {
                        $("#page_" + (i - 6)).show();
                        if ((i != currentpage) && (i % 6 == 0) && ($("#page_" + currentpage).prevAll().length > 6)) {
                            $(this).parent().parent().parent().find(".legend").removeClass("legend");
                            $(this).parent().parent().parent().find("#page_" + (i)).addClass("legend");
                        }
                    }
                }
            });
        </script>
    </body>
</html>

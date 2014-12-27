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
                                        <?php for ($i = 0; $i < count($upcoming_game); $i++): ?>
                                            <div class="table-row paged1 guess" id="<?php echo "page1_".$upcoming_game[$i]['id']; ?>" data-gameid="<?php echo $upcoming_game[$i]['id']; ?>" data-team1="<?php echo $upcoming_game[$i]['team1']; ?>" data-team2="<?php echo $upcoming_game[$i]['team2']; ?>">
                                                <div class="col-4 col-text-title-black">
                                                    <div class="box box11"><?php echo $upcoming_game[$i]['teamonegoal']; ?></div>
                                                </div>
                                                <div class="col-9 col-text-black col-55"><?php echo $upcoming_game[$i]['team1'] . " Vs " . $upcoming_game[$i]['team2']; ?></div>
                                                <div class="col-4 col-text-title-black">
                                                    <div class="box box22"><?php echo $upcoming_game[$i]['teamtwogoal']; ?></div>
                                                </div>
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
                    </div>
                </div>
            </div>
        </div>

        <div id="form-content" class="hidden">
            <input type="number" value="10" class="inline-goal" required="required" max="100" min="0">
        </div>
        <div class="usermenu-wrapper">
            <?php bottomSessionedMenu("", "shape-active", "", "", "", ""); ?>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <div class="modal fade" id="myguessmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        <div class="hidden" id="insertaction">
            <div id="containermyguess">
                <div class="alert-custom"></div>
                <form id="myguessform" name="guessform">
                    <div class="form-group">
                        <label for="team1" class="gteam1"></label>
                        <input type="number" class="form-control" id="team1score" name="team1score" min="0" max="99" required="required">
                    </div>
                    <div class="form-group">
                        <label for="team2" class="gteam2"></label>
                        <input type="number" class="form-control" id="team2score" name="team2score" min="0" max="99" required="required">
                    </div>
                    <input type="hidden" id="guessgameid" name="gameid">
                    <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
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
        </script>
    </body>
</html>


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
        <script type="text/javascript">var addthis_config = {"data_track_addressbar": true};</script> 
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5212813c65cd38bc&async=1&domready=1"></script> 
        <script>
            function initAddThis()
            {
                addthis.init()
            }
            initAddThis();
        </script>
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
                                            <div class="col-6" id="backtoleaderboard"><i class="glyphicon glyphicon-chevron-left"></i> Back</div>
                                            <div class="col-154 col-text-title-black black">My History</div>
                                            <div class="col-144 col-text-title-black" style="position: relative;">
                                                <a href="javascript:void(0);" class="btn-share">Share</a>
                                                <div id="share">
                                                    <div class="socialshare st_sharethis_large">
                                                        <div  class="addthis_toolbox addthis_default_style" addthis:title="Mr. Goalz User History" addthis:description="Mr. Goalz User history, Points, Ranks, Top Ranking." addthis:url="<?php echo BASE_URL ?>myhistory.php"> 
                                                            <a class="addthis_button_google_plusone_share" href="<?php echo BASE_URL ?>myhistory.php"></a>
                                                            <a class="addthis_button_facebook" href="<?php echo BASE_URL ?>myhistory.php"></a>
                                                        </div>   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="table-title">
                                        <div class="table-row-heading">
                                            <div class="col-155 col-text-title-black condenced">Previous Guess</div>
                                            <div class="col-156 col-text-title-black condenced">Actual Score = Points</div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="table-content">
                                        <?php
                                        $week_total=0;
                                        for ($i = 0; $i < count($history2['data']); $i++):
                                            ?>
                                            <div class="table-row paged" id="<?php echo 'page_' . $i; ?>" data-pageid="<?php echo $i; ?>">
                                                <div class="col-155 col-text-title-black his-wrapper">
                                                    <div class="sub-col-155 his">
                                                        <div class="team "><?php echo $history2['data'][$i]['team1name']; ?></div>
                                                        <div class="gola"><?php echo $history2['data'][$i]['team1score']; ?></div>
                                                    </div>
                                                    <div class="sub-col-156 vs">VS</div>
                                                    <div class="sub-col-155 his">
                                                        <div class="team"><?php echo $history2['data'][$i]['team2name']; ?></div>
                                                        <div class="gola"><?php echo $history2['data'][$i]['team2score']; ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-157 col-text-title-black" style="text-align: center"><?php echo $history2['data'][$i]['team1realscore'] . "-" . $history2['data'][$i]['team2realscore'] . "=" . $history2['data'][$i]['totalpoints']; ?></div> 
                                                <div class="clearfix"></div>
                                            </div>
                                        <?php 
                                        $week_total=$week_total+$history2['data'][$i]['totalpoints'];
                                        endfor; ?>
                                    </div>
                                    <div class="update-button bonus-button condenced">
                                        <?php if($week_total >= 1):?>
                                         Week Score <?php echo $week_total; ?><?php echo $bonus==1?"":$bonus."X2(Bonus)";?> = <?php echo $week_total*$bonus;?>
                                        <?php else:?>
                                         Week Score 0
                                        <?php endif;?>
                                       
                                    </div>
                                    <div class="table-footer">

                                        <?php if ($totalhistory > 6): ?>
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
            <?php bottomSessionedMenu("shape-active", "", "", "", "", ""); ?>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
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
            var maxLength1 = "<?php echo $totalhistory; ?>";
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
            $(".btn-share").on("click", function () {
                $("#share").toggle();
            });
            $("#backtoleaderboard").on("click", function () {
                window.location.href = "leader-board.php";
            });
        </script>
    </body>
</html>


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
                                        <div class="col-text-title-black">Mail & Invitations</div>
                                    </div>
                                </div>
                                <div class="table-content">

                                    <?php for ($i = 0; $i < count($boxsmsall); $i++): ?>
                                        <div class="table-row paged1" id="<?php echo 'page1_' . $i; ?>" data-pageid1="<?php echo $i; ?>">
                                            <div class="col-4 col-text-title-black">
                                                <div class="box <?php echo $boxsmsall[$i]['status']; ?>"><?php echo $i + 1; ?></div>
                                            </div>
                                            <div class="col-9 mail-title" style="width: 75%;"><a href="maildetails.php?mailid=<?php echo $boxsmsall[$i]['message_id']; ?>"><?php echo $boxsmsall[$i]['message_title'] . "..."; ?></a></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="table-footer">
                                    <?php if (count($boxsmsall) > 6): ?>
                                        <div class="table-pagination2">
                                            <a href="javascript:void(0)" class="up-arrow1 pagination-icon" id="uparrow1"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                            <a href="javascript:void(0)" class="down-arrow1 pagination-icon" id="downarrow1"><i class="glyphicon glyphicon-chevron-down"></i></a>
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
        <div class="usermenu-wrapper">
            <?php bottomSessionedMenu(); ?>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <?php v_includeFooter(); ?>
        <script>
            $("#league-table").show();
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
            var maxLength1 = "<?php echo count($boxsmsall); ?>";
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


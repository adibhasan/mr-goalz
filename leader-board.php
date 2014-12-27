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
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">

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
                    <?php if (isset($_GET['key']) && isset($_GET['action']) && isset($_GET['groupid'])): ?>
                        <div class="wrapp-container" id="league-table2">
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
                                            <?php for ($i = 0; $i < count($fscore); $i++): ?>
                                                <div class="table-row paged2" id="<?php echo 'page2_' . $i; ?>" data-pageid2="<?php echo $i; ?>">
                                                    <div class="col-7">
                                                        <div class="shape-circle2"><?php echo $i + 1; ?></div>
                                                    </div>
                                                    <div class="col-99 col-text-black"><?php echo $fscore[$i]['username']; ?></div>
                                                    <div class="col-44 col-text-title-black">
                                                        <div class="box"><?php echo $fscore[$i]['rank']; ?></div>
                                                    </div>
                                                    <div class="col-44 col-text-title-black">
                                                        <div class="box box1"><?php echo $fscore[$i]['withbonus']; ?></div>
                                                    </div>
                                                    <div class="col-44 col-text-title-black">
                                                        <div class="box box"><?php echo "+" . ($fscore[$i]['withbonus'] - $fscore[$i]['withoutbonus']); ?></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="table-footer">
                                            <?php if (count($fscore) > 6): ?>
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
                        </div>
                    <?php else: ?>
                        <div class="wrapp-container" id="leader-list">
                            <div class="main-content">
                                <div class="my-guess" id="my-guess">
                                    <div class="table-wrapper">
                                        <div class="table-title">
                                            <div class="table-row-heading">
                                                <div class="col-15 col-text-title-black condenced">Leader Board</div>
                                                <div class="col-14 col-text-title-black withlist">
                                                    <div class="list" id="create-league-call" style="background-position: 0px;">&nbsp;</div>
                                                </div>
                                                <div class="col-14 col-text-title-black rank condenced">Rank</div>
                                                <div class="col-14 col-text-title-black score condenced">Score</div>
                                                <div class="col-14 col-text-title-black plus-minus condenced"> &nbsp;+/-</div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="table-content">
                                            <?php for ($i = 0; $i < count($leaderlist); $i++): ?>
                                                <div class="table-row paged1 history" id="<?php echo 'page_' . $i; ?>" data-pageid="<?php echo $i; ?>">
                                                    <div class="col-7">
                                                        <div class="shape-circle2"><?php echo $i + 1; ?></div>
                                                    </div>
                                                    <div class="col-99 col-text-black"><?php echo $leaderlist[$i]['username']; ?></div>
                                                    <div class="col-44 col-text-title-black">
                                                        <div class="box"><?php echo $leaderlist[$i]['rank']; ?></div>
                                                    </div>
                                                    <div class="col-44 col-text-title-black">
                                                        <div class="box"><?php echo $leaderlist[$i]['withbonus']; ?></div>
                                                    </div>
                                                    <div class="col-44 col-text-title-black">
                                                        <div class="box"><?php echo "+" . ($leaderlist[$i]['withbonus'] - $leaderlist[$i]['withoutbonus']); ?></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="table-footer">
                                            <?php if ($totalleader > 6): ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="usermenu-wrapper">
    <?php
    if (isset($_GET['action'])) {
        bottomSessionedMenu("", "", "", "shape-active", "", "");
    } else {
        bottomSessionedMenu("", "", "shape-active", "", "", "");
    }
    ?>
</div>
<div class="content-wrapper">
    <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
</div>
<div id="fnf-form" class="hidden">
    <div>Add to circle</div>
    <div class="data-action" data-action=""></div>
</div>
<div class="modal fade" id="invite-league-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Invite User</h4>
            </div>
            <div class="modal-body">
                <div>
                    <table id="example" class="display condenced" cellspacing="0" width="100%" style="font-size: 1em">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>

                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Airi Satou</td>
                                <td>Accountant</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Brielle Williamson</td>
                                <td>Integration Specialist</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Herrod Chandler</td>
                                <td>Sales Assistant</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Rhona Davidson</td>
                                <td>Integration Specialist</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Colleen Hurst</td>
                                <td>Javascript Developer</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Sonya Frost</td>
                                <td>Software Engineer</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Jena Gaines</td>
                                <td>Office Manager</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Quinn Flynn</td>
                                <td>Support Lead</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Charde Marshall</td>
                                <td>Regional Director</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Haley Kennedy</td>
                                <td>Senior Marketing Designer</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Tatyana Fitzpatrick</td>
                                <td>Regional Director</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Michael Silva</td>
                                <td>Marketing Designer</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Paul Byrd</td>
                                <td>Chief Financial Officer (CFO)</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Gloria Little</td>
                                <td>Systems Administrator</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Bradley Greer</td>
                                <td>Software Engineer</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Dai Rios</td>
                                <td>Personnel Lead</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Jenette Caldwell</td>
                                <td>Development Lead</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Yuri Berry</td>
                                <td>Chief Marketing Officer (CMO)</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Caesar Vance</td>
                                <td>Pre-Sales Support</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Doris Wilder</td>
                                <td>Sales Assistant</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Angelica Ramos</td>
                                <td>Chief Executive Officer (CEO)</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Gavin Joyce</td>
                                <td>Developer</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Jennifer Chang</td>
                                <td>Regional Director</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Brenden Wagner</td>
                                <td>Software Engineer</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Fiona Green</td>
                                <td>Chief Operating Officer (COO)</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Shou Itou</td>
                                <td>Regional Marketing</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Michelle House</td>
                                <td>Integration Specialist</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Suki Burks</td>
                                <td>Developer</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td>Prescott Bartlett</td>
                                <td>Technical Author</td>
                                <td><input type="checkbox"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send Invitation</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="enrolled-league"tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">My Group</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive datatable">
                    <table class="table table-bordered table-hover" id="leaguelist">
                        <thead>
                            <tr style="background: bisque;">
                                <th>Si</th>
                                <th>Group Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($allprivateleague['data']); $i++): ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td><?php echo $allprivateleague['data'][$i]['groupname']; ?></td>
                                    <td><?php echo '<a href="leader-board.php?key=leaderboard&action=chooseleague&groupid=' . $allprivateleague['data'][$i]['groupid'] . '" class="btn btn-primary btn-sm">League Details</a>'; ?></td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="invite-user"tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">My Group</h4>
            </div>
            <div id="containerjoin">
                <div class="alert-custom"></div>
                <form id="invitationform" name="invitationform" role="form">
                    <div class="modal-body">
                        <div class="my-p-league">
                            <select class="form-control" required="required" name="groupid">
                                <option value="">Select League</option>
                                <?php for ($i = 0; $i < count($allmyleague['data']); $i++): ?>
                                    <option value="<?php echo $allmyleague['data'][$i]['groupid']; ?>"><?php echo $allmyleague['data'][$i]['groupname']; ?></option>
                                <?php endfor; ?>

                            </select>
                        </div>
                        <br>
                        <div class="table-responsive datatable">
                            <table class="table table-bordered table-hover" id="inviteuserlist">
                                <thead>
                                    <tr style="background: bisque;">
                                        <th>Si</th>
                                        <th>User</th>
                                        <th>Point</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($inviteleaderlist); $i++): ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $inviteleaderlist[$i]['username']; ?></td>
                                            <td><?php echo $inviteleaderlist[$i]['withbonus']; ?></td>
                                            <td>
                                                <input type="checkbox" name="userid[]" value="<?php echo $inviteleaderlist[$i]['userid']; ?>">
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <br>
                            <input type="submit" class="btn btn-primary btn-block" value="Invite">
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade bs-example-modal-sm" id="create-league-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content create-league">
            <div id="create-private-league">
                <button class="btn btn-prmiry btn-block thin private" data-pageredirect="createleague.php">Create League</button>
            </div>
            <br>
            <div id="choose-private-league">
                <button class="btn btn-info btn-block thin private" data-pageredirect="leader-board.php?key=leaderboard&action=chooseleague">Choose League</button>
            </div>
            <br>
            <div id="exit-private-league">
                <button class="btn btn-danger btn-block thin private" data-pageredirect="leader-board.php?key=leaderboard&action=exitleague">Exit League</button>
            </div>
            <br>
            <div id="invite-private-league">
                <button class="btn btn-warning btn-block thin private" data-pageredirect="leader-board.php?key=leaderboard&action=inviteuser">Invite User</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="league-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content condenced">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Enter New League Name</h4>
            </div>
            <div class="modal-body" id="logincontainer">
                <div id="league-insert" class="game">
                    <div class="alert-custom messaage"></div>
                    <form id="leagueinput" name="league-input" role="form">
                        <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                        <div class="input-box ftitle">
                            <input type="text" class="textinput center-text black" name="league_name" required="required" maxlength="100" placeholder="League name">
                            <div class="error-message"></div>
                        </div>
                        <div class="input-box ftitle">
                            <textarea required="required" maxlength="200" style="width: 100%;resize: none" placeholder="Short description" name="description"></textarea>
                            <div class="error-message"></div>
                        </div>
                        <br>
                        <div>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
    var maxLength1 = "<?php echo $totalleader; ?>";
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


    //Start pagination, page 2
    var currentPage2 = 1;
    var pageSize2 = 6;
    var minPage2 = 1;
    var maxLength2 = "<?php echo count($fscore); ?>";
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
    $("#leader-table-list").on("click", function () {
        $("#leader-list").hide("slide", function () {
            $("#league-table2").show("slide");
        });

    });
    $("#leader-table-list2").on("click", function () {
        $("#league-table2").hide("slide", 500, function () {
            $("#leader-list").show("slide");
        });
    });
    $(".history").on("click", function () {
        window.location.href = "myhistory.php"
    });
    $("#create-league-call").on("click", function () {
        $("#create-league-modal").modal("show");
    });
    $(".invite-league").on("click", function () {
        $("#invite-league-modal").modal("show");
    });
    $("#go-to-leader").on("click", function () {
        window.location.href = "leader-board.php";
    });
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>
</body>
</html>


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
                    <?php if (isset($_GET['key']) && isset($_GET['action'])): ?>
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
                                            <?php for ($i = 0; $i < 50; $i++): ?>
                                                <div class="table-row paged2" id="<?php echo 'page2_' . $i; ?>" data-pageid2="<?php echo $i; ?>">
                                                    <div class="col-7">
                                                        <div class="shape-circle2"><?php echo $i + 1; ?></div>
                                                    </div>
                                                    <?php if (isset($_GET['action']) && $_GET['action'] == "exitleague"): ?>
                                                        <div class="col-99 col-text-black" style="position: relative">West Born Vs Sunder Land <?php echo $i; ?> <button class="btn btn-danger btn-sm exit-league" data-exit="<?php echo $i; ?>">Exit</button></div>
                                                    <?php elseif (isset($_GET['action']) && $_GET['action'] == "inviteuser"): ?>
                                                        <div class="col-99 col-text-black" style="position: relative">West Born Vs Sunder Land <?php echo $i; ?> <button class="btn btn-info btn-sm invite-league" data-invite="<?php echo $i; ?>">Invite</button></div>
                                                    <?php else: ?>
                                                        <div class="col-99 col-text-black">West Born Vs Sunder Land <?php echo $i; ?></div>
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
            <div  id="upcominggames" class="formcontainer hidden" style="margin-top: 0px;">
                <div class="table-responsive">
                    <div id="leader-list-wrapper">
                        <table class="table" id="leader-list">
                            <tr>
                                <th>
                            <div class="pull-left heading4">Leader Board </div>

                            </th>
                            <th><div class="pull-right list-number">
                                <a class="list-with-number" href="javascript:return false;" id="history-table-action">
                                    <span>1</span>
                                    <span>2</span>
                                    <span>3</span>
                                </a>
                            </div></th>
                            <th><h3 class="table-heading right-text">Rank</h3></th>
                            <th><h3 class="table-heading right-text">Score</h3></th>
                            <th><h3 class="table-heading right-text">+/-</h3></th>
                            </tr>
                            <?php for ($i = 0; $i < count($final_leader); $i++): ?>
                                <tr class="add-friend" title="Click to add">
                                    <td>
                                        <span class="<?php echo "shape-circle "; ?>">
                                            <?php echo $i + 1; ?>
                                        </span>
                                        <h4>
                                            <?php echo $final_leader[$i]['username']; ?>
                                        </h4>
                                    </td>
                                    <td style="text-align:right;">
                                        <div style="margin-top: 10px;">
                                            <?php
//                                                if ($final_leader[$i]['fnfstatus'] == "circle-blocked") {
//                                                    echo '<a class="btn btn-danger btn-xs">Blocked</a>';
//                                                } else if ($final_leader[$i]['fnfstatus'] == "circle-pending") {
//                                                    echo '<a class="btn btn-warning btn-xs">Pending</a>';
//                                                } else if ($final_leader[$i]['fnfstatus'] == "circle-active") {
//                                                    echo '<a class="btn btn-primary btn-xs">Alies</a>';
//                                                } else if ($final_leader[$i]['fnfstatus'] == "add-circle") {
//                                                    echo '<a  class="btn btn-default btn-xs add-to-circle" id="user_' . $final_leader[$i]['userid'] . '" data-userid="' . $final_leader[$i]['userid'] . '">Add</a>';
//                                                }
                                            ?>
                                        </div>
                                    </td> 
                                    <td class="right-text">
                                        <div class="shape-box"><?php echo $final_leader[$i]['rank']; ?></div>
                                    </td> 
                                    <td class="right-text">
                                        <div class="shape-box"><?php echo $final_leader[$i]['userpoint']; ?></div>
                                    </td>
                                    <td class="right-text">
                                        <div class="shape-box"><?php echo "+" . $final_leader[$i]['point3']; ?></div>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </table>
                        <div class="pagination center-text" id="pagination" style="bottom:30px;">
                            <a href="gamelist.php?limit=<?php echo $lowerlimit - 6; ?>" class="nav-link <?php echo ($_GET['limit'] < 5 || empty($_GET['limit'])) ? "no-link" : ""; ?>"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a href="gamelist.php?limit=<?php echo $lowerlimit + 6; ?>" class="nav-link <?php echo ($total_data <= 5 || $_GET['limit'] > $total_data) ? "no-link" : ""; ?>"><i class="glyphicon glyphicon-chevron-down"></i></a>
                        </div>
                        <div class="closable-add" style="width: 480px;margin:0px auto 10px;bottom: 0px;">
                            <?php sponsorClose(); ?>
                        </div>
                    </div>
                    <div id="my-history">
                        <div class="box-heading">
                            <div class="col-md-4 heading4" style="padding: 0px"><a href="javascript:return false;" id="back-to-leader"><i class="glyphicon glyphicon-chevron-left"></i> Back</a></div>
                            <div class="heading4 col-md-4 center-text">My History</div>
                            <div class="heading4 col-md-4 right-text"><a href="javascript:return false;">Share</a></div>
                            <div class="clearfix"></div>
                        </div>
                        <div>
                            <table class="table" >
                                <tr>
                                    <th colspan="3"><h3 class="table-heading">Previous Guess</h3></th>
                                <th colspan="1"><h3 class="table-heading right-text">Score=Points</h3></th>
                                </tr>
                                <?php for ($i = 0; $i < count($my_history); $i++): ?>
                                    <tr>
                                        <td>
                                            <div class="shape-box" style="float: left"><?php echo $my_history["data"][$i]['team1score']; ?></div>
                                        </td>
                                        <td><h4 class="center-text"><?php echo $my_history["data"][$i]['team1Name'] . " VS " . $my_history["data"][$i]['team2Name']; ?></h4></td>
                                        <td class="right-text">
                                            <div class="shape-box"><?php echo $my_history["data"][$i]['team2score']; ?></div>
                                        </td> 

                                        <td class="right-text">
                                            <h4><?php echo $my_history["data"][$i]['team1Goal'] . "-" . $my_history["data"][$i]['team2Goal'] . "=" . $my_history['data'][$i]['totalpoint'] . " Point(s)"; ?></h4>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                                <tr>
                                    <td colspan="4" style="text-align: center">
                                        <div class="weak-score"><h2 style="margin: 0px;color:#115DFF">Week Score 14x0.5(Bonus)=28</h2></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: center">
                                        <a href="" class="nav-link"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                        <a href="" class="nav-link"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="pagination center-text" id="pagination" style="bottom:30px;">
                            <a href="gamelist.php?limit=<?php echo $lowerlimit - 6; ?>" class="nav-link <?php echo ($_GET['limit'] < 5 || empty($_GET['limit'])) ? "no-link" : ""; ?>"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a href="gamelist.php?limit=<?php echo $lowerlimit + 6; ?>" class="nav-link <?php echo ($total_data <= 5 || $_GET['limit'] > $total_data) ? "no-link" : ""; ?>"><i class="glyphicon glyphicon-chevron-down"></i></a>
                        </div>
                        <div class="closable-add" style="width: 480px;margin:0px auto 10px;bottom: 0px;">
                            <?php sponsorClose(); ?>
                        </div>
                    </div>

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
        console.log("V::" + window.incrementor2);
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
    $(".private").on("click", function () {
        var url = $(this).data("pageredirect");
        window.location.href = url;
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


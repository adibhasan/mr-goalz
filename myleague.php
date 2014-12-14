<?php include 'Generic.php'; ?>
<?php include 'controller/MyLeague.php'; ?>
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
                    <div  id="upcominggames" class="formcontainer" style="margin-top: 0px;">
                        <div class="table-responsive">
                            <table class="table" id="leader-list">
                                <tr>
                                    <th colspan="2"> <div class="pull-left heading4">My League </div></th>
                                <th><h3 class="table-heading right-text">Rank</h3></th>
                                <th><h3 class="table-heading right-text">Score</h3></th>
                                <th><h3 class="table-heading right-text">+/-</h3></th>
                                </tr>
                                <?php
                                $counter = 0;
                                ?>
                                <?php for ($i = 0; $i < count($final_leader); $i++): ?>
                                    <?php if (($final_leader[$i]['fnfstatus'] == "circle-active") || ($final_leader[$i]['fnfstatus'] == "own-circle")): ?>
                                        <?php $counter++; ?>
                                        <tr class="add-friend">
                                            <td>
                                                <span class="<?php echo "shape-circle "; ?>">
                                                    <?php echo $counter; ?>
                                                </span>
                                                <h4>
                                                    <?php echo $final_leader[$i]['username']; ?>
                                                </h4>
                                            </td>
                                            <td style="text-align:right;">
                                                <div style="margin-top: 10px;">
                                                    <?php
                                                    if ($final_leader[$i]['fnfstatus'] == "circle-active") {
                                                        echo '<a class="btn btn-primary btn-xs delete_fnf" id="user_' . $final_leader[$i]['userid'] . '" data-userid="' . $final_leader[$i]['userid'] . '">Delete</a>';
                                                    }
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
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </table>
                        </div>

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
        <div class="usermenu-wrapper">
            <?php bottomSessionedMenu(); ?>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <div id="fnf-form" class="hidden">
            <div>Add to circle</div>
            <div class="data-action" data-action=""></div>
        </div>
        <?php v_includeFooter(); ?>
    </body>
</html>


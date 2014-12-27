<?php preventDirectAccess("bonus.php"); ?>
<div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
<div class="container-wrapper">
    <div class="menucontainer">
        <?php include 'menus.php'; ?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <?php if (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "all-bonus"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-list"></i> All Declared Bonus List</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <div  id="alluser">
                        <div class="table-responsive datatable">
                            <table class="table  table-hover" id="userlist">
                                <thead>
                                    <tr style="background: aliceblue;">
                                        <th>Si</th>
                                        <th>Bonus Type</th>
                                        <th>Description</th>
                                        <th>Bonus Month</th>
                                        <th>Bonus Year</th>
                                        <th>Create Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($allbonus['data']); $i++): ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo ucfirst($allbonus['data'][$i]['bonus_type']); ?></td>
                                            <td><?php echo $allbonus['data'][$i]['description']; ?></td>
                                            <td><?php echo $allbonus['data'][$i]['bonus_month']; ?></td>
                                            <td><?php echo $allbonus['data'][$i]['bonus_year']; ?></td>
                                            <td><?php echo $allbonus['data'][$i]['create_date']; ?></td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "month-bonus"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-list"></i> Month Bonus</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <div  id="alluser">
                        <div class="table-responsive datatable">
                            <?php if($monthbonus_status==true):?>
                            <h1>Monthly bonus for this month has been already added.</h1>
                            <?php else:?>
                            <div style="text-align: center">
                                <br><br><br><br><br>
                                <div class="res"><button class="btn btn-info" id="add-month-bonus">Add Bonus For This Month</button></div>
                                <br><br><br><br><br>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "performance-bonus"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-list"></i> Month Bonus</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <div  id="alluser">
                        <div class="table-responsive datatable">
                            <?php if($performance_status==true):?>
                            <h1>Performance bonus for this month has been already added.</h1>
                            <?php else:?>
                            <div style="text-align: center">
                                <br><br><br><br><br>
                                <div class="res"><button class="btn btn-info" id="add-perform-bonus">Add Performance Bonus For This Month</button></div>
                                <br><br><br><br><br>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "other-bonus"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-list"></i> Team List</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <div  id="alluser">
                        <div class="table-responsive datatable">
                            <table class="table  table-hover" id="userlist">
                                <thead>
                                    <tr style="background: aliceblue;">
                                        <th>Si</th>
                                        <th>Teamname</th>
                                        <th>Description</th>
                                        <th>Creator</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($teaminfo['data']); $i++): ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $teaminfo['data'][$i]['teamname']; ?></td>
                                            <td><?php echo $teaminfo['data'][$i]['description']; ?></td>
                                            <td><?php echo $teaminfo['data'][$i]['user_type']; ?></td>
                                            <td><?php echo $teaminfo['data'][$i]['status']; ?></td>
                                            <td>
                                                <button class="btn btn-danger deleteteam" style="margin:1px;padding: 0px 2px;" data-id="<?php echo $teaminfo['data'][$i]['teamid']; ?>"><i class="glyphicon glyphicon-trash"></i></button>
                                                <a href="<?php echo BASE_URL; ?>admin/admin.php?adminroute=team&action=edit-team&teamid=<?php echo $teaminfo['data'][$i]['teamid']; ?>"><button class="btn btn-info edit" style="margin:1px;padding: 0px 2px;"><i class="glyphicon glyphicon-edit"></i></button></a>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "user-score-list"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-list"></i> Team List</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <div  id="alluser">
                        <div class="table-responsive datatable">
                            <table class="table  table-hover" id="userlist">
                                <thead>
                                    <tr style="background: aliceblue;">
                                        <th>Si</th>
                                        <th>Teamname</th>
                                        <th>Description</th>
                                        <th>Creator</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($teaminfo['data']); $i++): ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $teaminfo['data'][$i]['teamname']; ?></td>
                                            <td><?php echo $teaminfo['data'][$i]['description']; ?></td>
                                            <td><?php echo $teaminfo['data'][$i]['user_type']; ?></td>
                                            <td><?php echo $teaminfo['data'][$i]['status']; ?></td>
                                            <td>
                                                <button class="btn btn-danger deleteteam" style="margin:1px;padding: 0px 2px;" data-id="<?php echo $teaminfo['data'][$i]['teamid']; ?>"><i class="glyphicon glyphicon-trash"></i></button>
                                                <a href="<?php echo BASE_URL; ?>admin/admin.php?adminroute=team&action=edit-team&teamid=<?php echo $teaminfo['data'][$i]['teamid']; ?>"><button class="btn btn-info edit" style="margin:1px;padding: 0px 2px;"><i class="glyphicon glyphicon-edit"></i></button></a>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        <?php else: ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-list"></i> Football at a Glance</strong></div>
                <div class="panel-body" style="text-align: center;">
                    <div data-type="timetable" data-id="60356" id="wgt-60356" class="tap-sport-tools" style="width:900px; height:auto;"></div>
                    <div id="wgt-ft-60356" style="width:896px;"><p>Widget powered by <a target="_blank" rel="nofollow" href="http://www.whatsthescore.com">WhatstheScore.com</a></p></div><style type="text/css">#wgt-ft-60356  {background:#FFFFFF !important;color:#484848 !important;text-decoration:none !important;padding:4px 2px !important;margin:0 !important;}#wgt-ft-60356 * {font:10px Arial !important;}#wgt-ft-60356 a {color:#484848 !important;}#wgt-ft-60356 img {vertical-align:bottom !important;height:15px !important;}</style><script type="text/javascript" src="http://tools.whatsthescore.com/load.min.js?241"></script>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>
<?php

function preventDirectAccess($filename = "") {
    $requesturl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if (false !== strpos($requesturl, $filename)) {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }
}
?>
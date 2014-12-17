<?php preventDirectAccess("team.php"); ?>
<div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
<div class="container-wrapper">
    <div class="menucontainer">
        <?php include 'menus.php'; ?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <?php if (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "create-team"): ?>
        
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-flag"></i> Add Team</strong></div>
                <div class="panel-body">

                    <div class="tab-pane" id="addnewteam">
                        <div class="formcontainer">
                            <div class="alert-custom"></div>
                            <form id="addteam" name="addteam" class="form-horizontal" autocomplete="off" action="<?php echo BASE_URL . "admin/controller/Account.php" ?>">
                                <input type="hidden" name="method" value="addteam">
                                <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-compressed"></i></span>
                                        <input type="text" class="form-control" name="teamname" placeholder="Team name">
                                    </div>
                                </div>

                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <textarea name="description" class="form-control" rows="3" maxlength="1000" placeholder="Insert team short description(max 200 characters)"></textarea>
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                        <select class="form-control" name="status">
                                            <option value="" selected="">Status</option>
                                            <option value="active">Active</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group marginvertical">
                                    <button type="submit" class="btn btn-info btn-block">Save Team Info</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "edit-team"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-flag"></i> Add Team</strong></div>
                <div class="panel-body">

                    <div class="tab-pane" id="addnewteam">
                        <div class="formcontainer">
                            <div class="alert-custom"></div>
                            <form id="updateteam" name="updateteam" class="form-horizontal" autocomplete="off" action="<?php echo BASE_URL . "admin/controller/Account.php" ?>">
                                <input type="hidden" name="method" value="updateteam">
                                <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                <input type="hidden" name="teamid" value="<?php echo $uniqueinfo['data'][0]['teamid']; ?>">
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-compressed"></i></span>
                                        <input type="text" class="form-control" name="teamname" placeholder="Team name" value="<?php echo $uniqueinfo['data'][0]['teamname']; ?>">
                                    </div>
                                </div>

                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <textarea name="description" class="form-control" rows="3" maxlength="1000" placeholder="Insert team short description(max 1000 characters)"><?php echo $uniqueinfo['data'][0]['description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <textarea name="playtype" class="form-control" rows="3" maxlength="1000" placeholder="Insert play type seperated by # e.g. Football#Cricket#Baseball"><?php echo $uniqueinfo['data'][0]['playtype']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                        <select class="form-control" name="status">
                                            <option value="<?php echo $uniqueinfo['data'][0]['status']; ?>" selected="selected"><?php echo ucfirst($uniqueinfo['data'][0]['status']); ?></option>
                                            <option value="active">Active</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group marginvertical">
                                    <button type="submit" class="btn btn-info btn-block">Save Team Info</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "show-team-list"): ?>
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
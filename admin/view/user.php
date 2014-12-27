<?php preventDirectAccess("user.php"); ?>
<div class="container-wrapper">
    <div class="menucontainer">
        <?php include 'menus.php'; ?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <?php if (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "edit-general-user"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-user"></i> User Info</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <div id="alluser">
                        <div class="details-block">
                            <div class="col-md-12"><img src="<?php echo $uniqueuser['data'][0]['profile_picture']; ?>"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="details-block">
                            <div class="col-md-2"><strong>User ID</strong></div>
                            <div class="col-md-10"><?php echo $uniqueuser['data'][0]['user_id_name']; ?></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="details-block">
                            <div class="col-md-2"><strong>User Email</strong></div>
                            <div class="col-md-10"><?php echo $uniqueuser['data'][0]['user_email']; ?></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="details-block">
                            <div class="col-md-2"><strong>User Name</strong></div>
                            <div class="col-md-10"><?php echo $uniqueuser['data'][0]['user_name']; ?></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="details-block">
                            <div class="col-md-2"><strong>User Birth Year</strong></div>
                            <div class="col-md-10"><?php echo $uniqueuser['data'][0]['birth_year']; ?></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="details-block">
                            <div class="col-md-2"><strong>Recovery Number</strong></div>
                            <div class="col-md-10"><?php echo $uniqueuser['data'][0]['recovery_number']; ?></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="details-block">
                            <div class="col-md-2"><strong>Gender</strong></div>
                            <div class="col-md-10"><?php echo $uniqueuser['data'][0]['gender']; ?></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="details-block">
                            <div class="col-md-2"><strong>Nationality</strong></div>
                            <div class="col-md-10"><?php echo $uniqueuser['data'][0]['nationality']; ?></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="details-block">
                            <div class="col-md-2"><strong>Game Notification</strong></div>
                            <div class="col-md-10"><?php echo $uniqueuser['data'][0]['game_notification'] == 0 ? "OFF" : "ON"; ?></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="details-block">
                            <div class="col-md-2"><strong>User IP</strong></div>
                            <div class="col-md-10"><?php echo $uniqueuser['data'][0]['user_ip'] == "" ? "Not detected" : $uniqueuser['data'][0]['user_ip']; ?></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="details-block">
                            <div class="col-md-2"><strong>Create Date</strong></div>
                            <div class="col-md-10"><?php echo $uniqueuser['data'][0]['create_date']; ?></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="details-block">
                            <div class="col-md-2"><strong>Last Update</strong></div>
                            <div class="col-md-10"><?php echo $uniqueuser['data'][0]['update_date']; ?></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="details-block">
                            <div class="col-md-2"><strong>Status</strong></div>
                            <div class="col-md-10">
                                <select class="form-control" name="status" id="commonuserstatus" data-id="<?php echo ucfirst($uniqueuser['data'][0]['userid']); ?>">
                                    <option value="<?php echo $uniqueuser['data'][0]['status']; ?>" selected="selected"><?php echo ucfirst($uniqueuser['data'][0]['status']); ?></option>
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="blocked">Blocked</option>
                                    <option value="deleted">Deleted</option>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "user-rank"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-user"></i> User Rank</strong></div>
                <div class="panel-body">
                    <div id="alluser">
                        <div class="table-responsive datatable">
                            <table class="table table-bordered table-hover" id="userlist">
                                <thead>
                                    <tr style="background: bisque;">
                                        <th>Si</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number of Games</th>
                                        <th>Without Bonus</th>
                                        <th>With Bonus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($alluserRank); $i++): ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $alluserRank[$i]['useridname']; ?></td>
                                            <td><?php echo $alluserRank[$i]['username']; ?></td>
                                            <td><?php echo $alluserRank[$i]['useremail']; ?></td>
                                            <td><?php echo $alluserRank[$i]['numberofgame']; ?></td>
                                            <td><?php echo $alluserRank[$i]['withoutbonus']; ?></td>
                                            <td><?php echo $alluserRank[$i]['withbonus']; ?></td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "send-notification"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-user"></i> Send Notification</strong></div>
                <div class="panel-body">
                    <div id="alluser">
                        <div class="table-responsive datatable">
                            <table class="table table-bordered table-hover" id="userlist">
                                <thead>
                                    <tr style="background: bisque;">
                                        <th>Si</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Favourite Team</th>
                                        <th>Nationality</th>
                                        <th>Signup type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($userinfo['data']); $i++): ?>
                                        <?php
                                        $teamid = $userinfo['data'][$i]['favourite_team'];
                                        $team = v_dataSelect("team", "teamid='$teamid'");
                                        ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['user_name']; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['user_email']; ?></td>
                                            <td><?php echo $team['data'][0]['teamname']; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['nationality']; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['login_type']; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['status']; ?></td>
                                            <td>
                                                <button class="btn btn-danger deletegeneraluser" style="margin:1px;padding: 0px 2px;" data-id="<?php echo $userinfo['data'][$i]['userid']; ?>"><i class="glyphicon glyphicon-trash"></i></button>
                                                <a href="<?php echo BASE_URL; ?>admin/admin.php?adminroute=user&action=edit-general-user&userid=<?php echo $userinfo['data'][$i]['userid']; ?>"><button class="btn btn-info edit" style="margin:1px;padding: 0px 2px;"><i class="glyphicon glyphicon-edit"></i></button></a>
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
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-user"></i> User Info</strong></div>
                <div class="panel-body">
                    <div id="alluser">
                        <div class="table-responsive datatable">
                            <table class="table table-bordered table-hover" id="userlist">
                                <thead>
                                    <tr style="background: bisque;">
                                        <th>Si</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Favourite Team</th>
                                        <th>Nationality</th>
                                        <th>Signup type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($userinfo['data']); $i++): ?>
                                        <?php
                                        $teamid = $userinfo['data'][$i]['favourite_team'];
                                        $team = v_dataSelect("team", "teamid='$teamid'");
                                        ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['user_name']; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['user_email']; ?></td>
                                            <td><?php echo $team['data'][0]['teamname']; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['nationality']; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['login_type']; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['status']; ?></td>
                                            <td>
                                                <button class="btn btn-danger deletegeneraluser" style="margin:1px;padding: 0px 2px;" data-id="<?php echo $userinfo['data'][$i]['userid']; ?>"><i class="glyphicon glyphicon-trash"></i></button>
                                                <a href="<?php echo BASE_URL; ?>admin/admin.php?adminroute=user&action=edit-general-user&userid=<?php echo $userinfo['data'][$i]['userid']; ?>"><button class="btn btn-info edit" style="margin:1px;padding: 0px 2px;"><i class="glyphicon glyphicon-edit"></i></button></a>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
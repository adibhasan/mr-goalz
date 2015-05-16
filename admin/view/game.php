<?php preventDirectAccess("user.php"); ?>
<div class="container-wrapper">
    <div class="menucontainer">
        <?php include 'menus.php'; ?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <?php if (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "create-league"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-flag"></i> Add League</strong></div>
                <div class="panel-body">

                    <div class="tab-pane" id="addnewteam">
                        <div class="formcontainer">
                            <div class="alert-custom"></div>
                            <form id="addleague" name="addleague" class="form-horizontal" autocomplete="off" action="<?php echo BASE_URL . "admin/controller/Account.php" ?>">
                                <input type="hidden" name="method" value="addleague">
                                <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-compressed"></i></span>
                                        <input type="text" class="form-control" name="league_name" placeholder="League name">
                                    </div>
                                </div>

                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <textarea name="description" class="form-control" rows="3" maxlength="1000" placeholder="Insert team short description(max 1000 characters)"></textarea>
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
                                    <button type="submit" class="btn btn-info btn-block">Save League Info</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "update-league"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-flag"></i> Add Team</strong></div>
                <div class="panel-body">
                    <div class="tab-pane" id="addnewteam">
                        <div class="formcontainer">
                            <div class="alert-custom"></div>
                            <form id="updateleague" name="updateleague" class="form-horizontal" autocomplete="off" action="<?php echo BASE_URL . "admin/controller/Account.php" ?>">
                                <input type="hidden" name="method" value="updateleague">
                                <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                <input type="hidden" name="leagueid" value="<?php echo $league_info['data'][0]['leagueid']; ?>">
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-compressed"></i></span>
                                        <input type="text" class="form-control" name="league_name" placeholder="League name" value="<?php echo $league_info['data'][0]['league_name']; ?>">
                                    </div>
                                </div>

                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <textarea name="description" class="form-control" rows="3" maxlength="1000" placeholder="Insert team short description(max 1000 characters)"><?php echo $league_info['data'][0]['description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                        <select class="form-control" name="status">
                                            <option value="<?php echo $league_info['data'][0]['status']; ?>" selected=""><?php echo ucfirst($league_info['data'][0]['status']); ?></option>
                                            <option value="active">Active</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group marginvertical">
                                    <button type="submit" class="btn btn-info btn-block">Save League Info</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "create-game"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-flag"></i> Create Game</strong></div>
                <div class="panel-body">

                    <div class="tab-pane" id="addnewteam">
                        <div class="formcontainer">
                            <div class="alert-custom"></div>
                            <form id="addgame" name="addgame" class="form-horizontal" autocomplete="off" action="<?php echo BASE_URL . "admin/controller/Account.php" ?>">
                                <input type="hidden" name="method" value="addgame">
                                <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                        <select class="form-control" name="leagueid">
                                            <option value="" selected="">Select League</option>
                                            <?php
                                            for ($i = 0; $i < count($userinfo['data']); $i++) {
                                                echo '<option value="' . $userinfo['data'][$i]['leagueid'] . '">' . $userinfo['data'][$i]['league_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                        <select class="form-control" name="team1">
                                            <option value="" selected="">Select Team 1</option>
                                            <?php
                                            for ($i = 0; $i < count($teaminfo['data']); $i++) {
                                                echo '<option value="' . $teaminfo['data'][$i]['teamid'] . '">' . $teaminfo['data'][$i]['teamname'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                        <select class="form-control" name="team2">
                                            <option value="" selected="">Select Team 1</option>
                                            <?php
                                            for ($i = 0; $i < count($teaminfo['data']); $i++) {
                                                echo '<option value="' . $teaminfo['data'][$i]['teamid'] . '">' . $teaminfo['data'][$i]['teamname'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="text" class="form-control" name="schedule" placeholder="Start time YYYY-mm-dd H:m:s (24 hour format ,e.g. <?php echo date("Y-m-d H:i:s"); ?>)" id="gameschedule">
                                    </div>
                                </div>

                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <textarea name="description" class="form-control" rows="3" maxlength="1000" placeholder="Insert Game short description(max 1000 characters)"></textarea>
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
                                    <button type="submit" class="btn btn-info btn-block">Save League Info</button>
                                </div>
                            </form>
                            <div class="col-md-12 note">
                                Note:
                                Calculate the time guessing UTC +0 time zone , current time is <?php echo date("Y-m-d H:i:s"); ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "game-list"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-user"></i> All Game Info</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <div id="alluser">
                        <div class="table-responsive datatable">
                            <table class="table table-bordered table-hover" id="userlist">
                                <thead>
                                    <tr style="background: bisque;">
                                        <th>Si</th>
                                        <th>League</th>
                                        <th>T1</th>
                                        <th>T2</th>
                                        <th>T1 Goal</th>
                                        <th>T2 Goal</th>
                                        <th>T1 Point</th>
                                        <th>T2 Point</th>
                                        <th>Game Date</th>
                                        <th>Last update</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($gameinfo['data']); $i++): ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td>
                                                <?php
                                                $leagueid = $gameinfo['data'][$i]['leagueid'];
                                                echo v_unique_info("league", "league_name", "leagueid='$leagueid'");
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $teamid = $gameinfo['data'][$i]['team1'];
                                                echo v_unique_info("team", "teamname", "teamid='$teamid'");
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $teamid = $gameinfo['data'][$i]['team2'];
                                                echo v_unique_info("team", "teamname", "teamid='$teamid'");
                                                ?>
                                            </td>
                                            <td><?php echo $gameinfo['data'][$i]['team1score']; ?></td>
                                            <td><?php echo $gameinfo['data'][$i]['team2score']; ?></td>
                                            <td><?php echo $gameinfo['data'][$i]['team1points']; ?></td>
                                            <td><?php echo $gameinfo['data'][$i]['team2points']; ?></td>
                                            <td><?php echo $gameinfo['data'][$i]['schedule']; ?></td>
                                            <td><?php echo $gameinfo['data'][$i]['updatedate']; ?></td>
                                            <td><?php echo $gameinfo['data'][$i]['status']; ?></td>
                                            <td>
                                                <button class="btn btn-danger deletegame" style="margin:1px;padding: 0px 2px;" data-id="<?php echo $gameinfo['data'][$i]['id']; ?>"><i class="glyphicon glyphicon-trash"></i></button>
                                                <a href="<?php echo BASE_URL; ?>admin/admin.php?adminroute=game&action=update-game&gameid=<?php echo $gameinfo['data'][$i]['id']; ?>"><button class="btn btn-info edit" style="margin:1px;padding: 0px 2px;"><i class="glyphicon glyphicon-edit"></i></button></a>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "game-list-old"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-user"></i> Old Game Info</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <div id="alluser">
                        <div class="table-responsive datatable">
                            <table class="table table-bordered table-hover" id="userlist">
                                <thead>
                                    <tr style="background: bisque;">
                                        <th>Si</th>
                                        <th>League</th>
                                        <th>T1</th>
                                        <th>T2</th>
                                        <th>T1 Goal</th>
                                        <th>T2 Goal</th>
                                        <th>T1 Point</th>
                                        <th>T2 Point</th>
                                        <th>Game Date</th>
                                        <th>Last update</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($gameinfo_old['data']); $i++): ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td>
                                                <?php
                                                $leagueid = $gameinfo_old['data'][$i]['leagueid'];
                                                echo v_unique_info("league", "league_name", "leagueid='$leagueid'");
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $teamid = $gameinfo_old['data'][$i]['team1'];
                                                echo v_unique_info("team", "teamname", "teamid='$teamid'");
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $teamid = $gameinfo_old['data'][$i]['team2'];
                                                echo v_unique_info("team", "teamname", "teamid='$teamid'");
                                                ?>
                                            </td>
                                            <td><?php echo $gameinfo_old['data'][$i]['team1score']; ?></td>
                                            <td><?php echo $gameinfo_old['data'][$i]['team2score']; ?></td>
                                            <td><?php echo $gameinfo_old['data'][$i]['team1points']; ?></td>
                                            <td><?php echo $gameinfo_old['data'][$i]['team2points']; ?></td>
                                            <td><?php echo $gameinfo_old['data'][$i]['schedule']; ?></td>
                                            <td><?php echo $gameinfo_old['data'][$i]['updatedate']; ?></td>
                                            <td><?php echo $gameinfo_old['data'][$i]['status']; ?></td>
                                            <td>
                                                <button class="btn btn-danger deletegame" style="margin:1px;padding: 0px 2px;" data-id="<?php echo $gameinfo_old['data'][$i]['id']; ?>"><i class="glyphicon glyphicon-trash"></i></button>
                                                <a href="<?php echo BASE_URL; ?>admin/admin.php?adminroute=game&action=update-game&gameid=<?php echo $gameinfo_old['data'][$i]['id']; ?>"><button class="btn btn-info edit" style="margin:1px;padding: 0px 2px;"><i class="glyphicon glyphicon-edit"></i></button></a>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "up-coming-game"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-user"></i> Up Coming Game</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <div id="alluser">
                        <div class="table-responsive datatable">
                            <table class="table table-bordered table-hover" id="userlist">
                                <thead>
                                    <tr style="background: bisque;">
                                        <th>Si</th>
                                        <th>League</th>
                                        <th>T1</th>
                                        <th>T2</th>
                                        <th>Game Date</th>
                                        <th>Last update</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($gameinfo_new['data']); $i++): ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td>
                                                <?php
                                                $leagueid = $gameinfo_new['data'][$i]['leagueid'];
                                                echo v_unique_info("league", "league_name", "leagueid='$leagueid'");
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $teamid = $gameinfo_new['data'][$i]['team1'];
                                                echo v_unique_info("team", "teamname", "teamid='$teamid'");
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $teamid = $gameinfo_new['data'][$i]['team2'];
                                                echo v_unique_info("team", "teamname", "teamid='$teamid'");
                                                ?>
                                            </td>
                                            <td><?php echo $gameinfo_new['data'][$i]['schedule']; ?></td>
                                            <td><?php echo $gameinfo_new['data'][$i]['updatedate']; ?></td>
                                            <td><?php echo $gameinfo_new['data'][$i]['status']; ?></td>
                                            <td>
                                                <button class="btn btn-danger deletegame" style="margin:1px;padding: 0px 2px;" data-id="<?php echo $gameinfo_new['data'][$i]['id']; ?>"><i class="glyphicon glyphicon-trash"></i></button>
                                                <a href="<?php echo BASE_URL; ?>admin/admin.php?adminroute=game&action=update-game&gameid=<?php echo $gameinfo_new['data'][$i]['id']; ?>"><button class="btn btn-info edit" style="margin:1px;padding: 0px 2px;"><i class="glyphicon glyphicon-edit"></i></button></a>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "update-game" && $_GET['gameid'] != ""): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-flag"></i> Update Game</strong></div>
                <div class="panel-body">

                    <div class="tab-pane" id="addnewteam">
                        <div class="formcontainer">
                            <div class="alert-custom"></div>
                            <form id="updategame" name="updategame" class="form-horizontal" autocomplete="off" action="<?php echo BASE_URL . "admin/controller/Account.php" ?>">
                                <input type="hidden" name="method" value="updategame">
                                <input type="hidden" name="gameid" value="<?php echo $id;?>">
                                <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                <div class="form-group marginvertical">
                                    <p><strong>League Name</strong></p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                        <select class="form-control" name="leagueid">
                                            <option value="<?php echo $game_info['data'][0]['leagueid']; ?>" selected="">
                                                <?php
                                                $leagueid = $gameinfo['data'][0]['leagueid'];
                                                echo v_unique_info("league", "league_name", "leagueid='$leagueid'");
                                                ?>
                                            </option>
                                            <?php
                                            for ($i = 0; $i < count($userinfo['data']); $i++) {
                                                echo '<option value="' . $userinfo['data'][$i]['leagueid'] . '">' . $userinfo['data'][$i]['league_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <p><strong>Team 1</strong></p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                        <select class="form-control" name="team1">
                                            <option value="<?php echo $game_info['data'][0]['team1']; ?>" selected="">
                                                <?php
                                                $teamid = $gameinfo['data'][0]['team1'];
                                                echo v_unique_info("team", "teamname", "teamid='$teamid'");
                                                ?>
                                            </option>
                                            <?php
                                            for ($i = 0; $i < count($teaminfo['data']); $i++) {
                                                echo '<option value="' . $teaminfo['data'][$i]['teamid'] . '">' . $teaminfo['data'][$i]['teamname'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <p><strong>Team 2</strong></p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                        <select class="form-control" name="team2">
                                            <option value="<?php echo $game_info['data'][0]['team2']; ?>" selected="">
                                                <?php
                                                $teamid2 = $gameinfo['data'][0]['team2'];
                                                echo v_unique_info("team", "teamname", "teamid='$teamid2'");
                                                ?>
                                            </option>
                                            <?php
                                            for ($i = 0; $i < count($teaminfo['data']); $i++) {
                                                echo '<option value="' . $teaminfo['data'][$i]['teamid'] . '">' . $teaminfo['data'][$i]['teamname'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <p><strong>Game Date</strong></p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="text" class="form-control" name="schedule" placeholder="Start time YYYY-mm-dd H:m:s (24 hour format ,e.g. <?php echo date("Y-m-d H:i:s"); ?>)" id="gameschedule" value="<?php echo $game_info['data'][0]['schedule']; ?>">
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <p><strong>Team 1 Goal</strong></p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="text" class="form-control" name="team1score" placeholder="0" id="gameschedule" value="<?php echo $game_info['data'][0]['team1score']; ?>">
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <p><strong>Team 2 Goal</strong></p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="text" class="form-control" name="team2score" placeholder="0" id="gameschedule" value="<?php echo $game_info['data'][0]['team2score']; ?>">
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <p><strong>Team 1 Point</strong></p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="text" class="form-control" name="team1points" placeholder="0" id="gameschedule" value="<?php echo $game_info['data'][0]['team1points']; ?>">
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <p><strong>Team 2 Point</strong></p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="text" class="form-control" name="team2points" placeholder="0" id="gameschedule" value="<?php echo $game_info['data'][0]['team2points']; ?>">
                                    </div>
                                </div>
                                <div class="form-group marginvertical">
                                    <p><strong>Game Description</strong></p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <textarea name="description" class="form-control" rows="3" maxlength="1000" placeholder="Insert Game short description(max 1000 characters)"><?php echo $game_info['data'][0]['description']; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group marginvertical">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                        <select class="form-control" name="status">
                                            <option value="<?php echo $game_info['data'][0]['status']; ?>" selected="">
                                                <?php
                                                echo ucfirst($game_info['data'][0]['status']);
                                                ?>
                                            </option>
                                            <option value="active">Active</option>
                                            <option value="pending">Pending</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group marginvertical">
                                    <button type="submit" class="btn btn-info btn-block">Save League Info</button>
                                </div>
                            </form>
                            <div class="col-md-12 note">
                                Note:
                                Calculate the time guessing UTC +0 time zone , current time is <?php echo date("Y-m-d H:i:s"); ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        <?php else: ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-user"></i> Game Info</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <div id="alluser">
                        <div class="table-responsive datatable">
                            <table class="table table-bordered table-hover" id="userlist">
                                <thead>
                                    <tr style="background: bisque;">
                                        <th>Si</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Last update</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($userinfo['data']); $i++): ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['league_name']; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['description']; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['update_date']; ?></td>
                                            <td><?php echo $userinfo['data'][$i]['status']; ?></td>
                                            <td>
                                                <button class="btn btn-danger deleteleague" style="margin:1px;padding: 0px 2px;" data-id="<?php echo $userinfo['data'][$i]['leagueid']; ?>"><i class="glyphicon glyphicon-trash"></i></button>
                                                <a href="<?php echo BASE_URL; ?>admin/admin.php?adminroute=game&action=update-league&leagueid=<?php echo $userinfo['data'][$i]['leagueid']; ?>"><button class="btn btn-info edit" style="margin:1px;padding: 0px 2px;"><i class="glyphicon glyphicon-edit"></i></button></a>
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
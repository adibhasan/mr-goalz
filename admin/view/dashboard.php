<?php preventDirectAccess("dashboard.php"); ?>
<div class="container-wrapper">
    <div class="menucontainer">
        <?php include 'menus.php'; ?>
    </div>
    <div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
    <div class="col-md-10 col-md-offset-1">
        <?php if (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "create-admin"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-user"></i> Create Admin</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <form id="createadmin" name="createadmin" class="form-horizontal" autocomplete="off" action="<?php echo BASE_URL . "admin/controller/Account.php" ?>">
                        <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                        <input type="hidden" name="method" value="createadmin">
                        <div class="form-group marginvertical">
                            <div class="input-group">
                                <span class="input-group-addon"><i class=" glyphicon glyphicon-star"></i></span>
                                <select class="form-control" name="status">
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="blocked">Blocked</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group marginvertical">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="adminname" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group marginvertical">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" class="form-control" name="adminemail" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group marginvertical">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="adminpassword" placeholder="Password" >
                            </div>
                        </div>
                        <div class="form-group marginvertical">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="retypedpassword" placeholder="Retype Password" >
                            </div>
                        </div>
                        <div class="form-group marginvertical">
                            <button type="submit" class="btn btn-info btn-block">Update User Name</button>
                        </div>
                    </form>
                    <div class="col-md-12 note">
                        Note: <br>-- Password must be at least 8 characters long including 1 upper character, 1 lower character and 1 number. <br>
                        -- Email id must be unique and valid.<br>
                        -- Password and retyped password must be same.
                    </div>
                </div>
            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "change-name"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon glyphicon-pencil"></i> Change Name</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <form id="updateusername" name="updateusername" class="form-horizontal" autocomplete="off" action="<?php echo BASE_URL . "admin/controller/Account.php" ?>">
                        <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                        <input type="hidden" name="method" value="changeusername">
                        <div class="form-group marginvertical">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="adminname" placeholder="User Name" value="<?php echo $_SESSION['vaiuugroup']['adminname']; ?>">
                            </div>
                        </div>

                        <div class="form-group marginvertical">
                            <button type="submit" class="btn btn-info btn-block">Update User Name</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "change-password"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-pencil"></i> Change Password</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <form id="changepassword" name="changepassword" class="form-horizontal" autocomplete="off" action="<?php echo BASE_URL . "admin/controller/Account.php" ?>">
                        <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                        <input type="hidden" name="method" value="changepassword">
                        <div class="form-group marginvertical">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="oldpassword" placeholder="Old Password">
                            </div>
                        </div>
                        <div class="form-group marginvertical">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="adminpassword" placeholder="New Password">
                            </div>
                        </div>
                        <div class="form-group marginvertical">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="retypedpassword" placeholder="Retype Password" >
                            </div>
                        </div>
                        <div class="form-group marginvertical">
                            <button type="submit" class="btn btn-info btn-block">Update User Name</button>
                        </div>
                    </form>
                    <div class="col-md-12 note">
                        Note: <br>-- Password must be at least 8 characters long including 1 upper character, 1 lower character and 1 number. <br>
                        -- Old password and new password can not be same.<br>
                        -- New password and retyped password must be same.
                    </div>
                </div>
            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "show-admin-user" && $_SESSION['vaiuugroup']['admintype'] == "super admin"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-user"></i> User Info</strong></div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="alert-custom"></div>
                        <div class="tab-pane active" id="alluser">
                            <div class="table-responsive datatable">
                                <table class="table table-bordered table-hover" id="userlist">
                                    <thead>
                                        <tr style="background: rgb(140,127,111);">
                                            <th>Si</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>IP</th>
                                            <th>Create Date</th>
                                            <th>Last Update</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($admininfo['data']); $i++): ?>
                                            <tr>
                                                <td><?php echo $i + 1; ?></td>
                                                <td><?php echo $admininfo['data'][$i]['adminname']; ?></td>
                                                <td><?php echo $admininfo['data'][$i]['adminemail']; ?></td>
                                                <td><?php echo $admininfo['data'][$i]['ip']; ?></td>
                                                <td><?php echo $admininfo['data'][$i]['createdate']; ?></td>
                                                <td><?php echo $admininfo['data'][$i]['updatedate']; ?></td>
                                                <td><?php echo $admininfo['data'][$i]['status']; ?></td>
                                                <td>
                                                    <button class="btn btn-danger deleteadmin" style="margin:1px;padding: 0px 2px;" data-id="<?php echo $admininfo['data'][$i]['id']; ?>"><i class="glyphicon glyphicon-trash"></i></button>
                                                    <a href="<?php echo BASE_URL; ?>admin/admin.php?adminroute=home&action=edit-admin-user&adminid=<?php echo $admininfo['data'][$i]['id']; ?>"><button class="btn btn-info" style="margin:1px;padding: 0px 2px;" data-id="<?php echo $admininfo['data'][$i]['id']; ?>"><i class="glyphicon glyphicon-edit"></i></button></a>
                                                </td>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php elseif (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "edit-admin-user" && $_SESSION['vaiuugroup']['admintype'] == "super admin"): ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-user"></i> Update Admin</strong></div>
                <div class="panel-body">
                    <div class="alert-custom"></div>
                    <form id="updateadmin" name="updateadmin" class="form-horizontal" autocomplete="off" action="<?php echo BASE_URL . "admin/controller/Account.php" ?>">
                        <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                        <input type="hidden" name="method" value="updateadmin">
                        <input type="hidden" name="userid" value="<?php echo ucfirst($uniqueuser['data'][0]['id']);?>">
                        <div class="form-group marginvertical">
                            <div class="input-group">
                                <span class="input-group-addon"><i class=" glyphicon glyphicon-star"></i></span>
                                <select class="form-control" name="status">
                                    <option value="<?php echo $uniqueuser['data'][0]['status'];?>"><?php echo ucfirst($uniqueuser['data'][0]['status']);?></option>
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="blocked">Blocked</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group marginvertical">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="adminname" placeholder="Name" value="<?php echo $uniqueuser['data'][0]['adminname'];?>">
                            </div>
                        </div>
                        <div class="form-group marginvertical">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" class="form-control" name="adminemail" placeholder="Email" value="<?php echo $uniqueuser['data'][0]['adminemail'];?>">
                            </div>
                        </div>
                        <div class="form-group marginvertical">
                            <button type="submit" class="btn btn-info btn-block">Update User Information</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong><i class="glyphicon glyphicon-road"></i> Shortcut</strong></div>
                <div class="panel-body">
                    <div class="shortcut">
                        <div class="shortcutblock ">
                            <a href="" class="color-orange">
                                <div class="shortcuticon"><i class="glyphicon glyphicon-home"></i></div>
                                <div class="shortcuttext">Home</div>
                            </a>
                        </div>
                        <div class="shortcutblock ">
                            <a href="" class="color-orange">
                                <div class="shortcuticon"><i class="glyphicon glyphicon-home"></i></div>
                                <div class="shortcuttext">xvcv</div>
                            </a>
                        </div>
                        <div class="shortcutblock ">
                            <a href="" class="color-orange">
                                <div class="shortcuticon"><i class="glyphicon glyphicon-home"></i></div>
                                <div class="shortcuttext">xvcv</div>
                            </a>
                        </div>
                        <div class="shortcutblock ">
                            <a href="" class="color-orange">
                                <div class="shortcuticon"><i class="glyphicon glyphicon-home"></i></div>
                                <div class="shortcuttext">xvcv</div>
                            </a>
                        </div>
                        <div class="shortcutblock ">
                            <a href="" class="color-orange">
                                <div class="shortcuticon"><i class="glyphicon glyphicon-home"></i></div>
                                <div class="shortcuttext">xvcv</div>
                            </a>
                        </div>
                        <div class="shortcutblock ">
                            <a href="" class="color-orange">
                                <div class="shortcuticon"><i class="glyphicon glyphicon-home"></i></div>
                                <div class="shortcuttext">xvcv</div>
                            </a>
                        </div>
                        <div class="shortcutblock ">
                            <a href="" class="color-orange">
                                <div class="shortcuticon"><i class="glyphicon glyphicon-home"></i></div>
                                <div class="shortcuttext">xvcv</div>
                            </a>
                        </div>
                        <div class="shortcutblock ">
                            <a href="" class="color-orange">
                                <div class="shortcuticon"><i class="glyphicon glyphicon-home"></i></div>
                                <div class="shortcuttext">xvcv</div>
                            </a>
                        </div>
                        <div class="shortcutblock ">
                            <a href="" class="color-orange">
                                <div class="shortcuticon"><i class="glyphicon glyphicon-home"></i></div>
                                <div class="shortcuttext">xvcv</div>
                            </a>
                        </div>
                        <div class="shortcutblock ">
                            <a href="" class="color-orange">
                                <div class="shortcuticon"><i class="glyphicon glyphicon-home"></i></div>
                                <div class="shortcuttext">xvcv</div>
                            </a>
                        </div>
                        <div class="shortcutblock ">
                            <a href="" class="color-orange">
                                <div class="shortcuticon"><i class="glyphicon glyphicon-home"></i></div>
                                <div class="shortcuttext">xvcv</div>
                            </a>
                        </div>
                        <div class="shortcutblock ">
                            <a href="" class="color-orange">
                                <div class="shortcuticon"><i class="glyphicon glyphicon-home"></i></div>
                                <div class="shortcuttext">xvcv</div>
                            </a>
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

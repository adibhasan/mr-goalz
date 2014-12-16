<?php preventMenuAccess('menus'); ?>
<nav class="navbar navbar-default" role="navigation" style="border-radius: 0px;">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand customnavbrand" href="<?php echo BASE_URL;?>admin/admin.php?adminroute=home"><img src="<?php echo APP_LOGO; ?>"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=home">Dashboard</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Game <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=team&action=create-team">Create Team</a></li>
                        <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=team&action=show-team-list">List of Team</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=game&action=create-league">Create League</a></li>
                        <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=game&action=list-of-league">List of League</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=game&action=create-game">Create Game</a></li>
                        <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=game&action=game-list">List of Game</a></li>
                        <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=game&action=game-list-old">Old Game</a></li>
                        <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=game&action=up-coming-game">Upcoming Game</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=team">Football at a Glance</a></li>
                        
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">User <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=user">All User</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <?php if ($_SESSION['vaiuugroup']['admintype'] == "super admin"): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin User <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=home&action=create-admin">Create Admin</a></li>
                            <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=home&action=show-admin-user">List Of Admin</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="" onclick="javascript:return false;"><strong><?php echo ucwords($_SESSION['vaiuugroup']['admintype']); ?>:</strong> <span class="username"><?php echo $_SESSION['vaiuugroup']['adminname']; ?></span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=home&action=change-name">Change Name</a></li>
                        <li><a href="<?php echo BASE_URL;?>admin/admin.php?adminroute=home&action=change-password">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo BASE_URL; ?>admin/">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php

function preventMenuAccess($filename = "") {
    $requesturl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if (false !== strpos($requesturl, $filename)) {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }
}
?>
<?php preventDirectAccess("userlogin.php"); ?>
<div class="container-wrapper">
    <div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
    <div class="col-md-6 col-md-offset-3">
        <div class="client-logo">
            <img src="<?php echo APP_LOGO; ?>" class="img-responsive">
        </div>
        <div class="panel panel-warning loginpanel">
            <div class="panel-heading"><strong>Administrator Login</strong></div>
            <div class="panel-body">
                <div class="alert-custom"></div>
                <form id="adminlogin" name="adminlogin" class="form-horizontal" autocomplete="off" action="<?php echo BASE_URL . "admin/controller/Account.php" ?>">
                    <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                    <input type="hidden" name="method" value="adminlogin">
                    <div class="form-group marginvertical">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input type="email" class="form-control" name="adminemail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group marginvertical">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input type="password" class="form-control" name="adminpassword" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group marginvertical">
                        <button type="submit" class="btn btn-info btn-block">Log In</button>
                    </div>
                </form>
                <div><a class="forgotpassword linkto" href="javascript:void(0);" data-brotherstate="forgotpasswordpanel" data-ownstate="loginpanel">Forgot password?</a></div>
            </div>
            <div class="panel-footer">Design and Developed by <a href="vaiuugroupbd.com">Vaiuu Group Bangladesh</a></div>
        </div>
        <div class="panel panel-warning forgotpasswordpanel">
            <div class="panel-heading"><strong>Administrator Password Retrieve</strong></div>
            <div class="panel-body">
                <div class="alert-custom" id="re"></div>
                <form id="passwordretrieve" name="passwordretrieve" class="form-horizontal" autocomplete="off" action="<?php echo BASE_URL . "admin/controller/Account.php" ?>">
                    <div class="form-group marginvertical">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input type="email" class="form-control" name="adminemail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group marginvertical">
                        <input type="hidden" name="method" value="generatepassword">
                        <button type="submit" class="btn btn-info btn-block">Retrieve</button>
                    </div>
                </form>
                <div><a class="goback linkto" data-brotherstate="loginpanel" data-ownstate="forgotpasswordpanel" href="javascript:void(0);"><i class="glyphicon glyphicon-chevron-left"></i> Go Back</a></div>
            </div>
            <div class="panel-footer">Design and Developed by <a href="vaiuugroupbd.com">Vaiuu Group Bangladesh</a></div>
        </div>
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
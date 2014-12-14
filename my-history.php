<?php include 'Generic.php'; ?>
<?php include 'controller/Gamelist.php'; ?>
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
            <div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
            <div class="page-container container">
                <div class="col-md-8 col-md-offset-2">
                    <div class="profile">
                        <div class="profile-image profileinfo">
                            <div class="pim avatar">
                                <img src="<?php echo $avatar; ?>" class="img-circle" id="changeprofileimage">
                                <div class="imageactionbutton">
                                    <button class="btn btn-success proceedupload">Save</button>
                                    <button class="btn btn-danger cancelupload">Cancel</button>
                                </div>
                                <div class="fileactionbutton hidden">
                                    <form id="upload-image" autocomplete="off" role="form">
                                        <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                        <input type="hidden" value="<?php echo $avatar; ?>" id="previousimage">
                                        <input type="hidden" name="profile_picture" id="profile_picture">
                                        <input type="submit"  class="hidden" id="uploadimage">
                                    </form>
                                </div>
                            </div>
                            <div class="pim uname"><?php echo $userid; ?></div>
                        </div>
                        <div class="profile-rank profileinfo">
                            <div>Rank : 2nd</div>
                            <div>Score: 2013</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="well"></div>
                    <div  id="upcominggames" class="formcontainer" style="margin-top: 0px;">
                        <div class="table-responsive">
                            <div id="my-shared-history">
                                <div class="box-heading">
                                    <div class="col-md-4 heading4" style="padding: 0px"><a href="logout.php"><i class="glyphicon glyphicon-chevron-left"></i> Back</a></div>
                                    <div class="heading4 col-md-4 center-text">My History</div>
                                    <div class="heading4 col-md-4 right-text"><a href="javascript:return false;">Share</a></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div>
                                    <table class="table" >
                                        <tr>
                                            <th colspan="3"><h3 class="table-heading">Previous Guess</h3></th>
                                        <th colspan="1"><h3 class="table-heading right-text">Score=Points</h3></th>
                                        <tr>
                                            <td>
                                                <div class="shape-box" style="float: left">3</div>
                                            </td>
                                            <td><h4 class="center-text">Man United Vs Swansea</h4></td>
                                            <td class="right-text">
                                                <div class="shape-box">1</div>
                                            </td> 

                                            <td class="right-text">
                                                <h4>3-0=4 Point(s)</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="shape-box" style="float: left">3</div>
                                            </td>
                                            <td><h4 class="center-text">Man United Vs Swansea</h4></td>
                                            <td class="right-text">
                                                <div class="shape-box">1</div>
                                            </td> 

                                            <td class="right-text">
                                                <h4>3-0=4 Point(s)</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="shape-box" style="float: left">3</div>
                                            </td>
                                            <td><h4 class="center-text">Man United Vs Swansea</h4></td>
                                            <td class="right-text">
                                                <div class="shape-box">1</div>
                                            </td> 

                                            <td class="right-text">
                                                <h4>3-0=4 Point(s)</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="shape-box" style="float: left">3</div>
                                            </td>
                                            <td><h4 class="center-text">Man United Vs Swansea</h4></td>
                                            <td class="right-text">
                                                <div class="shape-box">1</div>
                                            </td> 

                                            <td class="right-text">
                                                <h4>3-0=4 Point(s)</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="shape-box" style="float: left">3</div>
                                            </td>
                                            <td><h4 class="center-text">Man United Vs Swansea</h4></td>
                                            <td class="right-text">
                                                <div class="shape-box">1</div>
                                            </td> 

                                            <td class="right-text">
                                                <h4>3-0=4 Point(s)</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="shape-box" style="float: left">3</div>
                                            </td>
                                            <td><h4 class="center-text">Man United Vs Swansea</h4></td>
                                            <td class="right-text">
                                                <div class="shape-box">1</div>
                                            </td> 

                                            <td class="right-text">
                                                <h4>3-0=4 Point(s)</h4>
                                            </td>
                                        </tr>
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
                            </div>

                        </div>

                    </div>
                    <br>
                    <div class="well"></div>
                    <div class="usermenu">
                        <a class="usermenubutton" href="settings">
                            <img src="<?php BASE_URL ?>assets/css/images/btn/blue_main.png">
                        </a>
                        <a class="usermenubutton" href="guessit">
                            <img src="<?php BASE_URL ?>assets/css/images/btn/guessit.png">
                        </a>
                        <a class="usermenubutton" href="ranking">
                            <img src="<?php BASE_URL ?>assets/css/images/btn/ranking.png">
                        </a>
                        <a class="usermenubutton" href="news">
                            <img src="<?php BASE_URL ?>assets/css/images/btn/news.png">
                        </a>
                        <a class="usermenubutton" href="more">
                            <img src="<?php BASE_URL ?>assets/css/images/btn/more.png">
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <?php v_includeFooter(); ?>
    </body>
</html>


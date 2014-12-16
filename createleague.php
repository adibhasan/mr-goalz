<?php
include 'Generic.php';
include 'controller/Action.php';
include 'controller/Createleague.php';
?>
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
                        <?php profileInfoGeneral(); ?>
                    </div>
                    <div class="line"></div>
                    <div class="sponsor-link" style="padding: 5px;">
                        <?php sponsorRedirect("http://google.com"); ?>
                    </div>
                    <div class="wrapp-container">
                        <div class="main-content">
                            <div class="my-guess" id="my-guess">
                                <div class="table-wrapper">
                                    <div class="table-title">
                                        <div class="table-row-heading">
                                            <div class="col-text-title-black condenced" style="text-align: center;">Create League</div>
                                        </div>
                                    </div>
                                    <div class="table-content">
                                        <div id="container3">
                                            <div class="alert-custom"></div>
                                            <form id="insert-game" name="insert-game" role="form">
                                                <div id="gamename" style="font-size: 1em">
                                                    <div class="form-block">
                                                        <div class="condenced ftitle" >Select League Name</div>
                                                        <div>
                                                            <select class="league-list " id="league-name" required="required" name="leagueid">
                                                                <option value="">Select a League</option>
                                                                <?php for ($i = 0; $i < count($user['my_league']); $i++): ?>
                                                                    <option value="<?php echo $user['my_league'][$i]['leagueid']; ?>"><?php echo $user['my_league'][$i]['league_name']; ?></option>
                                                                <?php endfor; ?>
                                                                <option value="other">Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-block">
                                                        <div class="condenced ftitle">Short Description</div>
                                                        <div>
                                                            <textarea class="private-text-area" maxlength="200" required="required" name="description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-block">
                                                        <div class="condenced ftitle" >Team 1</div>
                                                        <div>
                                                            <select class="team-list" id="team1" name="team1" required="required">
                                                                <option value="">Select a Team</option>
                                                                <?php for ($i = 0; $i < count($user['team']); $i++): ?>
                                                                    <option value="<?php echo $user['team'][$i]['teamid']; ?>"><?php echo $user['team'][$i]['teamname']; ?></option>
                                                                <?php endfor; ?>
                                                                <option value="other">Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-block">
                                                        <div class="condenced ftitle">Team 2</div>
                                                        <div>
                                                            <select class="team-list"  id="team2" name="team2" required="required">
                                                                <option value="">Select a Team</option>
                                                                <?php for ($i = 0; $i < count($user['team']); $i++): ?>
                                                                    <option value="<?php echo $user['team'][$i]['teamid']; ?>"><?php echo $user['team'][$i]['teamname']; ?></option>
                                                                <?php endfor; ?>
                                                                <option value="other">Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-block ftitle">
                                                        <div>Date  & Time <span class="note2">(USE UTC+0 time e.g. <?php echo date("Y-m-d H:i:s"); ?>)</span></div>
                                                        <div><input type="text" class="p-input date" name="schedule" required="required"></div>
                                                    </div>
                                                    <div class="form-block">
                                                        <input type="hidden" name="token" value="<?php echo v_generateToken();?>">
                                                        <button type="submit" class="btn btn-primary btn-block" id="submit-league">Create</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="league-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content condenced">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Enter New League Name</h4>
                    </div>
                    <div class="modal-body" id="logincontainer">
                        <div id="league-insert" class="game">
                            <div class="alert-custom messaage"></div>
                            <form id="leagueinput" name="league-input" role="form">
                                <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                <div class="input-box ftitle">
                                    <input type="text" class="textinput center-text black" name="league_name" required="required" maxlength="100" placeholder="League name">
                                    <div class="error-message"></div>
                                </div>
                                <div class="input-box ftitle">
                                    <textarea required="required" maxlength="200" style="width: 100%;resize: none" placeholder="Short description" name="description"></textarea>
                                    <div class="error-message"></div>
                                </div>
                                <br>
                                <div>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="team-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content condenced">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Enter New Team Name</h4>
                    </div>
                    <div class="modal-body" id="logincontainer2">
                        <div id="league-insert" class="game">
                            <div class="alert-custom messaage"></div>
                            <form id="teaminput" name="teaminput" role="form">
                                <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                <div class="input-box ftitle">
                                    <input type="text" class="textinput center-text black" name="teamname" required="required" maxlength="100" placeholder="Team name">
                                    <div class="error-message"></div>
                                </div>
                                <div class="input-box ftitle">
                                    <textarea required="required" maxlength="200" style="width: 100%;resize: none" placeholder="Short description" name="description"></textarea>
                                    <div class="error-message"></div>
                                </div>
                                <br>
                                <div>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <div id="form-content" class="hidden">
            <input type="number" value="10" class="inline-goal" required="required" max="100" min="0">
        </div>
        <div class="usermenu-wrapper">
            <?php bottomSessionedMenu("shape-active", "", "", "", "", ""); ?>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <?php v_includeFooter(); ?>
        <script>
            $(function () {
                $(".ua").on("click", function () {
                    $(".ua").removeClass("user-active");
                    $(this).addClass("user-active");
                    var id = $(this).attr("id");
                    if (id == "crl") {
                        $("#gamename").hide();
                        $("#lgcreate").show();
                    } else {
                        $("#lgcreate").hide();
                        $("#gamename").show();
                    }
                });

                $(".date").mask("9999-99-99 99:99:99");
            });

        </script>
    </body>
</html>


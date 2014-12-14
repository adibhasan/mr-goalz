<?php include 'Generic.php'; ?>
<?php include 'controller/MyGuess.php'; ?>
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
                        <?php profileInfoGeneral($avatar, $userid); ?>
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
                                        <div id="gamename" style="font-size: 1em">
                                            <div class="form-block">
                                                <div class="condenced ftitle" >Select League Name</div>
                                                <div>
                                                    <select class="league-list " id="league-name">
                                                        <option>La League</option>
                                                        <option>Spanish League</option>
                                                        <option>Copa America</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-block">
                                                <div class="condenced ftitle">Short Description</div>
                                                <div>
                                                    <textarea class="private-text-area"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-block">
                                                <div class="condenced ftitle" >Team 1</div>
                                                <div>
                                                    <select class="league-list" id="team1">
                                                        <option>Argentina</option>
                                                        <option>Brazil</option>
                                                        <option>Germany</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-block">
                                                <div class="condenced ftitle">Team 1</div>
                                                <div>
                                                    <select class="league-list"  id="team2">
                                                        <option>Argentina</option>
                                                        <option>Brazil</option>
                                                        <option>Germany</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-block ftitle">
                                                <div>Game  & Time <span class="note">(USE UTC+0 time e.g. <?php echo date("Y-m-d H:i:s"); ?>)</span></div>
                                                <div><input type="text" class="p-input"></div>
                                            </div>
                                            <div class="form-block">
                                                <button type="button" class="btn btn-primary btn-block" id="submit-league">Create</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="team-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content condenced">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="input-form" name="league-input" role="form">
                            <div class="form-block ftitle">
                                <div><input type="text" class="p-input"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
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
                $(".league-list").on("change", function () {
                    if ($(this).val() == "other") {
                        var id=$(this).attr("id");
                        if(id=="league-name"){
                            $("#team-modal .modal-title").html("Enter New League Name");
                        }else{
                            $("#team-modal .modal-title").html("Enter New Team Name");
                        }
                        $("#team-modal").modal("show");
                    } else {
                        $("#team-modal").modal("hide");
                    }

                });

            });
        </script>
    </body>
</html>


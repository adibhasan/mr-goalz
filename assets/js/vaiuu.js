jQuery(function ($) {
    'use strict';
    var FIELD1 = "";
    var FIELD2 = "";
    var limit = 0;
    var VALIDFILE = ["jpg", "png", "gif"];
    var DUMMYIMAGE = "data:image/jpeg;base64,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AGxmZgAGAAAAAAABAC9mZgABAKGZmgAGAAAAAAABADIAAAABAFoAAAAGAAAAAAABADUAAAABAC0AAAAGAAAAAAABOEJJTQP4AAAAAABwAAD/////////////////////////////A+gAAAAA/////////////////////////////wPoAAAAAP////////////////////////////8D6AAAAAD/////////////////////////////A+gAADhCSU0EAAAAAAAAAgAPOEJJTQQCAAAAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4QklNBDAAAAAAABABAQEBAQEBAQEBAQEBAQEBOEJJTQQtAAAAAAAGAAEAAAAQOEJJTQQIAAAAAAAQAAAAAQAAAkAAAAJAAAAAADhCSU0EHgAAAAAABAAAAAA4QklNBBoAAAAAA0sAAAAGAAAAAAAAAAAAAAC3AAAAkwAAAAsAVQBuAGIAZQBuAGEAbgBuAHQALQAxAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAACTAAAAtwAAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAAAAAAAAABAAAAABAAAAAAAAbnVsbAAAAAIAAAAGYm91bmRzT2JqYwAAAAEAAAAAAABSY3QxAAAABAAAAABUb3AgbG9uZwAAAAAAAAAATGVmdGxvbmcAAAAAAAAAAEJ0b21sb25nAAAAtwAAAABSZ2h0bG9uZwAAAJMAAAAGc2xpY2VzVmxMcwAAAAFPYmpjAAAAAQAAAAAABXNsaWNlAAAAEgAAAAdzbGljZUlEbG9uZwAAAAAAAAAHZ3JvdXBJRGxvbmcAAAAAAAAABm9yaWdpbmVudW0AAAAMRVNsaWNlT3JpZ2luAAAADWF1dG9HZW5lcmF0ZWQAAAAAVHlwZWVudW0AAAAKRVNsaWNlVHlwZQAAAABJbWcgAAAABmJvdW5kc09iamMAAAABAAAAAAAAUmN0MQAAAAQAAAAAVG9wIGxvbmcAAAAAAAAAAExlZnRsb25nAAAAAAAAAABCdG9tbG9uZwAAALcAAAAAUmdodGxvbmcAAACTAAAAA3VybFRFWFQAAAABAAAAAAAAbnVsbFRFWFQAAAABAAAAAAAATXNnZVRFWFQAAAABAAAAAAAG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P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA0LjIuMi1jMDYzIDUzLjM1MjYyNCwgMjAwOC8wNy8zMC0xODoxMjoxOCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIiB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iIHhtbG5zOnRpZmY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vdGlmZi8xLjAvIiB4bWxuczpleGlmPSJodHRwOi8vbnMuYWRvYmUuY29tL2V4aWYvMS4wLyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M0IFdpbmRvd3MiIHhtcDpNZXRhZGF0YURhdGU9IjIwMTEtMDMtMTNUMjA6MjE6MDkrMDE6MDAiIHhtcDpNb2RpZnlEYXRlPSIyMDExLTAzLTEzVDIwOjIxOjA5KzAxOjAwIiB4bXA6Q3JlYXRlRGF0ZT0iMjAxMS0wMy0xM1QyMDoyMTowOSswMTowMCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo3ODVGQzkwQ0E3NERFMDExQTE4RThBNTRFODM3NzRFNyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo3NzVGQzkwQ0E3NERFMDExQTE4RThBNTRFODM3NzRFNyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ4bXAuZGlkOjc3NUZDOTBDQTc0REUwMTFBMThFOEE1NEU4Mzc3NEU3IiBkYzpmb3JtYXQ9ImltYWdlL2pwZWciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgdGlmZjpPcmllbnRhdGlvbj0iMSIgdGlmZjpYUmVzb2x1dGlvbj0iNzIwMDAwLzEwMDAwIiB0aWZmOllSZXNvbHV0aW9uPSI3MjAwMDAvMTAwMDAiIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiIHRpZmY6TmF0aXZlRGlnZXN0PSIyNTYsMjU3LDI1OCwyNTksMjYyLDI3NCwyNzcsMjg0LDUzMCw1MzEsMjgyLDI4MywyOTYsMzAxLDMxOCwzMTksNTI5LDUzMiwzMDYsMjcwLDI3MSwyNzIsMzA1LDMxNSwzMzQzMjswMTNCRThCMjFGNDAxMzY4NkQ3NTAzMjE4NDBCMzk3MyIgZXhpZjpQaXhlbFhEaW1lbnNpb249IjE0NyIgZXhpZjpQaXhlbFlEaW1lbnNpb249IjE4MyIgZXhpZjpDb2xvclNwYWNlPSIxIiBleGlmOk5hdGl2ZURpZ2VzdD0iMzY4NjQsNDA5NjAsNDA5NjEsMzcxMjEsMzcxMjIsNDA5NjIsNDA5NjMsMzc1MTAsNDA5NjQsMzY4NjcsMzY4NjgsMzM0MzQsMzM0MzcsMzQ4NTAsMzQ4NTIsMzQ4NTUsMzQ4NTYsMzczNzcsMzczNzgsMzczNzksMzczODAsMzczODEsMzczODIsMzczODMsMzczODQsMzczODUsMzczODYsMzczOTYsNDE0ODMsNDE0ODQsNDE0ODYsNDE0ODcsNDE0ODgsNDE0OTIsNDE0OTMsNDE0OTUsNDE3MjgsNDE3MjksNDE3MzAsNDE5ODUsNDE5ODYsNDE5ODcsNDE5ODgsNDE5ODksNDE5OTAsNDE5OTEsNDE5OTIsNDE5OTMsNDE5OTQsNDE5OTUsNDE5OTYsNDIwMTYsMCwyLDQsNSw2LDcsOCw5LDEwLDExLDEyLDEzLDE0LDE1LDE2LDE3LDE4LDIwLDIyLDIzLDI0LDI1LDI2LDI3LDI4LDMwOzRCOTFCREYyRDVDNkQzQTAzMDk5QUE4QTIzMzdDODAzIj4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY3JlYXRlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo3NzVGQzkwQ0E3NERFMDExQTE4RThBNTRFODM3NzRFNyIgc3RFdnQ6d2hlbj0iMjAxMS0wMy0xM1QyMDoyMTowOSswMTowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIENTNCBXaW5kb3dzIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo3ODVGQzkwQ0E3NERFMDExQTE4RThBNTRFODM3NzRFNyIgc3RFdnQ6d2hlbj0iMjAxMS0wMy0xM1QyMDoyMTowOSswMTowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIENTNCBXaW5kb3dzIiBzdEV2dDpjaGFuZ2VkPSIvIi8+IDwvcmRmOlNlcT4gPC94bXBNTTpIaXN0b3J5PiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8P3hwYWNrZXQgZW5kPSJ3Ij8+/+IMWElDQ19QUk9GSUxFAAEBAAAMSExpbm8CEAAAbW50clJHQiBYWVogB84AAgAJAAYAMQAAYWNzcE1TRlQAAAAASUVDIHNSR0IAAAAAAAAAAAAAAAEAAPbWAAEAAAAA0y1IUCAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA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";
    var VAIUU = {
        Initialize: function () {
            this.CacheElements();
            this.BindEvents();

        },
        BindEvents: function () {
            $(window).ready(function () {
                $("body").css("display", "block");
            });
            var viewWidth = $(window).width();
            var viewHeight = $(window).height();
            $('img').on('dragstart', function (event) {
                event.preventDefault();
            });
            $(document).ready(function () {
                $('#example').DataTable();
            });
            $("#change-password").on("click", function () {
                VAIUU.FormReset("#changePassword");
                $("#reset-password").modal("show");
            });
            $('.content-wrapper', '.content-wrapper img').click(function (e) {
                e.stopImmediatePropagation();
                e.preventDefault();
            });
            $("#re-send-activation-link").on("click", function () {
                VAIUU.FormReset("#resend-activation-link");
                $("#resend-r-link").modal("show");
            });
            $("body").on("click", function () {
                $(".messaage").html("");
                $(".alert-custom").find(".alert").fadeOut("400", function () {
                    $(".alert-custom").html("");
                })
                $(".return-message").remove();
            });
            $(document.body).ready(function () {
                $(".btngplus").attr("href", $("#gpls").attr("href"));
            });
            $('.scroll-top').click(function () {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
            $(".add-to-circle").on("click", function () {
                var friendid = $(this).data("userid");
                VAIUU.AjaxFormValueCheck("controller/Ajaxcall.php", "post", "invited_id=" + friendid + "&method=addfriend", CALLBACK.AjaxAddFriend);
            });
            $(".delete_fnf").on("click", function () {
                var x = confirm("Do you want to discard this item?");
                if (x) {
                    var friendid = $(this).data("userid");
                    VAIUU.AjaxFormValueCheck("controller/Ajaxcall.php", "post", "invited_id=" + friendid + "&method=deletefriend", CALLBACK.AjaxDeleteFriend);

                }
            });
            $(".leagueleave").on("click", function () {
                var x = confirm("Do you want to leave this group?");
                if (x) {
                    var leagueid = $(this).data("leagueid");
                    VAIUU.AjaxFormValueCheck("controller/Ajaxcall.php", "post", "leagueid=" + leagueid + "&method=leaveleague", CALLBACK.LeaveLeague);

                }
            });
            $(".my-guess-info .has-link").on("click", function () {
                window.location.href = "my-guess-info.php";
            });
            $(".add-cross").on("click", function () {
                $(this).parent().parent().hide();
            });
            $("#league-table-action").on("click", function (e) {
                e.preventDefault();
                $("#game-list-wrapper").hide("slide", 500, function () {
                    $("#league-table-wrapper").show();
                    $(".add-cross").parent().parent().show();
                });

            });
            $("#upcoming-table-action").on("click", function (e) {
                e.preventDefault();
                $("#league-table-wrapper").hide("slide", 500, function () {
                    $("#game-list-wrapper").show();
                    $(".add-cross").parent().parent().show();
                });

            });
            $("#history-table-action").on("click", function (e) {
                e.preventDefault();
                $("#leader-list").hide("slide", 500, function () {
                    $("#my-history").show();
                });

            });
            $("#back-to-leader").on("click", function (e) {
                e.preventDefault();
                $("#my-history").hide("slide", 500, function () {
                    $("#leader-list").show();
                });

            });
            $(".checkboxinput").on("click", function () {
                $(this).toggleClass("cb2");
                $(this).parent().find("input[type=checkbox]").trigger("click");
            });
            $("#noti").on("click", function () {
                $(this).toggleClass("notify1 notify2");
                $(this).parent().find("input[type=checkbox]").trigger("click");
            });
            $("#incrementor").on("click", function () {
                var i = 0;
                if (limit < window.maxleague) {
                    limit = limit + 6;
                    $(".sibling").hide();
                    for (i = limit; i < limit + 6; i++) {
                        $("#sibling_" + i).removeClass("hidden").show();
                    }

                }
            });
            $("#decrementor").on("click", function () {
                var j = 0;
                if (limit >= 6) {
                    $(".sibling").hide();
                    for (j = limit - 1; j >= limit - 6; j--) {

                        $("#sibling_" + j).removeClass("hidden").show();
                    }
                    limit = limit - 6;


                }
            });
            $("form input").on("keyup", function (event) {
                if (event.which == 13) {
                    $("form [type=submit]").trigger("click");
                }
            });
            $("#create-private-league button").on("click", function () {
                $("#create-league-modal").modal("hide");
                $("#league-modal").modal("show");
            });
            $("#choose-private-league button").on("click", function () {
                $("#create-league-modal").modal("hide");
                $("#enrolled-league").modal("show");
            });
            $("#exit-private-league button").on("click", function () {
                $("#create-league-modal").modal("hide");
                $("#leave-league").modal("show");
            });
            $("#invite-private-league button").on("click", function () {
                $("#create-league-modal").modal("hide");
                $("#invite-user").modal("show");
            });
            $('#leaguelist').DataTable();
            $('#inviteuserlist').DataTable();
            $('#leaguelistleave').DataTable();
            $(".league-list").on("change", function () {
                if ($(this).val() == "other") {
                    var id = $(this).attr("id");
                    $(".messaage").html("");
                    VAIUU.FormReset("#leagueinput");
                    $("#league-modal").modal("show");

                }
            });
            $(".team-list").on("change", function () {
                if ($(this).val() == "other") {
                    $(".messaage").html("");
                    VAIUU.FormReset("#teaminput");
                    $("#team-modal").modal("show");
                }
            });
            $(".logoicon img").on("click", function () {
                $(this).attr("src", BASE_URL + "assets/css/images/greenlogo.jpg");
            });
            $(".gender1").on("click", function () {
                $(this).removeClass("btngrad1").addClass("btngrad2");
                $(".gender2").removeClass("btngrad2").addClass("btngrad1");
                $("#gender").val("Female");
            });
            $(".gender2").on("click", function () {
                $(this).removeClass("btngrad1").addClass("btngrad2");
                $(".gender1").removeClass("btngrad2").addClass("btngrad1");
                $("#gender").val("Male");
            });
            // Side menu 
            $(".sidemenucontainer").hide();
            $(".sidemenubackdrop").on("click", function () {
                $(this).parent().hide("slide", 500);
            });
            $("#listicon").on("click", function () {
                $(".sidemenucontainer").show("slide", 500);
            });
            $("#menuicon").on("click", function () {
                $(".tooglablemenu").toggle("blind");
            });
            $('.add .carousel').each(function () {
                $(this).carousel({
                    interval: false
                });
            });
            $(".sociallogin,.instruction").tooltip({
                show: null,
                position: {
                    my: "left top",
                    at: "left bottom"
                },
                open: function (event, ui) {
                    ui.tooltip.animate({top: ui.tooltip.position().top + 10}, "fast");
                }
            });
            $(document.body).on("click", ".btn-pic-reset", function () {
                $("#profileimage").attr("src", prevoiusimage);
                $("#profile_picture").val("");
            });
            $(".btn-upload").on("click", function () {
                $(this).parent().find(".picturefile").trigger("click");
            });
            $(".exit-league").on("click", function () {
                var x = confirm("Do you want to exit this league?");
                if (x) {
                    // call a function to exit
                }
            });
            $(".demo-avatar img").on("click", function () {
                var imgsrc = $(this).attr("src");
                $("#changeprofileimage").attr("src", imgsrc);
                $("#profile_picture").val(imgsrc);
                $(".imageactionbutton").show();
                $("html, body").animate({
                    scrollTop: 0
                }, 500);
            });
            $(document.body).on("click", ".btn-send", function () {
                $("#uploadimage").trigger("click");
            });
            $(window).resize(function () {
                console.log($(window).width());
                console.log($(window).height());
            })
            $(document.body).on("click", ".btn-guess-edit", function () {
                FIELD1 = $(this).parent().parent().find(".goal-team1 div").text();
                FIELD2 = $(this).parent().parent().find(".goal-team2 div").text();
                var field1 = '<input type="number" value="' + FIELD1 + '" class="inline-goal" required="required" min="0" max="100">';
                var field2 = '<input type="number" value="' + FIELD2 + '" class="inline-goal" required="required" min="0" max="100">';
                $(this).parent().parent().find(".goal-team1 div").html(field1);
                $(this).parent().parent().find(".goal-team2 div").html(field2);
                $(this).hide().parent().find(".btn-guess-save,.btn-guess-cancel").show();

            });
            $(document.body).on("click", ".btn-guess-cancel", function () {
                $(this).parent().parent().find(".goal-team1 div").html(FIELD1);
                $(this).parent().parent().find(".goal-team2 div").html(FIELD2);
                $(this).parent().find(".btn-guess-save,.btn-guess-cancel").hide();
                $(this).parent().find(".btn-guess-edit").show();
            });
            $(document.body).on("click", ".btn-guess-save", function () {
                FIELD1 = $(this).parent().parent().find(".goal-team1 div input").val();
                FIELD2 = $(this).parent().parent().find(".goal-team2 div input").val();
                var gameid = $(this).parent().parent().data("play");

                VAIUU.AjaxFormValueCheck("controller/Ajaxcall.php", "post", "team1score=" + FIELD1 + "&team2score=" + FIELD2 + "&method=addmyscore" + "&gameid=" + gameid, CALLBACK.AjaxGoalNumberSubmit);
                $(this).parent().parent().find(".goal-team1 div").html(FIELD1);
                $(this).parent().parent().find(".goal-team2 div").html(FIELD2);
                $(this).parent().find(".btn-guess-save,.btn-guess-cancel").hide();
                $(this).parent().find(".btn-guess-edit").show();
            });
            $(".cancelupload").on("click", function () {
                var previousimg = $("#previousimage").val();
                $("#changeprofileimage").attr("src", previousimg);
                $("#profile_picture").val("");
                $(".imageactionbutton").hide();
            });
            $(".proceedupload").on("click", function () {
                $("#uploadimage").trigger("click");
            });
            $("#leagueinput input[name=league_name]").on("keyup", function () {
                VAIUU.AjaxFormValueCheck("controller/Ajaxcall.php", "post", "league_name=" + $(this).val() + "&method=leaguecheck" + "&token=" + $("#leagueinput input[name=token]").val(), CALLBACK.AjaxLeaguecheck);
            });
            $("#teaminput input[name=teamname]").on("keyup", function () {
                VAIUU.AjaxFormValueCheck("controller/Ajaxcall.php", "post", "teamname=" + $(this).val() + "&method=teamcheck" + "&token=" + $("#teaminput input[name=token]").val(), CALLBACK.AjaxTeamCheck);
            });
            $("#login input[name=user_id_name],#login input[name=user_password],#signup input[name=user_password]").on("keyup", function () {
                var Pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,50}$/;
                var fieldvalue = $(this).val();
                if (fieldvalue != "") {
                    $(this).prev().removeClass("error correct loader").addClass("loader");
                    if (Pattern.test(fieldvalue)) {
                        $(this).parent().find(".error-message").hide("slow").html("");
                        $(this).prev().removeClass("error correct loader").addClass("correct");
                    } else {
                        $(this).parent().find(".error-message").show("slow").html("Must have 8 character including at least 1 uppercase,1 lowercas and 1 number");
                        $(this).prev().removeClass("error correct loader").addClass("error");
                    }
                }
                if (fieldvalue == "") {
                    $(this).parent().find(".error-message").hide("slow").html("");
                    $(this).parent().find(".signal").removeClass("error correct loader");
                }
            }).on("focusout", function () {
                $(this).parent().find(".error-message").hide("slow").html("");
            });
            $("#signup input[name=retyped_user_password]").on("keyup", function () {
                var Pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,20}$/;
                var fieldvalue = $(this).val();
                var matchval = $("#signup input[name=user_password]").val();
                if (fieldvalue != "") {
                    if (Pattern.test(fieldvalue) && fieldvalue == matchval) {
                        $(this).parent().find(".error-message").hide("slow").html("");
                        $(this).prev().removeClass("error correct loader").addClass("correct");
                    } else {
                        $(this).parent().find(".error-message").show("slow").html("Must match with previous given password");
                        $(this).prev().removeClass("error correct loader").addClass("error");
                    }
                }
                if (fieldvalue == "") {
                    $(this).parent().find(".error-message").hide("slow").html("");
                    $(this).prev().removeClass("error correct loader");
                }
            }).on("focusout", function () {
                $(this).parent().find(".error-message").hide("slow").html("");
            });
            $("#signup input[type=email]").on("keyup", function () {
                var Pattern = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
                var fieldvalue = $(this).val();
                if (fieldvalue != "") {
                    if (Pattern.test(fieldvalue)) {
                        $(this).parent().find(".error-message").hide("slow").html("");
                        $(this).prev().removeClass("error correct loader").addClass("loader");
                        VAIUU.AjaxFormValueCheck("controller/Ajaxcall.php", "post", "user_email=" + fieldvalue + "&method=emailcheck" + "&token=" + $("#signup input[name=token]").val(), CALLBACK.AjaxEmailcheck);
                    } else {
                        $(this).parent().find(".error-message").show("slow").html("Email pattern is not valid.");
                        $(this).prev().removeClass("error correct loader").addClass("error");
                    }
                }
                if (fieldvalue == "") {
                    $(this).parent().find(".error-message").hide("slow").html("");
                    $(this).prev().removeClass("error correct loader");
                }
            }).on("focusout", function () {
                $(this).parent().find(".error-message").hide("slow").html("");
            });
            $(".guess").on("click", function () {
                VAIUU.AjaxFormValueCheck("controller/Account.php", "post", "team1Name=" + $(this).data("team1") + "&team2Name=" + $(this).data("team2") + "&gameid=" + $(this).data("gameid") + "&method=guess", CALLBACK.GuessInfoAlert);
            });
            
            $("#signup input[name=user_id_name]").on("keyup", function () {
                var Pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,150}$/;
                var fieldvalue = $(this).val();
                if (fieldvalue != "") {
                    if (Pattern.test(fieldvalue)) {
                        $(this).prev().removeClass("error correct loader").addClass("loader");
                        VAIUU.AjaxFormValueCheck("controller/Ajaxcall.php", "post", "user_id_name=" + fieldvalue + "&method=useridnamecheck" + "&token=" + $("#signup input[name=token]").val(), CALLBACK.AjaxUserNamecheck);
                    } else {
                        $(this).parent().find(".error-message").show("slow").html("Must have 8 character including at least 1 uppercase,1 lowercas and 1 number");
                        $(this).prev().removeClass("error correct loader").addClass("error");
                    }
                }
                if (fieldvalue == "") {
                    $(this).parent().find(".error-message").hide("slow").html("");
                    $(this).prev().removeClass("error correct loader");
                }
            }).on("focusout", function () {
                $(this).parent().find(".error-message").hide("slow").html("");
            });
            /** Form Submit Login **/
            $(".btnlogin").on("click", function () {
                $("#submitlogin").trigger("click");
            });
            $(".add-button").on("click", function () {
                VAIUU.AjaxFormValueCheck("controller/Ajaxcall.php", "post", "method=addbonus", CALLBACK.AddBonus);
            });
            $(".add-sponsor-button").on("click", function () {
                var url = $(this).data("redirect");
                if (url != "") {
                    window.location.href = url;
                }

            });
            $(document.body).on("click", ".add-month-bonus", function () {
                VAIUU.AjaxFormValueCheck("controller/Ajaxcall.php", "post", "method=addbonus", CALLBACK.AddBonus);
            });
            $(document.body).on("click", "#delete-sms", function () {
                var smsid = $(this).data("msis");
                VAIUU.AjaxFormValueCheck("controller/Ajaxcall.php", "post", "method=deletesms&smsis=" + smsid, CALLBACK.DeleteSms);
            });
            $(document.body).on("click", ".add-to-group", function () {
                var smsid = $(this).data("invitationid");
                VAIUU.AjaxFormValueCheck("controller/Ajaxcall.php", "post", "method=addToCircle&smsis=" + smsid, CALLBACK.AddToCircle);
            });
            $(document.body).on("submit", "#myguessform", function (event) {
                event.preventDefault();
                VAIUU.AjaxForm("controller/Account.php", "post", "#myguessform", "method=updatemyguess", "containermyguess", CALLBACK.UpdateMyGuess);
            });
            $(document.body).on("submit", "#invitationform", function (event) {
                event.preventDefault();
                VAIUU.AjaxForm("controller/Account.php", "post", "#invitationform", "method=joinmyleague", "containerjoin", CALLBACK.sendInvitation);
            });
            $("#login").submit(function (event) {
                event.preventDefault();
                VAIUU.AjaxForm("controller/Account.php", "post", "#login", "method=userlogin", "logincontainer", CALLBACK.Login);
            });
            $("#changePassword").submit(function (event) {
                event.preventDefault();
                VAIUU.AjaxForm("controller/Account.php", "post", "#changePassword", "method=changepassword", "changePasswordContainer", CALLBACK.Changepassword);
            });
            $("#resend-activation-link").submit(function (event) {
                event.preventDefault();
                VAIUU.AjaxForm("controller/Account.php", "post", "#resend-activation-link", "method=resendal", "logincontainer", CALLBACK.ResendAl);
            });
            $("#leagueinput").submit(function (event) {
                event.preventDefault();
                VAIUU.AjaxForm("controller/Account.php", "post", "#leagueinput", "method=leagueinsert", "logincontainer", CALLBACK.AddLeague);
            });
            $("#teaminput").submit(function (event) {
                event.preventDefault();
                VAIUU.AjaxForm("controller/Account.php", "post", "#teaminput", "method=teaminput", "logincontainer2", CALLBACK.AddTeam);
            });
            $("#retrievepassword").submit(function (event) {
                event.preventDefault();
                VAIUU.AjaxForm("controller/Account.php", "post", "#retrievepassword", "method=passwordretrieve", "logincontainer", CALLBACK.RetrievePassword);
            });
            /** Form Submit Signup **/
            $(".btn-signup-submit").on("click", function () {
                $("#submitsignup").trigger("click");
            });
            $(document.body).on("change", "#picturefile", function () {
                VAIUU.CanvasUploadImageFile();
            });
            $("#profileimage").on("click", function () {
                $(".fileactionbutton").toggleClass("hidden");
            });
            $("#upload-image").submit(function (event) {
                event.preventDefault();
                VAIUU.AjaxForm("controller/Account.php", "post", "#upload-image", "method=updateimage", "user-image", CALLBACK.UpdateImage);
            });
            $("#signup").submit(function (event) {
                $(this).find(".error-message").hide("slow").html("");
                event.preventDefault();
                VAIUU.AjaxForm("controller/Account.php", "post", "#signup", "method=registration", "signupcontainer", CALLBACK.MandatoryRegForm);
            });
            $("#insert-game").submit(function (event) {
                event.preventDefault();
                if ($("#team1").val() == $("#team2").val()) {
                    alert("Team1 and Team2 can not be same.");
                } else {
                    VAIUU.AjaxForm("controller/Account.php", "post", "#insert-game", "method=gamecreate", "container3", CALLBACK.GameCreate);
                }
            });
            // Update Settings page
            $("#form-settings").submit(function (event) {
                event.preventDefault();
                VAIUU.AjaxForm("controller/Account.php", "post", "#form-settings", "method=updatesettings", "editprofilecontainer", CALLBACK.UpdateSettings);
            });
            // Login form
            $("#adminlogin").submit(function (event) {
                $(this).find(".error-message").hide("slow").html("");
                event.preventDefault();
                VAIUU.AjaxForm("controller/Account.php", "post", "#adminlogin", "method=userlogin", "signupcontainer", CALLBACK.AdminLogin);
            });
            $(".dummy-select").on("change", function () {
                var selection = $("option:selected", this).text();
                if (selection == "Favorite Team" || selection == "Nationality") {
                    $(this).parent().find(".dummy-input").val("");
                } else {
                    $(this).parent().find(".dummy-input").val(selection);
                }

            });


        },
        CacheElements: function () {

        },
        Utils: function () {

        },
        Log: function (data) {
            console.log("Log || " + data);
        },
        AjaxForm: function (pageurl, method, el, parameters, containerid, callback) {
            $("#ajaxloader").show();
            $.ajax({
                url: BASE_URL + pageurl,
                type: "POST",
                data: $(el).serialize() + "&" + parameters,
                success: function (jsonObject) {
                    $("#ajaxloader").hide();
                    var jsonData = JSON.parse(jsonObject);
                    callback(jsonData);

                }

            });
        },
        AjaxFormValueCheck: function (pageurl, method, parameters, Ajaxcallback) {
            $.ajax({
                url: BASE_URL + pageurl,
                type: "POST",
                data: parameters,
                success: function (jsonObject) {
                    var jsonData = JSON.parse(jsonObject);
                    Ajaxcallback(jsonData);
                }
            });
        },
        GetFileInfo: function (id, property) {
            var file = $('#' + id)[0].files[0];
            if (property == "filename") {
                return file.name;
            }
            if (property == "filesize") {
                return file.size;
            }
            if (property == "filetype") {
                var sFileName = file.name;
                var fileext = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
                return fileext;
            }
        },
        CanvasUploadImageFile: function () {
            var reader = new FileReader();
            var asrc = reader.readAsDataURL($('#picturefile')[0].files[0]);
            reader.onload = function (e) {
                var asrc = e.target.result;
                var image = new Image();
                image.onload = function () {
                    var canvas = document.getElementById("profilecanvus");
                    image.width = 150;
                    image.height = 150;
                    var ctx = canvas.getContext("2d");
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    canvas.width = image.width;
                    canvas.height = image.height;
                    ctx.drawImage(image, 0, 0, image.width, image.height);
                    var m = canvas.toDataURL("image/jpg");
                    $("#profileimage").attr("src", m);
                    $("#profile_picture").val(m);
                };
                image.src = asrc;
            }
        },
        FormReset: function (el) {
            $(el)[0].reset();
        }
    };
    var CALLBACK = {
        MandatoryRegForm: function (data) {
            $("#signup").prev().html("<div class='alert alert-" + data.styleclass + "'>" + data.message + "</div>");
            if (data.success === true) {
                $("#signup input").prev().removeClass("error correct loader");
                VAIUU.FormReset("#signup");
            }
        },
        GameCreate: function (data) {
            $("#insert-game").prev().html("<div class='alert alert-" + data.styleclass + "'>" + data.message + "</div>");
            if (data.success === true) {
                VAIUU.FormReset("#insert-game");
            }
        },
        UpdateSettings: function (data) {
            $("#form-settings").prev().html("<div class='alert alert-" + data.styleclass + "'>" + data.message + "</div>");
            if (data.success === true) {
                $("#form-settings input").prev().removeClass("error correct loader");
            }
        },
        AjaxEmailcheck: function (data) {
            if (data.success == false) {
                $("input[type=email]").parent().find(".error-message").show("slow").html(data.message);
                $("input[type=email]").prev().removeClass("correct error loader").addClass("error");
            }
            if (data.success == true) {
                $("input[type=email]").parent().find(".error-message").hide("slow").html("");
                $("input[type=email]").prev().removeClass("correct error loader").addClass("correct");
            }
        },
        AjaxLeaguecheck: function (data) {
            if (data.success == false) {
                $("#leagueinput").parent().find(".alert-custom").show("slow").html(data.message).css("color", "red");

            }
            if (data.success == true) {
                $("#leagueinput").parent().find(".alert-custom").show("slow").html(data.message).css("color", "yellowgreen");

            }
        },
        AjaxTeamCheck: function (data) {
            if (data.success == false) {
                $("#teaminput").parent().find(".alert-custom").show("slow").html(data.message).css("color", "red");

            }
            if (data.success == true) {
                $("#teaminput").parent().find(".alert-custom").show("slow").html(data.message).css("color", "yellowgreen");

            }
        },
        AjaxGoalNumberSubmit: function (data) {
            if (data.field == 0) {
                alert(data.message);
            } else {
                if (data.success == true) {
                    $("#data_" + data.field).append("<div class='return-message' style='color:green'>" + data.message + "</div>");
                } else {
                    $("#data_" + data.field).append("<div class='return-message' style='color:red'>" + data.message + "</div>");
                }

            }
        },
        AjaxAddFriend: function (data) {
            if (data.success == true) {
                $("#user_" + data.field).removeClass("btn-default").addClass("btn-warning").removeAttr("data-id").text("Pending");
            }
            alert(data.message);
        },
        AjaxDeleteFriend: function (data) {
            if (data.success == true) {
                $("#user_" + data.field).parent().parent().parent().remove();
            }
            alert(data.message);
        },
        LeaveLeague: function (data) {
            alert(data.message);
            window.location.href="leader-board.php";
        },
        AjaxUserNamecheck: function (data) {
            if (data.success == false) {
                $("input[name=user_id_name]").parent().find(".error-message").show("slow").html(data.message);
                $("input[name=user_id_name]").prev().removeClass("correct error loader").addClass("error");
            }
            if (data.success == true) {
                $("input[name=user_id_name]").parent().find(".error-message").hide("slow").html("");
                $("input[name=user_id_name]").prev().removeClass("correct error loader").addClass("correct");
            }
        },
        GuessInfoAlert: function (data) {
            if (data.success == false) {
                var colorCode = "red";
            } else {
                var colorCode = "yellowgreen";
            }
            $("#myguessmodal .modal-title").html(data.title).css("color", colorCode);
            if (data.success == false) {
                $("#myguessmodal .modal-body").html(data.message);
            } else {
                $("#myguessmodal .modal-body").html($("#insertaction").html());
                $(".gteam1").html(data.datas.team1name);
                $(".gteam2").html(data.datas.team2name);
                $("#team1score").val(data.datas.team1score);
                $("#team2score").val(data.datas.team2score);
                $("#guessgameid").val(data.datas.gameid);
            }
            $("#myguessmodal").modal("show");
        },
        AddBonus: function (data) {
            alert(data.message);
            $(".sponser-number .shape-circle").html(data.field);
        },
        DeleteSms: function (data) {
            alert(data.message);
            window.location.href = "mail_invitations.php";
        },
        AddToCircle: function (data) {
            alert(data.message);
        },
        Login: function (data) {
            $("#login").prev().html("<div class='alert alert-" + data.styleclass + "'>" + data.message + "</div>");
            $("#login input").prev().removeClass("error correct loader");
            VAIUU.FormReset("#login");
            if (data.success === true) {
                setTimeout(function () {
                    window.location.href = data.field;
                }, 500);
            } else {
                $("#login input[name=user_id_name],#login input[name=user_password]").prev().addClass("error");
            }
        },
        UpdateMyGuess: function (data) {
            $("#myguessform").prev().html("<div class='alert alert-" + data.styleclass + "'>" + data.message + "</div>");
            var rowid = "#page1_" + $("#myguessform #guessgameid").val();
            var team1Goal = $("#myguessform #team1score").val();
            var team2Goal = $("#myguessform #team2score").val();
            if (data.success == true) {
                $(rowid + " .box11").html(team1Goal);
                $(rowid + " .box22").html(team2Goal);
            }
            setTimeout(function () {
                $("#myguessmodal").modal("hide");
            }, 3000);

        },
        sendInvitation: function (data) {
            $("#invitationform").prev().html("<div class='alert alert-" + data.styleclass + "'>" + data.message + "</div>");
            VAIUU.FormReset("#invitationform");
        },
        Changepassword: function (data) {
            $("#changePassword").prev().html("<div class='alert alert-" + data.styleclass + "'>" + data.message + "</div>");
            if (data.success === true) {
                VAIUU.FormReset("#changePassword");
                setTimeout(function () {
                    $("#reset-password").modal("hide");
                }, 3000);
            }
        },
        ResendAl: function (data) {
            $("#resend-activation-link").prev().html("<div class='alert alert-" + data.styleclass + "'>" + data.message + "</div>");
            $("#resend-activation-link input").prev().removeClass("error correct loader");
            VAIUU.FormReset("#resend-activation-link");
            if (data.success === true) {
                setTimeout(function () {
                    $("#resend-r-link").modal("hide");
                }, 5000);
            }
        },
        AddLeague: function (data) {
            $("#leagueinput").prev().html("<div class='alert alert-" + data.styleclass + "'>" + data.message + "</div>");
            VAIUU.FormReset("#leagueinput");
            if (data.success === true) {
                $("#league-name").append('<option value="' + data.field + '" selected="selected">' + data.league_name + '</option>');
                setTimeout(function () {
                    $("#league-modal").modal("hide");
                }, 3000);
            }
        },
        AddTeam: function (data) {
            $("#teaminput").prev().html("<div class='alert alert-" + data.styleclass + "'>" + data.message + "</div>");
            VAIUU.FormReset("#teaminput");
            if (data.success === true) {
                $(".team-list").append('<option value="' + data.field + '" selected="selected">' + data.team_name + '</option>');
                setTimeout(function () {
                    $("#team-modal").modal("hide");
                }, 3000);
            }
        },
        RetrievePassword: function (data) {
            $("#retrievepassword").prev().html("<div class='alert alert-" + data.styleclass + "'>" + data.message + "</div>");
            $("#retrievepassword input").prev().removeClass("error correct loader");
            VAIUU.FormReset("#retrievepassword");
            if (data.success === true) {
                setTimeout(function () {
                    window.location.href = "signin.php";
                }, 5000);
            } else {
                $("#retrievepassword input[name=user_email]").prev().addClass("error");
            }
        },
        UpdateImage: function (data) {
            $(".imageactionbutton").html(data.message).css("color", "orange");
            setTimeout(function () {
                window.location.href = "avatar.php";
            }, 3000);
        }
    }
    VAIUU.Initialize();
});





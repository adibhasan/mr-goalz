jQuery(function ($) {
    'use strict';
    var VALIDFILE = ["jpg", "png", "gif"];
    var DUMMYIMAGE = "data:image/jpeg;base64,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AGxmZgAGAAAAAAABAC9mZgABAKGZmgAGAAAAAAABADIAAAABAFoAAAAGAAAAAAABADUAAAABAC0AAAAGAAAAAAABOEJJTQP4AAAAAABwAAD/////////////////////////////A+gAAAAA/////////////////////////////wPoAAAAAP////////////////////////////8D6AAAAAD/////////////////////////////A+gAADhCSU0EAAAAAAAAAgAPOEJJTQQCAAAAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4QklNBDAAAAAAABABAQEBAQEBAQEBAQEBAQEBOEJJTQQtAAAAAAAGAAEAAAAQOEJJTQQIAAAAAAAQAAAAAQAAAkAAAAJAAAAAADhCSU0EHgAAAAAABAAAAAA4QklNBBoAAAAAA0sAAAAGAAAAAAAAAAAAAAC3AAAAkwAAAAsAVQBuAGIAZQBuAGEAbgBuAHQALQAxAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAACTAAAAtwAAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAAAAAAAAABAAAAABAAAAAAAAbnVsbAAAAAIAAAAGYm91bmRzT2JqYwAAAAEAAAAAAABSY3QxAAAABAAAAABUb3AgbG9uZwAAAAAAAAAATGVmdGxvbmcAAAAAAAAAAEJ0b21sb25nAAAAtwAAAABSZ2h0bG9uZwAAAJMAAAAGc2xpY2VzVmxMcwAAAAFPYmpjAAAAAQAAAAAABXNsaWNlAAAAEgAAAAdzbGljZUlEbG9uZwAAAAAAAAAHZ3JvdXBJRGxvbmcAAAAAAAAABm9yaWdpbmVudW0AAAAMRVNsaWNlT3JpZ2luAAAADWF1dG9HZW5lcmF0ZWQAAAAAVHlwZWVudW0AAAAKRVNsaWNlVHlwZQAAAABJbWcgAAAABmJvdW5kc09iamMAAAABAAAAAAAAUmN0MQAAAAQAAAAAVG9wIGxvbmcAAAAAAAAAAExlZnRsb25nAAAAAAAAAABCdG9tbG9uZwAAALcAAAAAUmdodGxvbmcAAACTAAAAA3VybFRFWFQAAAABAAAAAAAAbnVsbFRFWFQAAAABAAAAAAAATXNnZVRFWFQAAAABAAAAAAAG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P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA0LjIuMi1jMDYzIDUzLjM1MjYyNCwgMjAwOC8wNy8zMC0xODoxMjoxOCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIiB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iIHhtbG5zOnRpZmY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vdGlmZi8xLjAvIiB4bWxuczpleGlmPSJodHRwOi8vbnMuYWRvYmUuY29tL2V4aWYvMS4wLyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M0IFdpbmRvd3MiIHhtcDpNZXRhZGF0YURhdGU9IjIwMTEtMDMtMTNUMjA6MjE6MDkrMDE6MDAiIHhtcDpNb2RpZnlEYXRlPSIyMDExLTAzLTEzVDIwOjIxOjA5KzAxOjAwIiB4bXA6Q3JlYXRlRGF0ZT0iMjAxMS0wMy0xM1QyMDoyMTowOSswMTowMCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo3ODVGQzkwQ0E3NERFMDExQTE4RThBNTRFODM3NzRFNyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo3NzVGQzkwQ0E3NERFMDExQTE4RThBNTRFODM3NzRFNyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ4bXAuZGlkOjc3NUZDOTBDQTc0REUwMTFBMThFOEE1NEU4Mzc3NEU3IiBkYzpmb3JtYXQ9ImltYWdlL2pwZWciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgdGlmZjpPcmllbnRhdGlvbj0iMSIgdGlmZjpYUmVzb2x1dGlvbj0iNzIwMDAwLzEwMDAwIiB0aWZmOllSZXNvbHV0aW9uPSI3MjAwMDAvMTAwMDAiIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiIHRpZmY6TmF0aXZlRGlnZXN0PSIyNTYsMjU3LDI1OCwyNTksMjYyLDI3NCwyNzcsMjg0LDUzMCw1MzEsMjgyLDI4MywyOTYsMzAxLDMxOCwzMTksNTI5LDUzMiwzMDYsMjcwLDI3MSwyNzIsMzA1LDMxNSwzMzQzMjswMTNCRThCMjFGNDAxMzY4NkQ3NTAzMjE4NDBCMzk3MyIgZXhpZjpQaXhlbFhEaW1lbnNpb249IjE0NyIgZXhpZjpQaXhlbFlEaW1lbnNpb249IjE4MyIgZXhpZjpDb2xvclNwYWNlPSIxIiBleGlmOk5hdGl2ZURpZ2VzdD0iMzY4NjQsNDA5NjAsNDA5NjEsMzcxMjEsMzcxMjIsNDA5NjIsNDA5NjMsMzc1MTAsNDA5NjQsMzY4NjcsMzY4NjgsMzM0MzQsMzM0MzcsMzQ4NTAsMzQ4NTIsMzQ4NTUsMzQ4NTYsMzczNzcsMzczNzgsMzczNzksMzczODAsMzczODEsMzczODIsMzczODMsMzczODQsMzczODUsMzczODYsMzczOTYsNDE0ODMsNDE0ODQsNDE0ODYsNDE0ODcsNDE0ODgsNDE0OTIsNDE0OTMsNDE0OTUsNDE3MjgsNDE3MjksNDE3MzAsNDE5ODUsNDE5ODYsNDE5ODcsNDE5ODgsNDE5ODksNDE5OTAsNDE5OTEsNDE5OTIsNDE5OTMsNDE5OTQsNDE5OTUsNDE5OTYsNDIwMTYsMCwyLDQsNSw2LDcsOCw5LDEwLDExLDEyLDEzLDE0LDE1LDE2LDE3LDE4LDIwLDIyLDIzLDI0LDI1LDI2LDI3LDI4LDMwOzRCOTFCREYyRDVDNkQzQTAzMDk5QUE4QTIzMzdDODAzIj4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY3JlYXRlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo3NzVGQzkwQ0E3NERFMDExQTE4RThBNTRFODM3NzRFNyIgc3RFdnQ6d2hlbj0iMjAxMS0wMy0xM1QyMDoyMTowOSswMTowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIENTNCBXaW5kb3dzIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo3ODVGQzkwQ0E3NERFMDExQTE4RThBNTRFODM3NzRFNyIgc3RFdnQ6d2hlbj0iMjAxMS0wMy0xM1QyMDoyMTowOSswMTowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIENTNCBXaW5kb3dzIiBzdEV2dDpjaGFuZ2VkPSIvIi8+IDwvcmRmOlNlcT4gPC94bXBNTTpIaXN0b3J5PiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8P3hwYWNrZXQgZW5kPSJ3Ij8+/+IMWElDQ19QUk9GSUxFAAEBAAAMSExpbm8CEAAAbW50clJHQiBYWVogB84AAgAJAAYAMQAAYWNzcE1TRlQAAAAASUVDIHNSR0IAAAAAAAAAAAAAAAEAAPbWAAEAAAAA0y1IUCAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA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";
    var VAIUU = {
        Initialize: function () {
            this.CacheElements();
            this.BindEvents();

        },
        BindEvents: function () {
            VAIUU.Render("modalcontainer", null, "temp-confirm-alert");
            $("body").on("click", function () {
                $(".alert-custom").find(".alert").fadeOut("400", function () {
                    $(".alert-custom").html("");
                })
            });
            $(".linkto").on("click", function () {
                var ownparentid = $(this).data("ownstate");
                var brotherparentid = $(this).data("brotherstate");
                $("." + ownparentid).fadeOut("3000", function () {
                    $("." + brotherparentid).fadeIn();
                });

            });
            $('#userlist').DataTable();
            $("#gameschedule").mask("9999-99-99 99:99:99");
            $("#userlist_wrapper .delete").on("click", function () {
                var id = $(this).data("id");
                $("#alertmodal #datadelete").val("");
                VAIUU.FormReset("#datadelete");
                $("#datadelete input[name=userid]").val(id);
                $("#datadelete input[name=container]").val(1);
                $("#alertmodal").modal();
            });
            $(document.body).on("click", "#yes", function () {
                $("#datadelete input[type=submit]").trigger("click");
            });
            $(".deleteadmin").on("click", function () {
                var adminid = $(this).data("id");
                var r = confirm("Do you want to delete this item?");
                if (r == true) {
                    $("#ajaxloader").show();
                    VAIUU.AjaxFormValueCheck("admin/controller/Account.php", "deleteuser", "method=deleteuser&usertype=admin&" + "userid=" + adminid, CALLBACK.userDelete);
                }
            });
            $(".deleteteam").on("click", function () {
                var teamid = $(this).data("id");
                var r = confirm("Do you want to delete this item?");
                if (r == true) {
                    $("#ajaxloader").show();
                    VAIUU.AjaxFormValueCheck("admin/controller/Account.php", "deleteuser", "method=deleteuser&usertype=team&" + "userid=" + teamid, CALLBACK.userDelete);
                }
            });
            $(".deleteleague").on("click", function () {
                var id = $(this).data("id");
                var r = confirm("Do you want to delete this item?");
                if (r == true) {
                    $("#ajaxloader").show();
                    VAIUU.AjaxFormValueCheck("admin/controller/Account.php", "deleteuser", "method=deleteuser&usertype=league&" + "leagueid=" + id, CALLBACK.userDelete);
                }
            });
            $("#commonuserstatus").on("change", function () {
                var filedvalue = $(this).val();
                var userid = $(this).data("id");
                VAIUU.AjaxFormValueCheck("admin/controller/Account.php", "updateuserstatus", "method=updateuserstatus&status=" + filedvalue + "&userid=" + userid, CALLBACK.userUpdate);
            });
            $(document).ready(function () {
                $('#adminlogin').bootstrapValidator({
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        adminemail: {
                            validators: {
                                notEmpty: {
                                    message: 'Email is required'
                                }
                            }
                        },
                        adminpassword: {
                            validators: {
                                notEmpty: {
                                    message: 'Password is required'
                                }
                            }
                        }
                    }
                }).on('success.form.bv', function (e) {
                    e.preventDefault();
                    $("#ajaxloader").show();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        CALLBACK.adminLogin(result);
                    }, 'json');
                });
                $('#updateusername').bootstrapValidator({
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        adminname: {
                            validators: {
                                notEmpty: {
                                    message: 'Admin name is required'
                                },
                                stringLength: {
                                    max: 50,
                                    min: 2,
                                    message: 'Admin name  must be more than 2 characters and  less than 50 characters'
                                }
                            }
                        }
                    }
                }).on('success.form.bv', function (e) {
                    e.preventDefault();
                    $("#ajaxloader").show();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        CALLBACK.updateUserName(result);
                    }, 'json');
                });
                $('#updateadmin').bootstrapValidator({
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        adminname: {
                            validators: {
                                notEmpty: {
                                    message: 'Admin name is required'
                                },
                                stringLength: {
                                    max: 50,
                                    min: 2,
                                    message: 'Admin name  must be more than 2 characters and  less than 50 characters'
                                }
                            }
                        },
                        status: {
                            validators: {
                                notEmpty: {
                                    message: 'Status is required'
                                },
                                stringLength: {
                                    max: 10,
                                    min: 2,
                                    message: 'Status must be active, pending or blocked.'
                                }
                            }
                        },
                        adminemail: {
                            validators: {
                                notEmpty: {
                                    message: 'Admin email is required'
                                },
                                stringLength: {
                                    max: 50,
                                    min: 2,
                                    message: 'Admin email  must be more than 5 characters and  less than 100 characters'
                                }
                            }
                        }
                    }
                }).on('success.form.bv', function (e) {
                    e.preventDefault();
                    $("#ajaxloader").show();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        CALLBACK.updateAdminInfo(result);
                    }, 'json');
                });
                $('#addteam').bootstrapValidator({
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        teamname: {
                            validators: {
                                notEmpty: {
                                    message: 'Team name is required'
                                },
                                stringLength: {
                                    max: 50,
                                    min: 2,
                                    message: 'Team name  must be more than 2 character and  less than 50 characters'
                                }
                            }
                        },
                        description: {
                            validators: {
                                notEmpty: {
                                    message: 'Short description is required'
                                },
                                stringLength: {
                                    max: 200,
                                    min: 2,
                                    message: 'Short description  must be more than 2 character and  less than 200 characters'
                                }
                            }
                        },
                        status: {
                            validators: {
                                notEmpty: {
                                    message: 'Status is required'
                                }
                            }
                        }
                    }
                }).on('success.form.bv', function (e) {
                    e.preventDefault();
                    $("#ajaxloader").show();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        CALLBACK.teamInsert(result);
                    }, 'json');
                });
                $('#addgame').bootstrapValidator({
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        leagueid: {
                            validators: {
                                notEmpty: {
                                    message: 'League name is required'
                                }
                            }
                        },
                        team1: {
                            validators: {
                                notEmpty: {
                                    message: 'Team1 name is required'
                                }
                            }
                        },
                        team2: {
                            validators: {
                                notEmpty: {
                                    message: 'Team2 name is required'
                                }
                            }
                        },
                        schedule: {
                            validators: {
                                notEmpty: {
                                    message: 'Schedule is required'
                                },
                                stringLength: {
                                    max: 20,
                                    min: 16,
                                    message: 'Please check the requested format'
                                }
                            }
                        },
                        description: {
                            validators: {
                                notEmpty: {
                                    message: 'Short description is required'
                                },
                                stringLength: {
                                    max: 1000,
                                    min: 2,
                                    message: 'Short description  must be more than 2 character and  less than 1000 characters'
                                }
                            }
                        },
                        status: {
                            validators: {
                                notEmpty: {
                                    message: 'Status is required'
                                }
                            }
                        }
                    }
                }).on('success.form.bv', function (e) {
                    e.preventDefault();
                    $("#ajaxloader").show();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        CALLBACK.gameInsert(result);
                    }, 'json');
                });
                $('#updategame').bootstrapValidator({
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        leagueid: {
                            validators: {
                                notEmpty: {
                                    message: 'League name is required'
                                }
                            }
                        },
                        team1: {
                            validators: {
                                notEmpty: {
                                    message: 'Team1 name is required'
                                }
                            }
                        },
                        team2: {
                            validators: {
                                notEmpty: {
                                    message: 'Team2 name is required'
                                }
                            }
                        },
                        schedule: {
                            validators: {
                                notEmpty: {
                                    message: 'Schedule is required'
                                },
                                stringLength: {
                                    max: 20,
                                    min: 16,
                                    message: 'Please check the requested format'
                                }
                            }
                        },
                        description: {
                            validators: {
                                notEmpty: {
                                    message: 'Short description is required'
                                },
                                stringLength: {
                                    max: 1000,
                                    min: 2,
                                    message: 'Short description  must be more than 2 character and  less than 1000 characters'
                                }
                            }
                        },
                        status: {
                            validators: {
                                notEmpty: {
                                    message: 'Status is required'
                                }
                            }
                        }
                    }
                }).on('success.form.bv', function (e) {
                    e.preventDefault();
                    $("#ajaxloader").show();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        CALLBACK.gameUpdate(result);
                    }, 'json');
                });
                $('#addleague').bootstrapValidator({
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        league_name: {
                            validators: {
                                notEmpty: {
                                    message: 'League name is required'
                                },
                                stringLength: {
                                    max: 50,
                                    min: 2,
                                    message: 'League name  must be more than 2 character and  less than 50 characters'
                                }
                            }
                        },
                        description: {
                            validators: {
                                notEmpty: {
                                    message: 'Short description is required'
                                },
                                stringLength: {
                                    max: 1000,
                                    min: 2,
                                    message: 'Short description  must be more than 2 character and  less than 1000 characters'
                                }
                            }
                        },
                        status: {
                            validators: {
                                notEmpty: {
                                    message: 'Status is required'
                                }
                            }
                        }
                    }
                }).on('success.form.bv', function (e) {
                    e.preventDefault();
                    $("#ajaxloader").show();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        CALLBACK.leagueInsert(result);
                    }, 'json');
                });
                $('#updateteam').bootstrapValidator({
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        teamname: {
                            validators: {
                                notEmpty: {
                                    message: 'Team name is required'
                                },
                                stringLength: {
                                    max: 50,
                                    min: 2,
                                    message: 'Team name  must be more than 2 character and  less than 50 characters'
                                }
                            }
                        },
                        description: {
                            validators: {
                                notEmpty: {
                                    message: 'Short description is required'
                                },
                                stringLength: {
                                    max: 1000,
                                    min: 2,
                                    message: 'Short description  must be more than 2 character and  less than 1000 characters'
                                }
                            }
                        },
                        playtype: {
                            validators: {
                                notEmpty: {
                                    message: 'Play type is required'
                                },
                                stringLength: {
                                    max: 1000,
                                    min: 2,
                                    message: 'Short description  must be more than 2 character and  less than 1000 characters'
                                }
                            }
                        },
                        status: {
                            validators: {
                                notEmpty: {
                                    message: 'Status is required'
                                }
                            }
                        }
                    }
                }).on('success.form.bv', function (e) {
                    e.preventDefault();
                    $("#ajaxloader").show();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        CALLBACK.updateTeam(result);
                    }, 'json');
                });
                $('#updateleague').bootstrapValidator({
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        league_name: {
                            validators: {
                                notEmpty: {
                                    message: 'League name is required'
                                },
                                stringLength: {
                                    max: 100,
                                    min: 2,
                                    message: 'League name  must be more than 2 character and  less than 50 characters'
                                }
                            }
                        },
                        description: {
                            validators: {
                                notEmpty: {
                                    message: 'Short description is required'
                                },
                                stringLength: {
                                    max: 1000,
                                    min: 2,
                                    message: 'Short description  must be more than 2 character and  less than 1000 characters'
                                }
                            }
                        },
                        status: {
                            validators: {
                                notEmpty: {
                                    message: 'Status is required'
                                }
                            }
                        }
                    }
                }).on('success.form.bv', function (e) {
                    e.preventDefault();
                    $("#ajaxloader").show();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        CALLBACK.updateLeague(result);
                    }, 'json');
                });
                $('#changepassword').bootstrapValidator({
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        oldpassword: {
                            validators: {
                                notEmpty: {
                                    message: 'Old password is required'
                                }
                            }
                        },
                        adminpassword: {
                            validators: {
                                notEmpty: {
                                    message: 'New password is required'
                                },
                                stringLength: {
                                    max: 20,
                                    min: 8,
                                    message: 'Password must be at least 8 character long including 1 uppercase 1 lower case and 1 number'
                                }
                            }
                        },
                        retypedpassword: {
                            validators: {
                                notEmpty: {
                                    message: 'New password is required'
                                },
                                stringLength: {
                                    max: 20,
                                    min: 8,
                                    message: 'Password must be at least 8 character long including 1 uppercase 1 lower case and 1 number'
                                }
                            }
                        }
                    }
                }).on('success.form.bv', function (e) {
                    e.preventDefault();
                    $("#ajaxloader").show();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        CALLBACK.updateUserPassword(result);
                    }, 'json');
                });
                $('#createadmin').bootstrapValidator({
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        status: {
                            validators: {
                                notEmpty: {
                                    message: 'Status is required'
                                }
                            }
                        },
                        adminname: {
                            validators: {
                                notEmpty: {
                                    message: 'Admin name is required'
                                },
                                stringLength: {
                                    max: 50,
                                    min: 5,
                                    message: 'Min character length is 5 and Max character length is 50'
                                }
                            }
                        },
                        adminemail: {
                            validators: {
                                notEmpty: {
                                    message: 'Email is required'
                                },
                                stringLength: {
                                    max: 150,
                                    min: 5,
                                    message: 'Min character length is 5 and Max character length is 150'
                                }
                            }
                        },
                        adminpassword: {
                            validators: {
                                notEmpty: {
                                    message: 'New password is required'
                                },
                                stringLength: {
                                    max: 20,
                                    min: 8,
                                    message: 'Password must be at least 8 character long including 1 uppercase 1 lower case and 1 number'
                                }
                            }
                        },
                        retypedpassword: {
                            validators: {
                                notEmpty: {
                                    message: 'New password is required'
                                },
                                stringLength: {
                                    max: 20,
                                    min: 8,
                                    message: 'Password must be at least 8 character long including 1 uppercase 1 lower case and 1 number'
                                }
                            }
                        }
                    }
                }).on('success.form.bv', function (e) {
                    e.preventDefault();
                    $("#ajaxloader").show();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        CALLBACK.createAdminUser(result);
                    }, 'json');
                });
                $('#datadelete').bootstrapValidator().on('success.form.bv', function (e) {
                    e.preventDefault();
                    $("#ajaxloader").show();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        CALLBACK.teamInsert(result);
                    }, 'json');
                });
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
//                alert(asrc);

                var image = new Image();
                image.onload = function () {
                    var canvas = document.getElementById("profilecanvus");
//                    alert(image.width);
//                    alert(image.height);
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
        },
        Render: function (el, data, template) {
            $('#' + el).html(tmpl(template, data));
        }
    };
    var CALLBACK = {
        teamInsert: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
            $("#addteam [type=submit]").removeAttr("disabled");
            if (data.success == true) {
                VAIUU.FormReset("#addteam");
            }
        },
        leagueInsert: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
            $("#addleague [type=submit]").removeAttr("disabled");
            if (data.success == true) {
                VAIUU.FormReset("#addleague");
            }
        },
        gameInsert: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
            $("#addgame [type=submit]").removeAttr("disabled");
            if (data.success == true) {
                VAIUU.FormReset("#addgame");
            }
        },
        gameUpdate: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
            $("#updategame [type=submit]").removeAttr("disabled");
        },
        updateTeam: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
            $("#updateteam [type=submit]").removeAttr("disabled");
        },
        updateLeague: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
            $("#updateleague [type=submit]").removeAttr("disabled");
        },
        adminLogin: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
            $("#adminlogin [type=submit]").removeAttr("disabled");
            if (data.success == true) {
                VAIUU.FormReset("#adminlogin");
                if (data.redirecturl !== "") {
                    window.location.href = data.redirecturl;
                }
            }
        },
        updateUserName: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
            $("#updateusername [type=submit]").removeAttr("disabled");
            if (data.success == true) {
                $(".username").text($("#updateusername input[name=adminname]").val());
            }
        },
        updateUserPassword: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
            $("#changepassword [type=submit]").removeAttr("disabled");
            VAIUU.FormReset("#changepassword");
            if (data.redirecturl !== "" && data.redirecturl != null) {
                window.location.href = data.redirecturl;
            }
        },
        createAdminUser: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
            $("#createadmin [type=submit]").removeAttr("disabled");
            if (data.success == true) {
                VAIUU.FormReset("#createadmin");
            }
            if (data.redirecturl !== "" && data.redirecturl != null) {
                window.location.href = data.redirecturl;
            }
        },
        updateAdminInfo: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
            $("#updateadmin [type=submit]").removeAttr("disabled");
        },
        userDelete: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
            if (data.redirecturl !== "") {
                setTimeout(function () {
                    window.location.href = data.redirecturl;
                }, 3000);
            }

        },
        userUpdate: function (data) {
            $("#ajaxloader").hide();
            $('.alert-custom').html('<div class="alert alert-' + data.styleclass + '">' + data.message + '</div>');
        }

    }
    VAIUU.Initialize();
});





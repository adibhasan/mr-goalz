/* Simple Javasctipt/JQuery MVC Framework
 * Copyright (C) <2013>  Shamim Ahmed
 * CodeRangers LLC
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 */

//Author: Shamim Ahmed
//shamim@coderangers.com
//08/06/2013

/*global jQuery */
jQuery(function($) {
    'use strict';

    var Template = {
        videolist: ""
    }

    var Utils = {
        uuid: function() {
            /*jshint bitwise:false */
            var i, random;
            var uuid = '';

            for (i = 0; i < 32; i++) {
                random = Math.random() * 16 | 0;
                if (i === 8 || i === 12 || i === 16 || i === 20) {
                    uuid += '-';
                }
                uuid += (i === 12 ? 4 : (i === 16 ? (random & 3 | 8) : random)).toString(16);
            }

            return uuid;
        },
        pluralize: function(count, word) {
            return count === 1 ? word : word + 's';
        },
        Log: function(data) {
            //console.log("Log: " + data);
        },
        Alert: function(data) {
            alert(data);
        },
        store: function(namespace, data) {
            if (arguments.length > 1) {
                return localStorage.setItem(namespace, JSON.stringify(data));
            } else {
                var store = localStorage.getItem(namespace);
                return (store && JSON.parse(store)) || [];
            }
        },
        animatedSkillBar: function() {
            $('.progress-skills').each(function() {
                var t = $(this),
                label = t.attr('data-label');
                percent = t.attr('data-percent') + '%';
                t.find('.bar').text(label + ' ' + '(' + percent + ')').animate({
                    width: percent
                });
            });
        },
        responsiveVideoPlayer: function() {
         
        },
        scrollEffect: function() {
            scrollPos = $(this).scrollTop();
            $('#landingSlide').css({
                'background-position': 'center ' + (200 + (scrollPos / 4)) + "px"
            });
        },
        scrollEffectInit: function() {
            $(window).scroll(function() {
                this.scrollEffect;
            });
        },
        getPageName: function() {
            return window.location.pathname.split('/')[1];
        },
        getFullPageName: function() {
            return window.location.pathname.split('/')[2];
        },
        getPageAnchor: function() {
            return window.location.hash;
        },
        addValidation: function(form, callbacks) {

            $('form[name="' + form + '"]').find('input, textarea').not("[type=submit]").not("[type=hidden]").jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App[callbacks].apply(this);
                }
            });

        },
        getLocale: function(str){
            var newstr = '';
            if($.isNumeric(str)){

                for (var x = 0; x < str.length; x++)
                {
                    var c = $.i18n._(str.charAt(x));
                    newstr = newstr+c;
                }
                return newstr;
            }else{
                //  console.log(str);
                return $.i18n._(str);
            }
        },
        Localize: function(){
        /*
            $.each($('.i18n'), function() {
                 $(this)._t($(this).html());
            });


            $.each($('.i18n-date'), function() {
                 //$(this)._t($(this).html());
                 var date = $(this).html().split(' ');;
                 var month = date[0];
                 var day = date[1];
                 day = day.replace(/,+$/, '');
                 var year = date[2];
                  console.log(month);
                 date = Utils.getLocale(month)+ ' '+Utils.getLocale(day)+', '+Utils.getLocale(year);
                $(this).html(date);
            });
            $.each($('.i18n-n'), function() {  
                $(this).html(Utils.getLocale($(this).html()));
            });
             */
        },

        Confirm:function (heading, question, cancelButtonTxt, okButtonTxt, callback) {
            var confirmModal = 
            $('<div class="modal hide fade">' +    
                '<div class="modal-header">' +
                '<a class="close" data-dismiss="modal" >&times;</a>' +
                '<h3>' + heading +'</h3>' +
                '</div>' +

                '<div class="modal-body">' +
                '<p>' + question + '</p>' +
                '</div>' +

                '<div class="modal-footer">' +
                '<a href="#" class="btn" data-dismiss="modal">' + 
                cancelButtonTxt + 
                '</a>' +
                '<a href="#" id="okButton" class="btn btn-primary">' + 
                okButtonTxt + 
                '</a>' +
                '</div>' +
                '</div>');

            confirmModal.find('#okButton').click(function(event) {
                callback();
                confirmModal.modal('hide');
            });

            confirmModal.modal('show');     
        },
        LiveEdit: function(el) {

            console.log(el);
            var type = el.data('type');


            var tmpl1 = '<span class="editable-container editable-inline" style=""><div><div class="editableform-loading" style="display: none;"></div><form id="' + el.attr('rel') + '" class="form-inline editableform" style="">' +
            '<div class="control-group"><div>';

            var tmpl3 = '<span class="editable-clear-x"></span></div><div class="editable-buttons"><button class="btn btn-primary editable-submit" type="submit"><i 		class="icon-ok icon-white"></i></button><button class="btn editable-cancel" type="button"><i class="icon-remove"></i></button></div></div><div class="editable-error-block help-block" style="display: none;"></div></div></form></div></span>';

            if (type == 'text') {
                var tmpl2 = '<div class="editable-input" style="position: relative;"><input type="text" style="padding-right: 24px;" value="' +$.trim(el.html()) + '" class="input-mini">';
                el.hide().before(tmpl1 + tmpl2 + tmpl3);
            }

            if (type == 'textarea') {
                var tmpl2 = '<div class="editable-input" style="position: relative;"><textarea class="input-large" placeholder="' + el.html() + '" rows="4">' + el.html() + '</textarea>';
                el.hide().before(tmpl1 + tmpl2 + tmpl3);
            }

            if (type == 'tags') {
                var tmpl2 = '<div class="editable-input" style="position: relative;width:165px;"><select data-placeholder="Select Tags" user-input="true" multiple class="chzn-select-width input-medium live-select" tabindex="16"> ';
                var option = '';
                $.each(el.attr('data-source').split(','), function(key, data) {

                    option += '<option selected="selected" value="' + data + '">' + data + '</option>';
                });

                tmpl2 += option + '</select>';
                el.hide().before(tmpl1 + tmpl2 + tmpl3);
                Utils.setChosen();


            }
            if (type == 'select')
            {
                var tmpl2 = '<div class="editable-input" style="position: relative;"><select class="input-medium live-select"> ';
                var option ='';
 
                //   var option = '<option value="">Select</option>';
                //$.getJSON('/util/' + el.data('source'), function(data) {
                $.each(el.attr('data-source').split(','), function(key, data) {
						
                    var value = data.split('=');
                    if (el.html() == value[1])
                        option += '<option value="' + value[1] + '" selected>' + value[0] + '</option>';
                    else
                        option += '<option value="' + value[1] + '">' + value[0] + '</option>';
                });
                tmpl2 += option + '</select>';
                el.hide().before(tmpl1 + tmpl2 + tmpl3);

                 
            }
        }


    };

    var App = {
        url: 'error',
        placeholdervalue:'',
        type: 'GET',
        data: 'Jones=1',
        dataType: 'JSON',
        idleTime: 0,
        idleLimit:14,
        VideoDataTable: null,
        init: function() {
            this.ENTER_KEY = 13;
            //this.todos = Utils.store('Coderangers');
            this.cacheElements();
            this.bindEvents();
            //this.render();
            Utils.animatedSkillBar();
            Utils.responsiveVideoPlayer();
            Utils.scrollEffectInit();
        // Utils.Localize();
        },
        cacheElements: function() {
            //here
            this.$faqform = $("#frequentlyAskedQuestionForm");
            // Updates form
            this.$updatesForm = $("#updatesForm");
            this.$register = $("#register");
            this.$accountinfo = $("#accountinfo");
            this.$password_form = $("#password_form");
            this.$passwordreset_form = $("#passwordreset_form");
            this.$main = $('#main');
            this.$message = $('#message');
            this.$login = $('#login');
            this.$fpform = $('#fpform');
            this.$resetpassword = $('#resetpassword');
            this.$updatepassword = $('#updatepassword');
            this.$likecomment = '';
            //Security question
            this.$securityquestionform = $("#securityquestionform");
            this.$setsecurityquestion = $("#setsecurityquestion");
            //Check security question for forget password
            this.$checksecurityquestion = $("#checksecurityquestion");
            this.$generateQr=$("#generateQr");
            this.$checkqrscan=$("#checkqrscan");
            this.$generateQrWiFi=$("#generateQrWiFi");
            this.$supportrequest=$("#supportrequest");
            this.$searchhelp=$("#searchhelp");
            this.$updatdocsq = $("#updatdocsq");
            this.$insertappqr =$("#insertappqr");
            this.$termsandservice=$("#termsandservice");
            this.$augmedixtermsandservice=$("#augmedixtermsandservice");
            this.$deleteimageform=$("#deleteimageform");
        },
        bindEvents: function() {
            /* Design issue js  for new UI*/
            $("body").on("click",function(){
                $(".errormessage div").fadeOut(300,function(){
                    $(".errormessage").html("");
                });
            });
            $("input[type=text],input[type=email],input[type=password]").on("click",function(){
                if($(this).hasClass( "danger" )){
                    $(this).removeClass("danger").val("").attr("placeholder",App.placeholdervalue);
                }
            });            
            $("#showretrieveblock").on("click",function(){
                $("#clogin").fadeOut(300,function(){
                    App.reset("#login");
                    $("#cretrieve").fadeIn();
                });
            });
            $("#showloginblock").on("click",function(){
                $("#cretrieve").fadeOut(300,function(){
                    App.reset("#fpform");
                    $("#clogin").fadeIn();
                });
            });
            
            
            
            $('form[name="register"]').find('input').not("[type=submit]").jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.CreateNewUser();
                }
            });
            // Terms of service
            $('form[name="termsandservice"]').find('input').not("[type=submit]").jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.UpdateTermsCondition();
                }
            });
            $('form[name="augmedixtermsandservice"]').find('input').not("[type=submit]").jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.UpdateAugmedixCondition();
                }
            });
            $('form[name="deleteimageform"]').find('input').not("[type=submit]").jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.DeleteImage();
                }
            });
            // Sign up form
            $('form[name="signup"]').find('input').jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.SignUpUser();
                }
            });

            //            $('form[name="login"]').find('input').not("[type=submit]").jqBootstrapValidation({
            //                submitSuccess: function($form, event) {
            //                    event.preventDefault();
            //                    App.Login();
            //                }
            //            });
              
            // Form Submit for Login
            $('#login').on("submit",function(event){
                event.preventDefault();
                var email=$("#login input[name=email]").val();
                var password=$("#login input[name=password]").val();
                if(browsername=="IE" && browserversion <10){
                    if(email==""){
                        $("#login input[name=email]").addClass("danger").val("Please fill out this field");
                        App.placeholdervalue="Enter email";
                    }else if(App.patternCheck(email,/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i)==false){
                        $("#login input[name=email]").addClass("danger").val("Please input a valid email");
                        App.placeholdervalue="Enter email";
                    }else if(password=="" || password=="Please fill out this field" || password=="Password"){
                        $("#login input[name=password]").addClass("danger").attr("placeholder","Please fill out this field");
                        App.placeholdervalue="Password";
                    }else{
                        App.Login();
                    }
                }else{
                    if(email==""){
                        $("#login input[name=email]").addClass("danger").attr("placeholder","Please fill out this field");
                        App.placeholdervalue="Enter email";
                    }else if(App.patternCheck(email,/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i)==false){
                        $("#login input[name=email]").addClass("danger").val("").attr("placeholder","Please input a valid email");
                        App.placeholdervalue="Enter email";
                    }else if(password=="" || password=="Please fill out this field"){
                        $("#login input[name=password]").addClass("danger").attr("placeholder","Please fill out this field");
                        App.placeholdervalue="Password";
                    }else{
                        App.Login();
                    }
                }
                
            });
            // Form submit for retrieve password
            $('#fpform').on("submit",function(event){
                event.preventDefault();
                var email=$("#fpform input[name=email]").val();
                if(browsername=="IE" && browserversion <10){
                    if(email==""){
                        $("#fpform input[name=email]").addClass("danger").val("Please fill out this field");
                        App.placeholdervalue="Enter email";
                    }else if(App.patternCheck(email,/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i)==false){
                        $("#fpform input[name=email]").addClass("danger").val("Please input a valid email");
                        App.placeholdervalue="Enter email";
                    }else{
                         App.ForgotPassword();
                    }
                }else{
                    if(email==""){
                        $("#fpform input[name=email]").addClass("danger").attr("placeholder","Please fill out this field");
                        App.placeholdervalue="Enter email";
                    }else if(App.patternCheck(email,/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i)==false){
                        $("#fpform input[name=email]").addClass("danger").val("").attr("placeholder","Please input a valid email");
                        App.placeholdervalue="Enter email";
                    }else{
                        App.ForgotPassword();
                    }
                }
                
            });
            $('form[name="modallogin"]').find('input').not("[type=submit]").jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.ModalLogin();
                }
            });

            //            $('form[name="fpform"]').find('input').not("[type=submit]").jqBootstrapValidation({
            //                submitSuccess: function($form, event) {                  
            //                    event.preventDefault();
            //                    App.ForgotPassword();
            //                }
            //            });			    
			
            $('form[name="resetpassword"]').find('input').not("[type=submit]").jqBootstrapValidation({
                submitSuccess: function($form, event) {               
                    event.preventDefault();
                    App.ResetPassword();
                }
            });
            $('form[name="updatepassword"]').find('input').not("[type=submit],#updatepassword input[name=password]").jqBootstrapValidation({
                submitSuccess: function($form, event) {               
                    event.preventDefault();
                    App.ResetPasswordUpdate();
                }
            });
            $('form[name="passwordreset_form"]').find('input').not("[type=submit],[name=password]").jqBootstrapValidation({
                submitSuccess: function($form, event) {      
                    event.preventDefault();
                    App.Passwordreset();
                }
            });
            $('form[name="accountinfo"]').find('input, textarea').not("[type=submit]").not("[type=hidden]").jqBootstrapValidation({
                submitSuccess: function($form, event) {      
                    event.preventDefault();
                    App.UpdateUser();
                }
            });


            $('form[name="password_form"]').find('input').not("[type=submit],[name=password]").jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    
                    event.preventDefault();
                    App.UpdatePassword();
                }
            });
            
            //here
            $('form[name="frequentlyAskedQuestionForm"]').find('input').jqBootstrapValidation({
                submitSuccess: function($form, event) {
                   
                    event.preventDefault();
                    App.CreateFAQ();
                }
            });
 
            // Security question form 
            $('form[name="securityquestionform"]').find('input').jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.CreateSecurityQuestion();
                }
            });
            $('form[name="setsecurityquestion"]').find('input').jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.SetSecurityQuestion();
                }
            });
            // Security question for forget password
            $('form[name="checksecurityquestion"]').find('input').jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.CheckSecurityQuestion();
                }
            });
            // Security question for doctor
            $('form[name="updatdocsq"]').find('input').jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.updatdocsq();
                }
            });
            $('form[name="insertappqr"]').find('input').jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.insertappqr();
                }
            });
            // Call QR By Clicking a button
            $('form[name="generateQr"]').find('input').jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.GenerateQrCode();
                }
            });
            // Check Qr is scanned successfully
            $('form[name="checkqrscan"]').find('input').jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.checkQRscan();
                }
            });
            $('form[name="generateQrWiFi"]').find('input').jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.GenerateWifiQrCode();
                }
            });
           
           
            //Search data from zendesk api
            $('form[name="searchhelp"]').find('input').jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.searchDataFromZenDesk();
                }
            });
            //Send data to zenddesk api
            $('form[name="supportrequest"]').find('input').jqBootstrapValidation({
                submitSuccess: function($form, event) {
                    event.preventDefault();
                    App.sendDataToZenDesk();
                }
            });
            $("#totop").click(function() {
                $("html, body").animate({
                    scrollTop: 0
                }, 300);
                return false;
            });

            $("#networktype").on("change",function(){
                var optvalue=$(this).val();
                if(optvalue==="PEAP" || optvalue==="PEAP-CA"){
                    $(".networkusername").html(App.render("peepnetwork", null, "tmpl-network-qr-peep"));
                    $('.peapuser').parent().removeClass('hidden');
                    $('.peapuser').attr('required','');
                    
                    if(optvalue==="PEAP-CA"){
                        var UploaderCert = App.CreateFileUploader('cert-uploader', ['crt', 'cert', 'txt', 'cer'], 'upload/certificate', "completeCertificateUpload", "Upload certificate file");
                        $(".file_upload_box").removeClass("hidden");
                    }else{
                        $(".file_upload_box").addClass("hidden"); 
                    }
            
                }else{
                    $(".networkusername").html(""); 
                    $('.peapuser').removeAttr('required');
                    $('.peapuser').parent().addClass('hidden');
                }
            });
            $(".forgot-password").on("click",function(){
                $(".retrievepassword input[type=email]").val("");
                $(".retrievepassword").toggleClass("hidden");
            });
            $(".hideretrieve").on("click",function(){
                $(".retrievepassword").addClass("hidden");
            });
            $("#password-reset").on("click",function(){
                $("#commonmodallabel").html("Reset Password");
                //App.render("commonmodalbody", null, "tmpl-reset-password");
                $("#password_form input[type=password]").val("");
                $("#commonmodal").modal();
            });
            $("#twistlecontent").load(function(){
                App.setContainerHeight("#twistlecontent",80,30);
            });
            $(window).resize(function() {
                App.setContainerHeight("#twistlecontent",80,30);
            });
            $(document.body).on("focusout","input",function(){
                var namevalue=$(this).val();
                var newval=$.trim(namevalue);
                $(this).val(newval);
            });
            if (Utils.getPageName()=='dashboard') {    
     
                window.closeModal = function(){
                    $('#myModal').modal('hide');
                    window.location = window.location.href;
                };
            //  $('#description').wysihtml5();

            }
  
            
            if (Utils.getPageName() == 'upload') {
                if (uploader_cat == "channel") {
                    var Uploader = App.CreateFileUploader('cover-uploader', ['jpeg', 'jpg', 'gif', 'png'], '/channel/uploadcover/1', "completeCoverUpload");
                } else {
                    var Uploader = App.CreateFileUploader('video-uploader', ['jpeg', 'jpg', 'gif', 'png'], '/upload/process', "completeVideoUpload");
                }
                Utils.setChosen();
            }

            console.log(Utils.getFullPageName())
            if (Utils.getPageName() == 'account' && Utils.getFullPageName() !="retrieve") {
                var Uploader = App.CreateFileUploader('profile-uploader', ['jpeg', 'jpg', 'gif', 'png'], 'upload/avatar', "completeAvatarUpload","CHANGE PHOTO");
      
            }
            
            if (Utils.getPageName()=='home' || Utils.getPageName()=='') {                
                var config = {
                    '.chzn-select': {
                    },
                    '.chzn-select-deselect': {
                        allow_single_deselect: true
                    },
                    '.chzn-select-no-single': {
                        disable_search_threshold: 10
                    },
                    '.chzn-select-no-results': {
                        no_results_text: 'Oops, nothing found!'
                    },
                    '.chzn-select-width': {
                        width: "200px"
                    }
                }
                for (var selector in config) {
                    $(selector).chosen(config[selector]);
                }
            }  
    

       
            $('.backtohelp').live("click",function(){
                $('.modal-body-callus').hide();
                $('.modal-body-ticket').hide();
                $('.modal-content-support').show();
                $('#supporttype').show();
                $('.modal-footer-button').hide();
                $('#searchresult').hide();
            });

            $('.modal-footer-button').on('click',function(){        
                $('.modal-body-callus').hide();
                $('.modal-body-ticket').hide();
                $('.modal-content-support').show();
                $('.modal-footer-button').hide();
                $('#searchresult').hide();
            });
            
            $(".callus").on("click",function(){
                $('.modal-footer-button').show();
                $('.modal-body-ticket').hide();
                $('.modal-body-callus').show();
                $('.modal-content-support').hide();
    
            });
            $(".report").on("click",function(){
                $('.modal-footer-button').show();
                $('.modal-body-ticket').show();
                $('.modal-body-callus').hide();
                $('.modal-content-support').hide();
    
            });
            $(".btn-appconnect").on("click",function(){
                $("#appconnect-qr").trigger("click");
            });
            $(".request-category").on("change",function(){
                $("#subject").val($("select[name='request_category'] option:selected").text());
                if($(this).val()==19174){
                    App.render('addTechnicalcategory',null, "tmpl-technical-support");
                }else{
                    $("#addTechnicalcategory").html("");
                }
            });
            
            $("#regenerateappqr").live("click",function(event){
                $(".qr").html('<div class="widget-box-layer" style="width:100%;"><i class="fa fa-cog fa-spin fa-3x"></i></div>');
                event.preventDefault();
                App.GenerateQrCode();
            });
            $("#scanqr").live("click",function(event){
                event.preventDefault();
                App.checkQRscan();
            });
            $("#callsupportmodal").live("click",function(){
                $(".modal-body-ticket").hide();
                $(".modal-body-callus").hide();
                $("#searchresult").hide();
                $(".modal-content-support").show();
                $("#myModal").modal();
            });
            $("#submitrequestinstead").live("click",function(){
                $("#searchresult").hide();
                $(".modal-body-ticket").show();
            });
            $(".doctorsignin").on("click",function(){
                $(".useremail,.userpassword").val("");
                $(".hideretrieve").trigger("click");
                App.reset('#fpform');
            });
            $(".container-fluid a").on("click",function(){
                if((window.baseURL+"account") == $(location).attr('href')){
                    if(window.BaseImage !=$("img.preview").attr("src")){
                        window.onbeforeunload = function() {
                            var x=document.getElementById("avatar").value;
                            if(x !=""){
                                return "Data you have entered may not be saved";
                            }
                        }
                    }
                }
            });
            $("body").on("click",function(){
                App.destroy("#alert-message");
                App.destroy("#iealertmessage");
            });
            $(document.body).on("click","#alert-yes",function(){
                var alertid=$(".tabname").attr("id");
                if(alertid == "deleteimage"){
                    $("#deleteuserimage").trigger("click");
                }
            });
            $(document.body).on("click",".delete-image",function(){
                $(".tabname").attr("id","deleteimage");
                $(".alert-title").text("Warning Message");
                $(".alert-text").text("Do you want to delete profile picture ?");
                $(".conditionalmodal").modal();
            });
        
            $(document.body).on("click",".add-image",function(){               
                $(".qq-upload-button input[type='file']").click();
            });
            
            $(document.body).on("change", ".password", function() {
                var value = $(this).val();
                if (value != "") {
                    $(this).each(function() {
                        if ($(this).val().match(/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,100}$/)) {
                            if(browsername =="IE" && browserversion <=9){
                                
                            }else{
                                this.setCustomValidity("");
                            }
                           
                        } 
                    });
                } else {
                    $(this).each(function() {
                        if(browsername =="IE" && browserversion <=9){
                                
                        }else{
                            this.setCustomValidity("");
                        }
                    });
                }
            });
            
            if (Utils.getPageName() !='home') { 
                Utils.Log("Counter::");
                App.idleTime = 0;
        
                //Increment the idle time counter every minute.
                var idleInterval = setInterval(App.idleChecker, 60000); // 1 minute

                //Zero the idle timer on mouse movement.
                $(this).mousemove(function (e) {
                    App.idleTime = 0;
                });
                $(this).keypress(function (e) {
                    App.idleTime = 0;
                });
        
            }
            $('.phones').mask('(999) 999-9999');
            var showPopover = function () {
                $(this).popover('show');
            };
            var hidePopover = function () {
                $(this).popover('hide');
            };
            $('.bt-popover').popover({
                content: "<ul class='suggestion'><li>Answers must have at least two characters</li><li>Answer must be in English</li><li>Answer must be unique</li></ul>",
                html:true,
                trigger: 'manual',
                placement: "bottom"
            })
            .keyup(showPopover)
            .blur(hidePopover);
            $('.bt-required').popover({
                content: "<div>Please fill up this field</div>",
                html:true,
                trigger: 'manual',
                placement: "bottom"
            })
            .keyup(showPopover)
            .blur(hidePopover);
            $(document.body).on('keyup','#securityquestionform .bt-popover,#updatdocsq .bt-popover,#insertappqr .bt-popover,#setsecurityquestion .bt-popover',function(){
                var error = 0;
                var current = $(this);
                var count =0;
                
                var msg="<ul class='suggestion'><li>Answers must have at least two characters</li><li>Answer must be in English</li><li>Answer must be unique</li></ul>";
             
                if($(this).parent().attr('id')=="doctorans")
                    msg = "<ul class='suggestion'><li>Answers must have at least two characters</li><li>Answer must be in English</li></ul>";
             
                var newMsg="<span class='suggestion'>Answer must be unique</span>";
                $(".sq").each(function(){
                    if ($(this).val() == current.val() && $(this).val()!="" ){
                        count++;
                    }
                });
                if(count>1)
                {                                
                    error =1;
                    current.attr("data-content",newMsg);
                    current.popover('show');
                // $('#btnsq').attr("disabled", true);
                }else{
                
                    $(this).attr("data-content",msg); 
                    error = 0;
                    count = 0;
                // $('#btnsq').removeAttr("disabled");
                }
                if( $(this).val().length <2 )
                {
                      
                    $(this).attr("data-content",msg); 
                    // $('#btnsq').attr("disabled", true);
                    $(this).popover('show'); 

                }
                if($(this).val()=="")
                {
                    // $('#btnsq').removeAttr("disabled"); 
                    $(this).popover('hide');                    
                }
                if($(this).val().length >=2 && error == 0)
                {  

                    //  $('#btnsq').removeAttr("disabled"); 
                    $(this).attr("data-content",msg);    
                    $(this).popover('hide'); 
                }
            });

            $('.bt-popover-password').popover({
                content: "<ul class='suggestion'><li>Password must be at least 8 characters long</li> <li>Must contain at least 1 uppercase letter</li><li>Must contain at least 1 lowercase letter</li> <li>Must contain at least 1 number</li></ul>",
                html:true,
                trigger: 'manual',
                placement: "bottom"
            })
            .keyup(showPopover)
            .blur(hidePopover);
             
            $('.bt-popover-rtpassword').popover({
                content: "<span class='suggestion'>Must match password entered above</span>",
                html:true,
                trigger: 'manual',
                placement: "bottom"
            })
            .keyup(showPopover)
            .blur(hidePopover);
        
         
            $(".bt-popover-rtpassword").on("keyup",function(e){
                if($(this).val() !="" ){
                    $(this).each(function() {
                        console.log($(this).val());
                        console.log($(".password").val());
                        if (  $(this).val()==  $(".password").val()) {
                            if(browsername =="IE" && browserversion <=9){
                                
                            }else{
                                this.setCustomValidity("");
                            }
                          
                            
                            $('.bt-popover-rtpassword').popover('hide'); 
                            
                        }else{
                            if(e.keyCode==13){
                                if(browsername =="IE" && browserversion <=9){
                                
                                }else{
                                    this.setCustomValidity("Must match password entered above");
                                }
                               
                            }
                        }
                    });
                }else{
                    $('.bt-popover-password').popover('hide'); 
                    if(browsername =="IE" && browserversion <=9){
                                
                    }else{
                        this.setCustomValidity("");
                    }
               
                }
            });
             
            $(".password").on("keyup",function(){
                if($(this).val() !="" ){
                    $(this).each(function() {
                        if ($(this).val().match(/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,100}$/)) {
                            $('.bt-popover-password').popover('hide'); 
                        } 
                    });
                }else{
                    $('.bt-popover-password').popover('hide'); 
                }
            });
            $(".add-image").live("click",function(){
                $(".qq-uploader").trigger("click");
            });
            $("#go-next").on("click",function(){
                window.setSecurityQuestion == 1;
                $(".firsttimelogin").addClass("hidden");
                if(window.userType=="doctor"){
                    $(".ftl-title").text("Set Glass Challenge Question");
                    $(".counter").text("Step 5 of ");
                    $("#doctor-challenge-question").removeClass("hidden");
                    
                }else{
                    window.location.href="dashboard";
                }
            });
            $("form input[type=text],form input[type=password]").on('keyup',function(e){
                if(e.keyCode==13){
                    $(this).popover('hide');
                }
            });
            $(".iealertmessage").on("click",function(e){
                e.preventDefault();
            });
        },
        CreateFileUploader: function(el, ext, url, responseHandler,btnText) {
            var uploader = new qq.FineUploader({
                element: document.getElementById(el),
                validation: {
                    allowedExtensions: ext,
                    sizeLimit: 5000000,
                    minSizeLimit: 0,             
                    stopOnFirstInvalidFile: true,
                    acceptFiles: null
                },
                editFilename: {
                    enabled: true
                },
                multiple: false,
                request: {
                    endpoint: url
                },
                deleteFile: {
                    enabled: true,
                    endpoint: 'account/deletefile',
                    forceConfirm: true
                },
                text: {
                    uploadButton: '<div><span class="i18n">'+btnText+'</div></div>'
                },
                template: '<div class="qq-uploader">' +
                '<pre class="qq-upload-drop-area"><span>{dragZoneText}</span></pre>' +
                '<div class="qq-upload-button btn btn-default btn-custom" style="width: auto;">{uploadButtonText}</div>' +
                '<span class="qq-drop-processing"><span>{dropProcessingText}</span><span class="qq-drop-processing-spinner"></span></span>' +
                '<ul class="qq-upload-list" style="margin-top: 10px; text-align: center;"></ul>' +
                '</div>',
                classes: {
                    success: 'alert alert-success',
                    fail: 'alert alert-error'
                },
                callbacks: {
                    onSubmit: function(id, fileName) {
                        $(".loading-image").removeClass("hidden");
                        $('.contact-form-submit').attr('disabled',true);
                    },
                    onComplete: function(id, fileName, responseJSON) {
                        $(".loading-image").addClass("hidden");
                        $('.contact-form-submit').removeAttr('disabled');
                        if (responseJSON.success) {
                            $('.contact-form-submit').removeAttr('disabled');
                            App[responseHandler].apply(this, [{
                                "response": responseJSON
                            }]);
                        }
                    },
                    onCancel: function(id, fileName) {
                        $('.contact-form-submit').removeAttr('disabled');
                    },
                    onDelete: function(id) {
                        $("#avatar-display img").attr("src", window.BaseImage);
                    //$(".settings a,.security a").removeClass("disablepointerevent");
                    }
                }
            });

            return uploader;
        },
        render: function(el, data, template) {
            $('#' + el).html(tmpl(template, data));
            Utils.Localize();
        },
        RenderDataGrid: function(){

            App.VideoDataTable = $('#table_report').dataTable( {
                "aoColumns": [
                {
                    "bSortable": false
                },
                null, null,null, null, null,
                {
                    "bSortable": false
                }
                ]
            } );
                
            $('table th input:checkbox').on('click' , function(){
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function(){
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });
                        
            });
            
            $('[data-rel=tooltip]').tooltip();

        },
        CreateNewUser: function() {
            App.url = '/register/create';
            App.type = 'POST';
            App.Ajax(App.$register, App.$register.serialize(), "completeRegistration");
        //App.render();
        },
        UpdateTermsCondition:function() {
            App.url = '/account/termsandconditions';
            App.type = 'POST';
            App.Ajax(App.$termsandservice, App.$termsandservice.serialize(), "completeTermsAndService");
        //App.render();
        },
        UpdateAugmedixCondition:function() {
            App.url = '/account/termsandconditions';
            App.type = 'POST';
            App.Ajax(App.$augmedixtermsandservice, App.$augmedixtermsandservice.serialize(), "completeAugmedixService");
        //App.render();
        },
        DeleteImage:function() {
            App.url = '/account/deleteprofileimage';
            App.type = 'POST';
            App.Ajax(App.$deleteimageform, App.$deleteimageform.serialize(), "completeProfileImageDelete");
        //App.render();
        },
        CreateFAQ:function(){
            //insert controller name
            App.url = '/questions/create';
            App.type = 'POST';
            //form name faqform    && callback 
            App.Ajax(App.$faqform, App.$faqform.serialize(), "completeFaqCreate");
        //App.render();   
        },
        // Configure jquery QR
        generateQr:function(enctext,holder){
            $("."+holder).qrcode({
                text    : enctext,
                render    : "div",  // 'canvas' or 'table'. Default value is 'canvas'
                background : "#ffffff",
                foreground : "#000000",
                width :550,
                height: 550,
                size: 550
            });
        },
        // Dismiss QR after 15 min and show timer
        invalidQr:function(message,duration){
            setTimeout(function(){
                $("#defaultCountdown").addClass("hidden");
                $(".generateQr").removeAttr("disabled");
                $("#qr").removeClass("qrcodeholder").text(message);
            },duration);
        },
        // pass security question data to controller
        CreateSecurityQuestion:function(){
            //insert controller name
            App.url = '/account/addSecurityQuestion';
            App.type = 'POST';
            //form name faqform    && callback 
            App.Ajax(App.$securityquestionform, App.$securityquestionform.serialize(), "completeAddingSecurityQuestion");
        //App.render();   
        },
        SetSecurityQuestion:function(){
            //insert controller name
            App.url = '/account/addSecurityQuestion';
            App.type = 'POST';
            //form name faqform    && callback 
            App.Ajax(App.$setsecurityquestion, App.$setsecurityquestion.serialize(), "completeInsertingSecurityQuestion");
        //App.render();   
        },
        // pass login security question data to controller
        CheckSecurityQuestion:function(){
            //insert controller name
            App.url = '/account/checksecurityquestion';
            App.type = 'POST';
            //form name faqform    && callback 
            App.Ajax(App.$checksecurityquestion, App.$checksecurityquestion.serialize(), "completeCheckingSecurityQuestion");
        //App.render();   
        },
        // pass login security question data to controller
        updatdocsq:function(){
            App.url = '/account/updatdocsq';
            App.type = 'POST';
            App.Ajax(App.$updatdocsq, App.$updatdocsq.serialize(), "completeUpdatdocsq");
        },
        insertappqr:function(){
            //insert controller name
            App.url = '/account/updatdocsq';
            App.type = 'POST';
            //form name faqform    && callback 
            App.Ajax(App.$insertappqr, App.$insertappqr.serialize(), "completeinsertAppsq");
        //App.render();   
        },
        FacebookLogin: function() {

            FB.login(function(response) {
                if (response.authResponse) {
                    // connected
                    alert(1);
                // window.location.reload();
                } else {
                    // cancelled
                    alert('User cancelled login or did not fully authorize.');
                }
            });

        },
        Login: function() {
            App.url = '/account/login';
            App.type = 'POST';
            App.Ajax(App.$login, App.$login.serialize(), "completeLogin");
        //App.render();
        },
        ModalLogin: function() {
            App.url = '/account/login';
            App.type = 'POST';
            App.Ajax(App.$login, App.$login.serialize(), "completeModalLogin");
        //App.render();
        },
        ForgotPassword: function() {
            App.url = '/account/forgot';
            App.type = 'POST';
            App.Ajax(App.$fpform, App.$fpform.serialize(), "forgotPassswordHandler");
        //App.render();
        },
        ResetPassword: function() {
            App.url = '/account/reset';
            App.type = 'POST';
            App.Ajax(App.$resetpassword, App.$resetpassword.serialize(), "resetPasswordHandler");
        //App.render();
        },
        ResetPasswordUpdate:function() {
            App.url = '/account/updatepassword';
            App.type = 'POST';
            App.Ajax(App.$updatepassword, App.$updatepassword.serialize(), "updatePasswordHandler");
        },
        Passwordreset: function() {
            App.url = '/account/passwordreset';
            App.type = 'POST';
            App.Ajax(App.$passwordreset_form, App.$passwordreset_form.serialize(), "resetUserPassword");
        },
        UpdatePassword: function() {
            App.url = '/account/updatepassword';
            App.type = 'POST';
            App.Ajax(App.$password_form, App.$password_form.serialize(), "completePasswordUpdate");
        //App.render();
        },
        LiveUpdate: function(form,field,value,table,id) {
            App.url = '/Live/update';
            App.type = 'POST';
            App.Ajax(form, 'table='+table+'&'+'value'+'='+value+'&field='+field+'&id='+id, "completeLiveUpdate");
        },
        UpdateUser: function() {
            App.url = '/account/update';
            App.type = 'POST';
            App.Ajax(App.$accountinfo, App.$accountinfo.serialize(), "completeProfileUpdate");
        //App.render();
        },
        LiveDelete: function(id, table) {
            App.url = '/Live/remove';
            App.type = 'POST';
            App.Ajax($('button[data-id="' + id + '"]'), 'table=' + table + '&id=' + id, "completeLiveDelete");
        },
        Ajax: function(el, data, responseHandler) {
            App.initLoader(el);
            var request = $.ajax({
                url: App.url,
                type: App.type,
                data: data,
                dataType: App.dataType
            });
            request.done(function(response) {
                //Utils.Log(response.TestResponse);
                App.destroy(".widget-box-layer");
                App[responseHandler].apply(this, [{
                    "element": el.selector, 
                    "response": response
                }]);
            });
            request.fail(function(jqXHR, textStatus) {
                App.destroy(".widget-box-layer");
                Utils.Log("Request failed: " + textStatus);
            });

        },
        
        GenerateQrCode: function() {
            App.url = '/dashboard/qrCodeGenerator';
            App.type = 'POST';
            App.Ajax(App.$generateQr, App.$generateQr.serialize(), "completeqrcodegeneration");
        },
        completeqrcodegeneration:function(data) {
            $("#qrmodalgenerate").removeClass("hidden");
            $("#qrmessage").addClass("hidden");
            $(".qr").html("");
            $(".qricon").html('<img src="'+window.baseURL+'assets/img/portalicons/appconnect.png">');
            $(".qrtitle").text("Unlock Augmedix");
            $(".qrhelptext").text("Center the cross hairs on Glass on the QR code to connect to Augmedix");
            App.render("qrfooter",null, "tmpl-qr-footer");
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.alertMessage($(data.element), 'success', data.response.message);
            App.reset('#generateQr');
            App.generateQr(data.response.qr,"qr");
            $('#qrcode').modal();
        },
        checkQRscan: function() {
            App.url = '/dashboard/checkQRscan';
            App.type = 'POST';
            App.Ajax(App.$checkqrscan, App.$checkqrscan.serialize(), "completeqrcheck");
        },
        completeqrcheck:function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.reset('#checkqrscan');
            if(data.response.message==="success"){
                $('#scanqr').show();
                $("#qrmodalgenerate").addClass("hidden");
                $("#qrmessage").removeClass("hidden");
                $(".message-body").html('Congratulations!<br>You have successfully logged into the Augmedix app!');
                $(".message-icon").html('<i class="glyphicon glyphicon-ok"></i>');
            }else{
                $('#scanqr').hide();
                $('.qr').html("Glass failed to read the QR code. Please try again.");
            }
            $('#qrcode').modal();
        },
        GenerateWifiQrCode: function() {
            App.url = '/dashboard/wifiqr';
            App.type = 'POST';
            App.Ajax(App.$generateQrWiFi, App.$generateQrWiFi.serialize(), "completewificodegeneration");
        },
        sendDataToZenDesk: function() {
            App.url = '/API/create';
            App.type = 'POST';
            App.Ajax(App.$supportrequest, App.$supportrequest.serialize(), "completeZendeskRequest");
        },
        completewificodegeneration:function(data) {
            $(".qr").html("");
            $(".qricon").html('<img src="'+window.baseURL+'assets/img/portalicons/connect-plugin.png">');
            $(".qrtitle").text("Set up Network Connection");
            $(".qrhelptext").text("Center the cross hairs on Glass on the QR code to set up network connection");
            Utils.Log(JSON.stringify(data));
            if(data.response.styleclass=="success"){
                App.generateQr(data.response.qr,"qr");
                $('#qrcode').modal(); 
            }
            if(data.response.styleclass=="danger"){
                App.clientAlertMessage($(data.element), data.response.styleclass, data.response.message,5000);
                if(browsername=="IE" && browserversion <10){
                    $(data.element+" [name="+ data.response.fieldname+"]").focus();
                    if($(data.element+" [name="+ data.response.fieldname+"]").attr("type")=="password"){
                        $(data.element+" [name="+ data.response.fieldname+"]").prev().focus();
                    }
                }
            }
            
        //App.alertMessage($(data.element), 'success', data.response.message);
        },
        searchDataFromZenDesk: function() {
            App.url = '/API/search';
            App.type = 'POST';
            App.Ajax($('#helpdesk'), App.$searchhelp.serialize(), "completeZendeskSearch");
        },
        completeZendeskSearch:function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
  
            
            $('.modal-body-callus').hide();
            $('.modal-content-support').hide();
            $('.modal-body-ticket').hide();
            $('#searchresult').show();
            $('.searchresult').show();
            $(".modal-footer-button").css("display","inline-block");
            App.render('searchresult',data.response, "tmpl-help-search");
            //alert(data.response.response.results[0].id);
            App.reset(App.$searchhelp);
        },
        completeZendeskRequest:function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element), data.response.styleclass, data.response.message,5000);
            if(data.response.styleclass=="success"){
                App.reset('#supportrequest');
            }
        },
        //here  completeFaqCreate
        completeFaqCreate: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.alertMessage($(data.element), 'success', data.response.message);
            App.reset('#faqform');
        },
        // Return for security question
        completeAddingSecurityQuestion: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element), data.response.styleclass, data.response.message,5000);
            //            if(data.response.message !=""){
            //                window.location.href=data.response.redirecturl;
            //            }
            if(data.response.styleclass=="success"){
                $(".actiontype").val("updateaction");
                $("#btnsq").text("Update");
                $(".sq").removeAttr("required");
                App.reset('#securityquestionform');
            }
            
        },
        completeInsertingSecurityQuestion: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element), data.response.styleclass, data.response.message,5000);
            if(data.response.styleclass=="success"){
                window.setSecurityQuestion == 1;
                $(".firsttimelogin").addClass("hidden");
                if(window.userType=="doctor"){
                    $(".ftl-title").text("Set Glass Challenge Question");
                    $(".counter").text("Step 5 of ");
                    $("#doctor-challenge-question").removeClass("hidden");
                    
                }else{
                    window.location.href="dashboard";
                }
                
            }
        // App.reset('#setsecurityquestion');
        },
        // Return for forget password security question
        completeCheckingSecurityQuestion: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element),data.response.styleclass, data.response.message,100);
            if(data.response.counter==0){
                var hostname=baseUrl+"passwordreset?key="+data.response.token;
                App.pageRedirect(hostname);
            }
            if(data.response.counter==1){
                setTimeout(function() {
                    App.pageRedirect(document.URL);
                }, 5000);
            }
            if(data.response.counter==2){
                setTimeout(function() {
                    var hostname=baseUrl+"account/logout";
                    App.pageRedirect(hostname);
                }, 5000);
               
            }
            App.reset('#checksecurityquestion');
            if (data.response.token) {
                App.setNewToken(data.response.token);
            }
        },
        completeUpdatdocsq: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element),data.response.styleclass, data.response.message,5000);
        },
        completeinsertAppsq: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element),data.response.styleclass, data.response.message,5000);
            App.reset('#insertappqr');
            if(data.response.styleclass == "success"){
                window.location.href="dashboard";  
            }
        },
        completeRegistration: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.alertMessage($(data.element), 'success', data.response.message);
            App.reset('#register');
        },
        completeAugmedixTermsAndService: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element), data.response.styleclass, data.response.message,5000);
            if(data.response.styleclass == "success"){
                window.augmedixCondition=1;
                $(".ftl-title").html("Reset Password");
                $(".counter").text("Step 2 of");
                $(".firsttimelogin").addClass("hidden");
                $("#update-password").removeClass("hidden");
                App.reset('#termsandservice');
            }
        },
        completeTermsAndService: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element), data.response.styleclass, data.response.message,5000);
            if(data.response.styleclass == "success"){
                window.termsAndCondition=1;
                $(".ftl-title").html("Reset Password");
                $(".counter").text("Step 3 of");
                $(".firsttimelogin").addClass("hidden");
                $("#update-password").removeClass("hidden");
                App.reset('#termsandservice');
            }
        },
        completeAugmedixService: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element), data.response.styleclass, data.response.message,5000);
            if(data.response.styleclass == "success"){
                window.termsAndCondition=1;
                $(".ftl-title").html("Google Terms of Service");
                $(".counter").text("Step 2 of");
                $(".firsttimelogin").addClass("hidden");
                $("#terms-condition").removeClass("hidden");
                App.reset('#termsandservice');
            }
        },
        completeProfileImageDelete: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            if(data.response.styleclass == "success"){
               
                $('.add-image').removeClass('hidden');
                $('.delete-image').addClass("hidden");
                
                window.BaseImage=data.response.image;
                $(".alert-title").text("Success Message");
                $(".alert-text").text(data.response.message);
                $("tabname").attr("id","");
                $("#avatar-display img").attr("src",window.BaseImage);
                $(".conditionalmodal").modal('hide');
            }else{
                $(".alert-title").text("Warning Message");
                $(".alert-text").text(data.response.message);
                $("tabname").attr("id","");
            }
            
        },
        forgotPassswordHandler: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.errorMessage($(data.element), data.response.styleclass, data.response.message,5000);
            if(data.response.styleclass=="success"){
                App.reset('#fpform');
            }
            if (data.response.token) {
                App.setNewToken(data.response.token);
            }
        },
        resetPasswordHandler: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.alertMessage($(data.element), data.response.styleclass, data.response.message);
            App.reset('#resetpassword');
            setTimeout(function() {
                window.location = '/' + data.response.redirect;
            }, 3000);

            if (data.response.token) {
                App.setNewToken(data.response.token);
            }
        },
        resetUserPassword: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element), data.response.styleclass, data.response.message,100);
            App.reset('#passwordreset_form');
            if(data.response.redirect == "account/logout"){
                App.pageRedirect(data.response.redirect);
            }
        },
        completeLogin: function(data) {
            App.errorMessage($(data.element), data.response.styleclass, data.response.message,5000);
            App.reset('#login');
            //Utils.Log(data.response.success);
            if (data.response.success){
                window.location = '/dashboard';
            }
            if(data.response.message=="Exploit attempts detected and notified to admin."){
                window.location = '/home';
            }
                
        }, 
        completeModalLogin: function(data) {

            App.alertMessage($(data.element), data.response.styleclass, data.response.message);
            App.reset('#login');
            if (data.response.success)
                $('#booking-form').submit();    
        },
        completeProfileUpdate: function(data) {
            //$(".settings a,.security a").removeClass("disablepointerevent");
            window.BaseImage=$("#avatar-display img").attr("src");
            //$("#username").html(data.response.username);
            Utils.Log(JSON.stringify(data));
            Utils.Log($('#accountinfo'));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element), data.response.styleclass, data.response.message,5000);
            if (data.response.token) {
                App.setNewToken(data.response.token);
            }
        },
        completePasswordUpdate: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log($('#password_form'));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element), data.response.styleclass, data.response.message,5000);
            if (data.response.token) {
                App.setNewToken(data.response.token);
            }
            if(data.response.styleclass=="success"){
                App.reset('#password_form'); 
                window.location.href="account";
            }
        },
        updatePasswordHandler: function(data) {
            Utils.Log(JSON.stringify(data));
            Utils.Log($('#password_form'));
            Utils.Log(data.response.message);
            App.clientAlertMessage($(data.element), data.response.styleclass, data.response.message,5000);
            if (data.response.token) {
                App.setNewToken(data.response.token);
            }
            if(data.response.styleclass=="success"){
                window.updatePassword == 1;
                $(".firsttimelogin").addClass('hidden');
                $(".ftl-title").text("Set Security Questions");
                $(".counter").text("Step 4 of ");
                $("#set-security-questions").removeClass("hidden");
                App.reset('#updatepassword'); 
            }
        },
        completeLiveUpdate: function(data) {

            Utils.Log(JSON.stringify(data));
            Utils.Log($('#password_form'));
            
            Utils.Log(data.response.value);
        //return data.response.value;
        //App.reset('#account_info');
        },
        completeLiveDelete: function(data) {
			 
            Utils.Log(JSON.stringify(data));
			 
        // $('#tr_' + data.response.value).remove();
        },
        completeAvatarUpload: function(data) {
            Utils.Log(JSON.stringify(data));
            if (data.response.success) {
                $('#avatar-display img').attr('src',  data.response.uploadName).show();
                $('.profile-large img').attr('src', data.response.uploadName);
                $('img.nav-user-photo').attr('src', data.response.uploadName);
                $('.add-image').addClass("hidden");
                $('.delete-image').removeClass("hidden");
                if (data.response.token) {
                    App.setNewToken(data.response.token);
                }
            }
            
        },
        completeCertificateUpload: function(data) {
            Utils.Log(JSON.stringify(data));
            if (data.response.success) {
         
                $("#CA").val(data.response.uploadName);
                if (data.response.token) {
                    App.setNewToken(data.response.token);
                }
            }
            
        },
        completePictureUpload: function(data) {
            Utils.Log(JSON.stringify(data));
            if (data.response.success) {
                $('#avatar').val(data.response.uploadName);
                $('#avatar-display img').attr('src', avatarUrl + data.response.uploadName).show();
                 
                
                if (data.response.token) {
                    App.setNewToken(data.response.token);
                }
            }
        },        
        completePictureUploadNews: function(data) {
            Utils.Log(JSON.stringify(data));
            if (data.response.success) {
                $('#avatar1').val(data.response.uploadName);
                $('#avatar-display1 img').attr('src', avatarUrl + data.response.uploadName).show();
               
                
                if (data.response.token) {
                    App.setNewToken(data.response.token);
                }
            }
        },
        completeImageUpload: function(data) {
            Utils.Log(data.response.thumb);
            if (data.response.success) {
                var space_images = Utils.store('space_image');
                $('#thumb-select').append('<img space_images="'+space_images+   '" rel="'+data.response.uploadName +'" class="preview thumbnail venue-pic" width="50" src="/assets/uploads/converted/'+data.response.uploadName +'" />');
                Utils.store('space_image','');
                $("#thumb-select img").on("click", function() {
                    $("#thumb-select img").removeClass('selected');
                    $(this).addClass('selected');
                    var thumb_index = $(this).attr('id');  
                });

                if (data.response.token) {
                    App.setNewToken(data.response.token);
                }
            }
        },
        pageRedirect: function(pageUrl){
            window.location.href=pageUrl;
            
        },
        update: function() {

        },
        initLoader: function(el) {
            //	el.before('<div class="progress progress-success progress-striped"><div class="bar" style="width: 100%"></div></div>')
            el.parent().parent().css('position', 'relative');
            el.before('<div class="widget-box-layer" style="width:100%"><div class="loader"><i class="fa fa-cog fa-spin fa-3x"></i></div></div>')

        },
        alertMessage: function(el, type, message) {
            el.before('<div id="alert-message" class="alert  alert-' + type + '">' + message + '</div>')
            setTimeout(function() {
                App.destroy(".alert");
            }, 5000);
        },
        customAlertMessage: function(el, type, message) {
            el.before('<div id="alert-message" class="alert alert-' + type + '">' + message + '</div>')
            setTimeout(function() {
                App.destroy("#alert-message");
            }, 5000);
        },
        clientAlertMessage: function(el, type, message,durtion) {
            el.prev().html('<div id="alert-message" class="alert alert-custom alert-' + type + '">' + message + '</div>');
            if(type=="success"){
                setTimeout(function() {
                    App.destroy("#alert-message");
                }, durtion);
            }
        },
        errorMessage: function(el, type, message,durtion) {
            el.prev().html('<div  class="'+type+'">' + message + '</div>');
            if(type=="success"){
                setTimeout(function() {
                    $(".errormessage").html("");
                }, durtion);
            }
        },
        setNewToken: function(token) {
            $("input[name='token']").val(token);
        },
        destroy: function(el) {
            $(el).remove();
        },
        reset: function(el) {
            $(el)[0].reset();
        },
        hideModal: function(modal, time) {
            setTimeout(function() {
                $('#' + modal).modal('hide');
            }, time);
        },
        hideModalShowanother: function(modal,time,newone) {
            setTimeout(function() {
                $('#' + modal).modal('hide');
                if(newone==true){
                    $("#launchsecurityquestion").trigger("click");
                }
            }, time);
        },
        showModal: function(modal) {
            setTimeout(function() {
                $('#' + modal).modal('show');
            }, time);
        },


        idleChecker: function() {
            App.idleTime = App.idleTime + 1;
            if (App.idleTime >App.idleLimit) { // 20 minutes
                window.location= '/account/logout';
            }
        },
        setContainerHeight: function(selector,headerHeight,footerHeight){
            var deviceHeight=document.documentElement.clientHeight;
            var containerHeight=deviceHeight-(headerHeight+footerHeight);
            $(selector).height(containerHeight);
        },
        patternCheck:function(value,pattern){
            var Pattern=pattern
            var Idvalue=value;
            if(Pattern.test(Idvalue)){
                return true;
            }else{
                return false;
            }
            
        }

    };

    App.init();


});

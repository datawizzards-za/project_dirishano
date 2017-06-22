/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $("#password, #confirm_password").keyup(
        function() {
            if ($("#password").val() !== $("#confirm_password").val()) {
                $('#passError').show();
                $("#btn_register").prop("disabled", true);
                $("#update_pass").prop("disabled", true);
            } else {
                $('#passError').hide();
                $("#btn_register").prop("disabled", false);
                $("#update_pass").prop("disabled", false);
            }
        }
    );


    /* ======= JOBS PORTAL =============*/

    $(document).on('submit', '#employer_reg', function() {
        $("#error").hide();
        $("#loading").fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'scripts/jobseekerReg.php',
            data: data,
            success: function(data) {
                $("#loading").fadeOut('fast');
                if (data === "2") {
                    $('#success').show(function() {
                        $("#success_msg").html("Yay! Your account has been created. <br />Please sign in");
                    });
                } else if (data === "0") {
                    $('#error').show(function() {
                        $("#error_msg").html("Oops! That email address is already registered. <br />Please login, or reset your password.");
                    });
                } else if (data === "1") {
                    $('#error').show(function() {
                        $("#error_msg").html("Oops! Account could not be created. <br />Something went wrong. Please try again.");
                    });
                }
            }
        });
        return false;
    });


    $(document).on('submit', '#forgotJPpass', function() {

        $("#fpass_error").hide();
        $("#fpass_success").hide();

        if ($.trim($('#userMail').val()) === '') {

            $('#error_div_fpass').show(function() {
                $("#error_msg_fpass").html("Please enter your email address.");
            });
            $('#userMail').focus();
            return false;
        }

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../../scripts/forgotPass.php',
            data: data,
            success: function(data) {
                if (data === "1") {
                    userM = $('#userMail').val();
                    $('#fpass_success').show(function() {
                        $("#fpass_success_msg").html("Yay!!! <br> We have mailed password reset instructions to " + userM);
                    });
                } else if (data === "0") {
                    $('#fpass_error').show(function() {
                        $("#fpass_error_msg").html("Oops!!!<br > Something went wrong. <br >Please try again or contact support at support@jmbonline.co.za");
                    });
                    $('#userMail').focus();
                } else if (data === "2") {
                    $('#fpass_error').show(function() {
                        $("#fpass_error_msg").html("Oops!!!<br> That email address doesn't seem to be registered. <br /> Please double check and try again or contact support at support@jmbonline.co.za");
                    });
                    $('#userMail').focus();
                } else {
                    $('#fpass_error').show(function() {
                        $("#fpass_error_msg").html("Oops!!!<br> Something went wrong. <br>Please contact support at support@jmbonline.co.za.");
                    });
                }
            }
        });
        return false;
    });

    $("#search_ppl").click(function() {
        var skills = $("#skills").val();
        var loc = $("#location").val();
        if (skills === '') {
            $('#search_error').show(function() {
                $("#_msg").html("Please enter the skills you would like to search.<br> Use 'ALL' to search everything.");
            });
            $("#skills").focus();
        } else if (loc === '') {
            $('#search_error').show(function() {
                $("#_msg").html("Please enter the location you would like to search.<br> Use 'ALL' to search everything.");
            });
            $("#location").focus();
        } else {
            window.location.href = "../search/index.php?skl=" + skills + "&loc=" + loc;
        }
    });

    $(document).on('submit', '#del_skill', function() {
        $('#s_error').fadeOut('fast');
        $('#s_loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../scripts/delete_cv.php?switch=skill',
            data: data,
            success: function(data) {
                $('#s_loading').fadeOut('fast');
                if (data === "1") {
                    $('#s_success').show(function() {
                        $("#ssuccess_msg").html("Removed.");
                    });
                } else {
                    $('#s_error').show(function() {
                        $("#serror_msg").html("Oops! Something went wrong. <br />Please try again later.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#add_skill', function() {
        $('#s_error').fadeOut('fast');
        $('#s_loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../scripts/update_cv.php?switch=skills',
            data: data,
            success: function(data) {
                $('#s_loading').fadeOut('fast');
                if (data === "1") {
                    $('#s_success').show(function() {
                        $("#ssuccess_msg").html("Skill Added.");
                    });
                } else if (data === "0") {
                    $('#s_error').show(function() {
                        $("#serror_msg").html("Oops! <br />Please try again.");
                    });
                } else {
                    $('#s_error').show(function() {
                        $("#serror_msg").html("Oops! Something went wrong. <br />Please try again later.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#del_cert', function() {
        $('#c_error').fadeOut('fast');
        $('#c_loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../scripts/delete_cv.php?switch=cert',
            data: data,
            success: function(data) {
                $('#c_loading').fadeOut('fast');
                if (data === "1") {
                    $('#c_success').show(function() {
                        $("#csuccess_msg").html("Removed.");
                    });
                } else {
                    $('#c_error').show(function() {
                        $("#cerror_msg").html("Oops! Something went wrong. <br />Please try again later.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#add_certificates', function() {
        $('#c_error').fadeOut('fast');
        $('#c_loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../scripts/update_cv.php?switch=cert',
            data: data,
            success: function(data) {
                $('#c_loading').fadeOut('fast');
                if (data === "1") {
                    $('#c_success').show(function() {
                        $("#csuccess_msg").html("Certificate Added.");
                    });
                } else if (data === "0") {
                    $('#c_error').show(function() {
                        $("#cerror_msg").html("Oops! <br />Please try again.");
                    });
                } else {
                    $('#c_error').show(function() {
                        $("#cerror_msg").html("Oops! Something went wrong. <br />Please try again later.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#js_basic_info', function() {
        $('#_error').fadeOut('fast');
        $('#_loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../scripts/update_cv.php?switch=basic',
            data: data,
            success: function(data) {
                $('#_loading').fadeOut('fast');
                if (data === "1") {
                    $('#_success').show(function() {
                        $("#success_msg").html("Yay! Information updated successfully.");
                    });
                } else if (data === "0") {
                    $('#_error').show(function() {
                        $("#error_msg").html("Oops! Information could not be updated.<br />Please try again.");
                    });
                } else {
                    $('#_error').show(function() {
                        $("#error_msg").html("Oops! Something went wrong. <br />Please try again later.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#jobseeker_reg', function() {
        $("#error").hide();
        $("#loading").fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'scripts/jobseekerReg.php',
            data: data,
            success: function(data) {
                $("#loading").fadeOut('fast');
                if (data === "2") {
                    $('#success').show(function() {
                        $("#success_msg").html("Yay! Your account has been created. <br />Please sign in");
                    });
                } else if (data === "0") {
                    $('#error').show(function() {
                        $("#error_msg").html("Oops! That email address is already registered. <br />Please login, or reset your password.");
                    });
                } else if (data === "1") {
                    $('#error').show(function() {
                        $("#error_msg").html("Oops! Account could not be created. <br />Something went wrong. Please try again.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#jobsportal_login', function() {
        $("#error_div").hide();
        $("#loading").fadeIn('fast');

        if ($.trim($('#username').val()) === '') {
            $("#loading").fadeOut('fast');
            $('#error_div').show(function() {
                $("#error_msg").html("Please enter your email address.");
            });
            $('#username').focus()
            return false;
        }
        if ($.trim($('#password').val()) == '') {
            $("#loading").fadeOut('fast');
            $('#error_div').show(function() {
                $("#error_msg").html("Please enter your password.");
            });
            $('#password').focus()
            return false;
        }

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../../scripts/jobsPortalLogin.php',
            data: data,
            success: function(data) {
                $("#loading").fadeOut('fast');
                if (data === "0") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! We could not log you in. <br />Wrong password or email address.<br />Please double check and try again.");
                    });
                    $('#password').focus();
                } else if (data === "2") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! That email address does't look right. <br />Please double check and try again.");
                    });
                    $('#username').focus();
                } else {
                    window.location.href = "../";
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#changeJobsPass', function() {
        $('#pass_error').hide();
        $('#pass_success').hide();
        $('#loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../scripts/changePass.php',
            data: data,
            success: function(data) {
                $('#loading').fadeOut('fast');
                if (data === "1") {
                    $('#pass_error').hide();
                    $('#pass_success').show(function() {
                        $("#pass_success_msg").html("Yay! Your password has been updated.");
                    });
                    $('#changePass').trigger("reset");
                } else if (data === "0") {
                    $('#pass_success').hide();
                    $('#pass_error').show(function() {
                        $("#pass_error_msg").html("Oops! Your existing password is invalid.");
                    });
                    $('#changePass').trigger("reset");
                } else if (data === "3") {
                    $('#pass_success').hide();
                    $('#pass_error').show(function() {
                        $("#pass_error_msg").html("Ooops! Your passwords do not match.");
                    });
                    $('#changePass').trigger("reset");
                } else {
                    $('#pass_success').hide();
                    $('#pass_error').show(function() {
                        $("#pass_error_msg").html("Oops! Something went wrong. Please try again.");
                    });
                    $('#changePass').trigger("reset");
                }
            }
        });
        return false;
    });

    /* =============================== */

    $(document).on('submit', '#bidJobForm', function() {
        $('#error_div').fadeOut('fast');
        $('#loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'scripts/bidJob.php',
            data: data,
            success: function(data) {
                $('#loading').fadeOut('fast');
                if (data === "0") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! Your form is missing some fileds. <br />Please check and try again.");
                    });
                } else if (data === "1") {
                    $('#success_div').show(function() {
                        $("#success_msg").html("Yay! You have succesfully bid for this job. The client has been notified. <br />You will be notified once they've reviewed your bid.");
                        //clear all fields
                        $('#bidJobForm').trigger("reset");
                    });
                } else if (data === "2") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! Something went wrong. <br>We were unable to place your bid for this job. <br />Please try again.");
                    });
                } else {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! We seem to be experirncing some technical problems. <br />Please try again later.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#editSUP', function() {
        $('#pro_error').fadeOut('fast');
        $('#pro_success').fadeOut('fast');
        $('#pro_loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'scripts/profiles.php?switch=SUP',
            data: data,
            success: function(data) {
                $('#pro_loading').fadeOut('fast');
                if (data === "0") {
                    $('#pro_error').show(function() {
                        $("#pro_error_msg").html("Oops! Your form is missing some fileds. <br />Please check and try again.");
                    });
                } else if (data === "1") {
                    $('#pro_success').show(function() {
                        $("#pro_success_msg").html("Profile updated.");
                        //clear all fields
                        $('#editSUP').trigger("reset");
                    });
                } else if (data === "2") {
                    $('#pro_error').show(function() {
                        $("#pro_error_msg").html("Oops! Something went wrong. Please try again.");
                    });
                } else {
                    $('#pro_error').show(function() {
                        $("#pro_error_msg").html("Oops! We seem to be experirncing some technical problems. <br />Please try again later.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#editCl', function() {
        $('#pro_error').fadeOut('fast');
        $('#pro_loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'scripts/profiles.php?switch=CL',
            data: data,
            success: function(data) {
                $('#pro_loading').fadeOut('fast');
                if (data === "0") {
                    $('#pro_error').show(function() {
                        $("#pro_error_msg").html("Oops! Your form is missing some fileds. <br />Please check and try again.");
                    });
                } else if (data === "1") {
                    $('#pro_success').show(function() {
                        $("#pro_success_msg").html("Profile updated.");
                        //clear all fields
                        $('#editCl').trigger("reset");
                    });
                } else if (data === "2") {
                    $('#pro_error').show(function() {
                        $("#pro_error_msg").html("Oops! Something went wrong. Please try again.");
                    });
                } else {
                    $('#pro_error').show(function() {
                        $("#pro_error_msg").html("Oops! We seem to be experirncing some technical problems. <br />Please try again later.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#editSP', function() {
        $('#pro_error_div').fadeOut('fast');
        $('#pro_loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../scripts/profiles.php?switch=SP',
            data: data,
            success: function(data) {
                $('#pro_loading').fadeOut('fast');
                if (data === "1") {
                    $('#pro_success').show(function() {
                        $("#pro_success_msg").html("Profile updated.");
                        //clear all fields
                        $('#editCl').trigger("reset"); 
                    });
                } else if (data === "2") {
                    $('#pro_error').show(function() {
                        $("#pro_error_msg").html("Oops! Something went wrong. Please try again.");
                    });
                } else {
                    $('#pro_error').show(function() {
                        $("#pro_error_msg").html("Oops! We seem to be experirncing some technical problems. <br />Please try again later.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#logJobForm', function() {
        console.log("INSIDE LOG JOB");
        $('#error_div').fadeOut('fast');
        $('#loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'scripts/logjob.php',
            data: data,
            success: function(data) {

                $('#loading').fadeOut('fast');

                if (data === "0") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! Your form is missing some fileds. <br />Please check and try again.");
                    });
                } else if (data === "1") {
                    $('#success_div').show(function() {
                        $("#success_msg").html("Yay! Your job was logged succesfully. <br />All Service Providers have been notified. <br />Sit back and let the bidders begin.");
                        //clear all fields
                        $('#logJobForm').trigger("reset");
                    });
                } else if (data === "2") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! We were unable to notify Service Providers about your new job. <br />Please do it mannually.");
                    });
                } else if (data === "3") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! Something went wrong. <br>We were unable to log your job. Please try again.");
                    });
                } else {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! We seem to be experirncing some technical problems. <br />Please try again later.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#supReg', function() {
        $('#error_div').fadeOut('fast');
        $('#success_div').fadeOut('fast');
        $('#loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'scripts/supReg.php',
            data: data,
            success: function(data) {
                $('#loading').fadeOut('fast');
                if (data === '4') {
                    $('#success_div').show(function() {
                        $("#success_msg").html("Yay! Your account has been created. <br />Please sign in.");
                    });

                    //clear all fields
                    $('#supReg').trigger("reset");
                } else if (data === "0") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! Your form is missing some fileds. <br />Please check and try again.");
                    });
                } else if (data === "1") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! Your email address is in invalid. <br />Please correct and try again.");
                    });
                } else if (data === "2") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! That email address is already registered. <br />Please login to your account. \n\
                                                    You can request your password if you've lost it.");
                    });
                } else if (data === "3") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! Account could not be created. <br />Something went wrong. Please try again.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#spReg', function() {

        $('#error_div').fadeOut('fast');
        $('#success_div').fadeOut('fast');
        $('#loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../scripts/spReg.php',
            data: data,
            success: function(data) {
                $('#loading').fadeOut('fast');

                if (data === "0") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! Your form is missing some fileds. <br />Please check and try again.");
                    });
                } else if (data === "1") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! Your email address is in invalid. <br />Please correct and try again.");
                    });
                } else if (data === "2") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! That email address is already registered. <br />Please try again.");
                    });
                } else if (data === "3") {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! Account could not be created. <br />Something went wrong. Please try again.");
                    });
                } else {
                    $('#success_div').show(function() {
                        $("#success_msg").html("Yay! Your account has been created. <br />Please sign in.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#clientReg', function() {
        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'scripts/clientReg.php',
            data: data,
            success: function(data) {
                if (data === "4") {
                    $('#success').show(function() {
                        $("#success_msg").html("Yay! Your account has been created. <br />Please sign in");
                    });
                } else if (data === "0") {
                    $('#error').show(function() {
                        $("#error_msg").html("Oops! Your form is missing some fileds. <br />Please check and try again.");
                    });
                } else if (data === "1") {
                    $('#error').show(function() {
                        $("#error_msg").html("Oops! Your email address is in invalid. <br />Please correct and try again.");
                    });
                } else if (data === "2") {
                    $('#error').show(function() {
                        $("#error_msg").html("Oops! That email address is already registered. <br />Please login, or reset your password.");
                    });
                } else if (data === "3") {
                    $('#error').show(function() {
                        $("#error_msg").html("Oops! Account could not be created. <br />Something went wrong. Please try again.");
                    });
                }

            }
        });
        return false;
    });

    $(document).on('submit', '#changePass', function() {
        $('#pass_error').hide();
        $('#pass_success').hide();
        $('#loading').fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../scripts/changePass.php',
            data: data,
            success: function(data) {
                $('#loading').fadeOut('fast');
                if (data === "1") {
                    $('#pass_error').hide();
                    $('#pass_success').show(function() {
                        $("#pass_success_msg").html("Yay! Your password has been updated.");
                    });
                    $('#changePass').trigger("reset");
                } else if (data === "0") {
                    $('#pass_success').hide();
                    $('#pass_error').show(function() {
                        $("#pass_error_msg").html("Oops! Your existing password is invalid.");
                    });
                    $('#changePass').trigger("reset");
                } else if (data === "3") {
                    $('#pass_success').hide();
                    $('#pass_error').show(function() {
                        $("#pass_error_msg").html("Ooops! Your passwords do not match.");
                    });
                    $('#changePass').trigger("reset");
                } else {
                    $('#pass_success').hide();
                    $('#pass_error').show(function() {
                        $("#pass_error_msg").html("Oops! Something went wrong. Please try again.");
                    });
                    $('#changePass').trigger("reset");
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#deepLoginForm', function() {
        $("#error_div").hide();
        $("#profile").hide();
        $("#loading").fadeIn('fast');

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'scripts/deep_login.php',
            data: data,
            success: function(data) {
                $("#loading").fadeOut('fast');
                if (data === "0") {
                    $("#profile").show();
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! We could not log you in. <br />Wrong password or email address.<br />Please double check and try again.");
                    });
                    $('#usrpass').focus();
                } else {
                    window.location.href = "index.php?page_id=" + data;
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#loginForm', function() {
        $("#error_div").hide();
        $("#loading").fadeIn('fast');

        if ($.trim($('#username').val()) === '') {
            $("#loading").fadeOut('fast');
            $('#error_div').show(function() {
                $("#error_msg").html("Please enter your email address.");
            });
            $('#username').focus()
            return false;
        }

        if ($.trim($('#password').val()) == '') {
            $("#loading").fadeOut('fast');
            $('#error_div').show(function() {
                $("#error_msg").html("Please enter your password.");
            });
            $('#password').focus()
            return false;
        }

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../scripts/login.php',
            data: data,
            success: function(data) {
                $("#loading").fadeOut('fast');
                if (data == 0) {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! We could not log you in. <br />Wrong password or email address.<br />Please double check and try again.");
                    });
                    $('#password').focus();
                } else if (data == 2) {
                    $('#error_div').show(function() {
                        $("#error_msg").html("Oops! That email address does't look right. <br />Please double check and try again.");
                    });
                    $('#username').focus();
                } else {
                    window.location.href = "../";
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#forgotPassForm', function() {

        $("#fpass_error").hide();
        $("#fpass_success").hide();

        if ($.trim($('#userMail').val()) === '') {

            $('#error_div_fpass').show(function() {
                $("#error_msg_fpass").html("Please enter your email address.");
            });
            $('#userMail').focus();
            return false;
        }

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'scripts/forgotPass.php',
            data: data,
            success: function(data) {
                if (data === "1") {
                    userM = $('#userMail').val();
                    $('#fpass_success').show(function() {
                        $("#fpass_success_msg").html("Yay!!! <br> We have mailed password reset instructions to " + userM);
                    });
                } else if (data === "0") {
                    $('#fpass_error').show(function() {
                        $("#fpass_error_msg").html("Oops!!!<br > Something went wrong. <br >Please try again or contact support at support@jmbonline.co.za");
                    });
                    $('#userMail').focus();
                } else if (data === "2") {
                    $('#fpass_error').show(function() {
                        $("#fpass_error_msg").html("Oops!!!<br> That email address doesn't seem to be registered. <br /> Please double check and try again or contact support at support@jmbonline.co.za");
                    });
                    $('#userMail').focus();
                } else {
                    $('#fpass_error').show(function() {
                        $("#fpass_error_msg").html("Oops!!!<br> Something went wrong. <br>Please contact support at support@jmbonline.co.za.");
                    });
                }
            }
        });
        return false;
    });

    $(document).on('submit', '#resetPassForm', function() {
        $("#error_div").hide();
        $("#loading").fadeIn('fast');
        var pID = $("#_id").val();

        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'scripts/resetPass.php?id=' + pID,
            data: data,
            success: function(data) {
                $("#loading").fadeOut('fast');
                if (data === "1") {
                    $('#profile').hide();
                    $('#resetPassForm').hide();
                    $('#error_div').hide();
                    $('#success').show();
                } else {
                    $('#error_div').show();
                    $('#resetPassForm').trigger('reset');
                    $('#password').focus();
                }
            }
        });
        return false;
    });
});
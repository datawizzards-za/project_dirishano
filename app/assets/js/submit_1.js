/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function()
{    
    $(document).on('submit', '#bidJobForm', function()
	{
            $('#error_div').fadeOut('fast');
            $('#loading').fadeIn('fast');
            
            var data = $(this).serialize();
            $.ajax({
            type : 'POST',
            url  : 'scripts/bidJob.php',
            data : data,
            success :  function(data){    
                $('#loading').fadeOut('fast');            
                if(data === "0"){
                $('#error_div').show(function()
                    {
                        $("#error_msg").html("Oops! Your form is missing some fileds. <br />Please check and try again.");
                    });
                }else if(data === "1"){
                    $('#success_div').show(function()
                    {
                        $("#success_msg").html("Yay! You have succesfully bid for this job. The client has been notified. <br />You will be notified once they've reviewed your bid.");
                        //clear all fields
                        $('#bidJobForm').trigger("reset");
                    });
                    }else if(data === "2"){
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! Something went wrong. <br>We were unable to place your bid for this job. <br />Please try again.");
                            });
                    }else{
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! We seem to be experirncing some technical problems. <br />Please try again later.");
                        });
                    }
            }});
            return false;
        });
    
    $(document).on('submit', '#logJobForm', function()
	{
            $('#error_div').fadeOut('fast');
            $('#loading').fadeIn('fast');
            
            var data = $(this).serialize();
            $.ajax({
            type : 'POST',
            url  : 'scripts/logjob.php',
            data : data,
            success :  function(data){   
                                
                $('#loading').fadeOut('fast');
                
                if(data === "0"){
                $('#error_div').show(function()
                    {
                        $("#error_msg").html("Oops! Your form is missing some fileds. <br />Please check and try again.");
                    });
                }else if(data === "1"){
                    $('#success_div').show(function()
                    {
                        $("#success_msg").html("Yay! Your job was logged succesfully. <br />All Service Providers have been notified. <br />Sit back and let the bidders begin.");
                        //clear all fields
                        $('#logJobForm').trigger("reset");
                    });
                    }else if(data === "2"){
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! We were unable to notify Service Providers about your new job. <br />Please do it mannually.");
                            });
                    }else if(data === "3"){
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! Something went wrong. <br>We were unable to log your job. Please try again.");
                            });
                    }else{
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! We seem to be experirncing some technical problems. <br />Please try again later.");
                        });
                    }
            }});
            return false;
        });
    
    $(document).on('submit', '#supReg', function()
	{
		$('#error_div').fadeOut('fast');
		$('#success_div').fadeOut('fast');
		$('#loading').fadeIn('fast');
		
		var data = $(this).serialize();
		$.ajax({
            type : 'POST',
            url  : 'scripts/supReg.php',
            data : data,
            success :  function(data){ 				
                $('#loading').fadeOut('fast');    
                if(data === "0"){
                $('#error_div').show(function()
                    {
                        $("#error_msg").html("Oops! Your form is missing some fileds. <br />Please check and try again.");
                    });
                }else if(data === "1"){
                    $('#error_div').show(function()
                    {
                        $("#error_msg").html("Oops! Your email address is in invalid. <br />Please correct and try again.");
                    });
                    }else if(data === "2"){
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! That email address is already registered. <br />Please try again.");
                            });
                    }else if(data === "3"){
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! Account could not be created. <br />Something went wrong. Please try again.");
                            });
                    }else{
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Yay! Your account has been created. <br />Please sign in.");
                        });
                        
                    //clear all fields
                    $('#supReg').trigger("reset");
                    }
            }});
            return false;
        });
    
    $(document).on('submit', '#spReg', function()
	{
		$('#error_div').fadeOut('fast');
		$('#success_div').fadeOut('fast');
		$('#loading').fadeIn('fast');
		
		var data = $(this).serialize();
            $.ajax({
            type : 'POST',
            url  : 'scripts/spReg.php',
            data : data,
            success :  function(data){   
                $('#loading').fadeOut('fast');  			
                if(data === "0"){
                $('#error_div').show(function()
                    {  
                        $("#error_msg").html("Oops! Your form is missing some fileds. <br />Please check and try again.");
                    });
                }else if(data === "1"){
                    $('#error_div').show(function()
                    {
                        $("#error_msg").html("Oops! Your email address is in invalid. <br />Please correct and try again.");
                    });
                    }else if(data === "2"){
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! That email address is already registered. <br />Please try again.");
                            });
                    }else if(data === "3"){
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! Account could not be created. <br />Something went wrong. Please try again.");
                            });
                    }else{
                        $('#success_div').show(function()
                        {
                            $("#error_msg").html("Yay! Your account has been created. <br />Please sign in.");
                        });
                    }
            }});
            return false;
        });
        
        $(document).on('submit', '#clientReg', function()
	{
            var data = $(this).serialize();
            $.ajax({
            type : 'POST',
            url  : 'scripts/clientReg.php',
            data : data,
            success :  function(data){
                
                if(data === "0"){
                $('#error_div').show(function()
                    {
                        $("#error_msg").html("Oops! Your form is missing some fileds. <br />Please check and try again.");
                    });
                }else if(data === "1"){
                    $('#error_div').show(function()
                    {
                        $("#error_msg").html("Oops! Your email address is in invalid. <br />Please correct and try again.");
                    });
                    }else if(data === "2"){
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! That email address is already registered. <br />Please try again.");
                            });
                    }else if(data === "3"){
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! Account could not be created. <br />Something went wrong. Please try again.");
                            });
                    }else{
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Yay! Your account has been created. <br />Please sign in");
                            });
                    }

            }});
            return false;
        });
	
        $(document).on('submit', '#changePass', function()
	{
		if($.trim($('#npassword').val()) !== $.trim($('#cpassword').val())){
                        $('#success_div').hide();
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Ooops! Your passwords do not match.");
                        });                     
			return false;
		}
                
                var data = $(this).serialize();
		$.ajax({
		type : 'POST',
		url  : 'scripts/changePass.php',
		data : data,
		success :  function(data){
                    if(data === "1"){
                        $('#error_div').hide();
                        $('#success_div').show(function()
                        {
                            $("#success_msg").html("Yay! Your password has been updated.");
                        });
                        $('#changePass').trigger("reset");
                    }else if(data === "0"){
                        $('#success_div').hide();
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! Your existing password is invalid.");
                        });                        
                        $('#changePass').trigger("reset");
                        }else{
                        $('#success_div').hide();
                            $('#error_div').show(function()
                            {
                                $("#error_msg").html("Oops! Something went wrong. Please try again.");
                                });
                        $('#changePass').trigger("reset");
                        }
                    
                }});
		return false;
        });
        
	$(document).on('submit', '#loginForm', function()
	{
            $("#error_div").hide();
            $("#loading").fadeIn('fast');
            
            if($.trim($('#username').val()) == ''){
                $("#loading").fadeOut('fast');
                $('#error_div').show(function()
                {                            
                    $("#error_msg").html("Please enter your email address.");
                });                        
                $('#username').focus()
                return false;
		}
		if($.trim($('#password').val()) == ''){
                    $("#loading").fadeOut('fast');
                    $('#error_div').show(function()
                        {
                            $("#error_msg").html("Please enter your password.");
                        });
			$('#password').focus()
			return false;
		}
			
		var data = $(this).serialize();
		$.ajax({
		type : 'POST',
		url  : 'scripts/login.php',
		data : data,
		success :  function(data){
                        $("#loading").fadeOut('fast');
                        if(data == 0){
                            $('#error_div').show(function(){
                                $("#error_msg").html("Oops! We could not log you in. <br />Wrong password or email address.<br />Please double check and try again.");
                            });
                            $('#password').focus();                    	
                    }else if(data == 2){          
                        $('#error_div').show(function()
                        {
                            $("#error_msg").html("Oops! That email address does't look right. <br />Please double check and try again.");
                        });
                        $('#username').focus();
                    }else{
                        window.location.href = "index.php?page_id="+data;
                    }
                }});
		return false;
	});
        
        $(document).on('submit', '#forgotPassForm', function()
	{
		if($.trim($('#userMail').val()) == ''){
                    
                        $('#error_div_fpass').show(function()
                        {
                            $("#error_msg_fpass").html("Please enter your email address.");
                        });                        
			$('#userMail').focus();
			return false;
		}
			
		var data = $(this).serialize();
		$.ajax({
		type : 'POST',
		url  : 'scripts/forgotPass.php',
		data : data,
		success :  function(data){
                    if(data === "1"){
                        userM = $('#userMail').val();
                         $('#error_div_fpass').show(function()
	                        {
	                            $("#error_msg_fpass").html("Yay! Your password has been retrieved successfully and mailed to " + userM);
	                        });
                                $('#userMail').val("");                        
                    }else if(data === "0"){
                        $('#error_div_fpass').show(function()
	                        {
	                            $("#error_msg_fpass").html("Oops! Something went wrong. Please try again or contact support at support@jmbonline.co.za");
	                        });
                                $('#userMail').focus();
                            }else if(data === "2"){
                        $('#error_div_fpass').show(function()
	                        {
	                            $("#error_msg_fpass").html("Oops! That email address doesn't seem to be registered. <br /> Please double check and try again or contact support at support@jmbonline.co.za");
	                        });
                                $('#userMail').focus();
                            }else{
                        $('#error_div_fpass').show(function()
	                        {
	                            $("#error_msg_fpass").html("Oops! Something went wrong. Please contact support at support@jmbonline.co.za.");
	                        });
                            }
                        }
            });
		return false;
	});
});
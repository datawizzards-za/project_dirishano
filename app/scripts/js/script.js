$(document).ready(function(e) {

    $("#uploadimage").on('submit', (function(e) {
        $('#pic_loading').fadeIn('fast');

        e.preventDefault();
        $("#message").empty();
        $('#pic_error').fadeOut('fast');
        $.ajax({
            url: "../scripts/upload.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function(data) // A function to be called if request succeeds
                {
                    $('#pic_loading').hide();
                    if (data === "1") {
                        $('#pic_loading').hide();
                        $('#pic_success').show(function() {
                            $("#success_msg").html("Yay! Your profile photo was successfully changed.");
                        });
                        $('#btnSave').hide();
                    } else if (data === "2") {
                        $('#pic_loading').fadeOut('fast');
                        $('#pic_error').show(function() {
                            $("#error_msg").html("Oops. <br />We could not update your profile picture. Please try again.");
                        });
                    } else if (data === "-1") {
                        $('#pic_loading').fadeOut('fast');
                        $('#pic_error').show(function() {
                            $("#error_msg").html("Oops. <br />Invalid image type. Only png and jpg images are permitted.");
                        });
                    } else {
                        $('#pic_error').show(function() {
                            $("#error_msg").html("Oops. <br />Some technical error occured. <br />Please try again later.");
                        });
                    }
                },
            error: function(data) {
                $('#pic_loading').fadeOut('fast');
                $('#btnSave').hide();
                $('#pic_error').show(function() {
                    $("#error_msg").html("Oops. A servere technical error occured. <br>Please contact support.");
                });
            }
        });
    }));

    $("#changeImage").on('submit', (function(e) {
        $('#pic_loading').fadeIn('fast');
        
        e.preventDefault();
        $("#message").empty();
        $('#pic_error').fadeOut('fast');
        $.ajax({
            url: "../../scripts/uploadJP.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function(data) // A function to be called if request succeeds
                {
                    if (data === "1") {
                        $('#pic_loading').hide();
                        $('#pic_success').show(function() {
                            $("#success_msg").html("Yay! Your profile photo was successfully changed.");
                        });
                        $('#btnSave').hide();
                    } else if (data === "-1") {
                        $('#pic_loading').fadeOut('fast');
                        $('#btnSave').hide();
                        $('#pic_error').show(function() {
                            $("#error_msg").html("Oops. Invalid image uploaded. <br>Only png and jpg images are permitted.");
                        });
                    } else if (data === "2") {
                        $('#pic_loading').fadeOut('fast');
                        $('#btnSave').hide();
                        $('#pic_error').show(function() {
                            $("#error_msg").html("Oops. We could not update your profile picture. Please try again.");
                        });
                    } else {
                        $('#pic_loading').fadeOut('fast');
                        $('#btnSave').hide();
                        $('#pic_error').show(function() {
                            $("#error_msg").html("Oops! There was a technical error. Please try again later.");
                        });
                    }
                },
            error: function(data) {
                $('#pic_loading').fadeOut('fast');
                $('#btnSave').hide();
                $('#pic_error').show(function() {
                    $("#error_msg").html("Oops. Some technical error occured. Please try again later.");
                });
            }
        });
    }));

    // Function to preview image after validation
    $(function() {
        $("#file").change(function() {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg", "image/JPEG", "image/PNG", "image/JPG"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                $('#previewing').attr('src', 'noimage.png');
                $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                return false;
            } else {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    function imageIsLoaded(e) {
        $("#file").css("color", "green");
        $('#image_preview').css("display", "block");
        $('#previewing').css("cursor", "pointer");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '50%');
        $('#previewing').attr('height', '50%');
    };
});
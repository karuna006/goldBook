$(document).ready(function () {
    $('#loginForm').validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true                
            }
        },
        messages: {
            username: {
                required: "Please choose a username."
            },
            password: {
                required: "Please enter your password."                
            }
        },
        errorPlacement: function (error, element) {
            // Check if an error message already exists (use .siblings() to check for an existing invalid-feedback)
            var existingError = element.siblings('.invalid-feedback');
            
            // If an error message already exists, remove it
            if (existingError.length) {
                existingError.remove();
            }

            // Create and append the new error message
            var errorMessage = $('<div class="invalid-feedback">' + error[0].innerHTML + '</div>');
            element.after(errorMessage);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
            if ($(element).attr('name') === 'password') {        
                $(".show-hide").addClass("is-invalid");
            }
            
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
            if ($(element).attr('name') === 'password') {        
                $(".show-hide").removeClass("is-invalid");
            }
            // Remove the error message once the field is valid
            // element.siblings('.invalid-feedback').remove();
        },
        submitHandler: function (form) {
            // On successful form validation, submit via AJAX or any other action
            var username = $('#username').val();
            var password = $('#password').val();

            $.ajax({
                type: 'POST',
                url: '/goldbook/controller/ajax_controller.php',
                data: { username: username, password: password, from: 'check_login' },
                success: function (response) {                    
                    if (response == 'request_success') {                        
                        window.location.href = './view';
                    } else {
                        showToast("Invalid username or password. Please try again.");                   
                    }
                },
                error: function (xhr, status, error) {         
                    showToast("An error occurred, please try again later.");           
                }
            });
        }
    });

    // Password visibility toggle
    $('.show-hide span').click(function () {
        var inputField = $('#password');
        var currentType = inputField.attr('type');
        
        if (currentType === 'password') {
            inputField.attr('type', 'text');
            $(this).addClass('show');
        } else {
            inputField.attr('type', 'password');
            $(this).removeClass('show');
        }
    });

    function showToast(message) {
        // Set new message
        document.getElementById('toastMessage').textContent = message;

        // Show the toast
        const toastLiveExample = document.getElementById("liveToast1");
        const toast = new bootstrap.Toast(toastLiveExample);
        toast.show();
    }
});

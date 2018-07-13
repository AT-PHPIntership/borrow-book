$(document).ready(function () {
    if (localStorage.getItem('access_token')) {
       window.location.href = '/';
    }

    $(document).on('click', '#send-email-reset', function (event) {
        event.preventDefault();
        $.ajax({
            url: "/api/password/reset",
            type: "POST",
            headers: {
                'Accept': 'application/json',
            },
            data: {
                email: $('#email').val(),
            },
            success: function (response) {
                $('#send-mail-form .alert-success').html(response.message);
                $('#send-mail-form .alert-success').show();
            },
            statusCode: {
                404: function (response) {
                    if (response.responseJSON.error) {
                        $('#send-mail-form .alert-danger').html(response.responseJSON.error.message);
                        $('#send-mail-form .alert-danger').show();
                    }
                },
                422: function (response) {
                    let errorMessage = '';
                    if (response.responseJSON.errors) {
                        let errors = Object.keys(response.responseJSON.errors);
                        errors.forEach(error => {
                            errorMessage = response.responseJSON.errors[error] + '<br/>';
                        });
                    }
                    $('#send-mail-form .alert-danger').html(errorMessage);
                    $('#send-mail-form .alert-danger').show();
                }
            }
        });
    })

    $(document).on('click', '#reset-password', function (event) {
        event.preventDefault();
        $.ajax({
            url: "/api/password/reset",
            type: "PUT",
            headers: {
                'Accept': 'application/json',
            },
            data: {
                token: $('#reset_token').val(),
                email: $('#email').val(),
                password: $('#new-password').val(),
                password_confirmation: $('#re-password').val(),
            },
            success: function () {
                window.location.href = '/login';
            },
            statusCode: {
                404: function (response) {
                    if (response.responseJSON.error) {
                        $('#reset-password-form .invalid-feedback-email').html(response.responseJSON.error.message);
                        $('#reset-password-form .invalid-feedback-email').show();
                    }
                },
                422: function (response) {
                    if (response.responseJSON.errors) {
                        let errors = Object.keys(response.responseJSON.errors);
                        errors.forEach(error => {
                            let messageErrors = response.responseJSON.errors[error];
                            if (error == 'password') {
                                $('#reset-password-form .invalid-feedback-password').html('');
                                for (let i = 0; i < messageErrors.length; i++) {
                                    $('#reset-password-form .invalid-feedback-password').append(messageErrors[i] + '<br/>');
                                }
                                $('#reset-password-form .invalid-feedback-password').show();
                            } else {
                                $('#reset-password-form .invalid-feedback-email').html(messageErrors);
                                $('#reset-password-form .invalid-feedback-email').show();
                            }
                        });
                    }
                }
            },
        });
    })
})

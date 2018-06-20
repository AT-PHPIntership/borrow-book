$( document ).ready(function() {
    register();
    redirectRegister();
});

function register() {
    $('#register-form').submit(function(event) {
        event.preventDefault();
        $('#identity-number-error').text('');
        $('#email-error').text('');
        $('#password-error').text('');
        $('#password-confirmation-error').text('');
        $('#name-error').text('');
        $.ajax({
            type: 'POST',
            url: '/api/register',
            data: ({
                identity_number: $('#identity-number').val(),
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                password_confirmation: $('#password-confirmation').val(),
            }),
            success: function (data){
                window.localStorage.setItem('access_token', data.token);
                window.localStorage.setItem('data', JSON.stringify(data.user));
                window.location = '/';
            },
            error: function (data) {
                errors = data.responseJSON.errors;
                $('.invalid-feedback').show();
                $('#name-error').text(errors['name']);
                $('#identity-number-error').text(errors['identity_number']);
                $('#email-error').text(errors['email']);
                $('#password-error').text(errors['password']);
                $('#password-confirmation-error').text(errors['password']);
            }
        });
    });
}

function redirectRegister() {
    if (window.localStorage.getItem('access_token')) {
        window.location.replace('/');
    }
}

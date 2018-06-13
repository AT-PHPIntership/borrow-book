$( document ).ready(function() {
    login();
    redirectLogin();
});

function login() {
    $('#loginForm').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/api/login',
            data: ({
                email: $('#email').val(),
                password: $('#password').val()
            }),
            success: function (data){
                window.localStorage.setItem('access_token', data.token);
                window.localStorage.setItem('data', JSON.stringify(data.user));
                window.location = '/';
            },
            error: function (data) {
                alert(data.responseJSON.error);
            }
        });
    });
}

function redirectLogin() {
    if (window.localStorage.getItem('access_token')) {
        window.location.replace('/');
    }
}

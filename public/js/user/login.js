$('#loginForm').submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'api/login',
        data: ({
            email: $('#email').val(),
            password: $('#password').val()
        }),
        success: function (data){
            console.log(data);
            window.localStorage.setItem('access_token', data.token);
            window.localStorage.setItem('data', JSON.stringify(data.data));
            window.location = '/';
            
        }
    });
})

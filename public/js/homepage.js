$( document ).ready(function() {
    if (window.localStorage.getItem('access_token')) {
        getInfo();
    }
});

function getInfo() {
    $.ajax({
        type: 'GET',
        url: '/api/checkAccessToken',
        headers: ({
            Accept: 'application/json',
            Authorization: 'Bearer ' + window.localStorage.getItem('access_token'),
        }),
        success: function (){
            if (localStorage.getItem('data')) {
                var user = JSON.parse(localStorage.getItem('data'));
                var imageInfo = '<img src="'+ user.avatar +'" class="img-circle" alt="Cinque Terre" width="40" height="40">\
                                <small>'+ user.name +'</small>'
                $(".menu-1 #login a").hide();
                $(".menu-1 #register").hide();
                $(".menu-1 #login").html(imageInfo);
            }
        },
        error: function () {
            window.localStorage.removeItem('access_token');
            window.localStorage.removeItem('data');
        }
    });
}

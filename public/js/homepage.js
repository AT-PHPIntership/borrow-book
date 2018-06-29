var logout = Lang.get('auth.logout');
var profile = Lang.get('auth.profile');

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
                                <a href="javascript:void(0);" class="dropdown-toggle" id="setting" data-toggle="dropdown"><small>'+ user.name +'</small><span class="caret"></span></a>\
                                <ul class="dropdown-menu" role="menu" aria-labelledby="setting">\
                                    <li><a id="profile" href="/profile">'+ profile +'</a></li>\
                                    <li><a id="logout">'+ logout +'</a></li>\
                                </ul>';
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

$(document).on('click', '#logout' , function logout() {
    $.ajax({
        type: 'POST',
        url: '/api/logout',
        headers: ({
            Accept: 'application/json',
            Authorization: 'Bearer ' + window.localStorage.getItem('access_token'),
        }),
        success: function (){
            window.localStorage.removeItem('access_token');
            window.localStorage.removeItem('data');
            window.location.reload();
        },
    });
});

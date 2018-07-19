const READ = 1;
const UNREAD = 0;
$(document).ready(function () {
    getListFavorite();
    updateStatus();
})

function getListFavorite() {
    $.ajax({
        url: "/api/users/favorites",
        type: "get",
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
        },
        success: function( response ) {
            response.data.forEach(favorites => {
                let nameBook = favorites.book.title;
                let idFavorite = "favorite" + favorites.id;
                $('#template-favorite').clone().attr({"style":"display: ", "id": idFavorite}).insertBefore('#template-favorite');
                $("#"+ idFavorite +" .book_name").text(nameBook);
                if (favorites.status == READ) {
                    $("#"+ idFavorite +" .status .btn-unread").hide();
                    $("#"+ idFavorite +" .status .btn-read").attr('data-status', READ);
                } else {
                    $("#"+ idFavorite +" .status .btn-read").hide();
                    $("#"+ idFavorite +" .status .btn-unread").attr('data-status', UNREAD);
                }
                $("#"+ idFavorite +" .status .btn-unread").attr('data-id', favorites.id);
                $("#"+ idFavorite +" .status .btn-read").attr('data-id', favorites.id);
            });
        }   
    });
}
function updateStatus() {
    $(document).on('click', '.btn-status',function(event) {
        var favoriteId = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        if(status == READ) {
            status = UNREAD
        } else {
            status = READ
        }
        $.ajax({
            url: '/api/users/favorites/' + favoriteId,
            type: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
            },
            data: {
                status: status
            },
            success: function(data) {
                if(data.status == READ) {
                   $("#favorite"+ favoriteId +" .status .btn-read").show();
                   $("#favorite"+ favoriteId +" .status .btn-unread").hide();
                } else {
                    $("#favorite"+ favoriteId +" .status .btn-unread").show();
                    $("#favorite"+ favoriteId +" .status .btn-read").hide();
                }
            }
        });
        
    });  
}

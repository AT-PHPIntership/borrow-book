var delete_confirm = Lang.get('auth.messages.delete_confirm');
var delete_success = Lang.get('auth.messages.delete_success');
var url = '/api/users/posts?limit=8';

function getUserPosts() {
    $.ajax({
        url: url,
        type: 'get',
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
        },
        success: function(response) {
            const COMMENT = 0;
            const REVIEW = 1;
            const ACCEPT = 1;
            const UNACCEPT = 0;
            if (response['next_page_url'] != null) {
                $('#next').show();
                $('#next').attr('href', response['next_page_url']);
            } else {
                $('#next').hide();
            }
            response.data.forEach(posts => {
                let body = posts.body;
                let rate = posts.rate_point;
                let nameBook = posts.book.title;
                let idpost = posts.id;
                let type = 'Comment';
                $('#template-post').clone().attr({"style":"display: ", "id":idpost}).insertBefore('#template-post');
                $("#"+ idpost +" .body").text(body);
                $("#"+ idpost +" .book-name").text(nameBook);
                if (posts.status == ACCEPT) {
                    $("#"+ idpost +" .status .btn-posts-err").hide();
                } else {
                    $("#"+ idpost +" .status .btn-posts-success").hide();
                }
                if (posts.post_type == REVIEW) {
                    type = "Review";
                    $("#"+ idpost +" .rate").text(rate);
                }
                $("#"+ idpost +" .type").html(type);
                $("#"+ idpost +" .option .delete-post-user").attr('id', idpost);
                $(".update-post-user").attr('data-id', idpost);
            });
        }
    });
}
getUserPosts();

$('#next').click(function (event) {
    event.preventDefault();
    url_next = $('#next').attr('href');
    getUserPosts(url_next);
})

function deletePostUser() {
    $(document).on('click', '.delete-post-user',function() {
        var postId = $(this).attr('id');
        if(confirm(delete_confirm))
        {
            $.ajax({
                url: '/api/posts/' + postId,
                type: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                },
                success: function(data) {
                    alert(delete_success);
                    $("#" + postId).remove();
                },
                error: function(data) {
                    $('.delete_error').html(data.responseJSON.error);
                    $('.delete_error').show();
                }
            });
        }
    });  
}
deletePostUser();

function editCommentProfile() {
    $("#form-edit-post").dialog({
        autoOpen: false,
        show: 'slide',
        resizable: false,
        position: 'center',
        stack: true,
        height: 'auto',
        width: 'auto',
        modal: true
    });
    $('.update-post-user').on('click', function () {
        $('').attr('class', 'center');
    })

    $('#close').on('click', function () {
        $('#form-edit-post').hide();
    })
}
editCommentProfile();

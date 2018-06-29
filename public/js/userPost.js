url = '/api/users/posts?limit=8';
function getUserPosts(url) {
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
                    $("#"+ idpost +" .status .btn-posts-success").attr('class','btn btn-success fa fa-check').show();
                } else {
                    $("#"+ idpost +" .status .btn-posts-err").attr('class','btn btn-danger fa fa-close').show();
                }
                if (posts.post_type == REVIEW) {
                    type = "Review";
                    $("#"+ idpost +" .rate").text(rate);
                }
                $("#"+ idpost +" .type").html(type);
            });
        }
    });
}

getUserPosts(url);
$('#next').click(function (event) {
    event.preventDefault();
    url_next = $('#next').attr('href');
    getUserPosts(url_next);
})

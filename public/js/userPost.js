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
            const UNACCEPT = 0;
            const ACCEPT = 1;
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
                let status = '';
                if (posts.status == ACCEPT) {
                    status = '<button class="btn btn-success fa fa-check " id="btn-posts-success" style="" disabled="disabled"></button>';
                } else {
                    status = '<button class="btn btn-danger fa fa-close" id="btn-posts-err" disabled="disabled"></button>';
                }
                let type = '';
                if (posts.post_type == REVIEW) {
                    type = "Review";
                } else {
                    type = "Comment";
                }
                let idpost=posts.id;
                $('#template-post').clone().attr({"style":"display: ", "id":idpost}).insertBefore('#template-post');
                $("#"+idpost +" .body").text(body);
                $("#"+idpost +" .book-name").text(nameBook);
                $("#"+idpost +" .status").html(status);
                $("#"+idpost +" .type").html(type);
                if (posts.post_type == REVIEW) {
                    $("#"+idpost +" .rate").text(rate);
                }
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

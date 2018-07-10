var delete_confirm = Lang.get('auth.messages.delete_confirm');
var delete_success = Lang.get('auth.messages.delete_success');
var url = '/api/users/posts?limit=8';
var urlUpdatePost = '/api/posts/';
const COMMENT = 0;
const REVIEW = 1;
const ACCEPT = 1;
const UNACCEPT = 0;

function getUserPosts() {
    $.ajax({
        url: url,
        type: 'get',
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
        },
        success: function(response) {
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
                let postType = posts.post_type;
                let type = 'Comment';
                $('#template-post').clone().attr({ "style": "display: ", "id": idpost, "data-post-type": postType }).insertBefore('#template-post');
                $("#"+ idpost +" .body").text(body);
                $("#"+ idpost +" .book-name").text(nameBook);
                if (posts.status == ACCEPT) {
                    $("#"+ idpost +" .status .btn-posts-err").hide();
                } else {
                    $("#"+ idpost +" .status .btn-posts-success").hide();
                }
                if (postType == REVIEW) {
                    type = "Review";
                    $("#"+ idpost +" .rate").text(rate);
                }
                $("#"+ idpost +" .type").html(type);
                $("#"+ idpost +" .option .delete-post-user").attr('id', idpost);
                $("#"+ idpost +" .update-post-user").attr('data-id', idpost);
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

$(document).ready(function(){
    $('#stars li').on('mouseover', function(){
        var onStar =$(this).data('value');
        $(this).parent().children('li.star').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            } else {
                $(this).removeClass('hover');
            }
        });
    }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
            $(this).removeClass('hover');
        });
    });
    $('#stars li').on('click', function(){
        var onStar = $(this).data('value');
        var stars = $(this).parent().children('li.star');
        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }
        for (i = 0; i < onStar; i++) {
          $(stars[i]).addClass('selected');
        }
    }); 
});

function editPostProfile() {
    var postId, postType;
    $(document).on('click', '.update-post-user',function() {
        postId = $(this).attr('data-id');
        postType = $('#'+ postId).attr('data-post-type');
        if(postType == REVIEW) {
            var rateStars = $("#"+ postId +" .rate").html();
            var stars = $('#stars li').parent().children('li.star');
            for (var i = 0; i < rateStars; i++) {
                $(stars[i]).addClass('selected');
            }
            $('#content-post').val($("#"+ postId +" .body").html());
            editReview(postId);
        } else{
            $('.rating-stars').attr('class', 'hidden');
            $('#content-post').val($("#"+ postId +" .body").html());
            editComment(postId);
        }
    });
      
}
editPostProfile();

function editComment(postId) {
    $(document).on('click', '#submit-update-post', function(event) {
        $.ajax({
            url: urlUpdatePost + postId,
            type: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
            },
            data: {
                post_type: COMMENT,
                body: $('#content-post').val(),
            },
            success: function(data) {
                $('.review_success').show();
                $("#"+ postId +" .body").text($('#content-post').val());
                $('#content_review').val('');
                $("#"+ postId +" .status .btn-posts-success").hide();
                $('#modal-update-post').modal('hide');
            },
            error: function(data) {
                errorMessage = data.responseJSON.message + '<br/>';
                if (data.responseJSON.errors) {
                    errors = Object.keys(data.responseJSON.errors);
                    errors.forEach(error => {
                        errorMessage += data.responseJSON.errors[error] + '<br/>';
                    });
                }
                $('.review_error').html(errorMessage);
                $('.review_error').show();
            }
        });
    });  
}

function editReview(postId) {
    $(document).on('click', '#submit-update-post', function(event) {
        $.ajax({
            url: urlUpdatePost + postId,
            type: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
            },
            data: {
                post_type: REVIEW,
                rate_point: $('#stars li.selected').last().data('value'),
                body: $('#content-post').val(),
            },
            success: function(data) {
                $('.review_success').show();
                $("#"+ postId +" .body").text($('#content-post').val());
                $('#content_review').val('');
                $("#"+ postId +" .rate").text($('#stars li.selected').last().data('value'));
                $("#"+ postId +" .status .btn-posts-success").hide();
                $('#modal-update-post').modal('hide');
            },
            error: function(data) {
                errorMessage = data.responseJSON.message + '<br/>';
                if (data.responseJSON.errors) {
                    errors = Object.keys(data.responseJSON.errors);
                    errors.forEach(error => {
                        errorMessage += data.responseJSON.errors[error] + '<br/>';
                    });
                }
                $('.review_error').html(errorMessage);
                $('.review_error').show();
            }
        });
    });
}

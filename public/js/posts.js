var bookId = window.location.pathname;
const postComment = 0;
const postReview = 1;
var urlReview = '/api'+ bookId +'/posts' + '?post_type=' + postReview;
var urlComment = '/api'+ bookId +'/posts' + '?post_type=' + postComment;
var ratingValue;
var urlDelete = '/api/posts/'

$(document).ready(function () {
    getListReview();
    getListComment();
    deletePost();
    submitComment();
    submitReview();
});

function getListReview() {
    $.get(urlReview)
    .done(function(data) {
        contentReview(data);
    })
    .fail(function(data) {
        if (data.responseJSON.message) {
            window.alert(data.responseJSON.message);
        }
        else {
            window.alert(data.responseJSON);
        }
    });
}

function contentReview(data) {
    var reviews = '';
    $.each(data.data, function (key, value) {
        var stars = '';
        var k = Math.round(value.rate_point);
        for (var i = 1; i <= k; i++) {
            stars += '<i class="fa fa-star"></i>'; 
        };
        reviews += '<div class="review" id="review_post'+ value.id +'">\
                        <div class="user-img" style="background-image: url('+ value.user.avatar +')"></div>\
                        <div class="desc">\
                            <h4>\
                                <span class="text-left">'+ value.user.name +'</span>\
                                <span class="text-right">'+ value.updated_at +'</span>\
                            </h4>\
                            <p class="star">\
                                <span>'+ stars +'</span>\
                               <span class="text-right" ><a href="javascript:void(0);" class="reply delete-post review-book" hidden id="'+ value.id +'"><i class="fa fa-times"></i></a></span>\
                            </p>\
                            <p>'+ value.body +'</p>\
                        </div>\
                    </div>';
        $("#content-review").html(reviews);
        if(localStorage.getItem('access_token')) {
            $('.review-book').show();
        }
    });
}

function getListComment() {
    $.get(urlComment)
    .done(function(data) {
        contentComment(data);
    })
    .fail(function(data) {
        if (data.responseJSON.message) {
            window.alert(data.responseJSON.message);
        }
        else {
            window.alert(data.responseJSON);
        }
    });
}

function contentComment(data) {
    var comment = '';
    $.each(data.data, function (key, value) {
        comment += '<div class="review" id="comment'+ value.id +'">\
                        <div class="user-img" style="background-image: url('+ value.user.avatar +')"></div>\
                        <div class="desc">\
                            <h4>\
                                <span class="text-left">'+ value.user.name +'</span>\
                                <span class="text-right">'+ value.updated_at +'</span>\
                            </h4>\
                             <p class="star comment-book" hidden>\
                                <span class="text-left"></span>\
                                <span class="text-right"><a href="javascript:void(0);" class="delete-post reply" id="'+ value.id +'" ><i class="fa fa-times"></i></a></span>\
                            </p>\
                            <p>'+ value.body +'</p>\
                        </div>\
                    </div>';
        $("#content-comment").html(comment);
        if(localStorage.getItem('access_token')) {
            $('.comment-book').show();
        }
    });
}

function deletePost() {
    $(document).on('click', '.delete-post',function() {
        var postId = $(this).attr('id');
        confirm("Are you sure delete?");
        $.ajax({
            url: urlDelete + postId,
            type: 'DELETE',
            headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
            },
            success: function(data) {
                if(data.post_type == 1) {
                    $("#review_post" + postId).remove();
                } else {
                    $("#comment" + postId).remove();
                }
            },
            error: function(data) {
                alert(data.responseJSON.error);
            }
        });
    });  
}

function submitComment() {
    $(document).on('click', '#add_comment', function(event)  {
        $.ajax({
            url: '/api' + bookId + '/posts',
            type: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
            },
            data: {
                post_type: postComment,
                body: $('#content_cmt').val(),
            },
            success: function(data) {
                $('.alert-info').show();
                $('#content_cmt').val('');

            },
            error: function(data) {
                errorMessage = data.responseJSON.message + '<br/>';
                if (data.responseJSON.errors) {
                    errors = Object.keys(data.responseJSON.errors);
                    errors.forEach(error => {
                        errorMessage += data.responseJSON.errors[error] + '<br/>';
                    });
                }
                $('.alert-danger').html(errorMessage);
                $('.alert-danger').show();
            }
        }); 
    });
}

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

function submitReview() {
    $(document).on('click', '#add_review', function(event) {  
        $.ajax({
            url: '/api' + bookId + '/posts',
            type: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
            },
            data: {
                post_type: postReview,
                rate_point: $('#stars li.selected').last().data('value'),
                body: $('#content_review').val(),
            },
            success: function(data) {
                $('.review_success').show();
                $('.star.selected').attr('class', 'star');
                $('#content_review').val('');
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

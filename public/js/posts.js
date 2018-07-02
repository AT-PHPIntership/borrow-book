var bookId = window.location.pathname;
const postComment = 0;
const postReview = 1;
var urlReview = '/api'+ bookId +'/posts' + '?post_type=' + postReview;
var urlComment = '/api'+ bookId +'/posts' + '?post_type=' + postComment;
var ratingValue;
var url = '/api/posts/';
var data_login = JSON.parse(localStorage.getItem('data'));
var delete_confirm = Lang.get('auth.messages.delete_confirm');
var delete_success = Lang.get('auth.messages.delete_success');

$(document).ready(function () {
    getListReview();
    getListComment();
    deletePost();
    submitComment();
    submitReview();
    editReview();
    editComment();
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
        reviews += '<div class="review" id="review_post-'+ value.id +'">\
                        <div class="user-img" style="background-image: url('+ value.user.avatar +')"></div>\
                        <div class="desc">\
                            <h4>\
                                <span class="text-left">'+ value.user.name +'</span>\
                                <span class="text-right">'+ value.updated_at +'</span>\
                            </h4>\
                            <p class="star">\
                                <span id="rate-value-'+ value.id +'" data-star="'+ k +'">'+ stars +'</span>\
                                <div class="dropdown icon-option review-book-'+ value.user.id +'" hidden>\
                                    <i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown"></i>\
                                    <ul class="dropdown-menu">\
                                        <li><a href="javascript:void(0);" id="'+ value.id +'" class="delete-post">Delete</a></li>\
                                        <li><a href="javascript:void(0);" id="'+ value.id +'" class="edit-review">Edit</a></li>\
                                    </ul>\
                                </div>\
                            </p>\
                            <p id="body-review-'+ value.id +'" data-value-review="'+ value.body +'">'+ value.body +'</p>\
                        </div>\
                    </div>';
        $("#list-review").html(reviews);
        if(localStorage.getItem('access_token')) {
            if(data_login.id == value.user.id){
                $('.review-book-'+ value.user.id +'').show();
            }
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
        comment += '<div class="review" id="comment-'+ value.id +'">\
                        <div class="user-img" style="background-image: url('+ value.user.avatar +')"></div>\
                        <div class="desc">\
                            <h4>\
                                <span class="text-left">'+ value.user.name +'</span>\
                                <span class="text-right">'+ value.updated_at +'</span>\
                            </h4>\
                            <p class="star comment-book">\
                                <span class="text-left"></span>\
                                <div class="dropdown icon-option comment-book-'+value.user.id+'" hidden>\
                                    <i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown"></i>\
                                    <ul class="dropdown-menu">\
                                        <li><a href="javascript:void(0);" id="'+ value.id +'" class="delete-post">Delete</a></li>\
                                        <li><a href="javascript:void(0);" id="'+ value.id +'" class="edit-comment">Edit</a></li>\
                                    </ul>\
                                </div>\
                            </p>\
                            <p id="body-comment-'+ value.id +'" data-value-comment="'+ value.body +'">'+ value.body +'</p>\
                        </div>\
                    </div>';
        $("#content-comment").html(comment);
        if(localStorage.getItem('access_token')) {
            if(data_login.id == value.user.id){
                $('.comment-book-'+value.user.id).show();
            }
        }

    });
}

function deletePost() {
    $(document).on('click', '.delete-post',function() {
        var postId = $(this).attr('id');
        if(confirm(delete_confirm))
        {
            $.ajax({
                url: url + postId,
                type: 'DELETE',
                headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                },
                success: function(data) {
                    if(data.post_type == 1) {
                        alert(delete_success);
                        $("#review_post-" + postId).remove();
                    } else {
                        alert(delete_success);
                        $("#comment-" + postId).remove();
                    }
                },
                error: function(data) {
                    if(data.post_type == 1) {
                        $('.review_error').html(errorMessage);
                        $('.review_error').show();
                    } else {
                        $('.comment-error').html(errorMessage);
                        $('.comment-error').show();
                    }
                }
            });
        }
    });  
}

function submitComment() {
    $(document).on('click', '#add_comment', function(event) {
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
                $('.comment-error').html(errorMessage);
                $('.comment-error').show();
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

function editReview() {
    var postId;
    $(document).on('click', '.edit-review',function() {
        postId = $(this).attr('id');
        $('#content_review').val($('#body-review-'+ postId).attr('data-value-review'));
        var rateStars = $('#rate-value-'+ postId).attr('data-star');
        var stars = $('#stars li').parent().children('li.star');
        for (var i = 0; i < rateStars; i++) {
            $(stars[i]).addClass('selected');
        }
        $('.btn-add-review').attr('id', 'update-review');
    });
    $(document).on('click', '#update-review', function(event) {
        $.ajax({
            url: url + postId,
            type: 'PUT',
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
                $('#review_post-' + postId).hide();
                $('.btn-add-review').attr('id', 'add-review');
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

function editComment() {
    var postId;
    $(document).on('click', '.edit-comment',function() {
        postId = $(this).attr('id');
        $('#content_cmt').val($('#body-comment-'+ postId).attr('data-value-comment'));
        $('.btn-add-comment').attr('id', 'update-comment');
    });
    $(document).on('click', '#update-comment', function(event) {
        $.ajax({
            url: url + postId,
            type: 'PUT',
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
                $('#comment-' + postId).hide();
                $('.btn-add-review').attr('id', 'add-comment');
            },
            error: function(data) {
                errorMessage = data.responseJSON.message + '<br/>';
                if (data.responseJSON.errors) {
                    errors = Object.keys(data.responseJSON.errors);
                    errors.forEach(error => {
                        errorMessage += data.responseJSON.errors[error] + '<br/>';
                    });
                }
                $('.comment-error').html(errorMessage);
                $('.comment-error').show();
            }
        });
    });  
}

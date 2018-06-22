var bookId = window.location.pathname;
const postComment = 0;
const postReview = 1;
var urlReview = '/api'+ bookId +'/posts' + '?post_type=' + postReview;
var urlComment = '/api'+ bookId +'/posts' + '?post_type=' + postComment;
var urlDelete = '/api/posts/'

$(document).ready(function () {
    getListReview();
    getListComment();
    deletePost();
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
                               <span class="text-right"><a href="javascript:void(0);" class="reply delete-post" id="'+ value.id +'"><i class="fa fa-times"></i></a></span>\
                            </p>\
                            <p>'+ value.body +'</p>\
                        </div>\
                    </div>';
        $("#content-review").html(reviews);
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
                             <p class="star">\
                                <span class="text-left"></span>\
                                <span class="text-right"><a href="javascript:void(0);" class="delete-post reply" id="'+ value.id +'"><i class="fa fa-times"></i></a></span>\
                            </p>\
                            <p>'+ value.body +'</p>\
                        </div>\
                    </div>';
        $("#content-comment").html(comment);
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

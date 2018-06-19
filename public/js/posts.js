var bookId = window.location.pathname;
const postComment = 0;
const postReview = 1;
var urlReview = '/api'+ bookId +'/posts' + '?post_type=' + postReview;
var urlComment = '/api'+ bookId +'/posts' + '?post_type=' + postComment;

$(document).ready(function () {
        getListReview();
        getListComment();
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
        reviews += '<div class="review">\
                        <div class="user-img" style="background-image: url('+ value.user.avatar +')"></div>\
                        <div class="desc">\
                            <h4>\
                                <span class="text-left">'+ value.user.name +'</span>\
                                <span class="text-right">'+ value.updated_at +'</span>\
                            </h4>\
                            <p class="star">\
                                <span>'+ stars +'</span>\
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
        comment += '<div class="review">\
                        <div class="user-img" style="background-image: url('+ value.user.avatar +')"></div>\
                        <div class="desc">\
                            <h4>\
                                <span class="text-left">'+ value.user.name +'</span>\
                                <span class="text-right">'+ value.updated_at +'</span>\
                            </h4>\
                            <p>'+ value.body +'</p>\
                        </div>\
                    </div>';
        $("#content-comment").html(comment);
    });
}

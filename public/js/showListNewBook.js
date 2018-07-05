var limit = 8;
var sortBy = "created_at";
var url = "api/books?sortBy=" + sortBy + "&limit=" + limit;
$(document).ready(function () {
    getListNewBooks()
});

function getListNewBooks() {
    $.get(url, {
        _method : 'GET',
    })
    .done(function(data) {
        contentNewBook(data);
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

function contentNewBook(data) {
    var books = '';
    $.each(data.data, function (key, value) {
        if(typeof value.image_books[0] === 'undefined') {
            value.image_books[0] = {
                'image': '../storage/images/default-book.png'
            };
        }
        books += '<div class="col-md-3 text-center" >\
                    <div class="product-entry">\
                        <div class="product-img" style="background-image: url('+ value.image_books[0].image +');">\
                            <p class="tag"><span class="sale">'+ value.author +'</span></p>\
                            <div class="cart">\
                                <p>\
                                    <span><a onclick="addKeyRecommend('+ value.category_id +')" class="recommend-book" href="/books/' + value.id + '"><i class="fa fa-eye"></i></a></span>\
                                </p>\
                            </div>\
                        </div>\
                        <div class="desc">\
                            <h3><a class="recommend-book" href="/books/' + value.id + '">'+ value.title +'</a></h3>\
                        </div>\
                    </div>\
                </div>';
        $("#new-books").html(books);
    });
}

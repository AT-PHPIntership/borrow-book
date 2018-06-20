var limit = 8;
var sortBy = "created_at";
var url = "api/books?sortBy="+ sortBy +"&limit="+ limit;
$(document).ready(function () {

});

function getListCategories() {
    $.get(url, {
        _method : 'GET',
    })
    .done(function(data) {
        titleCategory(data);
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

function contentBook(data) {

    var books = '';
    $.each(data.data, function (key, value) {
        if(typeof value.image_books[0] === 'undefined') {
            value.image_books[0] = {
                'image': 'http://via.placeholder.com/150x150'
            };
        }
        books += '<div class="col-md-4 text-center" >\
                    <div class="product-entry">\
                        <div class="product-img" style="background-image: url('+ value.image_books[0].image +');">\
                            <p class="tag"><span class="sale">'+ value.author +'</span></p>\
                            <div class="cart">\
                                <p>\
                                    <span><a href="#"><i class="fa fa-eye"></i></a></span>\
                                </p>\
                            </div>\
                        </div>\
                        <div class="desc">\
                            <h3><a href="#">'+ value.title +'</a></h3>\
                        </div>\
                    </div>\
                </div>';
        $("#books").html(books);
    });
}

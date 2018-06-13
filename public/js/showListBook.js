var current_page = 1;

$(document).ready(function () {
    getListBooks();
});

function getListBooks() {
    $.get("api/books", {
        _method : 'GET',
        page: current_page
    })
    .done(function(data) {
        var total_page = data.last_page;
        if (total_page > 1) {
            $('#pagination').twbsPagination({
                totalPages: total_page,
                visiblePages: 7,
                onPageClick: function (event, pageL) {
                    if (current_page != pageL) {
                        current_page = pageL;
                        getListBooks();
                    }
                }
            });
        }
        contentBook(data);
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
        books += '<div class="col-md-3 text-center" >\
                    <div class="product-entry">\
                        <div class="product-img" style="background-image: url('+ value.image_books[0].image +');">\
                            <p class="tag"><span class="sale">'+ value.author +'</span></p>\
                            <div class="cart">\
                                <p>\
                                    <span><a href="#"></a></span>\
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

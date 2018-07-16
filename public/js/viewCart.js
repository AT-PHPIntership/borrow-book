if (!window.localStorage.getItem('access_token') || !window.localStorage.getItem('carts')) {
    $('#modal-cart').hide();
}
var borrow;
if (window.localStorage.getItem('carts')) {
    $(document).ready(function () {
        getListCart();
        checkout();
        getListRecommendCartBooks();
    });
    var books = JSON.parse(window.localStorage.getItem('carts'));
    borrowBook(books);
}

function borrowBook(books) {
    borrow = [];
    books.forEach(function (book) {
        book_data = {};
        book_data.id = book.id;
        book_data.quantity = book.quantity;
        borrow.push(book_data);
    });
}

function getListCart() {
    var itemCart = '';
    $.each(books, function (key, value) {
        itemCart = '<div class="product-cart">\
                        <div class="one-forth">\
                            <div class="product-img" style="background-image: url('+ value.image +');">\
                            </div>\
                            <div class="display-tc">\
                                <h3>'+ value.title +'</h3>\
                            </div>\
                        </div>\
                        <div class="one-eight text-center">\
                            <div class="display-tc">\
                                <input type="number" id="quantity'+ value.id +'" name="quantity" class="form-control input-number text-center" value="'+ value.quantity +'" min="1" max="'+ value.quantity_max +'">\
                            </div>\
                        </div>\
                        <div class="one-eight text-center">\
                            <div class="display-tc">\
                                <a href="#" class="closed"></a>\
                            </div>  \
                        </div>\
                        <div class="one-eight text-center">\
                            <span class="text-danger error-quantity" id="error-quantity'+ key +'" ></span>\
                        </div>\
                    </div>';
        $('.cart').append(itemCart);
        changQuantity(value.id, value.quantity, key);
    });
    
}

function checkout() {
    $('#checkout').submit( function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/api/borrow',
            headers: ({
                Accept: 'application/json',
                Authorization: 'Bearer ' + window.localStorage.getItem('access_token'),
            }),
            data: ({
                from_date: $('input[name=from_date]').val(),
                to_date: $('input[name=to_date]').val(),
                book: borrow,
            }),
            success: function() {
                localStorage.removeItem('carts');
                localStorage.removeItem('count');
                window.location.reload();
            },
            error: function(data) {
                $('.error-quantity').html('');
                if (data.responseJSON.errors) {
                    errors = Object.keys(data.responseJSON.errors);
                    let errorMessage = '';
                    errors.forEach(error => {
                        errorMessage = data.responseJSON.errors[error];
                        i = error.slice((error.indexOf('.') + 1), error.lastIndexOf('.'));
                        $('#error-quantity' + i).html(errorMessage);
                    });
                    
                }
            }
        });
    });
}

function changQuantity(id, quantity, index) {
    $(document).on('change', '#quantity' + id, function() {
        if (parseInt($(this).val()) > parseInt($(this).prop('max'))) {
            alert('The max quantity is ' + parseInt($(this).prop('max')));
            $(this).val(parseInt($(this).prop('max')));
            books[index]['quantity'] = parseInt($(this).prop('max'));
            localStorage.setItem('carts', JSON.stringify(books));
        }
        books[index]['quantity'] = parseInt($(this).val());
        localStorage.setItem('carts', JSON.stringify(books));
        var bookCarts = JSON.parse(window.localStorage.getItem('carts'));
        borrowBook(bookCarts);
    });
}

var limit = 12;
var urlRecommendCart = '/api/books?limit=' + limit;
var categoryRecommend = [];
var bookExist = [];
$.each(books, function (key, value) {
    categoryRecommend.push(value.category_id);
    bookExist.push(value.id);
});
function getListRecommendCartBooks() {
    $.ajax({
        type: 'GET',
        url: urlRecommendCart + '&category=' + categoryRecommend.toString() + '&book=' + bookExist.toString(),
        success: function(data) {
            contentRecommendCartBook(data);
        }
    });
}

function contentRecommendCartBook(data) {
    var cartRecommend = '';
    $.each(data.data, function (key, value) {
        if(typeof value.image_books[0] === 'undefined') {
            value.image_books[0] = {
                'image': '../storage/images/default-book.png'
            };
        }
        cartRecommend += '<div class="col-md-3 text-center" >\
                    <div class="product-entry">\
                        <div class="product-img" style="background-image: url('+ value.image_books[0].image +');">\
                            <p class="tag"><span class="sale">'+ value.author +'</span></p>\
                            <div class="cart">\
                                <p>\
                                    <span><a onclick="addKeyRecommend('+ value.category_id +')" class="recommend-book" href="/books/'+ value.id +'"><i class="fa fa-eye"></i></a></span>\
                                </p>\
                            </div>\
                        </div>\
                        <div class="desc">\
                            <h3><a class="recommend-book" href="/books/'+ value.id +'">'+ value.title +'</a></h3>\
                        </div>\
                    </div>\
                </div>';
        $(".recommed-cart-book").html(cartRecommend);
    });
}

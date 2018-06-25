var books = JSON.parse(window.localStorage.getItem('carts'));
var borrow = [];
if (window.localStorage.getItem('carts')) {
    books.forEach(function (book) {
        book_data = {};
        book_data.id = book.id;
        book_data.quantity = book.quantity;
        borrow.push(book_data);
    });
}
    
$(document).ready(function () {
    if (window.localStorage.getItem('carts')) {
        getListCart();
    } else {
        $('#modal-cart').hide();
    }
    checkout();
});

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
                                <input type="text" id="quantity" name="quantity" class="form-control input-number text-center" value="'+ value.quantity +'" min="1" max="100" disabled>\
                            </div>\
                        </div>\
                        <div class="one-eight text-center">\
                            <div class="display-tc">\
                                <a href="#" class="closed"></a>\
                            </div>  \
                        </div>\
                    </div>';
        $('.cart').append(itemCart);
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
                form_date: $('input[name=form_date]').val(),
                to_date: $('input[name=to_date]').val(),
                book: borrow,
            }),
            success: function() {
                localStorage.removeItem('carts');
                localStorage.removeItem('count');
                window.location.reload();
            },
            error: function(data) {
                alert(data.responseJSON.message);
            }
        });
    });
}

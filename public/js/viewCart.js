if (!window.localStorage.getItem('access_token') || !window.localStorage.getItem('carts')) {
    $('#modal-cart').hide();
}

if (window.localStorage.getItem('carts')) {
    $(document).ready(function () {
        getListCart();
        checkout();
        changQuantity();
    });
    var books = JSON.parse(window.localStorage.getItem('carts'));
    var borrow = [];
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
                alert(data.responseJSON.message);
            }
        });
    });
}

function changQuantity() {
    $(document).on('change', '.input-number', function() {
        if (parseInt($(this).val()) > parseInt($(this).prop('max'))) {
            alert('The max quantity is ' + parseInt($(this).prop('max')));
            $(this).val(parseInt($(this).prop('max')));
        }
    });
}

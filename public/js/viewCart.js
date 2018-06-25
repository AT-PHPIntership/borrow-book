var books = JSON.parse(window.localStorage.getItem('carts'));
$(document).ready(function () {
    getListCart();
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

console.log(books);
function register() {
    $('#checkout').submit( function() {
        // $.ajax({
        //     type: 'POST',
        //     url: '/api/borrow',
        //     headers: ({
        //         Accept: 'application/json',
        //         Authorization: 'Bearer ' + window.localStorage.getItem('access_token'),
        //     }),
        //     data: ({
        //         form_date: $('#input[name=form_date]').val(),
        //         to_date: $('#input[name=to_date]').val(),
        //         number_book: 
        //     }),
        // });
    });
}

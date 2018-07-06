var item = [];
var cartProduct = [];
var exists = false;
var n = 0;
numberItem();

function numberItem() {
  if (localStorage.count) {
    document.getElementById('number-item').innerHTML = localStorage.count;
  }
}
$(document).on('click', '.borrowing', function() {
    item = {
        id: $('#book-id').val(),
        title: $('#title').text(),
        image: $('#product-img').css('background-image').replace('url(','').replace(')','').replace(/\"/gi, ""),
        quantity: $('#quantity').val(),
        quantity_max: $('#quantity').prop('max'),
        category_id: $('#category').attr('data-category-id')
    };
    $('.product-detail-wrap').hide().fadeIn(3000);
    if (localStorage.carts) {
        cartProduct = JSON.parse(localStorage.carts);
        $.each(cartProduct, function(index, value) {
            if (value.id == item.id) {
                value.quantity = parseInt(value.quantity) + parseInt(item.quantity);                    
                exists = true;
                return false;
            }
        });
    }
    if(!exists) {
        cartProduct.push(item);
        window.localStorage.setItem('carts', JSON.stringify(cartProduct));
        n = cartProduct.length;
        localStorage.setItem('count', n);
    }
    numberItem();
    window.localStorage.setItem('carts', JSON.stringify(cartProduct));
});

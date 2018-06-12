$("document").ready(function() {
    $.get("api/books", function(data) {
        data.data.forEach(function(book) {
            if(typeof book.image_limit_books[0] === 'undefined') {
                book.image_limit_books[0] = {
                    'image': 'http://via.placeholder.com/150x150'
                };
            }
            $('#books').append(
                    '<div class="col-md-3 text-center" >\
                        <div class="product-entry">\
                            <div class="product-img" style="background-image: url('+ book.image_limit_books[0].image +');">\
                                <p class="tag"><span class="sale">'+ book.author +'</span></p>\
                                <div class="cart">\
                                    <p>\
                                        <span><a href="#"></a></span>\
                                    </p>\
                                </div>\
                            </div>\
                            <div class="desc">\
                                <h3><a href="#">'+ book.title +'</a></h3>\
                            </div>\
                        </div>\
                    </div>'
            );
        });
    });

});

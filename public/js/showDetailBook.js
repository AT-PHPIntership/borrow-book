url = window.location.pathname;
var id = url.substring(url.lastIndexOf('/') + 1);
$.ajax({
    url: "/api/books/" + id,
    type: "get",
    success: function( data ) {
        let img='', imgItem='';
        if (typeof data.image_books[0] === 'undefined') {
            data.image_books[0] = {
                'image': '../storage/images/default-book.png'
            };
            img += '<div id="product-img" class="product-img" style="background-image: url(' + data.image_books[0].image + ');"></div>';
        } else {
            img += '<div id="product-img" class="product-img" style="background-image: url(' + data.image_books[0].image + ');"></div>';
            for(var i = 1; i < data.image_books.length; i++ ) {                
                imgItem += '<a href="#" class="thumb-img" style="background-image: url(' + data.image_books[i].image + ');"></a>';
            }
        }
        $('.product-img').html(img);
        $('.thumb-nail').html(imgItem);
        $('#title').text(data.title);
        $('#author').text(data.author);
        $('#description').append(data.description);
        $('#rating').append(data.count_rate);
        $('#category').append(data.category.name);
        $('#category').attr('data-category-id', data.category_id);
        $('#number_of_page').append(data.number_of_page);
        $('#language').append(data.language);
        $('#publishing_year').append(data.publishing_year);
        $('#quantity').attr('max', data.quantity);
        $('#book-id').attr('value', data.id);
    }
});

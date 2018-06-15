url = window.location.pathname;
var id = url.substring(url.lastIndexOf('/') + 1);
$.ajax({
    url: "/api/books/" + id,
    type: "get",
    success: function( data ) {
        for(var i = 0; i <= 3; i++){
            if(typeof data.image_books[i] === 'undefined') {
                data.image_books[i] = {
                    'image': 'http://via.placeholder.com/150x150'
                };
            }
        }
        let img = '';
        img += '<div class="product-img" style="background-image: url(' + data.image_books[0].image + ');">\
                </div>\
                <div class="thumb-nail">\
                    <a href="#" class="thumb-img" style="background-image: url(' + data.image_books[1].image + ');"></a>\
                    <a href="#" class="thumb-img" style="background-image: url(' + data.image_books[2].image + ');"></a>\
                    <a href="#" class="thumb-img" style="background-image: url(' + data.image_books[3].image + ');"></a>\
                </div>'; 
        $('.product-entry').append(img);
        $('#title').text(data.title);
        $('#author').text(data.author);
        $('#description').text(data.description);
        $('#rating').append(data.count_rate);
        $('#category').append(data.category.name);
        $('#number_of_page').append(data.number_of_page);
        $('#language').append(data.language);
        $('#publishing_year').append(data.publishing_year);
    }
});

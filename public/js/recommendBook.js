var recommend = [];
var limit = 12;
var urlRecommend = '/api/books?limit=' + limit;
function addKeyRecommend(value) {
    if (typeof recommend !== 'undefined') {
        recommend = value;
        localStorage.setItem('recommend', JSON.stringify(recommend));
    }
}

function getKeyRecommend() {
    keyRecommend = JSON.parse(localStorage.getItem('recommend'));
    if (typeof keyRecommend == 'number') {
        urlRecommend += '&category=' + keyRecommend;
    } else if (typeof keyRecommend == 'string') {
        urlRecommend += '&search=' + keyRecommend;
    }
}

$(document).ready(function () {
    getKeyRecommend();
    getListRecommendBooks();
});


function getListRecommendBooks() {
    $.ajax({
        type: 'GET',
        url: urlRecommend,
        success: function(data) {
            contentRecommendBook(data);
        }
    });
}

function contentRecommendBook(data) {
    var books = '';
    $.each(data.data, function (key, value) {
        if(typeof value.image_books[0] === 'undefined') {
            value.image_books[0] = {
                'image': '../storage/images/default-book.png'
            };
        }
        books += '<div class="col-md-3 text-center" >\
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
        $(".recommend-list-book").html(books);
    });
}

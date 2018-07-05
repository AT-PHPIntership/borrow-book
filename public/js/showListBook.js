var current_page = 1;
var limit = 12;
var url = '/api/books';
if (window.location.search != '') {
    url += window.location.search + '&limit=' + limit;
} else {
    url += '?limit=' + limit;
}
var category = [];
$(document).ready(function () {
    getListBooks();
    getListCategoriesFilter();
});

function getListBooks() {
    $.get(url, {
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
        $("#books").html('<h4 class="text-center h1">Not Found</h4>');
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
                'image': '../storage/images/default-book.png'
            };
        }
        books += '<div class="col-md-4 text-center" >\
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
        $("#books").html(books);
    });
}

function getListCategoriesFilter() {
    $.get("/api/categories", {
        _method : 'GET',
    }).done(function(data) {
        contentCategory(data);
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

function contentCategory(data) {
    var categories = '';
    $.each(data.data, function (key, value) {
        categories +=   '<div class="checkbox">\
                        <label><input name="category" type="checkbox" onclick="filterCategory(this.value)" id="checkCategory'+ value.id +'" value="'+ value.id +'">'+ value.name +'</label>\
                        </div>';
        $("#filter-categories").html(categories);
    });
}

function filterCategory(value) {
    if ($('#checkCategory' + value).is(':checked')) {
        $('#checkCategory' + value).attr('disabled','disabled');
        category.push(value);
        url += '&category=' + category.toString();
        getListBooks(url)
    }
}

$("#filter-language").on("click", function filterLanguage() {
    if ($('#filter-language option').is(':selected')) {
        var language = $('#filter-language option:selected').val();
        url += '&language=' + language;
        getListBooks(url);
    }
});

$(".number-of-page").on("click", function filterNumberPage() {
    from = $('#from').val();
    to = $('#to').val();
    url += '&number_of_page=' + from + ',' + to;
    getListBooks(url);
});

$("#filter-search").submit(function filterSearch(event) {
    event.preventDefault();
    search = $('#search').val();
    url += '&search=' + search;
    getListBooks(url);
    addKeyRecommend(search);
});

$(".reset-filter").on('click', function resetFilter() {
    window.location.reload();
});

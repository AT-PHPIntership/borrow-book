$(document).ready(function () {
    getListCategories();
});

function getListCategories() {
    $.get("api/categories", {
        _method : 'GET',
        page: current_page
    })
    .done(function(data) {
        titleCategory(data);
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

function titleCategory(data) {
    var categories = '';
    $.each(data.data, function (key, value) {
        categories += '<li role="presentation" class="category-item"><a role="menuitem" tabindex="-1" href="#">'+ value.name +'</a></li>';
        $(".category-list").html(categories);
    });
} 

$(document).ready(function(){
    var category, arr_category;
    $(".button-edit-category").click(function(){
        $(".update-category").attr("class", "col-md-6 update-category");
        $(".create-category").attr("class", "col-md-6 create-category hidden");
        category = $(this).attr("data-category");
        arr_category = JSON.parse(category);
        $("#category-update").val(arr_category['name']);
    });
    $("button[name='update-btn']").click( function (event) {
        event.preventDefault();
        $.ajax({
            url: 'admin/categories/'+arr_category['id'],
            type: 'PATCH',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: {
                "name": $("input[name='categoryName']").val()
            },
            success: function(data) {
                $("#"+arr_category['id']).html(data['category'].name);
                $(".update-category").attr("class", "col-md-6 update-category hidden");
                $(".create-category").attr("class", "col-md-6 create-category");
                $(".update-notice").html(data.msg);
                $(".update-notice").attr("class", "alert alert-success update-notice");
            },
            statusCode: {
                422: function(data) {
                    $(".update-notice").html(data.responseJSON.errors.name);
                    $(".update-notice").attr("class", "alert alert-danger update-notice");
                }
            }
        });
    });
});
